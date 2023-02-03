@extends('admin.layouts.layout')
@section('dashboard.content-view')
    <!-- BEGIN: Content-->

    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Users</a>
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
                                                <form action="{{url('gallery/update')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <fieldset class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title" value="{{$gallery->title}}" placeholder="Write title here..." class="form-control" id="basicInput">
                                                    </fieldset>
                                                    
                                                    <fieldset class="form-group">
                                                        <label>image</label>
                                                        <img class="edit-page-img" src="{{ $gallery->file }}" alt="">
                                                        <input type="file" name="file" class="form-control" accept=".png,.jpg,.jpeg" id="inputFileToLoad" onchange="encodeImageFileAsURL();">
                                                    </fieldset>

                                                    <input type="hidden" id="d_img" value='' name="img-data">

                                                    <div id="imgTest"></div>

                                                    <input type="hidden" name="pre-image" value="{{$gallery->file}}">
                                                    <input type="hidden" name="id" value="{{$gallery->id}}">

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

