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

.justify-content-center > i, .justify-content-center > a > i {
    background: #748EF2;
    border-radius: 5px;
    padding: 18%;
    font-size: 2.5pc;
    color: #fff;
    margin: 0;
}
.fixed-top {
    position: sticky !important;
}
.justify-content-center:nth-child(2) > i{
    background: #FFCBCD;
}
.justify-content-center:nth-child(4) > i{
    background: #CF83DA;
}
.col-3.align-items-center.justify-content-center {
    padding: 0 !important;
}
.d-flex.justify-content-right {
  justify-content: flex-end;
}
.links {
    padding-bottom: 5%;
    text-align: center;
}
.transaction {
    padding-bottom: 2%;
}
.top-left {
    padding-left: 15px;
}
.top-right {
    padding-right: 0;
}
header.d-flex.align-items-center.bg-light {
    padding-top: 2%;
}
.top-left span {
    font-size: 14px;
    text-transform: capitalize;
    color: #8b8484;
}
.top-left p {
    font-weight: 700;
    font-size: 16px;
    text-transform: capitalize;
}
header {
    top: -100px;
    left: 0;
    right: 0;
    z-index: 999;
    transition: top 0.5s ease;
}

.fixed-top {
    background-color: #fff !important;
    top: 0;
}
.top-right > img {
    vertical-align: middle;
    border-style: none;
    padding: 5%;
    border-radius: 20px;
}
header#header {
    padding-top: 4%;
}

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
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-md-8 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                <h2>Deposit Amount</h2>
                                                <form id="deposit_form" action="{{route('deposit.confirm')}}" method="post"
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
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')ID đăng nhập @else Amount : VND @endif</label>
                                                        <input type="number" name="amount" value="{{old('amount')}}" class="form-control"
                                                            id="basicInput" required>

                                                        @if($errors->has('amount'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('amount')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Nhóm quyền @else Bank Name @endif</label>
                                                        <select name="bank_name" class="form-control" id="basicInput" disabled>
                                                            <option value="{{$active_bank->bank_name}}">{{$active_bank->bank_name}}</option>
                                                            <option value="BIDV">BIDV</option>
                                                            <option value="ACB">ACB</option>
                                                            <option value="VCB">VCB</option>
                                                        </select>

                                                        @if($errors->has('role'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('role')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Nhóm quyền @else Content @endif</label>
                                                        <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
                                                        @if($errors->has('content'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('content')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('welcome')}}"
                                                               class="btn btn-primary">Home</a>
                                                            <button type="submit" class="btn btn-success">Next
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
// $('#deposit_form').on('submit', function(e) {
//     e.preventDefault(); 
//     $.ajax({
//         type: "POST",
//         url: '',
//         data: $(this).serialize(),
//         success: function(msg) {
//         alert(msg);
//         }
//     });
// });

  $(document).ready(function() {
    $(".sidebar-toggle").click(function() {
      $(".sidebar").toggleClass("open");
    });
  });

  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('fixed-top');
    } else {
      $('#header').removeClass('fixed-top');
    }
  });
</script>

</body>