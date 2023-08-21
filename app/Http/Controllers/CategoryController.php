<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if(strcmp($request->key,'search')){
            $statuses_ids = '';

            if(strcmp($request->status_id,'All')==0){
                $statuses_ids = getNonDeletedStatusesIds();
            }

            else{
                $statuses_ids = $request->status_id;
            }

            $categories = Category::whereIn('status_id',$statuses_ids)
                                ->where('name','LIKE','%'.$request->name.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->get();
                        
            return view('Category.serch',compact('Categories'));
        }

        $statuses = Status::all();

        $categories = Category::where('status_id',getStatusID('Active'))
                            ->get();
        
        return view('Category.index',compact('Categories','statuses'));
    }

    public function create()
    {
        return view('Category.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required|min:3|max:20',
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
            $category = Category::create([
                'status_id' => getStatusID('Active'),
                'admin_id'  => Auth::user()->id,
                'name'      => $data['name'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Category created successfully',
                'route'     => route('Categories.show',$category),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(Category $category)
    {
        return view('Category.show',compact('Category'));
    }

    public function edit(Category $category)
    {
        $statuses = Status::all();

        return view('Category.edit',compact('Category','statuses'));
    }

    public function update(Request $request, Category $category)
    {
        $data = Validator::make($request->all(),[
            'status_id' => 'required|exists:statuses,id,'.getStatusID('Deleted'), 
            'name'      => 'required|min:3|max:20',
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
            $category->status_id = $data['status_id'];
            $category->admin_id  = Auth::user()->id;
            $category->name      = $data['name'];

            $category->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Category updated successfully',
                'route'     => route('Categories.show',$category),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,Category $category)
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
                $category->status_id = getStatusID('Deleted');

                $category->save();
            }
            
            else{
                $category->delete();
            }

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Category deleted successfully',
                'route'     => route('Categories.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
