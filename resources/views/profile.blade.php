

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <title>Taco Collect System  </title>
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
        <div class="row mt-3">
            <div class="col-12 bg-primary text-white d-flex align-items-center justify-content-center banner" style="border-radius: 20px;">
                @php
                    $user_id = Auth::user()->id;
                    $bank_detail = DB::table('user_banks')->where('user_id', $user_id)->first();
                    $balance = $bank_detail->amount ?? 0;
                @endphp
                <div class="row" style="width: 100%;">
                  @if(isset($bank_detail->account_name))
                    <div class="col-12 top-banner gold-color">
                      <span>{{$bank_detail->account_name ?? ''}}</span>
                    </div>

                    <div class="col-12 mid-banner gold-color">
                      <p class="m-0">{{$bank_detail->account_number ?? ''}}</p>
                    </div>
                    
                    <div class="bottom-banner row">
                      <div class="col-6">
                        <span class="gold-color">{{$bank_detail->bank_name ?? ''}}</span>
                      </div>
                      <div class="col-6 gold-color" style="text-align: right;">
                        @if(isset($profits[0]))
                        <span class="usdt_data">@if($profits[0]->usdt > '') {{number_format($profits[0]->usdt, 2, '.', ',')}} @else 00 @endif USDT</span><br>
                        @else
                        <span class="usdt_data"> 00 USDT</span><br>
                        @endif
                        <span class="m-0">{{number_format($balance ?? 'not connected')}} VND</span>
                      </div>
                    </div>
                  @else
                    <div class="col-12 top-banner">
                      <span>....</span>
                    </div>

                    <div class="col-12 mid-banner">
                      <p class="m-0 gold-color">0000000000000</p>
                    </div>
                    
                    <div class="bottom-banner row">
                      <div class="col-6">
                        <span>....</span>
                      </div>
                      <div class="col-6 gold-color" style="text-align: right;">
                        <span class="usdt_data">00 USDT</span><br>
                        <span class="m-0">00 VND</span>
                      </div>
                    </div>
                  @endif

                </div>
            </div>
          </div>
        <div class="row">
                <div class="col-12" style="padding-right:0px;padding-left:0px;">
                    <div class="card news">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-md-8 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                <h2>@if(Session::get('language') == 'vie') Cài đặt cá nhân @else Setting Profile @endif</h2>
                                                <form id="deposit_form" action="{{route('profile.update')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" @if(isset($bank->id)) name="id" value="{{$bank->id}}" @endif>
                                                    
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color"> @if(Session::get('language') == 'vie')Tên người dùng @else User Name @endif</label>
                                                        <input type="text" name="user_name" value="{{$user->email ?? ''}}" class="form-control"
                                                               id="basicInput" disabled>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Họ và tên @else Full Name @endif</label>
                                                        <input type="text" name="name" value="{{$user->name ?? ''}}" class="form-control"
                                                               id="basicInput">
                                                        @if($errors->has('name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Số điện thoại @else Phone Number @endif</label>
                                                        <input type="number" name="phone" value="{{$user->phone ?? ''}}" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('phone'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('phone')}}</div>
                                                        @endif
                                                    </fieldset>
                                                    <hr>
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Mật khẩu cũ @else Old Password @endif</label>
                                                        <input type="password" name="old_password" value="{{old('old_password')}}" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('old_password'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('old_password')}}</div>
                                                        @endif
                                                        @if(isset($err))
                                                            <div class="error"
                                                                 style="color:red">{{$err}}</div>
                                                        @endif
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Mật khẩu mới @else New Password @endif</label>
                                                        <input type="password" name="password" value="" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('password'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('password')}}</div>
                                                        @endif
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie')Xác nhận mật khẩu mới @else Confirm Password @endif</label>
                                                        <input type="password" name="password_confirmation" value="{{$user->password_confirmation ?? ''}}" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('password_confirmation'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('password_confirmation')}}</div>
                                                        @endif
                                                    </fieldset>
                                                    

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{ url()->previous() }}"
                                                               class="btn btn-primary btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
                                                            <button type="submit" class="btn btn-success btn-light-dark">@if(Session::get('language') == 'vie') Cập nhật @else Update @endif
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