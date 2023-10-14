<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Status;
use App\Models\Product;
use App\Models\SellOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
            'product_id'    => 'required|exists:products,id',
            'units'         => 'required|numeric|min:1',
            'discount'      => 'required|numeric|min:0'
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'error',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        $sell_id = Auth::user()->adminSells->where('status_id',getStatusID('pending'))->first()->id;

        // return response()->json([
        //     'sell_id' => $sell_id,
        // ]);

        DB::beginTransaction();

        try{

            $sellOrder = SellOrder::where('status_id',getStatusID('pending'))
                                    ->where('admin_id',Auth::user()->id)
                                    ->where('sell_id',$sell_id)
                                    ->where('product_id',$data['product_id'])
                                    ->first();

            if($sellOrder == null){
                $sellOrder = SellOrder::create([
                    'status_id'     => getStatusID('pending'),
                    'admin_id'      => Auth::user()->id,
                    'sell_id'       => $sell_id,
                    'product_id'    => $data['product_id'],
                    'units'         => $data['units'],
                    'price'         => Product::find($data['product_id'])->price,
                    'discount'      => $data['discount'],
                ]);
            }

            else{
                $sellOrder->units += $data['units'];
                $sellOrder->price = Product::find($data['product_id'])->price;
                $sellOrder->discount = $data['discount'];
                $sellOrder->save();
            }

            $sell = $sellOrder->sell;
            $sellUnits = 0;
            $sellSubTotal = 0;

            foreach($sell->sellOrders as $so){
                $sellUnits += $so->units;
                $sellSubTotal += ($so->units * $so->price - $so->discount);
            }

            $sell->units = $sellUnits;
            $sell->sub_total = $sellSubTotal;
            $sell->save();

            DB::commit();

            if(array_key_exists('key',$request->all())){
                if(strcmp($request->key,'create_sell')==0 || strcmp($request->key,'edit_sell')==0){
                    // return response()->json([
                    //     'sell_order' => $sellOrder,
                    //     'sell' => $sell,
                    // ]);
                    return view('sell.sell-order-table',compact('sell'));
                }
            }

            return response()->json([
                'status'    => 'success',
                'message'   => 'SellOrder created successfully',
                'route'     => route('sellorders.show',$sellOrder),
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
        if(array_key_exists('key',$request->all())){
            if(strcmp('create_sell',$request->key)==0 || strcmp($request->key,'edit_sell')==0){
                // return response()->json([
                //     'data' => $request->all(),
                // ]);
                $sellOrder = SellOrder::find($request->id);
                $sell = $sellOrder->sell;
                $sellSubTotal = 0;
                $sellUnits = 0;

                if($request->sign == 0){
                    $sellOrder->delete();
                }

                else if($request->sign == 1){
                    $sellOrder->units++;
                    $sellOrder->save();
                }
                
                else{
                    if($sellOrder->units == 1){
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Units can not be less than 1',
                        ]);
                    }
                    $sellOrder->units--;

                    if($sellOrder->units * $sellOrder->price < $sellOrder->discount *2){
                        return response()->json([
                            'status' => 'warning',
                            'message' => 'Please modify discount it can not be greater than total'
                        ]);
                    }

                    $sellOrder->save();
                }

                foreach($sell->sellOrders as $so){
                    $sellSubTotal += $so->units * $so->price - $so->discount;
                    $sellUnits = $so->units;
                }

                $sell->units = $sellUnits;
                $sell->sub_total = $sellSubTotal;
                $sell->save();

                // return response()->json([
                //     'sell' => $sell,
                //     'sell_order' => $sellOrder,
                // ]);

                return view('sell.sell-order-table',compact('sell'));
            }
        }

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
