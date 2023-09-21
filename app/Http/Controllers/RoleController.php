<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if(!array_key_exists('key',$request->all())){
        
            $roles = Role::all();            
            return view('role.index',compact('roles'));
        }

        else if(strcmp($request->key,'search') == 0){
            $roles = Role::where('name','LIKE','%'.$request->search.'%')
                            ->get();
                        
            return view('role.search',compact('roles'));
        } 
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required|min:3|max:20|unique:roles,name',
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

            Role::create([
                'name' => $data['name'],
            ]);

            DB::commit();

            Session::flash('role_created','Role created successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('roles.index'),
            ]);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function edit(Role $role)
    {
        $allPermissions = Permission::all();

        $grantedPermissions = $role->permissions;

        $commonPermissions = array();

        foreach($allPermissions as $ap){
            foreach($grantedPermissions as $gp){
                if($ap->id == $gp->id){
                    array_push($commonPermissions,$ap->id);
                }
            }
        }

        // dd($commonPermissions);

        return view('role.edit',compact('role','allPermissions','grantedPermissions','commonPermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required|min:3|max:20|unique:roles,name,'.$role->id,
            'permission_ids.*' => 'required|exists:permissions,id',
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

            $role->name = $data['name'];

            $role->syncPermissions($data['permission_ids']);

            $role->save();

            DB::commit();

            Session::flash('role_updated','Role updated successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('roles.index'),
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
    
    public function destroy(Role $role)
    {
        DB::beginTransaction();

        try{
            $role->delete();

            DB::commit();

            Session::flash('role_deleted','Role deleted successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('roles.index'),
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
