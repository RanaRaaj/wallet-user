@extends('admin.layouts.layout')
    
@section('dashboard.content-view')
    <!-- BEGIN: Content-->
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Job</a>
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
                                            <th>Title</th>
                                            <th>Short Description</th>
                                            <th>Status</th>
                                            <th>Create At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($job as $key => $value)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$value['title']}}</td>
                                                    <td>{{$value['short_description']}}</td>
                                                    
                                                    <td>
                                                        @if($value['status'] == 1)
                                                            <span class='text-success'><a href="{{url('inactive_job/' . $value->id)}}" onclick="return confirm('Are you sure, Inactive this Job')"><span class="act">Active</span></a></span>
                                                        @else
                                                            <span class='text-danger'><a href="{{url('active_job/' . $value->id)}}" onclick="return confirm('Are you sure,  Active this Job')"><span class="inact">Inactive</span></a></span>
                                                        @endif
                                                    </td>
                                                    <td>{{$value['created_at']}}</td>
                                                    <td>
                                                        <a href="{{url('edit_job' . $value->id)}}" edit-id="<?php echo $value->id; ?>" class="back_color btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                                        <a data-id="<?php echo $value->id; ?>" data-url="delete_job" data-back="job" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
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
