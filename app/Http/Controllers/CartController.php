<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Product;
use App\Models\SellOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Carts Index'])->only(['index']);
        $this->middleware(['permission:Carts Create'])->only(['create','store']);
        $this->middleware(['permission:Carts Edit'])->only(['edit','update']);
        $this->middleware(['permission:Carts Delete'])->only(['destroy']);
    }

    public function index()
    {
        $sell = Sell::where('customer_id',Auth::user()->id)
                    ->where('status_id',getStatusID('Carted'))
                    ->first();
        
        return response()->json([
            'count' => count($sell->sellOrders),
        ]);
    }

    public function store(Request $request)
    {
        $validProducts = Product::where('status_id',getStatusID('Active'))->get('id');

        $ids = array();

        foreach($validProducts as $vp){
            array_push($ids,$vp->id);
        }

        $data = Validator::make($request->all(),[
            'id' => [
                Rule::in($ids),
            ],
        ]);

        if($data->fails()){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid product ID',
            ]);
        }

        DB::beginTransaction();

        try{
            $sell = Sell::where('customer_id',Auth::user()->id)
                        ->where('status_id',getStatusID('Carted'))
                        ->first();
        
            if($sell == null){
                $sell = Sell::create([
                    'status_id'     => getStatusID('Carted'),
                    'customer_id' => Auth::user()->id,
                    'units'         => 0,
                    'subtotal'      => 0,
                    'discount'      => 0,
                ]);
            }
            
            $product = Product::find($request->id);

            $sellOrder = SellOrder::where('sell_id',$sell->id)
                                    ->where('product_id',$product->id)
                                    ->where('status_id',getStatusID('Carted'))
                                    ->first();

            if($sellOrder !== null){
                return response()->json([
                    'status' => 'info',
                    'message' => 'This product has already been added to cart',
                ]);
            }

            $sellOrder = SellOrder::create([
                'status_id'     => getStatusID('Carted'),
                'sell_id'       => $sell->id,
                'admin_id'      => 1,
                'product_id'    => $product->id,
                'units'         => 1,
                'price'         => $product->price,
                'discount'      => 0,
            ]);

            $sell = $this->autoSellUpdate($sell->id);

            DB::commit();

            return response()->json([
                'status'        => 'success',
                'message'       => 'Product added to cart successfully',
                'sell'          => $sell,
                'sell_order'    => $sellOrder,
            ]);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status' => 'exception',
                'message' => $e->getMessage(),
            ]);
        }        
    }

    public function show(string $id)
    {
        $sell = Sell::where('customer_id',Auth::user()->id)
                        ->where('status_id',getStatusID('Carted'))
                        ->first();
        
        if($sell == null){
            $sell = Sell::create([
                'status_id'     => getStatusID('Carted'),
                'customer_id'   => Auth::user()->id,
                'units'         => 0,
                'subtotal'      => 0,
                'discount'      => 0,
            ]);
        }

        return view('default.cart',compact('sell'));
    }

    public function update(Request $request,$id)
    {
        $sign = $request->sign;

        $sellOrder = SellOrder::find($request->id);
        $sell_id = $sellOrder->sell_id;

        DB::beginTransaction();

        try{
            if($sign == 0){
                $sellOrder->delete();
    
                $sell = $this->autoSellUpdate($sell_id);
                
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'sell' => $sell,
                    'message' => 'Item deleted successfully',
                ]);
            }
    
            else{
                $units = $sellOrder->units;
    
                if($sign == 1){
                    $units++;
                }
    
                else if($sign == 2){
                    if($units == 1){
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Units can not be zero',
                        ]);
                    }
    
                    $units--;
                }
    
                $sellOrder->units = $units;
                $sellOrder->save();
            }
    
            $sell = $this->autoSellUpdate($sell_id);

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status' => 'exception',
                'message' => $e->getMessage(),
            ]);
        }        

        return response()->json([
            'status' => 'success',
            'sell' => $sell,
            'message' => 'Cart updated successfully',
        ]);
    }

    public function destroy(Request $request)
    {
        $sell = Sell::where('customer_id',Auth::user()->id)
                        ->where('status_id',getStatusID('Carted'))
                        ->first();

        DB::beginTransaction();

        try{
            foreach($sell->sellOrders as $so){
                $so->delete();
            }
    
            $sell = $this->autoSellUpdate($sell->id);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Cart Cleared',
            ]);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status' => 'exception',
                'message' => $e->getMessage(),
            ]);
        } 
    }

    private function autoSellUpdate($id)
    {
        $sell = Sell::find($id);
        $units = 0;
        $sub_total = 0;

        foreach($sell->sellOrders as $so){
            $units += $so->units;
            $sub_total += $so->units * $so->price - $so->discount;
        }

        $sell->units = $units;
        $sell->sub_total = $sub_total;
        $sell->save();

        return $sell;
    }
}
