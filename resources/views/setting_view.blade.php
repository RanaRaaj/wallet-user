<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <title>Taco Collect System  </title><style>

/* Add your custom CSS here */
body {
  background-color: #f2f2f2;
}

.list-group-item {
  animation: fadein 0.5s;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
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
</style>

  <title>Sended Amount</title>
</head>
  <body>
      <x-side-bar />
    <div class="container">

      
      <div class="container my-5 news">
        <h2 class="text-center mb-5">@if(Session::get('language') == 'vie') Cài đặt @else Settings @endif</h2>
          <div class="list-group">
                <a href="{{route('profile.view')}}" class="list-group-item list-group-item-action off-white-color" id="sendAmountBtn">
                  <i class="fas fa-user gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Cá nhân @else Profile @endif
                </a>
                <a href="{{route('bank.view')}}" class="list-group-item list-group-item-action off-white-color" id="sendAmountBtn">
                  <i class="fas fa-credit-card gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Ngân hàng @else Bank @endif
                </a>
                <a href="{{route('language.view')}}" class="list-group-item list-group-item-action off-white-color" id="sendAmountBtn">
                  <i class="fas fa-flag gold-color"></i>&nbsp&nbsp&nbsp @if(Session::get('language') == 'vie') Ngôn ngữ @else Language @endif
                </a>
            <a href="{{route('welcome')}}" class="btn btn-primary mt-3 btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      </div>

    </div>

  </body>
</html>
