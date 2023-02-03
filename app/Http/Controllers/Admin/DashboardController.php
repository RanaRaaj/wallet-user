<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Event;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard() {
        $product = Product::count();
        $order = Order::count();
        $data = Product::get()->all();
        $stock = Stock::get()->all();
        $low = 0;
        $out = 0;
        foreach($data as $key => $value){
            $stock = Stock::select('balance')->where('product_code',$value['product_code'])->get()->last();
            if($stock != []){
                if($stock['balance'] >0 && $stock['balance'] < 6){
                    $low++;
                }
                if($stock['balance'] == 0){
                    $out++;
                }
            }
        
        }
        $sold = Order::where('status','1')->count();
        return view('admin.dashboard', compact('product','order','low','out','sold'));
    }

    public function adminDashboard ()
    {
        $product = Product::count();
        $user = User::get()->all();
        $order = Order::count();
        $data = Product::get()->all();
        $stock = Stock::get()->all();
        $event = Event::count();
        $job = Job::count();
        $low = 0;
        $out = 0;
        foreach($data as $key => $value){
            $stock = Stock::select('balance')->where('product_code',$value['product_code'])->get()->last();
            if($stock != []){
                if($stock['balance'] >0 && $stock['balance'] < 6){
                    $low++;
                }
                if($stock['balance'] == 0){
                    $out++;
                }
            }
        
        }
        $sold = Order::where('status','1')->count();
        return view('admin.dashboard', compact('user','product','order','low','out','sold','event','job'));
    }

    public function slider ()
    {
        $slider = Slider::get()->all();
        return view('admin.slider.index', compact('slider'));
    }

    public function sliderCreate ()
    {
        return view('admin.slider.create');
    }

    public function sliderStore (Request $request)
    {
        // dd($request->all());
        // if ($request->hasFile('file')) {
        //     $image = $request->file('file');
        //     $imageName = time() .'1'. "." .$image->extension();
        //     $imagePath = public_path() . '/images';
        //     $image->move($imagePath, $imageName);
        //     $imageDbIqaman = $imageName;
        // }
        // $time = time();
        Slider::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'file'=> $request['img-data'] ?? ''
        ]);

        $slider = Slider::get()->all();
        return view('admin.slider.index', compact('slider'));
    }

    public function sliderDelete(Request $request)
    {
        Slider::where('id',$request['id'])->delete();
        return "Record Deleted Successfully..!";
    }

    public function sliderEdit ($id)
    {
        $slider = Slider::where('id',$id)->get()->first();
        return view('admin.slider.edit', compact('slider'));
    }

    public function sliderUpdate(Request $request)
    {
        if (($request->hasFile('file')) && ($request['img-data'] != '')) {
            // $image = $request->file('file');
            // $imageName = time() .'1'. "." .$image->extension();
            // $imagePath = public_path() . '/images';
            // $image->move($imagePath, $imageName);
            // $imageDbIqaman = $imageName;
            $imageDbIqaman = $request['img-data'];
        }
        $time = time();
        Slider::where('id',$request['id'])->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'file'=> $imageDbIqaman ?? $request['pre-image']
        ]);

        $slider = Slider::get()->all();
        return view('admin.slider.index', compact('slider'));
    }


    public function users ()
    {
        $user = User::get()->all();
        return view('admin.users.index', compact('user'));
    }

    public function userEdit ($id)
    {
        $user = User::where('id',$id)->get()->first();
        return view('admin.users.edit', compact('user'));
    }

    public function userUpdate(Request $request)
    {
        User::where('id',$request['id'])->update([
            'name' => $request['name'],
            'email' => $request['email']
        ]);
        $user = User::get()->all();
        return view('admin.users.index', compact('user'));
    }

    public function userDelete(Request $request)
    {
        User::where('id',$request['id'])->delete();
        return "Record Deleted Successfully..!";
    }

    public function userCreate ()
    {
        return view('admin.users.create');
    }

    public function userStore (Request $request)
    {
        User::create([
            'name' => $request['name'],
            'username' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user = User::get()->all();
        return view('admin.users.index', compact('user'));
    }

    public function profileIndex() {
        $authUser = Auth::user();
        return view('admin.profile', compact('authUser'));
    }

    public function updateProfile(Request $request) {
        $auth = Auth::user();
        $request->validate([
            'name'=>'required | min:5',
            'email'=>'required | email',
        ]);

        if($request['password']) {
            $request->validate([
                'password' => 'required | min:5'
            ]);
            $auth->password = Hash::make($request['password']);
        }
        $auth->name = $request['name'];
        $auth->email = $request['email'];
        $auth->save();
        return redirect()->back()->with('success','Profile updated successfully.');
    }

}
