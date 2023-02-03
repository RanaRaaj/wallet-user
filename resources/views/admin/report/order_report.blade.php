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
                                        @csrf
                                        <h2>Order Summary : Search Panel</h2>
                                        @if(!isset($order))
                                        <div class="row">
                                            <div class="col-6">
                                                <fieldset class="form-group">
                                                    <label>Order Type</label>
                                                    <select class="form-control" name="type">
                                                        <option value="All Type">All Type</option>
                                                        @foreach($data as $val)
                                                        <option value="{{$val['order_type']}}">{{$val['order_type']}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>From Date</label>
                                                    <input type="date" name="start_date" class="form-control" placeholder="Enter ..." required="">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>To Date</label>
                                                    <input type="date" name="to_date" class="form-control" placeholder="Enter ..." required="">
                                                </fieldset>
                                                <div class="row justify-content-center m-2" style="border-top: 1px solid black">
                                                    <fieldset class="form-group center m-2">
                                                        <button type="submit" class="btn btn-success">submit
                                                        </button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-4">
                                                <fieldset class="form-group">
                                                    <label>Order Type</label>
                                                    <select class="form-control" name="type">
                                                        <option  value="{{$type}}">{{$type}}</option>
                                                        <option value="All Type">All Type</option>
                                                        @foreach($data as $val)
                                                        <option value="{{$val['order_type']}}">{{$val['order_type']}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>From Date</label>
                                                    <input type="date" name="start_date" class="form-control" value="<?php echo date('Y-m-d',strtotime($start_date)) ?>" required="">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label>To Date</label>
                                                    <input type="date" name="to_date" class="form-control" value="<?php echo date('Y-m-d',strtotime($to_date)) ?>" required="">
                                                </fieldset>
                                                <div class="row justify-content-center m-2" style="border-top: 1px solid black">
                                                    <fieldset class="form-group center m-2">
                                                        <button type="submit" class="btn btn-success">submit
                                                        </button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-4 list">
                                                        <h3>Total Order</h3>
                                                        <h1>{{$total_order}}</h1>
                                                    </div>
                                                    <div class="col-4 list">
                                                        <h3>Total Transection</h3>
                                                        <h1>{{$transection}}</h1>
                                                    </div>
                                                    <div class="col-4 list">
                                                        <h3>Total Shipping</h3>
                                                        <h1>{{$shipping}}</h1>
                                                    </div>
                                                    <div class="col-4 list">
                                                        <h3>Total Cancel</h3>
                                                        <h1>{{$cancel}}</h1>
                                                    </div>
                                                </div>
                                                <table class="table table-striped table-bordered ajax-sourced example" id="table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer Name</th>
                                                        <th>Order Date</th>
                                                        <th>Address</th>
                                                        <th>Track Id</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $count = 1; ?>
                                                        @foreach($order as $value)
                                                            <tr>
                                                                <td>{{ $count ?? '' }}</td>
                                                                <td>{{$value['name']}}</td>
                                                                <td>{{$value['date']}}</td>
                                                                <td>{{$value['address']}}</td>
                                                                <td>{{$value['tracking_id']}}</td>
                                                            </tr>
                                                        <?php $count++ ?>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif
                                    </form>
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
