<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Status;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if(strcmp($request->key,'search')){
            $statuses_ids = '';
            $categories_ids = '';

            if(strcmp($request->status_id,'All')==0){
                $statuses_ids = getNonDeletedStatusesIds();
            }

            else{
                $statuses_ids = $request->status_id;
            }
            
            if(strcmp($request->category_id,'All')==0){
                $categories_ids = getNonDeletedStatusesIds();
            }

            else{
                $categories_ids = $request->category_id;
            }

            $products = Product::whereIn('status_id',$statuses_ids)
                                ->whereIn('category_id',$categories_ids)
                                ->where('name','LIKE','%'.$request->name.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->orderBy('category_id','ASC')
                                ->get();
                        
            return view('Product.serch',compact('Products'));
        }

        $statuses = Status::all();
        $categories = Category::all();

        $products = Product::where('status_id',getStatusID('Active'))
                            ->get();
        
        return view('Product.index',compact('Products','statuses','categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('Product.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|min:3|max:20',
            'units'         => 'required|numeric',
            'price'         => 'required|numeric',
            'details'       => 'nullable|string|max:500',
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'errors',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        DB::beginTransaction();

        try{
            $product = Product::create([
                'status_id'     => getStatusID('Active'),
                'admin_id'      => Auth::user()->id,
                'category_id'   => $data['category_id'],
                'name'          => $data['name'],
                'units'         => $data['units'],
                'price'         => $data['price'],
                'details'       => $data['details'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Product created successfully',
                'route'     => route('Products.show',$product),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(Product $product)
    {
        return view('Product.show',compact('Product'));
    }

    public function edit(Product $product)
    {
        $statuses = Status::all();
        $categories = Category::all();

        return view('Product.edit',compact('Product','statuses','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = Validator::make($request->all(),[
            'status_id'     => 'required|exists:statuses,id,'.getStatusID('Deleted'), 
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|min:3|max:20',
            'units'         => 'required|numeric',
            'price'         => 'required|numeric',
            'details'       => 'nullable|string|max:500',
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'errors',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        DB::beginTransaction();

        try{
            $product->status_id     = $data['status_id'];
            $product->admin_id      = Auth::user()->id;
            $product->name          = $data['name'];
            $product->category_id   = $data['category_id'];
            $product->units         = $data['units'];
            $product->price         = $data['price'];
            $product->details       = $data['details'];

            $product->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Product updated successfully',
                'route'     => route('Products.show',$product),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,Product $product)
    {
        $data = Validator::make($request->all(),[
            'password' => [
                'required',Password::min(8)
                                    ->letters()
                                    ->mixedCase()
                                    ->numbers()
                                    ->symbols()
                                    ->uncompromised(),
            ]
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'error',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        if(!Hash::check($data['password'],Auth::user()->password)){
            return response()->json([
                'status'    => 'error',
                'message'   => 'Incorrect password',
            ]);
        }

        DB::beginTransaction();

        try{
            if(strcmp($request->soft_delete,'true')==0){
                $product->status_id = getStatusID('Deleted');

                $product->save();
            }
            
            else{
                $product->delete();
            }

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Product deleted successfully',
                'route'     => route('Products.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
