<!DOCTYPE html>
<html lang="en">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.justify-content-right > span {
    color: #fff !important;
    font-size: 12px !important;
}
.col-9.align-items-center > span {
    font-size: 10px;
    font-weight: 500;
}
.col-9.align-items-center p {
    font-size: 14px;
    font-weight: 700;
}
.container-fluid.col-md-6 {
    padding: 0px 10px;
}
span.usdt_data {
    font-size: 14px;
    float: right;
}
span.exchange_value > span {
    font-size: 11px !important;
    color: #fff !important;
}
span.exchange_value {
    font-size: 11px !important;
    color: #fff !important;
    text-align: center;
    margin-top: 11%;
    line-height: 19px;
}
p#current_rate {
    margin: 0;
    width: 100%;
    text-align: center;
    font-size: 13px;
    color: #606060;
    font-family: math;
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
                      <p class="m-0" style="color: #fff;">{{$bank_detail->account_number ?? ''}}</p>
                    </div>
                    
                    <div class="bottom-banner row">
                      <div class="col-6">
                        <span>{{$bank_detail->bank_name ?? ''}}</span>
                      </div>
                      <div class="col-6" style="text-align: right;">
                        <span class="usdt_data">@if($profits[0]->usdt != '') {{number_format($profits[0]->usdt, 2, '.', ',')}} @else 00 @endif USDT</span><br>
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

          <div class="row mt-3 links">

              <div class="col-3 align-items-center justify-content-center">
                  <a href="{{route('deposit.form')}}">
                      <i class="fas fa-list-ul fa-2x"></i>
                      <p class="mt-2">Deposit</p>
                  </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('withdraw.form')}}">
                  <i class="fas fa-credit-card fa-2x"></i>
                  <p class="mt-2">Withdraw</p>
                </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                  <a href="{{route('send.form.view')}}">
                      <i class="fas fa-paper-plane fa-2x"></i>
                      <p class="mt-2">Send</p>
                  </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('detail.view',['type' => 'profit'])}}">
                  <i class="fas fa-money-bill fa-2x"></i>
                  <p class="mt-2">Profit</p>
                </a>
              </div>
              
          </div>
          <div class="row mt-3 links">

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('payment.page')}}">
                  <i class="fas fa-money-check fa-2x"></i>
                  <p class="mt-2">Payment</p>
                </a>
              </div>
              
              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('status.view')}}">
                  <i class="fas fa-check-circle fa-2x"></i>
                  <p class="mt-2">Status</p>
                </a>
              </div>
              
              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('setting.view')}}">
                  <i class="fas fa-cog fa-2x"></i>
                  <p class="mt-2">Setting</p>
                </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('currency.exchange')}}">
                  <i class="fas fa-money-bill-alt fa-2x"></i>
                  <p class="mt-2">Buy/Sell USDT</p>
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

        <div class="container-fluid col-md-6">
          <div class="row news" style="background-color: hsl(273deg 100% 93%) !important;">
              <!-- <canvas id="myChart"></canvas> -->
              <p id="current_rate"></p>
              <canvas id="dailyChart"></canvas>

          </div>
        </div>

        <div class="container-fluid col-md-6">
          <div class="row news">
              <div class="col-8 d-flex align-items-center">
                <p><b>Profits</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'profit'])}}"><span>See All</span></a>
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
                        <p>Bank Name: {{$profit->bank_name}}</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <br><br>
                      <span>{{number_format($profit->amount, 2, '.', ',')}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>No Record Found...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news">
              <div class="col-8 d-flex align-items-center">
                <p><b>Exchange Amount</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'exchange'])}}"><span>See All</span></a>
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
                        <!-- <p>Received From: Admin</p> -->
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      @php
                        $amount = json_decode($exc->exchange);
                      @endphp
                      <span class="exchange_value">{{number_format($amount[0]->first, 2, '.', ',')}} @if($exc->type == 'vnd') VND @else USDT @endif<br>
                      <span>To</span><br>
                      <span>{{number_format($amount[0]->second, 2, '.', ',')}} @if($exc->type == 'vnd') USDT @else VND @endif</span></span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>No Record Found...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6">
          <div class="row news">
              <div class="col-8 d-flex align-items-center">
                <p><b>Sended Amount</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'send'])}}"><span>See All</span></a>
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
                        <p>Send To: {{$send->receiver_name}}</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span style="text-transform: uppercase;">{{number_format($send->amount, 2, '.', ',')}} {{$send->type}}</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>No Record Found...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news">
              <div class="col-8 d-flex align-items-center">
                <p><b>Received Amount</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'rcv'])}}"><span>See All</span></a>
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
                        <p>Received From: {{$rcv->receiver_name}}</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span>{{number_format($rcv->amount)}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>No Record Found...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news">
              <div class="col-8 d-flex align-items-center">
                <p><b>Received From System</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'admin_rcv'])}}"><span>See All</span></a>
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
                        <p>Received From: Admin</p>
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span>{{number_format($rcv->amount)}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>No Record Found...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news">
              <div class="col-8 d-flex align-items-center">
                <p><b>Deposit Request</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'deposit'])}}"><span>See All</span></a>
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
                          <p style="color: #94dd94">Approved</p>
                        @elseif($val->status == '0')
                          <p style="color: red">Cancel</p>
                        @else
                          <p style="color: blue">Pending</p>
                        @endif
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span>{{number_format($val->amount)}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>No Record Found...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

        <div class="container-fluid col-md-6 home-div-bottom-space">
          <div class="row news">
              <div class="col-8 d-flex align-items-center">
                <p><b>Withdraw Request</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'withdraw'])}}"><span>See All</span></a>
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
                          <p style="color: #94dd94">Approved</p>
                        @elseif($val->status == '0')
                          <p style="color: red">Cancel</p>
                        @else
                          <p style="color: blue">Pending</p>
                        @endif
                      </div>
                    </div>
                    <div class="col-4 d-flex justify-content-right">
                      <span>{{number_format($val->amount)}} VND</span>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="row story-2 stories">
                  <div class="col-12 d-flex align-items-center">
                    <p>No Record Found...</p>
                  </div>
                </div>
              @endif
          </div>
        </div>

      </div>

    </div>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">

// var chartData = {
//     labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
//     datasets: [{
//         label: 'Exchange Rate',
//         data: [
//             {x: 0, y: 23175/1.0001},
//             {x: 1, y: 23150/1.0002},
//             {x: 2, y: 23180/1.0005},
//             {x: 3, y: 23200/1.0008},
//             {x: 4, y: 23220/1.0012},
//             {x: 5, y: 23250/1.0015},
//         ],
//         borderColor: 'blue',
//         backgroundColor: 'rgba(0, 0, 255, 0.2)',
//         borderWidth: 1,
//     }]
// };

// var ctx = document.getElementById('myChart').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: chartData,
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: false,
//                     callback: function(value, index, values) {
//                         if (value >= 1000) {
//                             return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//                         } else {
//                             return '$' + value.toFixed(4);
//                         }
//                     }
//                 }
//             }]
//         },
//         tooltips: {
//             callbacks: {
//                 label: function(tooltipItem, data) {
//                     var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
//                     var value = tooltipItem.yLabel.toFixed(4);
//                     if (value >= 1000) {
//                         value = '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//                     } else {
//                         value = '$' + value;
//                     }
//                     return datasetLabel + ': ' + value;
//                 }
//             }
//         }
//     }
// });

// function updateChart() {
//     var select1 = document.getElementById("currency-select-1");
//     var value1 = select1.options[select1.selectedIndex].value;
//     var select2 = document.getElementById("currency-select-2");
//     var value2 = select2.options[select2.selectedIndex].value;
//     var chartDataset = myChart.data.datasets[0];
//     chartDataset.label = value1.toUpperCase() + ' to ' + value2.toUpperCase() + ' Exchange Rate';
//     chartDataset.data = [
//         {x: 0, y: getExchangeRate(value1, value2, '2022-01-01')},
//         {x: 1, y: getExchangeRate(value1, value2, '2022-02-01')},
//         {x: 2, y: getExchangeRate(value1, value2, '2022-03-01')},
//         {x: 3, y: getExchangeRate(value1, value2, '2022-04-01')},
//         {x: 4, y: getExchangeRate(value1, value2, '2022-05-01')},
//         {x: 5, y: getExchangeRate(value1, value2, '2022-06-01')},
//         ];
//         myChart.update();
//       }

//   function getExchangeRate(fromCurrency, toCurrency, date) {
//   var exchangeRates = {
//   usdt: {vnd: 23175.00, usd: 1.0001},
//   vnd: {usdt: 0.000043, usd: 0.000042},
//   usd: {vnd: 23150.00, usdt: 1.0002},
//   };
//   return exchangeRates[fromCurrency][toCurrency];
// }

//while graph

// var chartData = {
//     labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
//     datasets: [{
//         label: 'Exchange Rate',
//         data: [
//             {x: 0, y: 23175.00},
//             {x: 1, y: 23150.00},
//             {x: 2, y: 23180.00},
//             {x: 3, y: 23200.00},
//             {x: 4, y: 23220.00},
//             {x: 5, y: 23250.00},
//         ],
//         borderColor: 'white',
//         backgroundColor: 'rgba(255, 255, 255, 0.2)',
//         borderWidth: 1,
//     }]
// };

// var ctx = document.getElementById('myChart').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: chartData,
//     options: {
//         scales: {
//             xAxes: [{
//                 ticks: {
//                     fontColor: 'white'
//                 }
//             }],
//             yAxes: [{
//                 ticks: {
//                     fontColor: 'white',
//                     beginAtZero: false,
//                     callback: function(value, index, values) {
//                         return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
//                     }
//                 }
//             }]
//         },
//         legend: {
//             labels: {
//                 fontColor: 'lightgray'
//             }
//         },
//         tooltips: {
//             callbacks: {
//                 label: function(tooltipItem, data) {
//                     var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
//                     var value = tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
//                     return datasetLabel + ': ' + value;
//                 }
//             },
//             backgroundColor: 'white',
//             titleFontColor: 'black',
//             bodyFontColor: 'black',
//             displayColors: false
//         }
//     }
// });

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
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'hsl(273deg 77% 55%)',
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