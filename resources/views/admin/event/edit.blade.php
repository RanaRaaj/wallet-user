@extends('admin.layouts.layout')
@section('dashboard.content-view')
    <!-- BEGIN: Content-->

    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Event</a>
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
                                                <form action="{{url('event/update')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <fieldset class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title" value="{{$event->title}}" placeholder="Write title here..." class="form-control" id="basicInput">
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Short Description</label>
                                                        <textarea class="form-control" placeholder="Enter Short Description" name="short_description" required>{{$event->short_description}}</textarea>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label>Full Description</label>
                                                        <textarea class="form-control" rows="10" placeholder="Enter Full Description" name="long_description" required>{{$event->long_description}}</textarea>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                    <label>Form Type</label>
                                                        <select class="form-control" name="form_status">
                                                            @if($event->form_status == 'online')
                                                            <option value="online">Online</option>
                                                            <option value="offline">Offline</option>
                                                            @else
                                                            <option value="offline">Offline</option>
                                                            <option value="online">Online</option>
                                                            @endif
                                                        </select>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                    <label>Event Type</label>
                                                        <select class="form-control" name="event_type">
                                                            @if($event->event_type == 'all')
                                                            <option value="all">All</option>
                                                            <option value="student">Student</option>
                                                            @else
                                                            <option value="student">Student</option>
                                                            <option value="all">All</option>
                                                            @endif
                                                        </select>
                                                    </fieldset>

                                                    <label>Location</label>
                                                        <input type="text" name="location" value="{{$event->location}}" placeholder="Write location Here..." class="form-control">
                                                    </fieldset>

                                                    <label>Event Time</label>
                                                        <input type="date" name="event_time" value="{{$event->event_time}}" class="form-control">
                                                    </fieldset>
                                                    
                                                    <fieldset class="form-group">
                                                        <label>image</label>
                                                        <img class="edit-page-img" src="{{ $event->file }}" alt="">
                                                        <input type="file" name="file" class="form-control" accept=".png,.jpg,.jpeg" id="inputFileToLoad" onchange="encodeImageFileAsURL();">
                                                    </fieldset>

                                                    <input type="hidden" id="d_img" value='' name="img-data">

                                                    <div id="imgTest"></div>

                                                    <input type="hidden" name="pre-image" value="{{$event->file}}">
                                                    <input type="hidden" name="id" value="{{$event->id}}">

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('users')}}"
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
@endsection

<script type='text/javascript'>
  function encodeImageFileAsURL() {

    var filesSelected = document.getElementById("inputFileToLoad").files;
    if (filesSelected.length > 0) {
      var fileToLoad = filesSelected[0];

      var fileReader = new FileReader();

      fileReader.onload = function(fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result; // <--- data: base64

        var newImage = document.createElement('img');
        newImage.src = srcData;

        document.getElementById("imgTest").innerHTML = newImage.outerHTML;
        document.getElementById("d_img").value = srcData;
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  }
</script>

