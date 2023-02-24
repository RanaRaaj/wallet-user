

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    <div class="container">
      <x-side-bar />
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
                    <div class="col-12 top-banner">
                      <span>{{$bank_detail->account_name ?? ''}}</span>
                    </div>

                    <div class="col-12 mid-banner">
                      <p class="m-0">{{$bank_detail->account_number ?? ''}}</p>
                    </div>
                    
                    <div class="bottom-banner row">
                      <div class="col-6">
                        <span>{{$bank_detail->bank_name ?? ''}}</span>
                      </div>
                      <div class="col-6" style="text-align: right;">
                        <span class="usdt_data">@if($profits[0]->usdt != '') {{$profits[0]->usdt}} @else 00 @endif USDT</span><br>
                        <span class="m-0">{{number_format($balance ?? 'not connected')}} VND</span>
                      </div>
                    </div>
                  @else
                    <div class="col-12 top-banner">
                      <span>....</span>
                    </div>

                    <div class="col-12 mid-banner">
                      <p class="m-0">0000000000000</p>
                    </div>
                    
                    <div class="bottom-banner row">
                      <div class="col-6">
                        <span>....</span>
                      </div>
                      <div class="col-6" style="text-align: right;">
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
                                                <h2>Setting Profile</h2>
                                                <form id="deposit_form" action="{{route('profile.update')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" @if(isset($bank->id)) name="id" value="{{$bank->id}}" @endif>
                                                    
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else User Name @endif</label>
                                                        <input type="text" name="name" value="{{$user->name ?? ''}}" class="form-control"
                                                               id="basicInput" disabled>
                                                        @if($errors->has('name'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('name')}}</div>
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else Phone Number @endif</label>
                                                        <input type="number" name="phone" value="{{$user->phone ?? ''}}" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('phone'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('phone')}}</div>
                                                        @endif
                                                    </fieldset>
                                                    <hr>
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else Old Password @endif</label>
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
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else New Password @endif</label>
                                                        <input type="password" name="password" value="" class="form-control"
                                                               id="basicInput" require>
                                                        @if($errors->has('password'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('password')}}</div>
                                                        @endif
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="" class="label_edit">@if(Session::get('language') == 'vie')Tên người dùng @else Confirm Password @endif</label>
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
                                                               class="btn btn-primary">Go Back</a>
                                                            <button type="submit" class="btn btn-success">Update
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