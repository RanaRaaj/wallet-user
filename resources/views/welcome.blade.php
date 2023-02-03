<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Mobile Responsive Website</title>
</head>
<style type="text/css">

.justify-content-center > i {
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
.container-fluid.news {
    padding-left: 0px;
}
</style>
<body>
    <div class="container">
        <header class="d-flex align-items-center" id="header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-6 align-items-center top-left">
                <span>hello</span>
                <p>Username</p>
              </div>
              <div class="col-6 d-flex justify-content-right top-right">
                <img src="https://via.placeholder.com/30x30" alt="User Image" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              </div>
            </div>
          </div>
        </header>
        <main class="container-fluid">
            <div class="row mt-3">
              <div class="col-12 bg-primary text-white d-flex align-items-center justify-content-center" style="height: 100px;border-radius: 5px;">
                <p class="m-0">Total Amount: $100</p>
              </div>
            </div>
            <div class="row mt-3 links">
              <div class="col-3 align-items-center justify-content-center">
                <i class="fas fa-paper-plane fa-2x"></i>
                <p class="mt-2">Send</p>
              </div>
              <div class="col-3 align-items-center justify-content-center">
                <i class="fas fa-list-ul fa-2x"></i>
                <p class="mt-2">Activities</p>
              </div>
              <div class="col-3 align-items-center justify-content-center">
                <i class="fas fa-check-circle fa-2x"></i>
                <p class="mt-2">Status</p>
              </div>
              <div class="col-3 align-items-center justify-content-center">
                <i class="fas fa-credit-card fa-2x"></i>
                <p class="mt-2">Payment</p>
              </div>
            </div>
        </main>
        <div class="container-fluid transaction">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <p>News</p>
                </div>
                <div class="col-6 d-flex justify-content-right">
                  <a href=""><span>See All</span></a>
                </div>
            </div>
        </div>

        <div class="container-fluid news">
            <div class="row stories">
                <div class="col-9 d-flex align-items-center new-story">
                    <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                    </div>
                    <div class="col-9 align-items-center">
                        <span>Today</span>
                        <p>Electric Bill</p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-right">
                    <span>$33.5</span>
                </div>
            </div>

            <div class="row">
                <div class="col-9 d-flex align-items-center">
                    <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                    </div>
                    <div class="col-9 align-items-center">
                        <span>Today</span>
                        <p>Electric Bill</p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-right">
                    <span>$33.5</span>
                </div>
            </div>

            <div class="row">
                <div class="col-9 d-flex align-items-center">
                    <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                    </div>
                    <div class="col-9 align-items-center">
                        <span>Today</span>
                        <p>Electric Bill</p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-right">
                    <span>$33.5</span>
                </div>
            </div>

            <div class="row">
                <div class="col-9 d-flex align-items-center">
                    <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                    </div>
                    <div class="col-9 align-items-center">
                        <span>Today</span>
                        <p>Electric Bill</p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-right">
                    <span>$33.5</span>
                </div>
            </div>

            <div class="row">
                <div class="col-9 d-flex align-items-center">
                    <div class="col-3 d-flex align-items-left">
                        <i class="fas fa-paper-plane fa-2x"></i>
                    </div>
                    <div class="col-9 align-items-center">
                        <span>Today</span>
                        <p>Electric Bill</p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-right">
                    <span>$33.5</span>
                </div>
            </div>
        </div>
    </div>


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