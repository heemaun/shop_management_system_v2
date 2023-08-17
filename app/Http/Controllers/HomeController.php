<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\User;
use App\Models\Status;
use App\Models\Product;
use App\Models\SellOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function home()
    {
        // dd(getCurrencyFormat(1111111111.22222));
        // setlocale(LC_MONETARY,'it_IT');
        // $jj = number_format(1111111.111,2);
        $products = Product::Where('status_id','!=',getDeletedStatusId())
                            ->limit(10)
                            ->get();

        $sell = Sell::find(2);

        return view('default.home',compact('products','sell'));
    }

    public function addToCart(Request $request)
    {
        $validProducts = Product::where('status_id',getStatusID('Active'))->get('id');

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

        $sell = Sell::where('customer_id',1)//where('customer_id',Auth::user()->id)
                        ->where('status_id',getStatusID('Carted'))
                        ->first();
        
        if($sell == null){
            $sell = Sell::create([
                'status_id'     => getStatusID('Carted'),
                // 'customer_id' => Auth::user()->id,
                'customer_id'   => 1,
                'units'         => 0,
                'subtotal'      => 0,
                'discount'      => 0,
            ]);
        }
        
        $product = Product::find($request->id);

        $sellOrder = SellOrder::where('sell_id',$sell->id)
                                // ->where('admin_id',Auth::user()->id)
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
            // 'admin_id' => Auth::user()->id,
        ]);

        $this->autoSellUpdate($sell);

        return response()->json([
            'status'        => 'success',
            'message'       => 'Product added to cart successfully',
            'sell'          => $sell,
            'sell_order'    => $sellOrder,
        ]);
    }

    public function productView(Request $request)
    {
        $product = Product::find($request->id);
        
        return response()->json([
            'product' => $product,
        ]);
    }

    public function updateCart(Request $request)
    {
        $sign = $request->sign;

        $sellOrder = SellOrder::find($request->id);
        $sell = $sellOrder->sell;

        if($sign === 0){
            $sellOrder->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Item deleted successfully',
            ]);
        }

        else{
            $units = $sellOrder->units;

            if($sign === 1){
                $units++;
            }

            else if($sign === 2){
                if($units === 1){
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

        $this->autoSellUpdate($sell);

        return view('default.cart',compact('sell'));
    }

    private function autoSellUpdate($sell)
    {
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
