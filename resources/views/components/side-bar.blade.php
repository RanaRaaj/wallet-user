<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <title>Mobile Responsive Website</title>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sidebar.css')}}">
</head>
<style>
  ul.list-group {
    padding: 0% 6%;
  }
  .list-group-item {
    background-color: hsl(273deg 77% 55%) !important;
    border-radius: 16px !important;
  }
  .list-group-item > a {
    color: #fff !important;
  }
  .support-sub > a > img {
    width: 100%;
  }
</style>
<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
    <header class="d-flex align-items-center" id="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6 align-items-center top-left">
            <span>hello</span>
            <p><span style="text-transform: uppercase;color:hsl(273deg 100% 69%);font-family:inherit;">{{auth()->user()->name}}</span> ({{auth()->user()->email}})</p>
          </div>
          <div class="col-6 row d-flex justify-content-right top-right">
            <!-- <div class="avatar">
              <img src="{{asset('assets/avatar.jpg')}}" alt="Toggle Sidebar">
            </div> -->
            <div class="col-2 language-flag">
              <li class="dropdown dropdown-user nav-item" style="list-style-type: none;">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown" style="position:absolute;top:0;left: -40px;"> <span
                        class="avatar avatar-online">
                            @if(Session::get('language') == 'vie')
                                <img class="vie_flag" src="{{ url('images/vie.jpg')}}" alt="avatar" style="width:36px;border-radius:33%;margin-top:6px;">
                                @else
                                <img src="{{ url('assets/en.png')}}" alt="avatar" style="width:36px;">
                                @endif
                          </span></a>
                <div class="dropdown-menu dropdown-menu-right" style="min-width: 140px !important;">
                    <div class="arrow_box_right">
                        <a class="dropdown-item" href="{{ route('en') }}">
                            <i class="fa fa-flag"></i>
                            ENGLISH
                        </a>
                        <a class="dropdown-item" href="{{ route('vie') }}">
                            <i class="fa fa-flag"></i>
                            TIẾNG VIỆT
                        </a>
                    </div>
                </div>
              </li>
            </div>
            <div class="col-2 bell-icon">
              <a style="color:hsl(273deg 100% 69%);" href="{{route('payment.page')}}"><i class="fas fa-bell"></i></a>
              <span id="notify_count"></span>
            </div>
            <div class="col-2">
              <button class="sidebar-toggle">
                <i class="fas fa-bars"></i>
              </button>
            </div>
            <div class="sidebar">
              @php
                $data = DB::table('user_panel_sidebars')->first();
              @endphp
              <h3 class="text-center text-light p-3 bg-primary">{{$data->text}}</h3>
              <ul class="list-group">

                <li class="list-group-item">
                  <a href="{{route('welcome')}}">
                    <i class="fa fa-home mr-2"></i>@if(Session::get('language') == 'vie') Trang chủ @else Home @endif
                  </a>
                </li>

                <li class="list-group-item">
                  <a href="{{route('profile.view')}}">
                    <i class="fa fa-user mr-2"></i>@if(Session::get('language') == 'vie') Cá nhân @else Profile @endif
                  </a>
                </li>

                <li class="list-group-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#payment-options" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-dollar-sign mr-2"></i>@if(Session::get('language') == 'vie') Giao dịch @else Payment @endif <i class="fa fa-caret-down ml-2"></i>
                  </a>
                  <div id="payment-options" class="collapse">
                    <a class="dropdown-item" href="{{route('detail.view',['type' => 'send'])}}">@if(Session::get('language') == 'vie') Gửi tiền @else Send @endif</a>
                    <a class="dropdown-item" href="{{route('detail.view',['type' => 'rcv'])}}">@if(Session::get('language') == 'vie') Nhận tiền @else Received @endif</a>
                    <!-- <a class="dropdown-item" href="#">Option 3</a> -->
                  </div>
                </li>
                <li class="list-group-item">
                  <a href="{{route('setting.view')}}">
                    <i class="fa fa-cog mr-2"></i>@if(Session::get('language') == 'vie') Cài đặt @else Setting @endif
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="{{url('/logout')}}" class="logout">
                    <i class="fa fa-sign-out-alt mr-2"></i>@if(Session::get('language') == 'vie') Thoát @else Logout @endif
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
</div>
@php
  $links = DB::table('links')->where('status',1)->get();
@endphp
<div class="support-icon">
  <div class="support-main">
    <a href="#">
      <i class="fas fa-headset fa-2x"></i>
    </a>
  </div>
    <span class="head-set-title">CSKH</span>
  <div class="support-sub">
    @if($links)
    @foreach($links as $link)
      <a href="{{$link->link}}" target="_blank">
        <img src="{{$link->icon}}">
        <!-- <i class="fas fa-envelope fa-2x"></i> -->
      </a>
      @endforeach
    @endif
  </div>
</div>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  $.ajax({
    url: "{{ url('updated_notification') }}",
    type: 'GET',
    dataType: 'JSON',
    success: function(data) {
      console.log(data);
      $('#notify_count').text(data[0].total);
      if($('#deposit') && $('#withdraw')){
        if(data[0].deposit > 0){
          $('#deposit').text( data[0].deposit);
        }
        if(data[0].withdraw > 0){
          $('#withdraw').text( data[0].withdraw);
        }
        if(data[0].admin_deposit > 0){
          $('#deposit_admin').text( data[0].admin_deposit);
        }
        if(data[0].user_deposit > 0){
          $('#received').text( data[0].user_deposit);
        }
        if(data[0].user_interest_count > 0){
          $('#payment_interest').text( data[0].user_interest_count);
        }
      }
    }
  });
});

$("#generateForm").hide();
var pusher = new Pusher('57313b8085a7707d1c7e', {
    cluster: 'ap2',
    encrypted: true
});

var channel = pusher.subscribe('withdraw-request-aprove');
channel.bind('withdraw-event-aprove', function(data) {
    $.ajax({
      url: "{{ url('updated_notification') }}",
      type: 'GET',
      dataType: 'JSON',
      success: function(data) {
        $('#notify_count').text(data[0].total);
          if($('#deposit') && $('#withdraw')){
            if(data[0].deposit > 0){
              $('#deposit').text('new : ' + data[0].deposit);
            }
            if(data[0].withdraw > 0){
              $('#withdraw').text('new : ' + data[0].withdraw);
            }
            if(data[0].admin_deposit > 0){
              $('#deposit_admin').text('new : ' + data[0].admin_deposit);
            }
            if(data[0].user_deposit > 0){
              $('#received').text('new : ' + data[0].user_deposit);
            }
            if(data[0].user_interest_count > 0){
              $('#payment_interest').text('new : ' + data[0].user_interest_count);
            }
          }
        }
    });
});

  $(document).ready(function() {
    const sidebarToggle = document.querySelector(".sidebar-toggle");
    const sidebar = document.querySelector(".sidebar");

    function toggleSidebar() {
      sidebar.classList.toggle("open");
    }
    sidebarToggle.addEventListener("click", toggleSidebar);
    function checkScreenSize() {
      if (window.innerWidth > 766) {
        sidebar.classList.add("open");
      } else {
        document.addEventListener('click', (event) => {
          if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('open');
          }
        });
      }
    }
    window.addEventListener("resize", checkScreenSize);
    checkScreenSize();
  });

  $(document).ready(function() {
    $('.support-icon .support-main').click(function() {
      $('.support-icon').toggleClass('active');
    });
  });


  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('fixed-top');
      $('#header').addClass('container');
    } else {
      $('#header').removeClass('fixed-top');
      $('#header').removeClass('container');
    }
  });

  
</script>