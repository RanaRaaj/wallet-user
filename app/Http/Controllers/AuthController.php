<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function adminLogin(Request $request) {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
//        $user = User::where('email',$request['email'])->first();
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password']
        ];
        $auth = Auth::attempt($credentials);
        if($auth) {
            $user = Auth::user();
            if($user->role == 'user'){
                if($user->role == "admin" || $user->role == "sub_admin"){
                    if($user->status == 1) {

                        $bank_detail = UserBank::where('user_id',Auth::user()->id)->get()->first();
                        $balance = $bank_detail->amount ?? 00;
                        return redirect()->route('admin.dashboard', compact('balance'));
                    }
                    else {
                        Auth::logout();
                        return redirect()->back()->with('error', 'You profile is inactive from super admin.');
                    }
                }elseif($user->role == "user"){
                    Session::put('language', 'vie');
                    return redirect()->route('welcome');
                }
                else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'You are not admin. Please enter valid credentials.');
                }
            }else{
                return redirect()->back()->with('error', 'Email or Password is incorrect.');
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
            'email'=>'required | unique:users',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return redirect()->back()->with('success', 'Chúc mừng bạn đã hoàn tất quá trình đăng ký. Xin hãy nhấn ĐĂNG NHẬP để tiếp tục sử dụng');

    }

}
