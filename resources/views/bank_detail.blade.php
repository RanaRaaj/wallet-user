

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <title>Taco Collect System  </title>
    <!-- Custom CSS -->
</head>
<style type="text/css">
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
                                                <h2>@if(Session::get('language') == 'vie') Chi tiết ngân hàng @else Bank Detail @endif</h2>
                                                <form id="deposit_form" action="{{route('bank.confirm')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" @if(isset($bank->id)) name="id" value="{{$bank->id}}" @endif>
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Tên đăng nhập @else User Name @endif</label>
                                                        <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control"
                                                               id="basicInput" disabled>
                                                        @if($errors->has('name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Tên ngân hàng @else Bank Name @endif</label>
                                                        <select name="bank_name" class="form-control" id="basicInput" required>
                                                            <option value="">Select You Bank</option>
                                                            @if(isset($panel_bank[0]))
                                                                @foreach($panel_bank as $bank_name)
                                                                    <option value="{{$bank_name->name ?? ''}}" @if(isset($bank->bank_name)) @if($bank->bank_name == $bank_name->name) selected @endif @endif>{{$bank_name->name ?? ''}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        @if($errors->has('bank_name'))
                                                            <div class="error"
                                                                style="color:red">{{$errors->first('bank_name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Tên tài khoản @else Account Name @endif</label>
                                                        <input type="text" name="account_name" value="{{$bank->account_name ?? ''}}" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('account_name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('account_name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Số tài khoản @else Account Number @endif</label>
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
                                                            <a href="{{ url()->previous() }}"
                                                               class="btn btn-primary btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
                                                            <button type="submit" class="btn btn-success btn-light-dark">@if(Session::get('language') == 'vie') Cập nhật @else Add @endif
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