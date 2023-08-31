<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::all();

        if(array_key_exists('key',$request->all())){
            if(strcmp('from load design',$request->key)==0){
                return response()->json([
                    'status'    => 'success',
                    'settings'  => $settings,
                ]);
            }
        }

        return view('setting.index',compact('settings'));
    }
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        
    }
    public function show(Setting $setting)
    {
        
    }
    public function edit(Setting $setting)
    {
        
    }
    public function update(Request $request)
    {   
        // return response()->json([
        //     'data' => $request->all(),
        // ]);

        $data = Validator::make($request->all(),[
            '--1st-bg-color'            => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--2nd-bg-color'            => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--3rd-bg-color'            => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--4th-bg-color'            => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--5th-bg-color'            => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--6th-bg-color'            => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--1st-color'               => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--2nd-color'               => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--3rd-color'               => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--4th-color'               => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--5th-color'               => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--6th-color'               => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--logo-color'              => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--banner-color'            => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--nav-color'               => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            '--nav-bg-color'            => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
        ]);

        if($data->fails()){
            return response()->json([
                'status' => 'errors',
                'errors' => $data->errors(),
            ]);
        }

        $data = $data->validate();

        // return response()->json([
        //     'data' => $data,
        // ]);

        $x = false;

        DB::beginTransaction();

        try{
            foreach($data as $key => $value){
                $setting = Setting::where('key',$key)->first();

                if($setting != null){
                    if(strcmp($setting->value,$value) == 0){
                        // return response()->json([
                        //     'status' => 'okay'
                        // ]);
                    }
                    
                    else{
                        $setting->value = $value;
                        $setting->admin_id = Auth::user()->id;
                        
                        $setting->save();

                        $x = true;                        
                    }
                }

            }

            DB::commit();            

            Session::flash('setting_updated','Settings saved successfully');

            if($x){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Setting saved successfully',
                    'url' => route('settings.index'),
                ]);
            }

            return response()->json([
                'status' => 'okay'
            ]);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status' => 'exception',
                'message' => $e->getMessage(),
            ]);
        }        
    }
    public function destroy(Setting $setting)
    {
        
    }
}
