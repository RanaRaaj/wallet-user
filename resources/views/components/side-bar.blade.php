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

<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
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
                  <a href="{{route('welcome')}}">
                    <i class="fa fa-home mr-2"></i>Home
                  </a>
                </li>

                <li class="list-group-item">
                  <a href="#">
                    <i class="fa fa-user mr-2"></i>Profile
                  </a>
                </li>

                <li class="list-group-item dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#payment-options" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-dollar-sign mr-2"></i>Payment <i class="fa fa-caret-down ml-2"></i>
                  </a>
                  <div id="payment-options" class="collapse">
                    <a class="dropdown-item" href="{{route('detail.view',['type' => 'send'])}}">Send</a>
                    <a class="dropdown-item" href="{{route('detail.view',['type' => 'rcv'])}}">Received</a>
                    <!-- <a class="dropdown-item" href="#">Option 3</a> -->
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
</div>