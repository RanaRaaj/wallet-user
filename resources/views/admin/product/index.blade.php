@extends('admin.layouts.layout')
    
@section('dashboard.content-view')
<style type="text/css">
.box {
  width: 12%;
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
                            <div class="card-body card-dashboard">
                                <p class="card-text">
                                                    </p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered ajax-sourced example" id="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Code</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($data as $value)
                                                <tr>
                                                    <td>{{ $count ?? '' }}</td>
                                                    <td>{{$value['product_code']}}</td>
                                                    <td>{{$value['name']}}</td>
                                                    <td>{{$value['description']}}</td>
                                                    <td>
                                                        @if($value['status'] == 0)
                                                        <span id="actDe">Active</span>
                                                        @else
                                                        <span id="actDe">Deactive</span>
                                                        @endif
                                                    </td>
                                                    <td style="width: 100% !important;">
                                                        <a data-id="<?php echo $value->id; ?>" data-url="act_deact" data-back="product" data-value="<?php echo $value->status; ?>" class="btn btn-sm btn-danger inactive" style="color: #fff;">Active/Deactive</a>
                                                        <a href="{{url('view_product' . $value->id)}}" edit-id="<?php echo $value->id; ?>" class="back_color btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                        <a href="{{url('product_stack' . $value['id'])}}" edit-id="<?php echo $value->id; ?>" class="back_color btn btn-sm btn-info"><i class="fa fa-info"></i> Update Stack</a>
                                                        <a href="{{url('bin_card' . $value->id)}}" edit-id="<?php echo $value->id; ?>" class="back_color btn btn-sm btn-info"><i class="fa fa-info"></i> BIN Card</a>
                                                        
                                                    </td>
                                                </tr>
                                                <?php $count++ ?>
                                            @endforeach
                                        </tbody>
                                    </table>
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
