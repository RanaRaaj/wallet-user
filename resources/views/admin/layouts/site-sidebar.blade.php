<style>
.index-images img{
    width:15%;
}
.edit-page-img{
    width:15%;
}
div#imgTest img {
    width: 15%;
}
span.ht {
    position: absolute;
    background: red;
    border-radius: 50%;
    font-size: 10px;
    color: #fff;
    top: 0px;
    padding: 0px 6px;
}
span.act {
    background: green;
    color: #fff;
    display: inline-flex;
    padding: 5%;
    border-radius: 6px;
}
span.inact {
    background: red;
    color: #fff;
    display: inline-flex;
    padding: 5%;
    border-radius: 6px;
}
</style>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true" data-img="{{ url('assets/dashboard/app-assets/images/backgrounds/02.')}}">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item m-auto">
                <a class="navbar-brand" href="#">
                    <img class="brand-logo" alt="Novel Nagri" src="{{ asset('assets/images/logo.png') }}" />
                </a>
            </li>

            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>

            <li class="nav-item">
                <a href="#" class="nav-link mainmenu-icon">
                    <img class="brand-logo" alt="" src="{{asset('app-assets/images/logo.png')}}" />
                </a>
            </li>
        </ul>
    </div>

    <div class="navigation-background"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span class="menu-title" data-i18n="">Dashboard</span>
                </a>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">Slider</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ route('slider') }}">
                            <span data-i18n="">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('slider.create') }}">
                            <span data-i18n="">Add</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">Gallery</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ route('gallery') }}">
                            <span data-i18n="">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.create') }}">
                            <span data-i18n="">Add</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">Events</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ route('event') }}">
                            <span data-i18n="">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('event.create') }}">
                            <span data-i18n="">Add</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">Jobs</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ route('job') }}">
                            <span data-i18n="">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('job.create') }}">
                            <span data-i18n="">Add</span>
                        </a>
                    </li>
                </ul>
            </li>
            @php
            $new_job_cout = DB::table('applications')->where('status',1)->count();
            @endphp
            <li class=" nav-item">
                <a href="#">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">Job Applications</span>
                    <span class="ht" id="ht">@if($new_job_cout > 0){{$new_job_cout}}@endif</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ route('application') }}">
                            <span data-i18n="">List</span>
                        </a>
                    </li>
                </ul>
            </li>


            <!-- <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="menu-title" data-i18n="">Orders</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{url('order')}}">
                            <span data-i18n="">Order List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('create_order')}}">
                            <span data-i18n="">New Order</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-product-hunt"></i>
                    <span class="menu-title" data-i18n="">Product</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{url('product')}}">
                            <span data-i18n="">Product List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('create_product')}}">
                            <span data-i18n="">New Product</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span class="menu-title" data-i18n="">Report</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{url('order_report')}}">
                            <span data-i18n="">Order Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('product_report')}}">
                            <span data-i18n="">Product Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('low_stock_report')}}">
                            <span data-i18n="">Low Stock Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('out_stock_report')}}">
                            <span data-i18n="">Out of Stock Report</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span class="menu-title" data-i18n="">Admin</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{url('order_type')}}">
                            <span data-i18n="">Order Type</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('reason_type')}}">
                            <span data-i18n="">Reason Type</span>
                        </a>
                    </li>
                </ul>
            </li> -->

            <li class=" nav-item clients">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span class="menu-title" data-i18n="">Settings</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{url('settings/profile')}}"><span data-i18n="">Profile</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
