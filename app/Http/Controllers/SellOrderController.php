<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\SellOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class SellOrderController extends Controller
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

            $sellorders = SellOrder::whereIn('status_id',$statuses_ids)
                                ->where('name','LIKE','%'.$request->name.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->get();
                        
            return view('sellorder.serch',compact('sellorders'));
        }

        $statuses = Status::all();

        $sellorders = SellOrder::where('status_id',getStatusID('Active'))
                            ->get();
        
        return view('sellorder.index',compact('sellorders','statuses'));
    }

    public function create()
    {
        return view('sellorder.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name'      => 'required|min:3|max:20',
            'balance'   => 'required|numeric',
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'error',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        DB::beginTransaction();

        try{
            $sellorder = SellOrder::create([
                'status_id' => getStatusID('Active'),
                'admin_id'  => Auth::user()->id,
                'name'      => $data['name'],
                'balance'   => $data['balance'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'SellOrder created successfully',
                'route'     => route('sellorders.show',$sellorder),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(SellOrder $sellorder)
    {
        return view('sellorder.show',compact('sellorder'));
    }

    public function edit(SellOrder $sellorder)
    {
        $statuses = Status::all();

        return view('sellorder.edit',compact('sellorder','statuses'));
    }

    public function update(Request $request, SellOrder $sellorder)
    {
        $data = Validator::make($request->all(),[
            'status_id' => 'required|exists:statuses,id,'.getStatusID('Deleted'), 
            'name'      => 'required|min:3|max:20',
            'balance'   => 'required|numeric',
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'error',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        DB::beginTransaction();

        try{
            $sellorder->status_id = $data['status_id'];
            $sellorder->admin_id  = Auth::user()->id;
            $sellorder->name      = $data['name'];
            $sellorder->balance   = $data['balance'];

            $sellorder->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'SellOrder updated successfully',
                'route'     => route('sellorders.show',$sellorder),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,SellOrder $sellorder)
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
                $sellorder->status_id = getStatusID('Deleted');

                $sellorder->save();
            }
            
            else{
                $sellorder->delete();
            }

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'SellOrder deleted successfully',
                'route'     => route('sellorders.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
