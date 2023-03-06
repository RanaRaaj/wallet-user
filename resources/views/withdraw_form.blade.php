<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <title>Taco Collect System  </title>
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
</style>
<body>
        <x-side-bar />
    <div class="container">
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
                                                <h2>@if(Session::get('language') == 'vie')Rút tiền @else Withdraw Amount @endif</h2>
                                                <form id="withdraw_form" action="{{route('withdraw.confirm')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <p style="text-align: center;"><b>@if(Session::get('language') == 'vie')Số dư của bạn @else Your Balance @endif : </b> {{$bank->amount}}</p>
                                                
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Số tiền @else Amount @endif VND</label>
                                                        <input type="number" name="amount" class="form-control"
                                                               id="basicInput" max={{$bank->amount}} value="" required>
                                                        @if($errors->has('amount'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('amount')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Tên ngân hàng @else Bank Name @endif</label>
                                                        <input type="text" name="bank_name" class="form-control"
                                                               id="basicInput" value="{{$bank->bank_name}}" disabled>
                                                        @if($errors->has('bank_name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('bank_name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Tên tài khoản ngân hàng @else Your Account Name @endif</label>
                                                        <input type="text" name="account_name" class="form-control"
                                                               id="basicInput" value="{{$bank->account_name}}" disabled>
                                                        @if($errors->has('account_name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('account_name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Số tài khoản ngân hàng @else Your Account number @endif</label>
                                                        <input type="number" name="account_number" class="form-control" id="basicInput" value="{{$bank->account_number}}" disabled>

                                                        @if($errors->has('account_number'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('account_number')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <!-- <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Nhóm quyền @else Content @endif</label>
                                                        <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
                                                        @if($errors->has('content'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('content')}}</div>
                                                        @endif
                                                    </fieldset> -->

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('welcome')}}"
                                                               class="btn btn-primary">Home</a>
                                                            <button type="submit" class="btn btn-success">@if(Session::get('language') == 'vie')Rút @else Withdraw @endif
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
    
    <script>
        const form = document.getElementById('withdraw_form');
        const bankName = form.querySelector('input[name="bank_name"]');
        const accountName = form.querySelector('input[name="account_name"]');
        const accountNumber = form.querySelector('input[name="account_number"]');

        form.addEventListener('submit', function(event) {
            bankName.disabled = false;
            accountName.disabled = false;
            accountNumber.disabled = false;
        });
    </script>

</body>