<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if(!array_key_exists('key',$request->all())){
        
            $permissions = Permission::paginate(10);            
            return view('permission.index',compact('permissions'));
        }

        else if(strcmp($request->key,'search') == 0){
            $permissions = Permission::where('name','LIKE','%'.$request->search.'%')
                            ->paginate($request->row_count);
                        
            return view('permission.search',compact('permissions'));
        } 
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required|min:3|max:20|unique:permissions,name',
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'errors',
                'message'   => $data->errors(),
            ]);
        }

        DB::beginTransaction();

        try{
            $data = $data->valid();

            Permission::create([
                'name' => $data['name'],
            ]);

            DB::commit();

            Session::flash('permission_created','Permission created successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('permissions.index'),
            ]);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function edit(Permission $permission)
    {      
        return view('permission.edit',compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required|min:3|max:20|unique:permissions,name,'.$permission->id,
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'errors',
                'message'   => $data->errors(),
            ]);
        }

        DB::beginTransaction();

        try{
            $data = $data->validate();

            $permission->name = $data['name'];

            $permission->save();

            DB::commit();

            Session::flash('permission_updated','Permission updated successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('permissions.index'),
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
    
    public function destroy(Permission $permission)
    {
        DB::beginTransaction();

        try{
            $permission->delete();

            DB::commit();

            Session::flash('permission_deleted','Permission deleted successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('permissions.index'),
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
