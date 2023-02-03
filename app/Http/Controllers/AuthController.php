<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function adminLogin(Request $request) {
        $request->validate([
            'email'=>'required | email',
            'password'=>'required',
        ]);
//        $user = User::where('email',$request['email'])->first();
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password']
        ];
        return redirect()->route('welcome');
        $auth = Auth::attempt($credentials);
        if($auth) {
            $user = Auth::user();
            return redirect()->route('admin.dashboard');
            if($user->role == "admin" || $user->role == "sub_admin"){
                if($user->status == 1) {
                    return redirect()->route('admin.dashboard');
                }
                else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'You profile is inactive from super admin.');
                }
            }
            else {
                Auth::logout();
                return redirect()->back()->with('error', 'You are not admin. Please enter valid credentials.');
            }
        }
        else {
            return redirect()->back()->with('error', 'Email or Password is incorrect.');
        }
    }

    public function admin_signup()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'email'=>'required | email | unique:users',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return view('login');

    }

}
