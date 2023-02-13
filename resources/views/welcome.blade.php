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
  /* right: 10px; */
  background: transparent;
  border: none;
  outline: none;
  cursor: pointer;
  padding-right: 0;
}
.news {
    padding: 20px;
    box-shadow: 0px 0px 10px 0px #ccc;
    margin-top: 20px;
    border-radius: 10px;
  }

  .stories {
    margin-bottom: 20px;
  }

  .stories:last-child {
    margin-bottom: 0px;
  }

  .stories:hover {
    background-color: #e9e9e9;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
  }

  .new-story {
    font-size: 20px;
    font-weight: 500;
  }

  .new-story i {
    color: #007bff;
    margin-right: 10px;
  }

  .new-story span {
    font-size: 12px;
    color: #828282;
  }

  .new-story p {
    font-size: 18px;
    font-weight: 400;
    margin-top: 5px;
  }

  .justify-content-right span {
    font-size: 15px;
    font-weight: 500;
    color: #007bff;
  }
  .links {
      display: flex;
      flex-direction: row;
      justify-content: center;
  }

  .links a {
      color: #333;
      text-decoration: none;
  }

  .links i {
      transition: all 0.3s ease-in-out;
  }

  .links a:hover i {
      transform: scale(1.2);
  }

  .links p {
      margin: 0;
      transition: all 0.3s ease-in-out;
  }

  .links a:hover p {
      transform: translateY(-20px);
  }
@keyframes AnimatedBackground {
  from {
    background-position: 0% 50%;
  }
  to {
    background-position: 100% 50%;
  }
}
@media (max-width: 766px) {
  .news {
    margin: 15px;
  }
}

/*.sidebar {
    background-color: #f9f9f9;
    width: 250px;
    height: 100%;
    position: fixed;
    top: 60px;
    left: 0;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .list-group-item {
    border: none;
  }

  .list-group-item a {
    display: block;
    color: #333;
    text-decoration: none;
  }

  .list-group-item:hover {
    background-color: #f5f5f5;
  }

  .dropdown .dropdown-toggle::after {
    display: none;
  }

  .dropdown .dropdown-menu {
    background-color: #f9f9f9;
    border: none;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .dropdown .dropdown-item {
    color: #333;
  }

  .dropdown .dropdown-item:hover {
    background-color: #f5f5f5;
  }*/

</style>
<body>
    <div class="container">
        <header class="d-flex align-items-center" id="header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-6 align-items-center top-left">
                <span>hello</span>
                <p>{{auth()->user()->name}}</p>
              </div>
              <div class="col-6 d-flex justify-content-right top-right">
                <button class="sidebar-toggle">
                  <img src="https://via.placeholder.com/50x50" alt="Toggle Sidebar">
                </button>
                <div class="sidebar">
                  <h3 class="text-center text-light p-3 bg-primary">Sidebar Menu</h3>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <a href="#">
                        <i class="fa fa-user mr-2"></i>Profile
                      </a>
                    </li>
                    <li class="list-group-item dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-dollar-sign mr-2"></i>Payment <i class="fa fa-caret-down ml-2"></i>
                      </a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Option 1</a>
                        <a class="dropdown-item" href="#">Option 2</a>
                        <a class="dropdown-item" href="#">Option 3</a>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <a href="#">
                        <i class="fa fa-cog mr-2"></i>Setting
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="{{url('/logout')}}" class="logout">
                        <i class="fa fa-sign-out-alt mr-2"></i>Logout
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </header>
        <main class="container-fluid">
          <div class="row mt-3">
            <div class="col-12 bg-primary text-white d-flex align-items-center justify-content-center" style="height: 100px; border-radius: 5px; background: linear-gradient(to right, #00b4db, #0083b0); animation: AnimatedBackground 10s linear infinite;">
                @php
                    $user_id = Auth::user()->id;
                    $bank_detail = DB::table('user_banks')->where('user_id', $user_id)->first();
                    $balance = $bank_detail->amount ?? 0;
                @endphp
                <p class="m-0">Total Amount: {{$balance ?? 'no'}} VND</p>
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

        <div class="container-fluid news col-md-6">
          <div class="row">
              <div class="col-8 d-flex align-items-center">
                <p><b>Sended Amount</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'send'])}}"><span>See All</span></a>
              </div>
          </div>
          <hr>
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
              <div class="col-9 d-flex align-items-center">
                <p>No Record Found...</p>
              </div>
            </div>
          @endif
        </div>

        <div class="container-fluid news col-md-6">
          <div class="row">
              <div class="col-8 d-flex align-items-center">
                <p><b>Received Amount</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'rcv'])}}"><span>See All</span></a>
              </div>
          </div>
          <hr>
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
              <div class="col-9 d-flex align-items-center">
                <p>No Record Found...</p>
              </div>
            </div>
          @endif
        </div>

        <div class="container-fluid news col-md-6">
          <div class="row">
              <div class="col-8 d-flex align-items-center">
                <p><b>Received From Admin</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'admin_rcv'])}}"><span>See All</span></a>
              </div>
          </div>
          <hr>
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
              <div class="col-9 d-flex align-items-center">
                <p>No Record Found...</p>
              </div>
            </div>
          @endif
        </div>

        <div class="container-fluid news col-md-6">
          <div class="row">
              <div class="col-8 d-flex align-items-center">
                <p><b>Deposit Request</b></p>
              </div>
              <div class="col-4 d-flex justify-content-right">
                <a href="{{route('detail.view',['type' => 'deposit'])}}"><span>See All</span></a>
              </div>
          </div>
          <hr>
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
              <div class="col-9 d-flex align-items-center">
                <p>No Record Found...</p>
              </div>
            </div>
          @endif
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