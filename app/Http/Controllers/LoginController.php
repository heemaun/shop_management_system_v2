<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $data = Validator::make($request->all(),[
            'username' => 'required|exists:users,username',
            'password' => 'required|min:8|max:20',
        ]);

        if($data->fails()){
            return response()->json([
                'status' => 'errors',
                'errors' => $data->errors(),
            ]);
        }

        $data = $data->validate();

        try{
            $user = User::where('username',$data['username'])->first();

            if(Hash::check($data['password'],$user->password)){
                Auth::login($user);

                return response()->json([
                    'status'    => 'success',
                    'url'       => route('home'),
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Incorrect password',
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
    
    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect(route('home'));
    }
}
