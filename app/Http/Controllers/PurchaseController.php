<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Purchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class PurchaseController extends Controller
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

            $purchases = Purchase::join('purchase_orders','purchases.id','=','purchase_orders.purchase_id')
                                ::join('products','purchase_orders.product_id','=','products.id')
                                ->whereIn('purchases.status_id',$statuses_ids)
                                ->where('products.name','LIKE','%'.$request->name.'%')
                                ->whereBetween('purchases.created_ay',[$request->from,$request->to])
                                ->select('purchases.*')
                                ->orderBy('purchases.created_ay','DESC')
                                ->orderBy('status_id','ASC')
                                ->get();
                        
            return view('purchase.serch',compact('purchases'));
        }

        $statuses = Status::all();

        $purchases = Purchase::where('status_id',getStatusID('Active'))
                                ->get();
        
        return view('purchase.index',compact('purchases','statuses'));
    }

    public function create()
    {
        return view('purchase.create');
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name'      => 'required|min:3|max:20',
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
            $purchase = Purchase::create([
                'status_id' => getStatusID('Active'),
                'admin_id'  => Auth::user()->id,
                'name'      => $data['name'],
                'balance'   => $data['balance'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'purchase created successfully',
                'route'     => route('purchases.show',$purchase),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(Purchase $purchase)
    {
        return view('purchase.show',compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $statuses = Status::all();

        return view('purchase.edit',compact('purchase','statuses'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $data = Validator::make($request->all(),[
            'status_id' => 'required|exists:statuses,id,'.getStatusID('Deleted'),
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
            $purchase->status_id = $data['status_id'];

            $purchase->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'purchase updated successfully',
                'route'     => route('purchases.show',$purchase),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,Purchase $purchase)
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
                $purchase->status_id = getStatusID('Deleted');

                $purchase->save();
            }
            
            else{
                $purchase->delete();
            }

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Purchase deleted successfully',
                'route'     => route('purchases.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
