@extends('admin.layouts.layout')
    
@section('dashboard.content-view')
<style type="text/css">
.box {
  width: 12%;
}
.botm-khata {
  display: block ruby;
}
.btn.btn-danger {
  cursor: auto;
}
.btn.btn-success {
  cursor: auto;
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
                        <li class="breadcrumb-item"><a href="">Product</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Bin Card</a>
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
                                    <table class="table table-striped table-bordered ajax-sourced example" id="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Qnt</th>
                                            <th>Balance</th>
                                            <th>Order ID</th>
                                            <th>Place</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($data as $value)
                                                <tr>
                                                    <td>{{$count}}</td>
                                                    <td>{{$value['product_code']}}</td>
                                                    <td>{{$value['product_name']}}</td>
                                                    <td>{{$value['created_at']}}</td>
                                                    <td>{{$value['type']}}</td>
                                                    <td>{{$value['quantity']}}</td>
                                                    <td>{{$value['balance']}}</td>
                                                    <td>{{$value['order_id']}}</td>
                                                    <td>{{$value['place']}}</td>
                                                    <td>{{$value['price']}}</td>
                                                </tr>
                                                <?php $count++ ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="botm-khata">
                                        <div style="text-align: left; width: 50%;">
                                            <button><a href="{{route('product')}}" class="btn btn-primary">Go Back</a></button>
                                        </div>
                                        <div style="text-align: right; width: 50%;">
                                           <button><a class="btn btn-danger">Bad Item : 0 </a></button>
                                           <button><a class="btn btn-success">Total Sold : ${{$total}}</a></button> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Alert animation end -->
    </div>
    <!-- END: Content-->
<script>
  $(document).ready(function() {
    $('#table').DataTable();
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
