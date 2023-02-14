<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container">
      <x-side-bar />  
        <main class="container-fluid">

          <div class="row mt-3">
            <div class="col-12 bg-primary text-white d-flex align-items-center justify-content-center" style="height: 100px; border-radius: 5px; background: linear-gradient(to right, #00b4db, #0083b0); animation: AnimatedBackground 10s linear infinite;">
                @php
                    $user_id = Auth::user()->id;
                    $bank_detail = DB::table('user_banks')->where('user_id', $user_id)->first();
                    $balance = $bank_detail->amount ?? 0;
                @endphp
                <span>{{$bank_detail->bank_name ?? ''}}</span>
                <p class="m-0">{{$bank_detail->account_number ?? ''}}</p>
                <span>{{$bank_detail->account_name ?? ''}}</span>
                <span class="m-0">Total Amount: {{$balance ?? 'not connected'}} VND</span>
            </div>
          </div>

          <div class="row mt-3 links">
              <div class="col-3 align-items-center justify-content-center">
                  <a href="{{route('send.form')}}">
                      <i class="fas fa-paper-plane fa-2x"></i>
                      <p class="mt-2">Send</p>
                  </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                  <a href="{{route('deposit.form')}}">
                      <i class="fas fa-list-ul fa-2x"></i>
                      <p class="mt-2">Deposit</p>
                  </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('detail.view',['type' => 'status'])}}">
                  <i class="fas fa-check-circle fa-2x"></i>
                  <p class="mt-2">Status</p>
                </a>
              </div>

              <div class="col-3 align-items-center justify-content-center">
                <a href="{{route('payment.page')}}">
                  <i class="fas fa-credit-card fa-2x"></i>
                  <p class="mt-2">Payment</p>
                </a>
              </div>
          </div>
        </main>
      <div class="row">
        <div class="container-fluid transaction">            
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
                    <div class="col-9 d-flex align-items-center">
                      <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $send->created_at->diffForHumans() }}</span>
                        <p>Send To: {{$send->receiver_name}}</p>
                      </div>
                    </div>
                    <div class="col-3 d-flex justify-content-right">
                      <span>{{$send->amount}} VND</span>
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
                <p><b>Received Amount</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'rcv'])}}"><span>See All</span></a>
              </div>
              <div class="col-12"><hr></div>
              @if(isset($rcv_data[0]))
                @foreach($rcv_data as $rcv)
                  <div class="row story-2 stories">
                    <div class="col-9 d-flex align-items-center">
                      <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $rcv->created_at->diffForHumans() }}</span>
                        <p>Received From: {{$rcv->receiver_name}}</p>
                      </div>
                    </div>
                    <div class="col-3 d-flex justify-content-right">
                      <span>{{$rcv->amount}} VND</span>
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
                <p><b>Received From Admin</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'admin_rcv'])}}"><span>See All</span></a>
              </div>
          
              <div class="col-12"><hr></div>
              @if(isset($rcv_amount[0]))
                @foreach($rcv_amount as $rcv)
                  <div class="row story-2 stories">
                    <div class="col-9 d-flex align-items-center">
                      <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $rcv->created_at->diffForHumans() }}</span>
                        <p>Received From: Admin</p>
                      </div>
                    </div>
                    <div class="col-3 d-flex justify-content-right">
                      <span>{{$rcv->amount}} VND</span>
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
                <p><b>Deposit Request</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'deposit'])}}"><span>See All</span></a>
              </div>
              <div class="col-12"><hr></div>
              @if(isset($deposit[0]))
                @foreach($deposit as $val)
                  <div class="row story-2 stories">
                    <div class="col-9 d-flex align-items-center">
                      <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                      </div>
                      <div class="col-9 align-items-center">
                        <span>{{ $val->created_at->diffForHumans() }}</span>
                        @if($val->status == '1')
                          <p style="color: green">Approved</p>
                        @elseif($val->status == '0')
                          <p style="color: red">Cancel</p>
                        @else
                          <p style="color: blue">Pending</p>
                        @endif
                      </div>
                    </div>
                    <div class="col-3 d-flex justify-content-right">
                      <span>{{$val->amount}} VND</span>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $(".sidebar-toggle").click(function() {
      $(".sidebar").toggleClass("open");
    });
  });
</script>
<script>
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('fixed-top');
    } else {
      $('#header').removeClass('fixed-top');
    }
  });
</script>

</body>