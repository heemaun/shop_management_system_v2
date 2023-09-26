<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Status;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Products Index'])->only(['index']);
        $this->middleware(['permission:Products Create'])->only(['create','store']);
        $this->middleware(['permission:Products Edit'])->only(['edit','update']);
        $this->middleware(['permission:Products Delete'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        if(array_key_exists('key',$request->all())){
            $statuses_ids = '';
            $categories_ids = array();

            if(strcmp($request->status_id,'All')==0){
                $statuses_ids = getNonDeletedStatusesIds();
            }

            else{
                $statuses_ids = [$request->status_id];
            }
            
            if(strcmp($request->category_id,'All')==0){
                $categories = Category::all();

                foreach($categories as $category){
                    array_push($categories_ids,$category->id);
                }
            }

            else{
                $categories_ids = [$request->category_id];
            }

            $products = Product::whereIn('status_id',$statuses_ids)
                                ->whereIn('category_id',$categories_ids)
                                ->where('name','LIKE','%'.$request->search.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->orderBy('category_id','ASC')
                                ->paginate($request->row_count);
                        
            return view('product.search',compact('products'));
        }

        $statuses = Status::all();
        $categories = Category::all();

        $products = Product::where('status_id',getStatusID('Active'))
                            ->paginate(10);
        
        return view('product.index',compact('products','statuses','categories'));
    }

    public function create()
    {
        $categories = Category::where('status_id',getStatusID('Active'))
                                ->get();

        return view('product.create',compact('categories'));
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

            Session::flash('product_added','Product added successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('products.show',$product->id),
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
        return view('product.show',compact('product'));
    }

    public function edit(Product $product)
    {
        $statuses = Status::where('name','!=','Deleted')->get();

        if($product->status_id == getDeletedStatusId()){
            $statuses = Status::all();
        }

        $categories = Category::all();

        return view('product.edit',compact('product','statuses','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = Validator::make($request->all(),[
            'status_id'     => 'required|exists:statuses,id', 
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|min:3|max:20',
            'units'         => 'required|numeric',
            'price'         => 'required|numeric',
            'details'       => 'nullable|string|max:500',
        ],$messages = [],$attributes = [
            'category_id' => 'category',
            'status_id' => 'status',
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

            Session::flash('product_updated','Product updated successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('products.show',$product->id),
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
                'required',Password::min(8),
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

            Session::flash('product_deleted','Product deleted successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('products.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
