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
                                                <form id="deposit_form" action="{{route('send.confirm')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <fieldset class="form-group" style="display: none;">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else Name @endif</label>
                                                        <input type="text" name="name" value="Admin test" class="form-control"
                                                               id="basicInput" disabled>
                                                        @if($errors->has('name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')ID đăng nhập @else Send To @endif</label>
                                                        <input type="text" name="receiver" value="{{old('receiver')}}" id="receiver" class="form-control"
                                                            id="basicInput" required><span id="username-check-result"></span>

                                                        @if($errors->has('receiver'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('receiver')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')ID đăng nhập @else Amount : Maximum {{$bank->amount}} VND @endif</label>
                                                        <input type="number" name="amount" value="{{old('amount')}}" class="form-control"
                                                            id="basicInput" max="{{$bank->amount}}" required>

                                                        @if($errors->has('amount'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('amount')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Nhóm quyền @else Content @endif</label>
                                                        <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
                                                        @if($errors->has('role'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('role')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <!-- <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Nhóm quyền @else Bank Name @endif</label>
                                                        <select name="bank_name" class="form-control" id="basicInput" disabled>
                                                            <option value="{{$bank->amount}}">{{$bank->amount}}</option>
                                                            <option value="BIDV">BIDV</option>
                                                            <option value="ACB">ACB</option>
                                                            <option value="VCB">VCB</option>
                                                        </select>

                                                        @if($errors->has('role'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('role')}}</div>
                                                        @endif
                                                    </fieldset> -->

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('welcome')}}"
                                                               class="btn btn-primary">Home</a>
                                                            <button type="submit" class="btn btn-success">Send
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
                    $('#username-check-result').html('<i class="fa fa-check-circle" style="color: green;"></i>');
                } else {
                    $('#username-check-result').html('<i class="fa fa-times-circle" style="color: red;"></i>');
                }
            }
        });
    });
});
</script>

</body>