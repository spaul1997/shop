<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use DB;

class AuthController extends Controller
{
    public function index()
    {
        if (session('jwt')){
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function register()
    {
        if (session('jwt')){
            return redirect()->route('dashboard');
        }
        return view('signup');
    }

    public function check_users(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50',
        ]);
        $credentials = $request->only('email', 'password');

        if($token = JWTAuth::attempt($credentials)){
            $user = JWTAuth::user();
            $role = Role::where('id',$user->role_id)->first()->role;
            $permission = DB::table('role_has_permissions as rhp')
                ->select('p.permission')
                ->join('permissions as p','p.id','=','rhp.permission_id')
                ->join('roles as r','r.id','=','rhp.role_id')
                ->where('r.id',$user->role_id)
                ->get();
            $permission = $permission->pluck('permission')->toArray();
            $user = [
                'id' => JWTAuth::user()->id,
                'name' => JWTAuth::user()->name,
                'email' => JWTAuth::user()->email,
                'role' => $role,
                'role_id' => JWTAuth::user()->role_id,
                'permission' => $permission,
            ];
            $request->session()->put('jwt',$token);
            $request->session()->put('user',$user);
            toastr()->success('Successfully logged In', 'Congrats');
            if(JWTAuth::user()->id == 1){
                return redirect()->Route('dashboard');
            }else{
                return redirect()->Route('my-orders');
            }
        }else{
            toastr()->error('Login credentials are invalid.');
            return redirect()->back();
        }
    }

    public function add_user(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50',
        ]);
        $check = User::where('email',$request->input('email'))->first();
        if($check){
            toastr()->error('Already register this email.');
        }else{
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role_id = 2;
            $user->save();
            toastr()->success('Successfully Register your account', 'Congrats');
        }
        return redirect()->Route('login');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('jwt');
        $request->session()->forget('user');
        toastr()->success('Successfully logged out', 'Congrats');
        return redirect()->Route('login');
    }
}
