

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
                                                            @if(isset($panel_bank[0]))
                                                                @foreach($panel_bank as $bank_name)
                                                                    <option value="{{$bank_name->name}}" @if($bank->bank_name == $bank_name->name) selected @endif>{{$bank_name->name}}</option>
                                                                @endforeach
                                                            @endif
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
                                                            <a href="{{ url()->previous() }}"
                                                               class="btn btn-primary">Go Back</a>
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