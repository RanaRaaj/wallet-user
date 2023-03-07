<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <title>Taco Collect System  </title><!-- Custom CSS -->
    <style>
    .list-group {
      margin-top: 4%;
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
    a.list-group-item.list-group-item-action {
        background-color: hsl(273deg 77% 55%);
        border-radius: 16px !important;
        color: #ffff;
    }

    @keyframes fadein {
      from { opacity: 0; }
      to   { opacity: 1; }
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    a.back_arrow {
        margin: 9% 0%;
        font-size: 22px;
        color: #fff;
    }
    .news-image > img {
      width: 70px;
      height: 70px;
    }
    . padding-zero {
      padding: 0 !important;
    }
    .news-text {
        padding-left: 23px;
        padding-right: 0 !important;
    }
    .sub-main-text , .main-text {
      padding: 0 !important;
    }
    .padding-zero.news-text {
        font-size: 13px;
        text-transform: capitalize;
    }
    .date-time-news {
        text-align: right;
        font-size: 10px;
    }
    .date-time-news > p {
        margin: 0;
    }

</style>

  <title>Sended Amount</title>
</head>
  <body>
    <x-side-bar />
    <div class="container">

      @if($type == 'news')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">News</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action bg-dark" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                    <div class="row story-2 main-text stories">
                      <div class="col-12 sub-main-text d-flex align-items-center padding-zero">
                        <div class="col-3 d-flex align-items-left padding-zero">
                          <img style="width: 70px;height: 70px;" src="{{$sendAmountDetail['image']}}" alt="">
                        </div>
                        <div class="col-9 align-items-center padding-zero news-text" style="color: #fff !important;">
                          <p style="color: #ebe894;margin-bottom:5px;">{{ substr( $sendAmountDetail['title'], 0, 35) }}...</p>
                          <p>{{ substr( $sendAmountDetail['short_description'], 0, 70) }}...</p>
                        </div>
                      </div>
                      <div class="col-12 date-time-news">
                        <p>{{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                      </div>
                    </div>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" style="background:#fff;color:#000;">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Send Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>Title:</strong> {{ $sendAmountDetail->title }}</p>
                        <img style="width: 100%;" src="{{$sendAmountDetail['image']}}" alt="">
                        <p class="off-white-color"><strong>Publish Time: <br> </strong> {{ $sendAmountDetail->created_at->diffForHumans() }} <br> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                        <p class="off-white-color"><strong> <br> </strong> {!! $sendAmountDetail->short_description !!}</p>
                        <p class="off-white-color"><strong> </strong> {!! $sendAmountDetail->full_description !!}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3 btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'send')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">@if(Session::get('language') == 'vie') Tiền đã gửi @else Sended Amount @endif</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 off-white-color">{{ $sendAmountDetail->receiver_name }}</h5>
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1 off-white-color">{{ $sendAmountDetail->content }}</p>
                <small class="off-white-color">@if(Session::get('language') == 'vie') Số tiền @else Amount @endif: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} {{$sendAmountDetail->type}}</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">@if(Session::get('language') == 'vie') Chi tiết  gửi tiền @else Send Amount Detail @endif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Gửi tới @else Send To @endif:</strong> {{ $sendAmountDetail->receiver_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Nội dung @else Content @endif:</strong> {{ $sendAmountDetail->content }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tiền @else Amount @endif:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} {{$sendAmountDetail->type}}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Từ ngân hàng @else From Bank Name @endif:</strong> {{ $sendAmountDetail->sender_bank_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Từ số tài khoản NH @else From Bank Number @endif:</strong> {{ $sendAmountDetail->sender_bank_number }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tới ngân hàng @else To Bank Name @endif:</strong> {{ $sendAmountDetail->receiver_bank_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tới số tài khoản NH @else To Bank Number @endif:</strong> {{ $sendAmountDetail->receiver_bank_number }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'rcv')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">@if(Session::get('language') == 'vie') Tiền đã nhận @else Received Amount @endif</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 off-white-color">{{ $sendAmountDetail->sender_name }}</h5>
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1 off-white-color">{{ $sendAmountDetail->content }}</p>
                <small class="off-white-color">@if(Session::get('language') == 'vie') Số tiền @else Amount @endif: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">@if(Session::get('language') == 'vie') Chi tiết tiết giao dịch @else Amount Detail @endif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Người gửi @else Sender Name @endif:</strong> {{ $sendAmountDetail->sender_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Nội dung @else Content @endif:</strong> {{ $sendAmountDetail->content }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tiền @else Amount @endif:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'exchange')
        <div class="container my-5 news">
          <h2 class="text-center">Exchange Amount</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>
          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              @php
                $amount = json_decode($sendAmountDetail->exchange);
              @endphp
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <!-- <p class="mb-1 off-white-color">{{ $sendAmountDetail->content }}</p> -->
                <small> {{number_format($amount[0]->first, 2, '.', ',')}} @if($sendAmountDetail->type == 'vnd') VND @else USDT @endif To {{number_format($amount[0]->second, 2, '.', ',')}} @if($sendAmountDetail->type == 'vnd') USDT @else VND @endif</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Exchange Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>Exchange Rate:</strong> {{number_format($sendAmountDetail->exchange_rate, 2, '.', ',')}}</p>
                        <!-- <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Nội dung @else Content @endif:</strong> {{ $sendAmountDetail->content }}</p> -->
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tiền @else Amount @endif:</strong> {{number_format($amount[0]->first, 2, '.', ',')}} @if($sendAmountDetail->type == 'vnd') VND @else USDT @endif To {{number_format($amount[0]->second, 2, '.', ',')}} @if($sendAmountDetail->type == 'vnd') USDT @else VND @endif</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'admin_rcv')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">@if(Session::get('language') == 'vie') Đã nhận từ hệ thống @else Received From System @endif</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 off-white-color">Admin</h5>
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1 off-white-color">{{ $sendAmountDetail->content ?? '' }}</p>
                <small class="off-white-color">@if(Session::get('language') == 'vie') Số tiền @else Amount @endif: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">@if(Session::get('language') == 'vie') Chi tiết tiết giao dịch @else Amount Detail @endif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Người gửi @else Sender @endif :</strong> Admin</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Nội dung @else Content @endif:</strong> {{ $sendAmountDetail->content }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tiền @else Amount @endif:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'profit')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">@if(Session::get('language') == 'vie') Lãi qua đêm @else Daily Interest Profit @endif</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 off-white-color" style="font-size: 14px;">{{ $sendAmountDetail->bank_name }}</h5>
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <!-- <p class="mb-1 off-white-color">{{ $sendAmountDetail->content ?? '' }}</p> -->
                <small class="off-white-color">@if(Session::get('language') == 'vie') Số tiền @else Amount @endif: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">@if(Session::get('language') == 'vie') Chi tiết @else Amount Detail @endif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tên ngân hàng @else Bank Name @endif :</strong> {{ $sendAmountDetail->bank_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tên tài khoản ngân hàng @else Bank Account Name @endif:</strong> {{ $sendAmountDetail->account_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tài khoản ngân hàng @else Bank Account Number @endif:</strong> {{ $sendAmountDetail->account_number }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tiền lãi đã nhận @else Added Amount @endif:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'deposit')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">@if(Session::get('language') == 'vie') yêu cầu nạp tiền @else Deposit Requests @endif</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  @if($sendAmountDetail->status == '1')
                    <h5 class="mb-1" style="color: #03ff03">@if(Session::get('language') == 'vie') Đã xử lý @else Approved @endif  </h5>
                  @elseif($sendAmountDetail->status == '0')
                    <h5 class="mb-1" style="color: red">@if(Session::get('language') == 'vie') Từ chối @else Cancel @endif</h5>
                  @else
                    <h5 class="mb-1" style="color: #ffc107;">@if(Session::get('language') == 'vie') Đang chờ xử lý... @else Pending... @endif</h5>
                  @endif
                  
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1 off-white-color">{{ $sendAmountDetail->content ?? '' }}</p>
                <small class="off-white-color">@if(Session::get('language') == 'vie') Số tiền @else Amount @endif: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">@if(Session::get('language') == 'vie') Chi tiết nạp tiền @else Deposit Detail @endif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Trạng thái @else Status @endif :</strong>
                          @if($sendAmountDetail->status == '1')
                          @if(Session::get('language') == 'vie') Đã xử lý @else Approved @endif
                          @elseif($sendAmountDetail->status == '0')
                          @if(Session::get('language') == 'vie') Từ chối @else Cancel @endif
                          @else
                          @if(Session::get('language') == 'vie') Đang chờ xử lý... @else Pending... @endif
                          @endif
                        </p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Nội dung @else Content @endif:</strong> {{ $sendAmountDetail->content }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tiền @else Amount @endif:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tên ngân hàng @else Bank Name @endif:</strong> {{ $sendAmountDetail->bank_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tên tài khoản ngân hàng @else Bank Account Name @endif:</strong> {{ $sendAmountDetail->account_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tài khoản ngân hàng @else Bank Account Number @endif:</strong> {{ $sendAmountDetail->account_number }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian xử lý @else Approve Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->approval_time . ' +7 hours'))}}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Lý do @else Reason @endif:</strong> {{ $sendAmountDetail->reason }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'status')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">@if(Session::get('language') == 'vie') yêu cầu nạp tiền @else Deposit Requests @endif</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  @if($sendAmountDetail->status == '1')
                    <h5 class="mb-1" style="color: #94dd94">@if(Session::get('language') == 'vie') Đã xử lý @else Approved @endif</h5>
                  @elseif($sendAmountDetail->status == '0')
                    <h5 class="mb-1" style="color: red">@if(Session::get('language') == 'vie') Từ chối @else Cancel @endif</h5>
                  @else
                    <h5 class="mb-1" style="color: #ffc107;">@if(Session::get('language') == 'vie') Đang chờ xử lý... @else Pending... @endif</h5>
                  @endif
                  
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1 off-white-color">{{ $sendAmountDetail->content ?? '' }}</p>
                <small class="off-white-color">@if(Session::get('language') == 'vie') Số tiền @else Amount @endif: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Deposit Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Trạng thái @else Status @endif :</strong>
                          @if($sendAmountDetail->status == '1')
                          @if(Session::get('language') == 'vie') Đã xử lý @else Approved @endif
                          @elseif($sendAmountDetail->status == '0')
                          @if(Session::get('language') == 'vie') Từ chối @else Cancel @endif
                          @else
                          @if(Session::get('language') == 'vie') Đang chờ xử lý... @else Pending... @endif
                          @endif
                        </p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Nội dung @else Content @endif:</strong> {{ $sendAmountDetail->content }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tiền @else Amount @endif:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tên ngân hàng @else Bank Name @endif:</strong> {{ $sendAmountDetail->bank_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tên tài khoản ngân hàng @else Bank Account Name @endif:</strong> {{ $sendAmountDetail->account_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tài khoản ngân hàng @else Bank Account Number @endif:</strong> {{ $sendAmountDetail->account_number }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian xử lý @else Approve Time @endif:</strong> {{ $sendAmountDetail->approval_time }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'withdraw')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">@if(Session::get('language') == 'vie') Yêu cầu rút tiền @else Withdraw Requests @endif</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  @if($sendAmountDetail->status == '1')
                    <h5 class="mb-1" style="color: #94dd94">@if(Session::get('language') == 'vie') Đã xử lý @else Approved @endif</h5>
                  @elseif($sendAmountDetail->status == '0')
                    <h5 class="mb-1" style="color: red">@if(Session::get('language') == 'vie') Từ chối @else Cancel @endif</h5>
                  @else
                    <h5 class="mb-1" style="color: #ffc107;">@if(Session::get('language') == 'vie') Đang chờ xử lý... @else Pending... @endif</h5>
                  @endif
                  
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1 off-white-color">{{ $sendAmountDetail->content ?? '' }}</p>
                <small class="off-white-color">@if(Session::get('language') == 'vie') Số tiền @else Amount @endif: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">@if(Session::get('language') == 'vie') Chi tiết rút tiền @else Withdraw Detail @endif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Trạng thái @else Status @endif :</strong>
                          @if($sendAmountDetail->status == '1')
                          @if(Session::get('language') == 'vie') Đã xử lý @else Approved @endif
                          @elseif($sendAmountDetail->status == '0')
                          @if(Session::get('language') == 'vie') Từ chối @else Cancel @endif
                          @else
                          @if(Session::get('language') == 'vie') Đang chờ xử lý... @else Pending... @endif
                          @endif
                        </p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Nội dung @else Content @endif:</strong> {{ $sendAmountDetail->content }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tiền @else Amount @endif:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tên ngân hàng @else Bank Name @endif:</strong> {{ $sendAmountDetail->bank_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Tên tài khoản ngân hàng @else Bank Account Name @endif:</strong> {{ $sendAmountDetail->account_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tài khoản ngân hàng @else Bank Account Number @endif:</strong> {{ $sendAmountDetail->account_number }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian xử lý @else Approve Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->approval_time . ' +7 hours'))}}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') lý do @else Reason @endif:</strong> {{ $sendAmountDetail->reason }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

      @if($type == 'payment')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Sended Amount</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 off-white-color">{{ $sendAmountDetail->receiver_name }}</h5>
                  <small class="off-white-color">{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1 off-white-color">{{ $sendAmountDetail->content }}</p>
                <small class="off-white-color">@if(Session::get('language') == 'vie') Số tiền @else Amount @endif: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Send Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p class="off-white-color"><strong>Send To:</strong> {{ $sendAmountDetail->receiver_name }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Nội dung @else Content @endif:</strong> {{ $sendAmountDetail->content }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Số tiền @else Amount @endif:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Thời gian @else Time @endif:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p class="off-white-color"><strong>@if(Session::get('language') == 'vie') Ngày giờ @else Date-Time @endif:</strong> {{ date('d/m/Y H:i:s', strtotime($sendAmountDetail->created_at . ' +7 hours')) }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  btn-light-dark" data-dismiss="modal">@if(Session::get('language') == 'vie') Đóng @else Close @endif</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3  btn-light-dark">@if(Session::get('language') == 'vie') Quay lại @else Go Back @endif</a>
        </div>
      @endif

    </div>
    <!-- Optional JavaScript -->
  </body>
</html>
