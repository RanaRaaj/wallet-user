<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <title>Mobile Responsive Website</title>
</head>
<style type="text/css">

.links .justify-content-center p{
    font-size: 12px;
    font-weight: 700;
}
.container-fluid.news {
    padding-left: 0px;
}
.justify-content-center fieldset {
    padding-top: 1%;
}
.justify-content-center.m-2 fieldset {
    padding-top: 3%;
}
.card-body {
    padding: 0.25rem !important;
}
fieldset.form-group > label {
    width: 100%;
}
fieldset.form-group > label  > span{
    float: right;
}
</style>
<body>
    <div class="container">
        <x-side-bar />
        <main class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="card news">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-md-8 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                <h2>Send Amount</h2>
                                                <form id="deposit_form" action="{{route('currency.buy')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <fieldset class="form-group">
                                                      <label for="" class="label_edit">VND <span>balance : {{$bank['amount']}} VND</span></label>
                                                      <input type="number" name="vnd" class="form-control" max="{{$bank['amount']}}" id="currency1" value="0.00" min="0" step="0.000001">
                                                      <span id="username-check-result">Exchange Rate: {{$data['usdt']}} USDT = {{$data['vnd']}} VND</span>
                                                      @if($errors->has('usdt'))
                                                        <div class="error" style="color:red">{{$errors->first('usdt')}}</div>
                                                      @endif
                                                    </fieldset>

                                                    <div class="col-sm-2 mt-4 text-center">
                                                      <button id="toggle-currencies-btn" class="btn btn-primary"><span class="fa fa-exchange fa-2x"></span></button>
                                                    </div>

                                                    <fieldset class="form-group">
                                                      <label for="" class="label_edit">USDT <span>balance : {{$bank['usdt']}} USDT</span></label>
                                                      <input type="number" name="usdt" class="form-control" id="currency2" value="" min="0" step="0.000001">
                                                      @if($errors->has('vnd'))
                                                        <div class="error" style="color:red">{{$errors->first('vnd')}}</div>
                                                      @endif
                                                    </fieldset>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('welcome')}}"
                                                               class="btn btn-primary">Home</a>
                                                            <button type="submit" class="btn btn-success">Buy
                                                            </button>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  var usdt = "{{ $data['usdt'] }}";
  var vnd = "{{ $data['vnd'] }}";
  
  // Swap the positions and IDs of the input fields
  function swapCurrencies() {
    var currency1 = $('#currency1');
    var currency2 = $('#currency2');
    var tempVal = currency1.val();
    var tempId = currency1.attr('id');
    currency1.val(currency2.val());
    currency2.val(tempVal);
    currency1.attr('id', currency2.attr('id'));
    currency2.attr('id', tempId);
  }
  
  // Set up event listener for the toggle button
  $('#toggle-currencies-btn').on('click', function(e) {
    e.preventDefault();
    swapCurrencies();
  });
  
  // Set up event listeners for the input fields
  $('#currency1, #currency2').on('input', function() {
    // Get the values of the input fields
    var currency1Val = $('#currency1').val();
    var currency2Val = $('#currency2').val();
    
    // Check which field triggered the event
    if ($(this).attr('id') === 'currency1') {
      // Convert from currency 1 to currency 2
      var convertedVal = currency1Val / vnd; // Replace 2 with the exchange rate
      $('#currency2').val(convertedVal.toFixed(6));
    } else {
      // Convert from currency 2 to currency 1
      var convertedVal = currency2Val * vnd; // Replace 2 with the exchange rate
      $('#currency1').val(convertedVal.toFixed(6));
    }
  });
</script>
<script>
$(document).ready(function() {
    $('#receiver').on('input', function() {
        var receiver = $(this).val();
        $.ajax({
            url: "/check-receiver",
            type: "GET",
            headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
            data: {receiver: receiver},
            success: function(data) {
            	console.log(data);
                if (data == "available") {
                    $('#username-check-result').html('<i class="fa fa-check-circle" style="color: #94dd94;"></i>');
                } else {
                    $('#username-check-result').html('<i class="fa fa-times-circle" style="color: red;"></i>');
                }
            }
        });
    });
});
</script>

</body>