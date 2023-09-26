<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Status;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Transactions Index'])->only(['index']);
        $this->middleware(['permission:Transactions Create'])->only(['create','store']);
        $this->middleware(['permission:Transactions Edit'])->only(['edit','update']);
        $this->middleware(['permission:Transactions Delete'])->only(['destroy']);
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

            $transactions = Transaction::whereIn('status_id',$statuses_ids)
                                ->where('name','LIKE','%'.$request->search.'%')
                                ->orderBy('name','ASC')
                                ->orderBy('status_id','ASC')
                                ->paginate($request->row_count);
                        
            return view('transaction.search',compact('transactions'));
        }

        $statuses = Status::all();

        $transactions = Transaction::where('status_id',getStatusID('Active'))
                            ->paginate(10);
        
        return view('transaction.index',compact('transactions','statuses'));
    }

    public function create()
    {
        return view('transaction.create');
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
            $transaction = Transaction::create([
                'status_id' => getStatusID('Active'),
                'admin_id'  => Auth::user()->id,
                'name'      => $data['name'],
                'balance'   => $data['balance'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Transaction created successfully',
                'route'     => route('transactions.show',$transaction),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(Transaction $transaction)
    {
        return view('transaction.show',compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $statuses = Status::all();

        return view('transaction.edit',compact('transaction','statuses'));
    }

    public function update(Request $request, Transaction $transaction)
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
            $transaction->status_id = $data['status_id'];
            $transaction->admin_id  = Auth::user()->id;
            $transaction->name      = $data['name'];
            $transaction->balance   = $data['balance'];

            $transaction->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Transaction updated successfully',
                'route'     => route('transactions.show',$transaction),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,Transaction $transaction)
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
                $transaction->status_id = getStatusID('Deleted');

                $transaction->save();
            }
            
            else{
                $transaction->delete();
            }

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Transaction deleted successfully',
                'route'     => route('transactions.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
