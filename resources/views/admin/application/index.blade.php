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
                        <li class="breadcrumb-item"><a href="">Application</a>
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
                                            <th>Job Title</th>
                                            <th>Job Status</th>
                                            <th>Applicant Email</th>
                                            <th>Application Type</th>
                                            <th>Resume</th>
                                            <th>Cover Letter</th>
                                            <th>Applied Time</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($application as $key => $value)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$value['job_title']}}</td>
                                                    @if($value['job_status'] == 1)
                                                    <td>Active</td>
                                                    @else
                                                    <td>Inactive</td>
                                                    @endif
                                                    <td>{{$value['email']}}</td>
                                                    @if($value['r_email'] != '')
                                                    <td>Reffered</td>
                                                    @else
                                                    <td>Applied</td>
                                                    @endif
                                                    <td class="index-file"><a href="http://127.0.0.1:8000/applications/{{$value['resume']}}" target="_blank">{{$value['resume']}}</a></td>
                                                    <td class="index-file"><a href="http://127.0.0.1:8000/applications/{{$value['attachment']}}" target="_blank">{{$value['attachment']}}</a></td>
                                                    <td>{{$value['created_at']}}</td>
                                                    <td>
                                                        <a href="{{url('view_application' . $value->id)}}" edit-id="<?php echo $value->id; ?>" class="back_color btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
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
