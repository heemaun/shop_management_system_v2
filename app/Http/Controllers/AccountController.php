<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Account;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class AccountController extends Controller
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

            $accounts = Account::whereIn('status_id',$statuses_ids)
                                ->where('name','LIKE','%'.$request->name.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->get();
                        
            return view('account.serch',compact('accounts'));
        }

        $statuses = Status::all();

        $accounts = Account::where('status_id',getStatusID('Active'))
                            ->get();
        
        return view('account.index',compact('accounts','statuses'));
    }

    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name'      => 'required|min:3|max:20',
            'balance'   => 'required|numeric',
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
            $account = Account::create([
                'status_id' => getStatusID('Active'),
                'admin_id'  => Auth::user()->id,
                'name'      => $data['name'],
                'balance'   => $data['balance'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Account created successfully',
                'route'     => route('accounts.show',$account),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(Account $account)
    {
        return view('account.show',compact('account'));
    }

    public function edit(Account $account)
    {
        $statuses = Status::all();

        return view('account.edit',compact('account','statuses'));
    }

    public function update(Request $request, Account $account)
    {
        $data = Validator::make($request->all(),[
            'status_id' => 'required|exists:statuses,id,'.getStatusID('Deleted'), 
            'name'      => 'required|min:3|max:20',
            'balance'   => 'required|numeric',
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
            $account->status_id = $data['status_id'];
            $account->admin_id  = Auth::user()->id;
            $account->name      = $data['name'];
            $account->balance   = $data['balance'];

            $account->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Account updated successfully',
                'route'     => route('accounts.show',$account),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,Account $account)
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
                $account->status_id = getStatusID('Deleted');

                $account->save();
            }
            
            else{
                $account->delete();
            }

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Account deleted successfully',
                'route'     => route('accounts.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
