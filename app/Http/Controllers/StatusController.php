<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Statuses Index'])->only(['index']);
        $this->middleware(['permission:Statuses Create'])->only(['create','store']);
        $this->middleware(['permission:Statuses Edit'])->only(['edit','update']);
        $this->middleware(['permission:Statuses Delete'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        if(array_key_exists('key',$request->all())){
            $statuses = Status::where('name','LIKE','%'.$request->search.'%')
                                ->orderBy('name','ASC')
                                ->paginate($request->row_count);
                        
            return view('status.search',compact('statuses'));
        }

        $statuses = Status::paginate(10);
        
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

            Session::flash('status_created','Status created successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('statuses.show',$status->id),
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
        return view('status.edit',compact('status'));
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

            Session::flash('status_updated','Status updated successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('statuses.show',$status->id),
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
            $status->delete();

            DB::commit();

            Session::flash('status_deleted','Status deleted successfully');

            return response()->json([
                'status'    => 'success',
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
