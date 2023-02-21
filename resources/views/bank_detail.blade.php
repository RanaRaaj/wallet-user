

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
    padding-left: 0;
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
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: -200px;
    width: 200px;
    background: #464545;
    transition: left 0.3s ease-out;
    color: #fff;
    z-index: 999;
}

.sidebar.open {
  left: 0;
}

.sidebar-toggle {
  position: absolute;
  top: 10px;
  right: 10px;
  background: transparent;
  border: none;
  outline: none;
  cursor: pointer;
}
.justify-content-center fieldset {
    padding-top: 1%;
}
.justify-content-center.m-2 fieldset {
    padding-top: 3%;
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
                                                <h2>Bank Detail</h2>
                                                <form id="deposit_form" action="{{route('bank.confirm')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" @if(isset($bank->id)) name="id" value="{{$bank->id}}" @endif>
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else User Name @endif</label>
                                                        <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control"
                                                               id="basicInput" disabled>
                                                        @if($errors->has('name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Nhóm quyền @else Bank Name @endif</label>
                                                        <select name="bank_name" class="form-control" id="basicInput" required>
                                                            <option value="">Select You Bank</option>
                                                            <option value="BIDV">BIDV</option>
                                                            <option value="ACB">ACB</option>
                                                            <option value="VCB">VCB</option>
                                                        </select>

                                                        @if($errors->has('bank_name'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('bank_name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else Account Name @endif</label>
                                                        <input type="text" name="account_name" value="{{$bank->account_name ?? ''}}" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('account_name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('account_name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else Account Number @endif</label>
                                                        <input type="number" name="account_number" value="{{$bank->account_number ?? ''}}" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('account_number'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('account_number')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('welcome')}}"
                                                               class="btn btn-primary">Back to Home</a>
                                                            <button type="submit" class="btn btn-success">Add
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

</body>