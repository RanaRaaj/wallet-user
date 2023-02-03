<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\OrderHistory;
use App\Models\OrderReturn;
use App\Models\OrderType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    //
    public function order_type()
    {
    	$order = OrderType::orderBy('id', 'desc')->get()->all();
    	return view('admin.order_type.index', compact('order'));
    }
    public function create_order_type()
    {
    	return view('admin.order_type.create');
    }
    public function orderTypeStore (Request $request)
    {
        OrderType::create([
            'order_type' => $request['order_type']
        ]);

        return redirect()->route('order_type');
    }
    public function delete_order_type(Request $request)
    {
    	OrderType::where('id',$request['id'])->delete();
        return "Record Deleted Successfully..!";
    }
    public function edit_order_type ($id)
    {
        $order = OrderType::where('id',$id)->get()->first();
        return view('admin.order_type.edit', compact('order'));
    }
    public function orderTypeUpdate(Request $request)
    {
        OrderType::where('id',$request['id'])->update([
            'order_type' => $request['order_type']
        ]);
        $order = OrderType::get()->all();
        return redirect()->back()->with('success','Order Type updated successfully.');
    }

    // start order section
    public function order()
    {
        $data = Order::orderBy('id', 'desc')->where('status','!=',10)->get()->all();
        return view('admin.order.index', compact('data'));
    }

    public function create_order()
    {
        $order_type = OrderType::get()->all();   
        $all_product = Product::select('product_code','name','selling_price')->get()->all();   
        return view('admin.order.create', compact('order_type','all_product'));
    }

    public function orderStore (Request $request)
    {
        // dd($request->all());
        $time = time();
        if(isset($request['item1'])){
            $item[0]=$request['item1'];
        }
        if(isset($request['item2'])){
            $item[1]=$request['item2'];
        }
        if(isset($request['item3'])){
            $item[2]=$request['item3'];
        }
        if(isset($request['item4'])){
            $item[3]=$request['item4'];
        }
        // dd($item);
        foreach($item as $key => $itemz){
            $product = Product::select('status')->where('product_code',$itemz)->get()->first();
            if(isset($product['status'])){
                if($product['status'] == 1){
                    return redirect()->back()->with('error','Product is Deactivated..!');
                }
                $stock = Stock::where('product_code',$itemz)->get()->last();
                if($key == 0){
                    if($stock['balance'] <= $request['quantity1']){
                        return redirect()->back()->with('error','Not Much Stock Available');
                    }
                }
                if($key == 1){
                    if($stock['balance'] <= $request['quantity2']){
                        return redirect()->back()->with('error','Not Much Stock Available');
                    }
                }
                if($key == 2){
                    if($stock['balance'] <= $request['quantity3']){
                        return redirect()->back()->with('error','Not Much Stock Available');
                    }
                }
            }

        }
        foreach($item as $key => $itemz){
            $product = Product::select('status')->where('product_code',$itemz)->get()->first();
            if(isset($product['status'])){
                if($product['status'] == 1){
                    return redirect()->back()->with('error','Product is Deactivated..!');
                }
            }
            if($key == 0){
                $stock = Stock::where('product_code',$itemz)->get()->last();
                if($stock['balance'] <= $request['quantity1']){
                    return redirect()->back()->with('error','Not Much Stock Available');
                }
                $balance = $stock['balance']-$request['quantity1'];
                $price = $request['quantity1']*$request['unit_price1'];
                $stock = Stock::create([
                    'product_code' => $itemz ?? '',
                    'product_name' => $stock['product_name'],
                    'type'=>'Order',
                    'quantity'=>$request['quantity1'],
                    'balance'=>$balance,
                    'order_id'=>$time,
                    'place'=>$request['order_type'],
                    'price'=>$price

                ])->id;
                OrderHistory::create([
                    'slip_id' => $time,
                    'order_id' => $request['order_id'],
                    'note' => 'Shipped',
                    'quantity' => $request['quantity1'],
                    'remark' => ''
                ]);
            }
            if($key == 1){
                $stock = Stock::where('product_code',$itemz)->get()->last();
                if($stock['balance'] <= $request['quantity2']){
                    return redirect()->back()->with('error','Not Much Stock Available');
                }
                $balance = $stock['balance']-$request['quantity2'];
                $price = $request['quantity2']*$request['unit_price2'];
                $stock = Stock::create([
                    'product_code' => $itemz ?? '',
                    'product_name' => $stock['product_name'],
                    'type'=>'Order',
                    'quantity'=>$request['quantity2'],
                    'balance'=>$balance,
                    'order_id'=>$time,
                    'place'=>$request['order_type'],
                    'price'=>$price

                ])->id;
                OrderHistory::create([
                    'slip_id' => $time,
                    'order_id' => $request['order_id'],
                    'note' => 'Shipped',
                    'quantity' => $request['quantity2'],
                    'remark' => ''
                ]);
            }
            if($key == 2){
                $stock = Stock::where('product_code',$itemz)->get()->last();
                if($stock['balance'] <= $request['quantity3']){
                    return redirect()->back()->with('error','Not Much Stock Available');
                }
                $balance = $stock['balance']-$request['quantity3'];
                $price = $request['quantity3']*$request['unit_price3'];
                $stock = Stock::create([
                    'product_code' => $itemz ?? '',
                    'product_name' => $stock['product_name'],
                    'type'=>'Order',
                    'quantity'=>$request['quantity3'],
                    'balance'=>$balance,
                    'order_id'=>$time,
                    'place'=>$request['order_type'],
                    'price'=>$price

                ])->id;
                OrderHistory::create([
                    'slip_id' => $time,
                    'order_id' => $request['order_id'],
                    'note' => 'Shipped',
                    'quantity' => $request['quantity3'],
                    'remark' => ''
                ]);
            }
            if($key == 3){
                $stock = Stock::where('product_code',$itemz)->get()->last();
                if($stock['balance'] <= $request['quantity3']){
                    return redirect()->back()->with('error','Not Much Stock Available');
                }
                $balance = $stock['balance']-$request['quantity3'];
                $price = $request['quantity3']*$request['unit_price3'];
                $stock = Stock::create([
                    'product_code' => $itemz ?? '',
                    'product_name' => $stock['product_name'],
                    'type'=>'Order',
                    'quantity'=>$request['quantity4'],
                    'balance'=>$balance,
                    'order_id'=>$time,
                    'place'=>$request['order_type'],
                    'price'=>$price

                ])->id;
                OrderHistory::create([
                    'slip_id' => $time,
                    'order_id' => $request['order_id'],
                    'note' => 'Shipped',
                    'quantity' => $request['quantity4'],
                    'remark' => ''
                ]);
            }

        }
        $id = Order::create([
            'order_types' => $request['order_type'] ?? '',
            'name' => $request['customer_name'] ?? '',
            'address' => $request['address'] ?? '',
            'address' => $request['address'] ?? '',
            'order_id' => $request['order_id'] ?? '',
            'date' => $request['date'] ?? '',
            'item' => json_encode($item) ?? '',
            'unit_price' => $request['unit_price1'] ?? '',
            'quantity' => $request['quantity1'] ?? '',
            'unit_price2' => $request['unit_price2'] ?? '',
            'quantity2' => $request['quantity2'] ?? '',
            'unit_price3' => $request['unit_price3'] ?? '',
            'quantity3' => $request['quantity3'] ?? '',
            'unit_price4' => $request['unit_price4'] ?? '',
            'quantity4' => $request['quantity4'] ?? '',
            'zip_code' => $request['zip_code'] ?? '',
            'email' => $request['email'] ?? '',
            'tracking_id' => $request['tracking_id'] ?? '',
            'shipping_method' => $request['shipping_method'] ?? '',
            'shipping' => $request['shipping'] ?? '',
            'note' => $request['note'] ?? '',
            'slip_id' => $time,
            'status' => 0
        ])->id;
        
        return redirect()->route('view_order', ['id' => $id]);
        
    }

    public function view_order($id)
    {
        $data = Order::where('id',$id)->get()->first();
        $history = OrderHistory::where('slip_id',$data['slip_id'])->get()->all();
        $less = -1;
        if($history != []){
            foreach($history as $his){
                $less++;
            }
        }
        $item = json_decode($data['item']);
        return view('admin.order.create', compact('data','history','less','item'));
    }

    public function edit_order ($id)
    {
        $editData = Order::where('id',$id)->get()->first();
        $order_type = OrderType::get()->all();
        $item = json_decode($editData['item']);
        return view('admin.order.create', compact('editData','order_type','item'));
    }

    public function orderUpdate(Request $request)
    {
        Order::where('id',$request['id'])->update([
            'order_types' => $request['order_type'] ?? '',
            'name' => $request['customer_name'] ?? '',
            'address' => $request['address'] ?? '',
            'address' => $request['address'] ?? '',
            'order_id' => $request['order_id'] ?? '',
            'date' => $request['date'] ?? '',
            'zip_code' => $request['zip_code'] ?? '',
            'email' => $request['email'] ?? '',
            'tracking_id' => $request['tracking_id'] ?? '',
            'shipping_method' => $request['shipping_method'] ?? '',
            'shipping' => $request['shipping'] ?? '',
            'note' => $request['note'] ?? '',
            'status' => 0
        ]);
        Stock::where('order_id',$request['slip_id'])->update([
            'place'=>$request['order_type'],

        ]);
        return redirect()->route('view_order', ['id' => $request['id']]);
    }

    public function returnOrder(Request $request)
    {
        if($request['reason'] == '-Select Return reason-'){
            return redirect()->back()->with('error','Send Request with "Reason"');   
        }
        if($request['quantity'] == ''){
            return redirect()->back()->with('error','Send Request with "Quantity"');   
        }
        $order = Order::where('id',$request['id'])->get()->first();
        $balance = Stock::select('balance')->where('product_code',$order['item'])->get()->last();
        $isReturn = OrderReturn::where('order_id',$request['id'])->get()->all();
        $que = $request['quantity'];
        if($isReturn != []){
            foreach($isReturn as $val){
                $que += $val['quantity'];
            }
        }
        if($order['quantity'] < $que){
            return redirect()->back()->with('error','You cannot add return quantity more that ordered quantity');   
        }
        if($order['quantity'] == $que){
            Order::where('id',$request['id'])->update([
                'status' => 4
            ]);
        }else{
            Order::where('id',$request['id'])->update([
                'status' => 5
            ]);
        }
        $return = OrderReturn::create([
            'order_id' => $request['id'],
            'reason' => $request['reason'],
            'quantity' => $request['quantity']
        ]);
        if(isset($request['good'])){
            Stock::create([
                'product_code' => $order['item'] ?? '',
                'product_name' => $order['name'],
                'type'=>'Return',
                'quantity'=>$request['quantity'],
                'balance'=>$balance['balance']+$request['quantity'],
                'order_id'=>$order['slip_id'],
                'place'=>$order['order_types'],
                'price'=>-$request['quantity']*$order['unit_price']

            ]);
        }else{
            Stock::create([
                'product_code' => $order['item'] ?? '',
                'product_name' => $order['name'],
                'type'=>'Return',
                'quantity'=>$request['quantity'],
                'balance'=>$balance['balance'],
                'order_id'=>$order['slip_id'],
                'place'=>$order['order_types'],
                'price'=>-$request['quantity']*$order['unit_price']

            ]);
        }
        OrderHistory::create([
            'slip_id' => $order['slip_id'],
            'order_id' => $order['order_id'],
            'note' => 'return',
            'quantity' => $request['quantity'],
            'remark' => $request['good'] ?? 'Bad Item'
        ]);
        return redirect()->route('view_order', ['id' => $request['id']])->with('success','Return Request Send Successfully..!');
    }

    public function addNote(Request $request)
    {
        Order::where('id',$request['id'])->update([
            'after_note' => $request['note']
        ]);
        return redirect()->route('view_order', ['id' => $request['id']])->with('success','Note Added Successfully..!');

    }

    public function cancel_order(Request $request)
    {
        Order::where('id',$request['id'])->update([
            'status' => 2
        ]);
        $order = Order::where('id',$request['id'])->get()->first();
        $stock = Stock::where('order_id',$order['slip_id'])->get()->first();
        Stock::create([
            'product_code' => $stock['product_code'] ?? '',
            'product_name' => $stock['product_name'],
            'type'=>'Cancel',
            'quantity'=>$stock['quantity'],
            'balance'=>$stock['balance'],
            'order_id'=>$stock['order_id'],
            'place'=>$stock['place'],
            'price'=>-$stock['price']
        ]);
        OrderHistory::create([
            'slip_id' => $order['slip_id'],
            'order_id' => $order['order_id'],
            'note' => 'Cancel Order',
            'quantity' => $order['quantity'],
            'remark' => ''
        ]);
        return 'Order Cancel successfully.';

    }

    public function delete_order(Request $request)
    {
        Order::where('id',$request['id'])->update([
            'status' => 10
        ]);
        return 'Order Deleted successfully.';

    }

    public function complete_order(Request $request)
    {
        $order = Order::where('id',$request['id'])->get()->first();
        if($order['status'] == 1){
            return 'Order Already Completed.';
        }
        Order::where('id',$request['id'])->update([
            'status' => 1
        ]);
        $quantity = $order['quantity']+$order['quantity'];
        $history = OrderHistory::select('quantity')->where('slip_id',$order['slip_id'])->get()->all();
        $qnt = 0;
        foreach($history as $his){
            $qnt +=$his['quantity'];
        }
        $quantity = $quantity-$qnt;
        OrderHistory::create([
            'slip_id' => $order['slip_id'],
            'order_id' => $order['order_id'],
            'note' => 'Complete Order',
            'quantity' => $quantity,
            'remark' => ''
        ]);
        return 'Order Complete successfully.';

    }

    public function order_history()
    {
        $data = OrderHistory::get()->all();
        dd($data);
    }

// start report module
    public function order_report()
    {
        $data = OrderType::select('order_type')->get()->all();
        return view('admin.report.order_report', compact('data'));
    }

    public function get_order_report(Request $request)
    {
        $data = OrderType::select('order_type')->get()->all();
        $start_date = $request['start_date'];
        $to_date = $request['to_date'];
        $type = $request['type'];
        if($request['type'] == 'All Type'){
            $order = Order::whereBetween('date',[$request['start_date'], $request['to_date']])->get()->all();
        }else{
            $order = Order::where('order_types',$type)->whereBetween('date',[$request['start_date'], $request['to_date']])->get()->all();
        }
        $transection = 0;
        $total_order = 0;
        $shipping = 0;
        $cancel = 0;
        foreach($order as $value){
            $total_order++;
            $transection += $value['quantity']*$value['unit_price'];
            if($value['status'] == 2){
                $cancel++;
            }
            if($value['status']==5 || $value['status']==0){
                $shipping++;
            }
        }
        return view('admin.report.order_report', compact('data','order','transection','total_order','shipping','cancel','start_date','to_date','type'));
    }

    public function product_report()
    {
        $data = Product::orderBy('id', 'desc')->get()->all();
        $stock = Stock::get()->all();
        
            foreach($data as $key => $value){
                $stock = Stock::select('balance')->where('product_code',$value['product_code'])->get()->last();
            if($stock != ''){
                $data[$key]['qty'] = $stock['balance'];
            }
        }
        return view('admin.report.product_report', compact('data'));
    }

    public function low_stock_report()
    {
        $data = Product::orderBy('id', 'desc')->get()->all();
        $stock = Stock::get()->all();
            foreach($data as $key => $value){
                $stock = Stock::select('balance')->where('product_code',$value['product_code'])->get()->last();
                if($stock != ''){
                if($stock['balance'] >0 && $stock['balance'] < 6){
                    $data[$key]['qty'] = $stock['balance'];
                }
            
            }
        }
        return view('admin.report.low_stock_report', compact('data'));
    }

    public function out_stock_report()
    {
        $data = Product::orderBy('id', 'desc')->get()->all();
        $stock = Stock::get()->all();
        
            foreach($data as $key => $value){
                $stock = Stock::select('balance')->where('product_code',$value['product_code'])->get()->last();
                if($stock != ''){
                $data[$key]['qty'] = $stock['balance'];
            }
        }
        return view('admin.report.out_stock_report', compact('data'));
    }


}
