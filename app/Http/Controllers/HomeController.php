<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $products = Product::Where('status_id',getStatusID('Active'))
                            ->orderBy('name','ASC')
                            ->limit(50)
                            ->get();

        if(Auth::check()){
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

            return view('default.home',compact('products','sell'));
        }
        
        return view('default.home',compact('products'));
    }

    public function productView(Request $request)
    {
        $product = Product::find($request->id);
        
        return response()->json([
            'product' => $product,
        ]);
    }    

    public function searchCategory(Request $request)
    {
        $categories = Category::where('name','LIKE','%'.$request->category_search.'%')
                                ->where('status_id',getStatusID('Active'))
                                ->orderBy('name','ASC')
                                ->limit(5)
                                ->get();
                                
        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function searchProduct(Request $request)
    {
        if(strcmp($request->key,'category_select')==0){
            $products = Product::where('category_id',$request->category_id)
                            ->where('status_id',getStatusID('Active'))
                            ->where('name','LIKE','%'.$request->product_search.'%')
                            ->limit(50)
                            ->get();
        }
        
        else{
            $products = Product::join('categories','products.category_id','=','categories.id')
                                ->where('categories.name','LIKE','%'.$request->category_search.'%')
                                ->where('categories.status_id',getStatusID('Active'))
                                ->where('products.name','LIKE','%'.$request->product_search.'%')
                                ->where('products.status_id',getStatusID('Active'))
                                ->select('products.*')
                                ->orderBy('products.name','ASC')
                                ->limit(50)
                                ->get();
        }

        return view('default.home-product-search',compact('products'));
    }
}
