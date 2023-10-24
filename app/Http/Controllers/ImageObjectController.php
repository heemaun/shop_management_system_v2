<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Product;
use App\Models\ImageObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageObjectController extends Controller
{
    public function index()
    {
        $imageObjects = ImageObject::all();
        return view('image-object.index',compact('imageObjects'));
    }

    public function create()
    {
        return view('image-object.create');
    }

    public function store(Request $request)
    {        
        // return response()->json([
        //     'data' => $request->all(),          
        // ]);
        $data = Validator::make($request->all(),[
            'user_id'       => 'required_if:key,user_profile_image|exists:users,id',
            'product_id'    => 'required_if:key,product_image|exists:products,id',
            'settings_id'   => 'required_if:key,settings_image|exists:settings,id',
            'key'           => 'required',
        ]);

        if($data->fails()){
            return response()->json([
                'status' => 'errors',
                'errors' => $data->errors()
            ]);
        }

        $data = $data->validate();

        DB::beginTransaction();

        try{
            if(strcmp($request->key,'user_profile_image')==0){
                if($request->has('image')){
                    // $imagePath = $request->file('image')->store('users','public')
                    $image = $request->file('image');
                    $imageName = time() * time().'.'.$image->getClientOriginalExtension();
                    $image->storeAs('public',$imageName);
                    
                    $imageObject = ImageObject::where('user_id',$data['user_id'])->first();

                    if($imageObject != null){
                        Storage::delete('public/'.$imageObject->url);
                        $imageObject->delete();
                    }
    
                    ImageObject::create([
                        'status_id' => getActiveStatusId(),
                        // 'user_id' => Auth::user()->id,
                        'user_id' => $data['user_id'],
                        'url' => $imageName,
                    ]);
    
                    Session::flash('upload_success','Image uploaded successfully');
    
                    DB::commit();
    
                    return response()->json([
                        'status' => 'success',
                        // 'route' => route('users.show',Auth::user()->id),
                        'route' => route('users.show',$data['user_id']),
                    ]);
                }            
            }
    
            else if(strcmp($request->key,'product_image')==0){
                if($request->has('image')){
                    $image = $request->file('image');
                    $imageName = time() * time().'.'.$image->getClientOriginalExtension();
                    $image->storeAs('public',$imageName);
    
                    ImageObject::create([
                        'status_id' => getActiveStatusId(),
                        'product_id' => $data['product_id'],
                        'url' => $imageName,
                    ]);

                    $product = Product::find($data['product_id']);

                    $product->admin_id = Auth::user()->id;
                    $product->save();
    
                    Session::flash('upload_success','Image uploaded successfully');
    
                    DB::commit();
    
                    return response()->json([
                        'status' => 'success',
                        'route' => route('products.show',$data['product_id']),
                    ]);
                }  
            }
    
            else if(strcmp($request->key,'settings_image')==0){
    
            }
    
            return response()->json([
                'status' => 'error',
                'message' => 'Request key error',
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'exception',
                'message' => $e->getMessage(),
            ]);
        }        
    }

    public function show(ImageObject $imageObject)
    {
        return view('image-object.show',compact('imageObject'));
    }

    public function edit(ImageObject $imageObject)
    {
        return view('image-object.edit',compact('imageObject'));
    }

    public function update(Request $request, ImageObject $imageObject)
    {
        
    }

    public function destroy(ImageObject $imageObject)
    {
        
    }
}
