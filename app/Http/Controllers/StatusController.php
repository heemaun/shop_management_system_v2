<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        if(strcmp($request->key,'search')){
            $statuses = Status::where('name','LIKE','%'.$request->name.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->get();
                        
            return view('status.serch',compact('statuses'));
        }

        $statuses = Status::all();
        
        return view('status.index',compact('statuses'));
    }

    public function create()
    {
        return view('status.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name'      => 'required|min:3|max:20',
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'ererrorsror',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        DB::beginTransaction();

        try{
            $status = Status::create([
                'name' => $data['name'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Status created successfully',
                'route'     => route('statuses.show',$status),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(Status $status)
    {
        return view('status.show',compact('status'));
    }

    public function edit(Status $status)
    {
        $statuses = Status::all();

        return view('status.edit',compact('status','statuses'));
    }

    public function update(Request $request, Status $status)
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
            $status->name = $data['name'];

            $status->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Status updated successfully',
                'route'     => route('statuses.show',$status),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,Status $status)
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
            $status->delete();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Status deleted successfully',
                'route'     => route('statuses.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
