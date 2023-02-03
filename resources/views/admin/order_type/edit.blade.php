@extends('admin.layouts.layout')
@section('dashboard.content-view')
    <!-- BEGIN: Content-->

    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Order Type</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Edit</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{--    main content--}}
    <div class="content-body">
        <!-- Alert animation start -->
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-md-8 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                <form action="{{url('order_type/update')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$order->id}}">
                                                    <fieldset class="form-group">
                                                        <input type="text" name="order_type" value="{{$order->order_type}}"
                                                               placeholder="Enter order type" class="form-control"
                                                               id="basicInput" required>
                                                        @if($errors->has('order_type'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('order_type')}}</div>
                                                        @endif
                                                    </fieldset>
                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('order_type')}}" class="btn btn-primary">View All</a>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                            </div>
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
@endsection

