@extends('admin.layouts.layout')
@section('dashboard.content-view')
<style type="text/css">
.box {
  width: 12%;
}
</style>
    <!-- BEGIN: Content-->
<script src="//code.jquery.com/jquery-1.12.3.js"></script>

    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Reason Type</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Create</a>
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
                                                <form action="{{route('reason.type.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <fieldset class="form-group">
                                                        <input type="text" name="reason_type" value="{{old('reason_type')}}"
                                                               placeholder="Enter reason type" class="form-control"
                                                               id="basicInput" required>
                                                        @if($errors->has('reason_type'))
                                                            <div class="error"
                                                                 style="color:red">{{$errors->first('reason_type')}}</div>
                                                        @endif
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="reason">Reason</label>
                                                        <input type="checkbox" class="form-control chk box" id="reason" name="reason" value="0">
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="cancel">Cancel</label>
                                                        <input type="checkbox" class="form-control chk box" id="cancel" name="cancel" value="0">
                                                    </fieldset>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('reason_type')}}"
                                                               class="btn btn-primary">View All</a>
                                                            <button type="submit" class="btn btn-success">submit
                                                            </button>
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
<script type="text/javascript">
  $('.chk').on('click', function() {
        this.value = this.checked ? 1 : 0;
    }).change();
</script>
@endsection

@push('dashboard.scripts-footer')
@endpush

