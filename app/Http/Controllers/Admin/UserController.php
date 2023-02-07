<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanyBank;
use App\Models\UserBank;
use App\Models\UserDeposit;
use App\Models\UserSendMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Auth;
use Pusher\Pusher;

class UserController extends Controller
{
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
        return view('bank_detail', compact('user_id'));
    }

    public function send_form()
    {
        $user_id = Auth::user()->id;
        $bank = UserBank::where('user_id', $user_id)->get()->first();
        if(isset($bank->id)){
            return view('send_amount', compact('bank'));
        }
        return view('bank_detail', compact('user_id'));
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

        $sender->amount = $sender->amount - $request->amount;
        $sender->save();

        $receiver->amount = $receiver->amount + $request->amount;
        $receiver->save();
        
        $send = new UserSendMoney();
        $send->sender_name = Auth::user()->name;
        $send->sender_id = Auth::user()->id;
        $send->receiver_name = $request->receiver;
        $send->receiver_id = $receiver_data->id;
        $send->amount = $request->amount;
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

        return view('deposit_success');

    }

    public function bank_confirm(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_bank = new UserBank();
        $user_bank->user_id = $user_id;
        $user_bank->bank_name = $request->bank_name;
        $user_bank->account_name = $request->account_name;
        $user_bank->account_number = $request->account_number;
        $user_bank->save();

        return view('deposit_success');
    }

    public function deposit_confirm(Request $request)
    {
        $amount = $request->amount;
        $content = $request->content;
        $active_bank = CompanyBank::where('status',1)->get()->first();
        return view('deposit_confirmation', compact('active_bank','amount','content'));
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

}

