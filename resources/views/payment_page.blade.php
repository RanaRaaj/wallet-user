<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <title>Wallet - User</title><!-- Custom CSS -->
    <style>

/* Add your custom CSS here */
body {
  background-color: #f2f2f2;
}

.list-group-item {
  animation: fadein 0.5s;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  /*box-shadow: 2px 2px 10px #ccc;*/
  margin-bottom: 10px;
  padding: 10px;
}

@keyframes fadein {
  from { opacity: 0; }
  to   { opacity: 1; }
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}
#sendAmountBtn, #receiveAmountBtn {
    background: hsl(273deg 77% 55%);
    color: #fff;
    border-radius: 10px !important;
    padding: 4%;
    margin: 2% 0%;
}
span.new_right {
    float: right;
    color: #fff;
    background: #ff4949;
    border-radius: 50%;
    padding: 0% 2%;
}
</style>

<title>Taco Collect System  </title>
</head>
  <body>
      <x-side-bar />
    <div class="container">

      
      <div class="container my-5 news">
        <h2 class="text-center mb-5">@if(isset($variable)) @if(Session::get('language') == 'vie') Giao dịch @else {{$variable}} @endif @else @if(Session::get('language') == 'vie') Thông báo @else Notifications @endif @endif</h2>
          <div class="list-group">
                <a href="{{route('detail.view',['type' => 'admin_rcv'])}}" class="list-group-item list-group-item-action off-white-color" id="sendAmountBtn">
                  <i class="fas fas fa-receipt gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Đã nhận từ hệ thống @else Received From System @endif <span class="new_right" id="deposit_admin"> <span></span></span>
                </a>
                <a href="{{route('detail.view',['type' => 'send'])}}" class="list-group-item list-group-item-action off-white-color" id="sendAmountBtn">
                  <i class="fas fa-paper-plane gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Tiền gửi @else Send Amount @endif
                </a>
                <a href="{{route('detail.view',['type' => 'rcv'])}}" class="list-group-item list-group-item-action off-white-color" id="receiveAmountBtn">
                  <i class="fas fa-money-bill-alt gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Tiền đã nhận @else Received Amount @endif <span class="new_right withdraw" id="received"> <span></span></span>
                </a>
                <a href="{{route('detail.view',['type' => 'deposit'])}}" class="list-group-item list-group-item-action off-white-color" id="sendAmountBtn">
                  <i class="fas fa-money-bill-alt gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Tiền đã nạp @else Deposit Amount @endif <span class="new_right" id="deposit"> <span></span></span>
                </a>
                <a href="{{route('detail.view',['type' => 'profit'])}}" class="list-group-item list-group-item-action off-white-color" id="receiveAmountBtn">
                  <i class="fas fa-money-bill-alt gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Chi tiết tiền lãi @else Profit Details @endif <span class="new_right" id="payment_interest"> <span></span></span>
                </a>
                <a href="{{route('detail.view',['type' => 'withdraw'])}}" class="list-group-item list-group-item-action off-white-color" id="receiveAmountBtn">
                  <i class="fas fa-credit-card gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Chi tiết rút tiền @else Withdraw Details @endif <span class="new_right withdraw" id="withdraw"> <span></span></span>
                </a>
            <a href="{{route('welcome')}}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      </div>

    </div>

  </body>
</html>
