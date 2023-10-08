<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sell;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SellController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Sells Index'])->only(['index']);
        $this->middleware(['permission:Sells Create'])->only(['create','store']);
        $this->middleware(['permission:Sells Edit'])->only(['edit','update']);
        $this->middleware(['permission:Sells Delete'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        if(array_key_exists('key',$request->all())){
            // return response()->json([
            //     'request' => $request->all(),
            // ]);
            if(strcmp($request->key,'customer_search')==0){               
                if(empty($request->customer_name)){
                    $customers = User::whereHas(
                                            'roles', function($query){
                                                $query->where('name','Customer');
                                            }
                                        )
                                        ->orderBy('name')
                                        ->limit(10)
                                        ->get();
                }

                else{
                    $customers = User::whereHas(
                                            'roles', function($query){
                                                $query->where('name','Customer');
                                            }
                                        )
                                        ->where(function($query) use($request){
                                            $query->where('name','LIKE','%'.$request->customer_name.'%')
                                                    ->orWhere('username','LIKE','%'.$request->customer_name.'%')
                                                    ->orWhere('phone','LIKE','%'.$request->customer_name.'%')
                                                    ->orWhere('email','LIKE','%'.$request->customer_name.'%')
                                                    ->orWhere('id',$request->customer_name);
                                        })
                                        ->orderBy('name')
                                        ->limit(10)
                                        ->get();
                }

                // return response()->json([
                //     'customers' => $customers,
                // ]);
                return view('sell.customer-datalist',compact('customers'));
            }

            else{
                $statuses_ids = '';
                $customers_ids = '';

                if(strcmp($request->status_id,'All')==0){
                    $statuses_ids = getNonDeletedStatusesIds();
                }

                else{
                    $statuses_ids = [$request->status_id];
                }
                
                if(array_key_exists('customer_id',$request->all())){
                    $sells = Sell::whereIn('status_id',$statuses_ids)
                                    ->where('customer_id',$request->customer_id)
                                    ->whereBetween('created_at',[$request->from_date,$request->to_date.' 23:59:59'])
                                    ->orderBy('created_at','DESC')
                                    ->orderBy('status_id','ASC')
                                    ->paginate($request->row_count);
                }

                else{
                    $sells = Sell::whereIn('status_id',$statuses_ids)
                                    ->whereBetween('created_at',[$request->from_date,$request->to_date.' 23:59:59'])
                                    ->orderBy('created_at','DESC')
                                    ->orderBy('status_id','ASC')
                                    ->paginate($request->row_count);
                }
                            
                return view('sell.search',compact('sells'));
            }            
        }

        $statuses = Status::all();

        $sells = Sell::where('status_id',getStatusID('Active'))
                            ->orderBy('created_at','DESC')
                            ->orderBy('status_id','ASC')
                            ->paginate(10);
        $fromDate = Sell::orderBy('created_at','ASC')
                    ->first()->created_at;
        $toDate = Sell::orderBy('created_at','DESC')
                    ->first()->created_at;

        $fromDate = date('Y-m-d',(strtotime($fromDate) - (24*60*60)));
        $toDate = date('Y-m-d',(strtotime($toDate) + (24*60*60)));

        $customers = User::whereHas(
                                'roles', function($query){
                                    $query->where('name','Customer');
                                }
                            )
                            ->orderBy('name')
                            ->limit(10)
                            ->get();

        // dd($customers);
        
        return view('sell.index',compact('sells','statuses','fromDate','toDate','customers'));
    }

    public function create()
    {
        return view('sell.create');
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
            $sell = Sell::create([
                'status_id' => getStatusID('Active'),
                'admin_id'  => Auth::user()->id,
                'name'      => $data['name'],
                'balance'   => $data['balance'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Sell created successfully',
                'route'     => route('sells.show',$sell),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(Sell $sell)
    {
        return view('sell.show',compact('sell'));
    }

    public function edit(Sell $sell)
    {
        $statuses = Status::all();

        return view('sell.edit',compact('sell','statuses'));
    }

    public function update(Request $request, Sell $sell)
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
            $sell->status_id = $data['status_id'];
            $sell->admin_id  = Auth::user()->id;
            $sell->name      = $data['name'];
            $sell->balance   = $data['balance'];

            $sell->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Sell updated successfully',
                'route'     => route('sells.show',$sell),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,Sell $sell)
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
                $sell->status_id = getStatusID('Deleted');

                $sell->save();
            }
            
            else{
                $sell->delete();
            }

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Sell deleted successfully',
                'route'     => route('sells.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
