<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Users Index'])->only(['index']);
        $this->middleware(['permission:Users Create'])->only(['create','store']);
        $this->middleware(['permission:Users Edit'])->only(['edit','update']);
        $this->middleware(['permission:Users delete'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        if(!array_key_exists('key',$request->all())){
            $statuses = Status::all();
            $roles = Role::all();
        
            $users = User::where('status_id',getStatusID('Active'))
                            ->orderBy('status_id','ASC')
                            ->orderBy('name','ASC')
                            ->paginate(10);
            
            return view('user.index',compact('users','statuses','roles'));
        }

        else if(strcmp($request->key,'search') == 0){
            $statuses_ids = '';
            $role_ids = '';

            if(strcmp($request->role_id,'All')==0){
                $role_ids = getAllRoleID();
            }

            else{
                $role_ids = [$request->role_id];
            }

            if(strcmp($request->status_id,'All')==0){
                $statuses_ids = getNonDeletedStatusesIds();
            }

            else{
                $statuses_ids = [$request->status_id];
            }

            $users = User::whereIn('status_id',$statuses_ids)
                            ->where(function($query) use($request){
                                $query->where('name','LIKE','%'.$request->search.'%')
                                        ->orWhere('username','LIKE','%'.$request->search.'%')
                                        ->orWhere('phone','LIKE','%'.$request->search.'%')
                                        ->orWhere('email','LIKE','%'.$request->search.'%');
                            })
                            ->whereHas(
                                'roles', function($query) use ($role_ids){
                                    $query->whereIn('id',$role_ids);
                                }
                            )
                            ->orderBy('status_id','ASC')
                            ->orderBy('name','ASC')
                            ->paginate($request->row_count);
                        
            return view('user.search',compact('users'));
        }     
        
        else if(strcmp($request->key,'product_create')==0){
            $customers = User::where('status_id',getActiveStatusId())
                            ->where(function($query) use($request){
                                $query->where('name','LIKE','%'.$request->search.'%')
                                        ->orWhere('username','LIKE','%'.$request->search.'%')
                                        ->orWhere('phone','LIKE','%'.$request->search.'%')
                                        ->orWhere('email','LIKE','%'.$request->search.'%');
                            })
                            ->whereHas(
                                'roles', function($query){
                                    $query->where('id',Role::where('name','customer')->first()->id);
                                }
                            )
                            ->orderBy('name','ASC')
                            ->limit(5)
                            ->get();
            
            return view('sell.customer-datalist',compact('customers'));
            // return response()->json([
            //     'users' => $customers,
            // ]);
        }
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'name'                  => 'required|min:3|max:20',
            'username'              => 'required|min:3|max:20|unique:users,username',
            'gender'                => 'required|in:Male,Female,Other',
            'address'               => 'required|min:10|max:100',
            'dob'                   => 'required|date_format:Y-m-d|before_or_equal:'.date('Y-m-d',strtotime(date('Y-m-d') . '-18 years')),
            'email'                 => 'required|email|unique:users,email',
            'phone'                 => 'required|numeric|unique:users,phone',
            'password'              => [
                                        'required','confirmed','max:20',Password::min(8)
                                                                                ->letters()
                                                                                ->mixedCase()
                                                                                ->numbers()
                                                                                ->symbols()
                                                                                ->uncompromised()        
                                    ],
            'password_confirmation' => [
                                        'required','max:20',Password::min(8)
                                                                                    ->letters()
                                                                                    ->mixedCase()
                                                                                    ->numbers()
                                                                                    ->symbols()
                                                                                    ->uncompromised()        
                                    ],
        ],$message=[
            'dob.required' => 'The date of birth field is required',
            'dob.before_or_equal' => 'You have to be atleast 18 years old',
        ]);

        if($data->fails()){
            return response()->json([
                'status'    => 'errors',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        DB::beginTransaction();

        try{
            $user = User::create([
                'status_id' => getStatusID('Active'),
                'name'      => $data['name'],
                'username'  => $data['username'],
                'gender'    => $data['gender'],
                'address'   => $data['address'],
                'dob'       => $data['dob'],
                'email'     => $data['email'],
                'phone'     => $data['phone'],
                'password'  => Hash::make($data['password']),
            ]);

            DB::commit();

            Session::flash('user_added','User created successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => route('users.show',$user),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }

    public function edit(User $user)
    {
        $statuses = Status::where('name','!=','Deleted')->get();
        $roles = Role::all();

        if($user->status_id = getDeletedStatusId()){
            $statuses = Status::all();
        }

        return view('user.edit',compact('user','statuses','roles'));
    }

    public function update(Request $request, User $user)
    {
        if(strcmp($request->key,'change_password')==0){
            $data = Validator::make($request->all(),[
                'old_password'              => [
                                                'required','confirmed','max:20',Password::min(8)
                                                                                        ->letters()
                                                                                        ->mixedCase()
                                                                                        ->numbers()
                                                                                        ->symbols()
                                                                                        ->uncompromised()        
                                            ],
                'new_password'              => [
                                                'required','confirmed','max:20',Password::min(8)
                                                                                        ->letters()
                                                                                        ->mixedCase()
                                                                                        ->numbers()
                                                                                        ->symbols()
                                                                                        ->uncompromised()        
                                            ],
                'new_password_confirmation' => [
                                                'same:new_password','required','max:20',Password::min(8)
                                                                                                ->letters()
                                                                                                ->mixedCase()
                                                                                                ->numbers()
                                                                                                ->symbols()
                                                                                                ->uncompromised()        
                                            ],
            ]);
        }

        else{
            $statuses = Status::where('name','!=','Deleted')->get('id');

            $statuses_ids = array();

            foreach($statuses as $status){
                array_push($statuses_ids,$status->id);
            }

            if($user->status_id = getDeletedStatusId()){
                array_push($statuses_ids,getDeletedStatusId());
            }

            $data = Validator::make($request->all(),[
                'status_id' => [
                                'required',
                                Rule::in($statuses_ids),
                                ],
                'name'      => 'required|min:3|max:20',
                'username'  => 'required|min:3|max:20|unique:users,username,'.$user->id,
                'gender'    => 'required|in:Male,Female,Other',
                'address'   => 'required|min:10|max:100',
                'dob'       => 'required|date_format:Y-m-d|before_or_equal:'.date('Y-m-d',strtotime(date('Y-m-d') . '-18 years')),
                'email'     => 'required|email|unique:users,email,'.$user->id,
                'phone'     => 'required|numeric|unique:users,phone,'.$user->id,
            ],$message=[
                'dob.required' => 'The date of birth field is required',
                'dob.before_or_equal' => 'You have to be atleast 18 years old',
                'status_id.required' => 'Status filed is required',
                'status_id.in' => 'This status is not appicable',
            ]);
        }

        if($data->fails()){
            return response()->json([
                'status'    => 'errors',
                'message'   => $data->errors(),
            ]);
        }

        $data = $data->validate();

        DB::beginTransaction();

        try{
            if(strcmp($request->key,'change_password')==0){
                if(Hash::check($data['old_password'],$user->password)){
                    $user->password = Hash::make($data['password']);
                }

                return response()->json([
                    'status'    => 'error',
                    'message'   => 'Password does not match',
                ]);
            }

            else{
                $user->status_id    = $data['status_id'];
                $user->name         = $data['name'];
                $user->username     = $data['username'];
                $user->gender       = $data['gender'];
                $user->address      = $data['address'];
                $user->dob          = $data['dob'];
                $user->email        = $data['email'];
                $user->phone        = $data['phone'];
            }            

            $user->save();

            DB::commit();

            Session::flash('user_updated',(strcmp($request->key,'change_password')==0) ? 'Password changed successfully' : 'User updated successfully');

            return response()->json([
                'status'    => 'success',
                'route'     => (strcmp($request->key,'change_password')==0) ? route('home') : route('users.show',$user),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request,User $user)
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

        else if(Auth::user()->id === $user->id){
            return response()->json([
                'status'    => 'error',
                'message'   => 'You can not delete your own ID',
            ]);
        }

        else if($user->id == 1){
            return response()->json([
                'status'    => 'error',
                'message'   => 'This user can not be deleted',
            ]);
        }

        DB::beginTransaction();

        try{
            if(strcmp($request->soft_delete,'true')==0){
                $user->status_id = getStatusID('Deleted');

                $user->save();
            }
            
            else{
                $user->delete();
            }

            DB::commit();

            Session::flash('user_deleted','User deleted successfully');

            return response()->json([
                'status'    => 'success',
                'message'   => 'User deleted successfully',
                'route'     => route('users.index'),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
