<?php

namespace App\Http\Controllers;

use App\Models\ImageObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            // 'status_id'     => 'required|exists:statuses,id',
            // 'user_id'       => 'required_if:key,user_profile_image|exists:users,id',
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

        if(strcmp($request->key,'user_profile_image')==0){
            if($request->has('image')){
                // $imagePath = $request->file('image')->store('users','public')
                $image = $request->file('image');
                $imageName = time() * time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public',$imageName);

                Storage::disk('public')->delete(Auth::user()->id);

                $imageObject = ImageObject::create([
                    'status_id' => getActiveStatusId(),
                    'user_id' => Auth::user()->id,
                    'url' => $imageName,
                ]);

                return response()->json([
                    'status' => 'success',
                    'url' => route('users.show',Auth::user()->id),
                ]);
            }            
        }

        else if(strcmp($request->key,'product_image')==0){

        }

        else if(strcmp($request->key,'settings_image')==0){

        }

        return response()->json([
            'status' => 'error',
            'message' => 'Request key error',
        ]);
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
