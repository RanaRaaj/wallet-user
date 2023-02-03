<!-- BEGIN: Header-->
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs"
                           href="#"><i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>
                </ul>

                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"> <span
                                class="avatar avatar-online"><img
                                    src="{{ url('assets/avatar.jpg')}}" alt="avatar"></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="{{url('settings/profile')}}">
                                    <i class="fa fa-user"></i>
                                    Edit Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fa fa-sign-out"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<script type="text/javascript">
    
        // $body.removeClass('menu-expanded').addClass('menu-collapsed');
    $(document).ready(function() {
        
    });
</script>
<!-- END: Header-->
