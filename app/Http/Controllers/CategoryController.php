<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Categories Index'])->only(['index']);
        $this->middleware(['permission:Categories Create'])->only(['create','store']);
        $this->middleware(['permission:Categories Edit'])->only(['edit','update']);
        $this->middleware(['permission:Categories Delete'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        if(array_key_exists('key',$request->all())){
            $statuses_ids = '';

            if(strcmp($request->status_id,'All')==0){
                $statuses_ids = getNonDeletedStatusesIds();
            }

            else{
                $statuses_ids = [$request->status_id];
            }

            $categories = Category::whereIn('status_id',$statuses_ids)
                                ->where('name','LIKE','%'.$request->search.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->paginate($request->row_count);
                        
            return view('category.search',compact('categories'));
        }

        $statuses = Status::all();

        $categories = Category::where('status_id',getStatusID('Active'))
                            ->paginate(10);
        
        return view('category.index',compact('categories','statuses'));
    }

    public function create()
    {
        return view('category.create');
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

            Session::flash('category_added','Category created successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('categories.show',$category->id),
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
        return view('category.show',compact('category'));
    }

    public function edit(Category $category)
    {
        $statuses = Status::where('name','!=','Deleted')->get();

        if($category->status_id == getDeletedStatusId()){
            $statuses = Status::all();
        }

        return view('category.edit',compact('category','statuses'));
    }

    public function update(Request $request, Category $category)
    {
        $data = Validator::make($request->all(),[
            'status_id' => 'required|exists:statuses,id', 
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

            Session::flash('category_updated','Category updated successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('categories.show',$category->id),
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
                $category->status_id = getStatusID('Deleted');

                $category->save();
            }
            
            else{
                $category->delete();
            }

            DB::commit();

            Session::flash('category_deleted','Category deleted successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('categories.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
