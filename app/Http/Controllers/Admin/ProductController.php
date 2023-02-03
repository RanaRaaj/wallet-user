<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    //
    public function product()
    {
        $data = Product::orderBy('id', 'desc')->get()->all();
        return view('admin.product.index', compact('data'));
    }

    public function bin_card($id)
    {
        $data = Product::where('id',$id)->get()->all();
        $data = Stock::orderBy('id', 'desc')->where('product_code',$data[0]['product_code'])->get()->all();
        $total = 0;
        foreach($data as $val){
            if($val != ''){
              $total += $val['price'];
            }
        }
        return view('admin.product.bincard', compact('data','total'));
    }

    public function create_product()
    {
        return view('admin.product.create');
    }

    public function productStore (Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() .'1'. "." .$image->extension();
            $imagePath = public_path() . '/images';
            $image->move($imagePath, $imageName);
            $imageDbIqaman = $imageName;
        }

        $time = time();
        $id = Product::create([
            'product_code' => $request['product_code'] ?? $time ?? '',
            'name' => $request['product_name'] ?? '',
            'description'=>$request['description'] ?? '',
            'purchased_price'=>$request['purchase_price'] ?? '',
            'selling_price'=>$request['selling_price'] ?? '',
            'image'=> $imageDbIqaman ?? ''
        ])->id;
        
        return redirect()->route('product_stack', ['id' => $id]);
    }

    public function view_product ($id)
    {
        $data = Product::where('id',$id)->get()->first();
        $balance = Stock::select('balance')->where('product_code',$data['product_code'])->get()->last();
        if($balance == ''){
            $balance = 0;
        }else{
            $balance = $balance['balance'];
        }
        return view('admin.product.create', compact('data','balance'));
    }

    public function edit_product ($id)
    {
        $editData = Product::where('id',$id)->get()->first();
        return view('admin.product.create', compact('editData'));
    }

    public function productUpdate(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() .'1'. "." .$image->extension();
            $imagePath = public_path() . '/images';
            $image->move($imagePath, $imageName);
            $imageDbIqaman = $imageName;
        }
        Product::where('id',$request['id'])->update([
            'product_code' => $request['product_code'] ?? '',
            'name' => $request['name'] ?? '',
            'description'=>$request['description'] ?? '',
            'purchased_price'=>$request['purchase_price'] ?? '',
            'selling_price'=>$request['selling_price'] ?? '',
            'image'=> $imageDbIqaman ?? $request['image']
        ]);
        return redirect()->back()->with('success','Order Type updated successfully.');
    }

    public function product_stack ($id)
    {
        $editDataStack = Product::where('id',$id)->get()->first();
        return view('admin.product.create', compact('editDataStack'));
    }

    public function productStackUpdate(Request $request)
    {
        $balance = Stock::select('balance')->where('product_code',$request['product_code'])->get()->last();
        if($balance == ''){
            $balance = 0;
        }else{
            $balance = $balance['balance'];
        }
        $balance = $balance + $request['stock'];
        $stock = Stock::create([
            'product_code' => $request['product_code'] ?? '',
            'product_name' => $request['product_name'],
            'type'=>$request['stock_type'],
            'quantity'=>$request['stock']

        ])->id;
        Stock::where('id',$stock)->Increment('balance',$balance);
        $data = Product::where('id',$request['id'])->get()->first();
        return view('admin.product.create', compact('data','balance'));
    }

    public function act_deact(Request $request)
    {
        if($request['status'] ==0){
            Product::where('id',$request['id'])->update([
                'status' => 1
            ]);
            return 'Product Deactivated successfully.';
        }else{
            Product::where('id',$request['id'])->update([
                'status' => 0
            ]);
            return 'Product Activated successfully.';
        }
    }

}
