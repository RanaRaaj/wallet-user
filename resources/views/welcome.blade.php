<!DOCTYPE html>
<html lang="en">
<title>Taco Collect System  </title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .justify-content-right > span {
  color: #fff ;
  font-size: 10px !important;
}
.col-9.align-items-center > span {
  font-size: 10px;
  font-weight: 500;
}
.col-9.align-items-center p {
  font-size: 11px;
  font-weight: 700;
}
.container-fluid.col-md-6 {
  padding: 0px 10px;
}
span.usdt_data {
  font-size: 15px;
}
span.exchange_value > span {
  font-size: 11px !important;
  color: #fff ;
}
span.exchange_value {
  font-size: 11px !important;
  color: #fff ;
  text-align: center;
  margin-top: 11%;
  line-height: 19px;
}
p#current_rate {
  margin: 0;
  width: 100%;
  text-align: center;
  font-size: 13px;
  font-family: math;
}
.stories > .justify-content-right {
  padding-top: 3%;
}
.stories > .align-items-center, .align-items-center > .align-items-center , .stories > .justify-content-right {
padding: 0 !important;
}
.align-items-center > .align-items-left {
padding-right: 0;
}
.justify-content-right > a {
padding-right: 15px !important;
}
hr {
  margin-top: 0rem !important;
}
.news-title {
font-size: 11px !important;
font-weight: 700 !important;
color: #ebe894;
text-transform: capitalize;
}
.align-items-center.justify-content-center > a > img {
  width: 77%;
}
.container-fluid > .news > .d-flex.align-items-center {
  padding-left: 0;
}
#stars {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: radial-gradient(circle, #fff 1px, transparent 1px);
  background-size: 10px 10px;
}
.news.ex.bg-main > .row {
    width: 100%;
    margin-left: 0% !important;
}
.graph-btn {
    width: 100% !important;
}
#not_buy {
  color: red;
}
button.close_model {
    color: #000;
    background: #ffc107;
    border: navajowhite;
    border-radius: 3px;
    font-size: 15px;
}
.gp {
    color: #ffc107;
    text-transform: uppercase;
}
</style>
<body>
<x-side-bar />  
    <div class="container">
        <main class="container-fluid">
        
          <div class="row mt-3">
            <div class="col-12 text-white d-flex align-items-center justify-content-center banner" style="border-radius: 20px;">
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
                      <p class="m-0" style="color: #fff;">{{$bank_detail->account_number ?? ''}}</p>
                    </div>
                    
                    <div class="bottom-banner row">
                      <div class="col-6" style="text-align: left;">
                        <span class="usdt_data">{{$bank_detail->bank_name ?? ''}}</span>
                      </div>
                      <div class="col-6" style="text-align: right;">
                        @if($balance > 0)
                        <span class="usdt_data">@if($profits[0]->usdt > '') {{number_format($profits[0]->usdt, 2, '.', ',')}} @else 00 @endif USDT</span><br>
                        @else
                        <span class="usdt_data"> 00 USDT</span><br>
                        @endif
                        <span class="m-0 usdt_data">{{number_format($balance ?? 'not connected')}} VND</span>
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

          <div class="row mt-3 links">

              <div class="col-3 align-items-center justify-content-center">
                  <a href="{{route('deposit.form')}}">
                      <i class="fas fa-list-ul fa-2x gold-color bg-main"></i>
                      <p class="mt-2">@if(Session::get('language') == 'vie') Nạp tiền @else Deposit @endif</p>
                  </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('withdraw.form')}}">
                  <i class="fas fa-credit-card fa-2x gold-color bg-main"></i>
                  <p class="mt-2">@if(Session::get('language') == 'vie') Rút tiền @else Withdraw @endif</p>
                </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                  <a href="{{route('send.form.view')}}">
                      <i class="fas fa-paper-plane fa-2x gold-color bg-main"></i>
                      <p class="mt-2">@if(Session::get('language') == 'vie') Gửi tiền @else Send @endif</p>
                  </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('detail.view',['type' => 'profit'])}}">
                  <i class="fas fa-money-bill fa-2x gold-color bg-main"></i>
                  <p class="mt-2">@if(Session::get('language') == 'vie') Tiền lãi @else Profit @endif</p>
                </a>
              </div>
              
          </div>
          <div class="row mt-3 links">

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('payment.page', ['variable' => 'Payment'])}}">
                  <i class="fas fa-money-check fa-2x gold-color bg-main"></i>
                  <p class="mt-2">@if(Session::get('language') == 'vie') Giao dịch @else Payment @endif</p>
                </a>
              </div>
              
              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('status.view')}}">
                  <i class="fas fa-check-circle fa-2x gold-color bg-main"></i>
                  <p class="mt-2">@if(Session::get('language') == 'vie') Trạng thái GD @else Status @endif</p>
                </a>
              </div>
              
              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('setting.view')}}">
                  <i class="fas fa-cog fa-2x gold-color bg-main"></i>
                  <p class="mt-2">@if(Session::get('language') == 'vie') Cài đặt @else Setting @endif</p>
                </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('currency.exchange')}}">
                  <!-- <img src="{{asset('assets/usdt.jpg')}}" alt=""> -->
                  <i class="fas fa-money-bill-alt fa-2x gold-color bg-main"></i>
                  <p class="mt-2">@if(Session::get('language') == 'vie') Mua/Bán USDT @else Buy/Sell USDT @endif</p>
                </a>
              </div>
              
          </div>
        </main>
      <div class="row">
        <!-- <select id="currency-select-1" onchange="updateChart()">
          <option value="usdt">USDT</option>
          <option value="vnd">VND</option>
          <option value="usd" selected>USD</option>
        </select>
        <select id="currency-select-2" onchange="updateChart()">
          <option value="usdt" selected>USDT</option>
          <option value="vnd">VND</option>
          <option value="usd">USD</option>
        </select>
        <canvas id="myChart"></canvas> -->


        <div class="container-fluid transaction">            
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news ex">
              <!-- <canvas id="myChart"></canvas> -->
              <p id="current_rate"></p>
              <canvas id="dailyChart" style="height: 200px; width: 100%;"></canvas>
              <div class="row">
                <div class="col-6">
                  <a href="#" class="btn btn-success graph-btn" data-toggle="modal" data-target="#modalBuy">@if(Session::get('language') == 'vie') Mua @else Buy @endif</a>
                  <input type="hidden" id="total_usdt" value="{{$user_bank['usdt']}}">
                  <input type="hidden" id="total_vnd" value="{{$user_bank['amount']}}">
                  <input type="hidden" id="exchange_rate" value="{{$currency_rate['vnd']}}">
                  <!-- Buy USDT Modal -->
                  <div class="modal fade" id="modalBuy" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title gp" id="exampleModalCenterTitle">@if(Session::get('language') == 'vie') Mua @else Buy @endif USDT</h5>
                        <button class="close_model" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        @if(Session::get('language') == 'vie') Đóng @else Close @endif
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action="{{route('buy.usdt')}}" method="POST">
                        @csrf
                        <label for="">@if(Session::get('language') == 'vie') Số dư hiện tại @else Current Balance @endif: </label><br>
                        <label for="" class="label_edit off-white-color" id="usdt_field"> USDT <span class="gold-color" style="font-weight: 500;"> $ {{number_format($user_bank['usdt'], 2, '.', ',')}}</span></label><br>
                        <label for="" class="label_edit off-white-color" id="vnd_field"> VND <span class="gold-color" style="font-weight: 500;"> ₫ {{number_format($user_bank['amount'])}}</span></label>
                        <input type="number" name="usdt" class="form-control" id="usdt_buy" value="" min="0" step="0.000001" placeholder="USDT" required>
                        <span id="username-check-result" class="gold-color">Exchange Rate : {{$currency_rate['usdt']}} USDT = {{number_format($currency_rate['vnd'])}} VND</span>
                        <div class="error" style="color:red"><p id="not_buy"></p></div>
                        <label for="">@if(Session::get('language') == 'vie') Số sư sau khi giao dịch mua @else Balance After Buy @endif: </label><br>
                        <label for="" class="label_edit off-white-color"> USDT <span class="gold-color" style="font-weight: 500;" id="after_usdt_field"> $ {{number_format($user_bank['usdt'], 2, '.', ',')}}</span></label><br>
                        <label for="" class="label_edit off-white-color"> VND <span class="gold-color" style="font-weight: 500;" id="after_vnd_field"> ₫ {{number_format($user_bank['amount'])}}</span></label><br>
                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie') Thanh toán @else Payment @endif : <span class="gold-color" style="font-weight: 500;" id="pay_buy_amount"> ₫ 00</span></label>
                      </div>
                      <div class="modal-footer row" style="text-align: center;display:block;">
                        <input type="hidden" name="exchange_rate" value="{{$currency_rate['vnd']}}">
                        <input type="hidden" name="total_usdt_amount" id="total_usdt_amount" value="">
                        <input type="hidden" name="total_vnd_amount" id="total_vnd_amount" value="">
                        <input type="submit" id="submitBtnBuy" style="width: 50%;color:#000 !important;" class="btn btn-success  btn-light-dark" value="@if(Session::get('language') == 'vie') Mua @else Buy @endif" disabled>
                      </div>
                      </form>
                    </div>
                    </div>
                  </div>

                </div>
                <div class="col-6">
                  <a href="#" class="btn btn-danger graph-btn" data-toggle="modal" data-target="#modalSell">@if(Session::get('language') == 'vie') Bán @else Sell @endif</a>
                  <!-- Sell USDT Modal -->
                  <div class="modal fade" id="modalSell" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title gp" id="exampleModalCenterTitle">@if(Session::get('language') == 'vie') Bán @else Sell @endif USDT</h5>
                        <button class="close_model" type="button" class="close" data-dismiss="modal" aria-label="Close">
                          @if(Session::get('language') == 'vie') Đóng @else Close @endif
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action="{{route('sell.usdt')}}" method="POST">
                        @csrf
                        <label for="">@if(Session::get('language') == 'vie') Số dư hiện tại @else Current Balance @endif: </label><br>
                        <label for="" class="label_edit off-white-color" id="usdt_field">USDT <span class="gold-color" style="font-weight: 500;"> $ {{number_format($user_bank['usdt'], 2, '.', ',')}}</span></label><br>
                        <label for="" class="label_edit off-white-color" id="vnd_field">VND <span class="gold-color" style="font-weight: 500;"> ₫ {{number_format($user_bank['amount'])}}</span></label>
                        <input type="number" name="usdt" class="form-control" id="usdt_sell" value="" min="0" step="0.000001" placeholder="USDT" required>
                        <span id="username-check-result" class="gold-color">Exchange Rate : {{$currency_rate['usdt']}} USDT = {{number_format($currency_rate['vnd'])}} VND</span>
                        <div class="error" style="color:red"><p id="not_sell"></p></div>
                        <label for="">@if(Session::get('language') == 'vie') Số sư sau khi giao dịch bán @else Balance After Sell @endif: </label><br>
                        <label for="" class="label_edit off-white-color">USDT <span class="gold-color" style="font-weight: 500;" id="after_usdt_sell"> $ {{number_format($user_bank['usdt'], 2, '.', ',')}}</span></label><br>
                        <label for="" class="label_edit off-white-color">VND <span class="gold-color" style="font-weight: 500;" id="after_vnd_sell"> ₫ {{number_format($user_bank['amount'])}}</span></label><br>
                        <label for="" class="label_edit off-white-color">@if(Session::get('language') == 'vie') Thanh toán @else Payment @endif : <span class="gold-color" style="font-weight: 500;" id="pay_sell_amount"> ₫ 00</span></label>
                      </div>
                      <div class="modal-footer row" style="text-align: center;display:block;">
                        <input type="hidden" name="exchange_rate2" value="{{$currency_rate['vnd']}}">
                        <input type="hidden" name="total_usdt_amount2" id="total_usdt_amount2" value="">
                        <input type="hidden" name="total_vnd_amount2" id="total_vnd_amount2" value="">
                        <input type="submit" id="submitBtnSell" style="width: 50%;color:#000 !important;" class="btn btn-success  btn-light-dark" value="@if(Session::get('language') == 'Bán') Mua @else Sell @endif" disabled>
                      </div>
                      </form>
                    </div>
                    </div>
                  </div>
                </div>

              </div>
          </div>
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news ex">
              <div class="col-7 d-flex align-items-center">
                <p><b class="gold-color">@if(Session::get('language') == 'vie') Tin tức @else News @endif</b></p>
              </div>
              <div class="col-5 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'news'])}}"><span class="off-white-color">@if(Session::get('language') == 'vie') Xem tất cả @else See All @endif</span></a>
              </div>
              <div class="col-12"><hr></div>
              @if(isset($news[0]))
                @foreach($news as $new)
                  <a href="#" class="col-12" style="padding: 0 !important;text-decoration:none;" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                    <div class="row story-2 stories">
                      <div class="col-9 d-flex align-items-center">
                        <div class="col-5 d-flex align-items-left">
                          <img style="width: 80px;" src="{{$new['image']}}" alt="">
                        </div>
                        <div class="col-9 align-items-center" style="color: #fff !important;">
                          <span class="news-title">{{ substr($new['title'], 0, 35) }}...</span>
                          <p>{{ substr($new['short_description'], 0, 70) }}...</p>
                        </div>
                      </div>
                      <div class="col-3 d-flex justify-content-right">
                        <br><br>
                        <span>{{ $new->created_at->diffForHumans() }}</span>
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
                        <p><strong>Title:</strong> {{ $new->title }}</p>
                        <img style="width: 100%;" src="{{$new['image']}}" alt="">
                        <p><strong>Publish Time: <br> </strong> {{ $new->created_at->diffForHumans() }} <br> {{ date('d/m/Y H:i:s', strtotime($new->created_at . ' +7 hours')) }}</p>
                        <p><strong> <br> </strong> {!! $new->short_description !!}</p>
                        <p><strong> </strong> {!! $new->full_description !!}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif ...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6">
          <div class="row news">
              <div class="col-7 d-flex align-items-center">
                <p><b class="gold-color">@if(Session::get('language') == 'vie') Lãi qua đêm @else Profits @endif</b></p>
              </div>
              <div class="col-5 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'profit'])}}"><span class="off-white-color">@if(Session::get('language') == 'vie') Xem tất cả @else See All @endif</span></a>
              </div>
              <div class="col-12"><hr></div>
              @if(isset($profits[0]))
                @foreach($profits as $profit)
                  <div class="row story-2 stories">
                    <div class="col-8 d-flex align-items-center">
                      <div class="col-4 d-flex align-items-left">
                        <i class="fas fa-money-bill fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $profit->created_at->diffForHumans() }}</span>
                        <p>@if(Session::get('language') == 'vie')  Lãi qua đêm ngày @else Overnight interest profit for the day @endif : {{ date('d/m/Y H:i:s', strtotime($profit->created_at . ' +7 hours')) }}</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <br><br>
                      <span>+{{number_format($profit->amount, 2, '.', ',')}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif ...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6">
          <div class="row news">
              <div class="col-7 d-flex align-items-center">
                <p><b class="gold-color">@if(Session::get('language') == 'vie') GD Mua / Bán USDT @else Exchange Amount @endif</b></p>
              </div>
              <div class="col-5 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'exchange'])}}"><span class="off-white-color">@if(Session::get('language') == 'vie') Xem tất cả @else See All @endif</span></a>
              </div>
          
              <div class="col-12"><hr></div>
              @if(isset($exchange[0]))
                @foreach($exchange as $exc)
                  <div class="row story-2 stories">
                    <div class="col-8 d-flex align-items-center">
                      <div class="col-4 d-flex align-items-left">
                        <i class="fas fa-money-bill-alt fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $exc->created_at->diffForHumans() }}</span>
                        <p>{{ date('d/m/Y H:i:s', strtotime($exc->created_at . ' +7 hours')) }}</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      @php
                        $amount = json_decode($exc->exchange);
                      @endphp
                      <span class="exchange_value">-{{number_format($amount[0]->first, 2, '.', ',')}} @if($exc->type == 'vnd') VND @else USDT @endif<br>
                      <span>To</span><br>
                      <span>+{{number_format($amount[0]->second, 2, '.', ',')}} @if($exc->type == 'vnd') USDT @else VND @endif</span></span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif ...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6">
          <div class="row news">
              <div class="col-7 d-flex align-items-center">
                <p><b class="gold-color">@if(Session::get('language') == 'vie') GD Tiền gửi @else Sended Amount @endif</b></p>
              </div>
              <div class="col-5 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'send'])}}"><span class="off-white-color">@if(Session::get('language') == 'vie') Xem tất cả @else See All @endif</span></a>
              </div>
              <div class="col-12"><hr></div>
              @if(isset($send_data[0]))
                @foreach($send_data as $send)
                  <div class="row story-2 stories">
                    <div class="col-8 d-flex align-items-center">
                      <div class="col-4 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $send->created_at->diffForHumans() }}</span>
                        <p>@if(Session::get('language') == 'vie') Đã gửi đến @else Send To @endif : {{$send->receiver_name}}</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span style="text-transform: uppercase;">-{{number_format($send->amount, 2, '.', ',')}} {{$send->type}}</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif ...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news">
              <div class="col-7 d-flex align-items-center">
                <p><b class="gold-color">@if(Session::get('language') == 'vie') GD Nhận tiền @else Received Amount @endif</b></p>
              </div>
              <div class="col-5 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'rcv'])}}"><span class="off-white-color">@if(Session::get('language') == 'vie') Xem tất cả @else See All @endif</span></a>
              </div>
              <div class="col-12"><hr></div>
              @if(isset($rcv_data[0]))
                @foreach($rcv_data as $rcv)
                  <div class="row story-2 stories">
                    <div class="col-8 d-flex align-items-center">
                      <div class="col-4 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $rcv->created_at->diffForHumans() }}</span>
                        <p>@if(Session::get('language') == 'vie') Đã nhận từ @else Received From @endif : {{$rcv->receiver_name}}</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span>+{{number_format($rcv->amount)}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif ...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6">
          <div class="row news">
              <div class="col-7 d-flex align-items-center">
                <p><b class="gold-color">@if(Session::get('language') == 'vie') Nhận tiền từ hệ thống @else Received From System @endif</b></p>
              </div>
              <div class="col-5 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'admin_rcv'])}}"><span class="off-white-color">@if(Session::get('language') == 'vie') Xem tất cả @else See All @endif</span></a>
              </div>
          
              <div class="col-12"><hr></div>
              @if(isset($rcv_amount[0]))
                @foreach($rcv_amount as $rcv)
                  <div class="row story-2 stories">
                    <div class="col-8 d-flex align-items-center">
                      <div class="col-4 d-flex align-items-left">
                        <i class="fas fa-store-alt fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $rcv->created_at->diffForHumans() }}</span>
                        <p>@if(Session::get('language') == 'vie') Đã nhận từ @else Received From @endif : Admin</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span>+{{number_format($rcv->amount)}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif ...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6">
          <div class="row news">
              <div class="col-7 d-flex align-items-center">
                <p><b class="gold-color">@if(Session::get('language') == 'vie') Yêu cầu nạp tiền @else Deposit Request @endif</b></p>
              </div>
              <div class="col-5 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'deposit'])}}"><span class="off-white-color">@if(Session::get('language') == 'vie') Xem tất cả @else See All @endif</span></a>
              </div>
              <div class="col-12"><hr></div>
              @if(isset($deposit[0]))
                @foreach($deposit as $val)
                  <div class="row story-2 stories">
                    <div class="col-8 d-flex align-items-center">
                      <div class="col-4 d-flex align-items-left">
                        <i class="fas fa-list-ul fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $val->created_at->diffForHumans() }}</span>
                        @if($val->status == '1')
                          <p style="color: #94dd94">@if(Session::get('language') == 'vie') Đã xử lý @else Approved @endif</p>
                        @elseif($val->status == '0')
                          <p style="color: red">@if(Session::get('language') == 'vie') Từ chối @else Cancel @endif</p>
                        @else
                          <p style="color: blue">@if(Session::get('language') == 'vie') Đang chờ xử lý @else Pending @endif</p>
                        @endif
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span>@if($val->status == '1')+@endif{{number_format($val->amount)}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif ...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news">
              <div class="col-7 d-flex align-items-center">
                <p><b class="gold-color">@if(Session::get('language') == 'vie') Yêu cầu rút tiền @else Withdraw Request @endif </b></p>
              </div>
              <div class="col-5 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'withdraw'])}}"><span class="off-white-color">@if(Session::get('language') == 'vie') Xem tất cả @else See All @endif</span></a>
              </div>
              <div class="col-12"><hr></div>
              @if(isset($withdraw[0]))
                @foreach($withdraw as $val)
                  <div class="row story-2 stories">
                    <div class="col-8 d-flex align-items-center">
                      <div class="col-4 d-flex align-items-left">
                        <i class="fas fa-credit-card fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $val->created_at->diffForHumans() }}</span>
                        @if($val->status == '1')
                          <p style="color: #94dd94">@if(Session::get('language') == 'vie') Đã xử lý @else Approved @endif</p>
                        @elseif($val->status == '0')
                          <p style="color: red">@if(Session::get('language') == 'vie') Từ chối @else Cancel @endif</p>
                        @else
                          <p style="color: blue">@if(Session::get('language') == 'vie') Đang chờ xử lý @else Pending @endif</p>
                        @endif
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span>@if($val->status == '1')-@endif{{number_format($val->amount)}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>@if(Session::get('language') == 'vie') Không có dữ liệu @else No Record Found @endif ...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

      </div>

    </div>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">

//Buy/Sell USDT
  $('#usdt_buy').on('input', function() {
    let buy_amount = $('#usdt_buy').val();
    let exchange_rate = $('#exchange_rate').val();
    let total_vnd = $('#total_vnd').val();
    let total_usdt = $('#total_usdt').val();
    let after_usdt = parseFloat(buy_amount)+parseFloat(total_usdt);
    const submitBtn = document.getElementById('submitBtnBuy');

    if(buy_amount*exchange_rate > parseFloat(total_vnd)) {
      $('#not_buy').text("Bạn không thể thực hiên mua vượt quá số tiền $"+(total_vnd/exchange_rate).toFixed(1));

      $('#total_vnd_amount').val('');
      $('#total_usdt_amount').val('');
      submitBtn.setAttribute('disabled', true);
    }else if(buy_amount == ''){
      $('#not_buy').text("");
      $('#after_usdt_field').text("$ "+parseFloat(total_usdt).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      $('#after_vnd_field').text("₫ "+parseFloat(total_vnd).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      $('#pay_buy_amount').text("₫ 00");

      $('#total_vnd_amount').val('');
      $('#total_usdt_amount').val('');
      submitBtn.setAttribute('disabled', true);
    }else{
      $('#not_buy').text("");
      $('#pay_buy_amount').text("₫ -"+(parseFloat(exchange_rate)*parseFloat(buy_amount)).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      $('#after_usdt_field').text("$ "+after_usdt.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      $('#after_vnd_field').text("₫ "+(parseFloat(total_vnd)-(parseFloat(exchange_rate)*parseFloat(buy_amount))).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));

      $('#total_vnd_amount').val(parseFloat(total_vnd)-(parseFloat(exchange_rate)*parseFloat(buy_amount))).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
      $('#total_usdt_amount').val(after_usdt.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      submitBtn.removeAttribute('disabled');
    }
  });
  $('#usdt_sell').on('input', function() {
    let buy_amount = $('#usdt_sell').val();
    let exchange_rate = $('#exchange_rate').val();
    let total_vnd = $('#total_vnd').val();
    let total_usdt = $('#total_usdt').val();
    let after_usdt = parseFloat(total_usdt)-parseFloat(buy_amount);
    const submitBtn = document.getElementById('submitBtnSell');

    if(buy_amount > parseFloat(total_usdt)) {
      $('#not_sell').text("Bạn không thể thực hiên bán vượt quá số tiền : $"+parseFloat(total_usdt).toFixed(2));

      $('#total_vnd_amount2').val('');
      $('#total_usdt_amount2').val('');
      submitBtn.setAttribute('disabled', true);
    }else if(buy_amount == ''){
      $('#not_sell').text("");
      $('#after_usdt_sell').text("$ "+parseFloat(total_usdt).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      $('#after_vnd_sell').text("₫ "+parseFloat(total_vnd).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      $('#pay_sell_amount').text("₫ 00");

      $('#total_vnd_amount2').val('');
      $('#total_usdt_amount2').val('');
      submitBtn.setAttribute('disabled', true);
    }else{
      $('#not_sell').text("");
      $('#pay_sell_amount').text("₫ +"+(parseFloat(exchange_rate)*parseFloat(buy_amount)).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      $('#after_usdt_sell').text("$ "+after_usdt.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      $('#after_vnd_sell').text("₫ "+(parseFloat(total_vnd)+(parseFloat(exchange_rate)*parseFloat(buy_amount))).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));

      $('#total_vnd_amount2').val(parseFloat(total_vnd)+(parseFloat(exchange_rate)*parseFloat(buy_amount))).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
      $('#total_usdt_amount2').val(after_usdt.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
      submitBtn.removeAttribute('disabled');
    }
  });

// Daily graph
var date = {!! $date_data !!};
var rate = {!! $rate_data !!};

var num = rate[rate.length - 1];

var formattedNum = num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

$('#current_rate').text('Exchange Rate: 1 USDT = '+formattedNum+' VND');

var dailyData = {
    labels : date,
    datasets: [{
        label: 'Exchange Rate',
        data: rate,
        backgroundColor: '#ffc107',
        borderColor: '#ffc107',
        borderWidth: 1
    }]
};

var dailyOptions = {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: false
            },
            gridLines: {
                display: true
            }
        }],
        xAxes: [{
            gridLines: {
                display: false
            }
        }]
    }
};

var dailyChart = new Chart(document.getElementById('dailyChart'), {
    type: 'line',
    data: dailyData,
    options: dailyOptions
});

</script>

</body>