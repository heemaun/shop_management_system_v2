<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Settings Index'])->only(['index']);
        $this->middleware(['permission:Settings Create'])->only(['create','store']);
        $this->middleware(['permission:Settings Edit'])->only(['edit','update']);
        $this->middleware(['permission:Settings Delete'])->only(['destroy']);
    }

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

        $settings = Setting::where('key','LIKE','%family%')
                            ->groupBy('value')
                            ->get('value');
        $fontFamilyArray = array();

        foreach($settings as $s){
            array_push($fontFamilyArray,$s->value);
        }
        
        // return response()->json([
        //     'data' => $fontFamilyArray,
        // ]);

        // if(strcmp($request->key,'colors')==0){

        // }

        if(strcmp($request->key,'colors')==0){
            $data = Validator::make($request->all(),[
                '--1st-bg-color'    => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--2nd-bg-color'    => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--3rd-bg-color'    => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--4th-bg-color'    => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--5th-bg-color'    => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--6th-bg-color'    => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--1st-color'       => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--2nd-color'       => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--3rd-color'       => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--4th-color'       => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--5th-color'       => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--6th-color'       => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--logo-color'      => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--banner-color'    => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--nav-color'       => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--nav-bg-color'    => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            ]);
        }

        else if(strcmp($request->key,'fonts')==0){
            $data = Validator::make($request->all(),[
                '--h2-font-size'            => 'required|numeric|min:4|max:100',
                '--h2-font-weight'          => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--h2-font-style'           => 'required|in:normal,italic',
                '--h2-font-family'          => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--h3-font-size'            => 'required|numeric|min:4|max:100',
                '--h3-font-weight'          => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--h3-font-style'           => 'required|in:normal,italic',
                '--h3-font-family'          => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--h4-font-size'            => 'required|numeric|min:4|max:100',
                '--h4-font-weight'          => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--h4-font-style'           => 'required|in:normal,italic',
                '--h4-font-family'          => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--text-field-font-size'    => 'required|numeric|min:4|max:100',
                '--text-field-font-weight'  => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--text-field-font-style'   => 'required|in:normal,italic',
                '--text-field-font-family'  => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--label-font-size'         => 'required|numeric|min:4|max:100',
                '--label-font-weight'       => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--label-font-style'        => 'required|in:normal,italic',
                '--label-font-family'       => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--default-font-size'       => 'required|numeric|min:4|max:100',
                '--default-font-weight'     => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--default-font-style'      => 'required|in:normal,italic',
                '--default-font-family'     => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--th-font-size'            => 'required|numeric|min:4|max:100',
                '--th-font-weight'          => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--th-font-style'           => 'required|in:normal,italic',
                '--th-font-family'          => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--td-font-size'            => 'required|numeric|min:4|max:100',
                '--td-font-weight'          => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--td-font-style'           => 'required|in:normal,italic',
                '--td-font-family'          => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--logo-font-size'          => 'required|numeric|min:4|max:100',
                '--logo-font-weight'        => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--logo-font-style'         => 'required|in:normal,italic',
                '--logo-font-family'        => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--nav-font-size'           => 'required|numeric|min:4|max:100',
                '--nav-font-weight'         => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--nav-font-style'          => 'required|in:normal,italic',
                '--nav-font-family'         => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
                '--banner-font-size'        => 'required|numeric|min:4|max:100',
                '--banner-font-weight'      => 'required|numeric|in:100,200,300,400,500,600,700,800,900',
                '--banner-font-style'       => 'required|in:normal,italic',
                '--banner-font-family'      => [
                    'required',
                    Rule::in($fontFamilyArray),
                ],
            ]);
        }

        else if(strcmp($request->key,'buttons')==0){
            $data = Validator::make($request->all(),[
                '--button-default-bg-color'     => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-default-color'        => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-primary-bg-color'     => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-primary-color'        => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-secondary-bg-color'   => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-secondary-color'      => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-success-bg-color'     => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-success-color'        => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-info-bg-color'        => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-info-color'           => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-warning-bg-color'     => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-warning-color'        => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-danger-bg-color'      => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-danger-color'         => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-light-bg-color'       => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-light-color'          => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-dark-bg-color'        => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
                '--button-dark-color'           => 'required|regex:"^#([A-Fa-f0-9]{6})$"',
            ]);
        }
        
        else if(strcmp($request->key,'border radius')==0){
            $data = Validator::make($request->all(),[
                '--text-field-border-radius' => 'required|numeric|min:0|max:100',
                '--button-border-radius' => 'required|numeric|min:0|max:100',
                '--form-border-radius' => 'required|numeric|min:0|max:100',
                '--section1-border-radius' => 'required|numeric|min:0|max:100',
                '--section2-border-radius' => 'required|numeric|min:0|max:100',
                '--section3-border-radius' => 'required|numeric|min:0|max:100',
            ]);
        }

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
                    if(strcmp($setting->value,$value) != 0){
                        if(str_contains($setting->value,'px')){
                            $setting->value = $value.'px';
                        }
                        
                        else{
                            $setting->value = $value;
                        }
                        
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
