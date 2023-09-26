<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Status;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Accounts Index'])->only(['index']);
        $this->middleware(['permission:Accounts Create'])->only(['create','store']);
        $this->middleware(['permission:Accounts Edit'])->only(['edit','update']);
        $this->middleware(['permission:Accounts Delete'])->only(['destroy']);
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

            $accounts = Account::whereIn('status_id',$statuses_ids)
                                ->where('name','LIKE','%'.$request->search.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->paginate($request->row_count);
                        
            return view('account.search',compact('accounts'));
        }

        $statuses = Status::all();

        $accounts = Account::where('status_id',getStatusID('Active'))
                            ->paginate(10);
        
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

            Session::flash('account_created','Account created successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('accounts.show',$account->id),
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
        $statuses = Status::where('name','!=','Deleted')->get();

        if($account->status_id == getDeletedStatusId()){
            $statuses = Status::all();
        }

        return view('account.edit',compact('account','statuses'));
    }

    public function update(Request $request, Account $account)
    {
        $data = Validator::make($request->all(),[
            'status_id' => 'required|exists:statuses,id', 
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

            Session::flash('account_updated','Account updated successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('accounts.show',$account->id),
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
