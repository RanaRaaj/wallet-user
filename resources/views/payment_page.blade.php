<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <style>
/*header*/
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

/*header close*/

/* Add your custom CSS here */
body {
  background-color: #f2f2f2;
}

.list-group-item {
  animation: fadein 0.5s;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 2px 2px 10px #ccc;
  margin-bottom: 10px;
  padding: 10px;
}

@keyframes fadein {
  from { opacity: 0; }
  to   { opacity: 1; }
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}


#sendAmountBtn {
  background-color: #007bff;
  border-color: #007bff;
  animation: pulse 1s infinite;
}

#receiveAmountBtn {
  background-color: #28a745;
  border-color: #28a745;
  animation: pulse 1s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.02); }
  100% { transform: scale(1); }
}
</style>

  <title>Sended Amount</title>
</head>
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
                <h3>Sidebar Menu</h3>
                <ul>
                  <li>Profile</li>
                  <li class="has-submenu">
                    Payment
                    <ul class="submenu">
                      <li>Option 1</li>
                      <li>Option 2</li>   
                      <li>Option 3</li>
                    </ul>
                  </li>
                  <li>Setting</li>
                  <li>
                    <a href="{{url('/logout')}}" class="logout">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>
      
      <div class="container my-5">
        <h2 class="text-center mb-5">Payment View</h2>
          <div class="list-group">
            <ul class="list-group list-group-horizontal">
              <li class="list-group-item">
                <a href="{{route('detail.view',['type' => 'send'])}}" class="btn btn-primary" id="sendAmountBtn">
                  <i class="fas fa-paper-plane"></i> Send Amount
                </a>
              </li>
              <li class="list-group-item">
                <a href="{{route('detail.view',['type' => 'rcv'])}}" class="btn btn-success" id="receiveAmountBtn">
                  <i class="fas fa-money-bill-alt"></i> Received Amount
                </a>
              </li>
            </ul>
            <a href="{{route('welcome')}}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpG<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>

      $(document).ready(function() {
        $(".sidebar-toggle").click(function() {
          $(".sidebar").toggleClass("open");
        });
      });

      $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
          $('#header').addClass('fixed-top');
        } else {
          $('#header').removeClass('fixed-top');
        }
      });

    </script>
  </body>
</html>
