@extends('admin.layouts.layout')

@section('dashboard.content-view')
<style type="text/css">
.dashboard-list h2 {
  font-weight: bold;
  font-size: 18px;
}
.dashboard-list {
  background-image: linear-gradient(to right, #9f78ff, #32cafe);
  padding: 2%;
  margin: 1%;
  max-width: 22.333% !important;
}
.dashboard-list p {
  font-size: 30px;
  font-weight: bold;
  text-align: center;
  color: #fff;
}
</style>
    <!-- BEGIN: Content-->
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">List</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <!-- Alert animation start -->
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body card-dashboard row">
                                <p class="card-text">
                                                    </p>
                                
                                <div class="col-md-3 dashboard-list">
                                    <h2>Total Events Posted</h2>
                                    <p>{{$event}}</p>
                                </div>
                                <div class="col-md-3 dashboard-list">
                                    <h2>Total Avtive Jobs</h2>
                                    <p>{{$job}}</p>
                                </div>
                                <!-- <div class="col-md-3 dashboard-list">
                                    <h2>Low Stock</h2>
                                    <p>{{$low}}</p>
                                </div>
                                <div class="col-md-3 dashboard-list">
                                    <h2>Out of Stock</h2>
                                    <p>{{$out}}</p>
                                </div>
                                <div class="col-md-3 dashboard-list">
                                    <h2>Total Product Sold</h2>
                                    <p>{{$sold}}</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Alert animation end -->
    </div>
    <!-- END: Content-->

@stop

@push('dashboard.scripts-footer')
    <script src="{{asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="https://unpkg.com/promise-polyfill" type="text/javascript"></script>
    <script src="{{asset('assets/dashboard/app-assets/vendors/js/extensions/sweetalert2.all.js')}}" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->

    <script src="{{asset('assets/dashboard/assets/js/scripts.js')}}" type="text/javascript"></script>
@endpush
