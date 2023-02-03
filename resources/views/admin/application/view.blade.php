@extends('admin.layouts.layout')
@section('dashboard.content-view')
    <!-- BEGIN: Content-->

    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Application</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">View</a>
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
                                                <form action="{{url('application/update')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <h4>JOB INFORMATION</h4>
                                                    <fieldset class="form-group">
                                                        <label>Job Title</label>
                                                        <input type="text" name="title" value="{{$application->job_title}}" class="form-control" disabled>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Job Description</label>
                                                        <textarea class="form-control" rows="10" name="job_description" disabled>{{$application->job_description}}</textarea>
                                                    </fieldset>

                                                    <hr>
                                                    @if($application->r_first_name != '')
                                                    <h4>REFERRER INFORMATION</h4>
                                                    <fieldset class="form-group">
                                                        <label>Referrer First Name</label>
                                                        <input type="text" value="{{$application->r_first_name}}" class="form-control" disabled>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Referrer Last Name</label>
                                                        <input type="text" value="{{$application->r_last_name}}" class="form-control" disabled>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Referrer Email</label>
                                                        <input type="email" value="{{$application->r_email}}" class="form-control" disabled>
                                                    </fieldset>
                                                    @endif

                                                    <hr>
                                                    <h4>APPLICANT INFORMATION</h4>
                                                    <fieldset class="form-group">
                                                        <label>Applicant Name</label>
                                                        <input type="text" name="title" value="{{$application->first_name}}" class="form-control" disabled>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Applicant Last Name</label>
                                                        <input type="text" value="{{$application->last_name}}" class="form-control" disabled>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Applicant Email</label>
                                                        <input type="email" value="{{$application->email}}" class="form-control" disabled>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="number" value="{{$application->phone_no}}" class="form-control" disabled>
                                                    </fieldset>

                                                    <label>Date Of Birth</label>
                                                        <input type="date" value="{{$application->dob}}" class="form-control" disabled>
                                                    </fieldset>
                                                    <br>
                                                    <fieldset class="form-group">
                                                        <label>Resume</label>
                                                        <a href="http://127.0.0.1:8000/applications/{{$application['resume']}}" target="_blank">{{$application['resume']}}</a>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Cover Letter</label>
                                                        <a href="http://127.0.0.1:8000/applications/{{$application['attachment']}}" target="_blank">{{$application['attachment']}}</a>
                                                    </fieldset>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('application')}}"
                                                               class="btn btn-primary">Go Back</a>
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
@endsection

<script type='text/javascript'>
  function encodeImageFileAsURL() {

    var filesSelected = document.getElementById("inputFileToLoad").files;
    if (filesSelected.length > 0) {
      var fileToLoad = filesSelected[0];

      var fileReader = new FileReader();

      fileReader.onload = function(fileLoadedapplication) {
        var srcData = fileLoadedapplication.target.result; // <--- data: base64

        var newImage = document.createElement('img');
        newImage.src = srcData;

        document.getElementById("imgTest").innerHTML = newImage.outerHTML;
        document.getElementById("d_img").value = srcData;
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  }
</script>

