<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::Where('status_id','!=',getDeletedStatusId())
                            ->limit(50)
                            ->get();
        return view('default.home',compact('products'));
    }

    public function addToCart()
    {

    }

    public function productView(Request $request)
    {
        $product = Product::find($request->id);
        
        return response()->json([
            'product' => $product,
        ]);
    }
}
