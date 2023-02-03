@extends('admin.layouts.layout')
    
@section('dashboard.content-view')
<style type="text/css">
.box {
  width: 12%;
}
.list {
  background-image: linear-gradient(to right, #9f78ff, #32cafe);
  padding: 2%;
  text-align: center;
  margin: 1%;
}
</style>
    <!-- BEGIN: Content-->
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Product Report</a>
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
                            <div class="card-body card-dashboard">
                                <p class="card-text">
                                                    </p>
                                <div class="table-responsive">
                                    <form action="{{route('get_order_report')}}" method="post">
                                        <h2>Product Report (Summary)</h2>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered ajax-sourced example">
                                                    <thead>
                                                    <tr>
                                                        <th>Product Code</th>
                                                        <th>Name</th>
                                                        <th>Qnt</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data as $value)
                                                            <tr>
                                                                <td>{{$value['product_code']}}</td>
                                                                <td>{{$value['name']}}</td>
                                                                <td>{{$value['qty'] ?? 0}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <a id="basiczuo" href="#" class="btn btn-primary">Print</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div style="display: none;">
            <div class="print-report twelve columns container" style="text-align: center;">
                <h1 style="padding-bottom: 4%;font-weight: 800;">SHOPROFY</h1>
                <table class="table table-striped table-bordered ajax-sourced example" style="font-size: 25px;text-align: left;">
                    <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Qnt</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $value)
                            <tr>
                                <td>{{$value['product_code']}}</td>
                                <td>{{$value['name']}}</td>
                                <td>{{$value['qty'] ?? 0}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h3 style="padding-top: 4%;font-weight: 800;"> © 2022 - shoprofy.com</h3>
            </div>
        </div>
        <!-- Alert animation end -->
    </div>
    <!-- END: Content-->
<script type="text/javascript" src="printThis.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
    //print order
    $('#basiczuo').on("click", function () {
      $('.print-report').printThis({
        base: ""
      });
    });
} );
 </script>
@stop

@push('dashboard.scripts-footer')
    <script src="{{asset('assets/dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="https://unpkg.com/promise-polyfill" type="text/javascript"></script>
    <script src="{{asset('assets/dashboard/app-assets/vendors/js/extensions/sweetalert2.all.js')}}" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->

    <script src="{{asset('assets/dashboard/assets/js/scripts.js')}}" type="text/javascript"></script>
@endpush
