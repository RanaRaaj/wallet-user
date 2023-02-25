<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
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
    color: #ff4949;
}
</style>

  <title>Sended Amount</title>
</head>
  <body>
    <div class="container">

      <x-side-bar />
      
      <div class="container my-5 news">
        <h2 class="text-center mb-5">Notifications</h2>
          <div class="list-group">
                <a href="{{route('detail.view',['type' => 'admin_rcv'])}}" class="list-group-item list-group-item-action" id="sendAmountBtn">
                  <i class="fas fas fa-receipt"></i>&nbsp&nbsp&nbsp Received From System <span class="new_right" id="deposit_admin"> <span></span></span>
                </a>
                <a href="{{route('detail.view',['type' => 'send'])}}" class="list-group-item list-group-item-action" id="sendAmountBtn">
                  <i class="fas fa-paper-plane"></i>&nbsp&nbsp&nbsp Send Amount
                </a>
                <a href="{{route('detail.view',['type' => 'rcv'])}}" class="list-group-item list-group-item-action" id="receiveAmountBtn">
                  <i class="fas fa-money-bill-alt"></i>&nbsp&nbsp&nbsp Received Amount <span class="new_right withdraw" id="received"> <span></span></span>
                </a>
                <a href="{{route('detail.view',['type' => 'deposit'])}}" class="list-group-item list-group-item-action" id="sendAmountBtn">
                  <i class="fas fa-money-bill-alt"></i>&nbsp&nbsp&nbsp Deposit Amount <span class="new_right" id="deposit"> <span></span></span>
                </a>
                <a href="{{route('detail.view',['type' => 'profit'])}}" class="list-group-item list-group-item-action" id="receiveAmountBtn">
                  <i class="fas fa-money-bill-alt"></i>&nbsp&nbsp&nbsp Profit Details <span class="new_right" id="payment_interest"> <span></span></span>
                </a>
                <a href="{{route('detail.view',['type' => 'withdraw'])}}" class="list-group-item list-group-item-action" id="receiveAmountBtn">
                  <i class="fas fa-credit-card"></i>&nbsp&nbsp&nbsp Withdraw Details <span class="new_right withdraw" id="withdraw"> <span></span></span>
                </a>
            <a href="{{route('welcome')}}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      </div>

    </div>

  </body>
</html>
