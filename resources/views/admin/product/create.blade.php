@extends('admin.layouts.layout')
@section('dashboard.content-view')
<style type="text/css">
.box {
  width: 12%;
}
.uploaded-image img {
  width: 100%;
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
                        <li class="breadcrumb-item"><a href="#">Product</a>
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
                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                        <div class="card-block">
                                            <div class="card-body">
                                                @if(isset($data))
                                                <form action="{{route('product.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label for="Product Name">Product Code</label>
                                                            <input type="text" value="{{$data['product_code']}}"
                                                                   placeholder="Enter Product name" class="form-control" disabled>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="Product Name">Product Name</label>
                                                            <input type="text" value="{{$data['name']}}"
                                                                   placeholder="Enter Product name" class="form-control" disabled>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" placeholder="Enter Description" disabled>{{$data['description']}}</textarea>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Purchased Price</label>
                                                            <input type="number" class="form-control" value="{{$data['purchased_price']}}" disabled>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Selling Price</label>
                                                            <input type="number" class="form-control" value="{{$data['selling_price']}}" disabled>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Status</label>
                                                            <input type="number" class="form-control" placeholder="Active" disabled>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Current Stock</label>
                                                            <input type="number" class="form-control" value="{{$balance ?? 0}}" disabled>
                                                        </fieldset>
                                                        </div>
                                                        <div  class="col-md-6">
                                                            <div class="uploaded-image">
                                                                <img src="{{asset('images/'.$data['image'])}}" id="upload_image">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div style="display: none;">
                                                        <div class="dem twelve columns">
                                                        @php
                                                            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                        @endphp
                                                        <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($data['product_code'], $generatorPNG::TYPE_CODE_128)) }}"><br>
                                                        <p style="margin-left: 100px;">{{$data['product_code']}}</p>
                                                      </div>
                                                    </div>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{url('edit_product' . $data['id'])}}"
                                                               class="btn btn-primary">Edit</a>
                                                            <a id="basic" href="#"
                                                               class="btn btn-primary">Print Barcode</a>
                                                            <a href="{{url('bin_card' . $data['id'])}}"
                                                               class="btn btn-primary">BIN Card Report</a>
                                                            <a href="{{url('product_stack' . $data['id'])}}"
                                                               class="btn btn-primary">Update Stock</a>
                                                            <a href="{{route('product')}}"
                                                               class="btn btn-primary">View All</a>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                @elseif(isset($editData))
                                                <form action="{{url('product/update')}}" method="post"
                                                      enctype="multipart/form-data"> 
                                                @csrf   
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="id" value="{{$editData['id']}}">

                                                    
                                                        <fieldset class="form-group">
                                                            <label for="Product Name">Product Code</label>
                                                            <input type="text" value="{{$editData['product_code']}}"
                                                                   placeholder="Enter Product name" class="form-control" name="product_code" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="Product Name">Product Name</label>
                                                            <input type="text" value="{{$editData['name']}}"
                                                                   placeholder="Enter Product name" class="form-control" name="name" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" placeholder="Enter Description" value="{{$editData['description']}}" name="description" required>{{$editData['description']}}</textarea>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Purchased Price</label>
                                                            <input type="number" class="form-control" value="{{$editData['purchased_price']}}" name="purchase_price" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Selling Price</label>
                                                            <input type="number" class="form-control" value="{{$editData['selling_price']}}" name="selling_price" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>image</label>
                                                            <input type="file" name="file" class="form-control" accept=".png,.jpg,.jpeg">
                                                        </fieldset>
                                                        </div>
                                                        <div  class="col-md-6">
                                                            <div class="uploaded-image">
                                                                <img src="{{asset('images/'.$editData['image'])}}" id="upload_image">
                                                                <input type="hidden" name="image" value="{{$editData['image']}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('product')}}"
                                                               class="btn btn-primary">View All</a>
                                                               <button type="submit" class="btn btn-success">Update
                                                            </button>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                @elseif(isset($editDataStack))
                                                <form action="{{url('product_stack/update')}}" method="post"
                                                      enctype="multipart/form-data"> 
                                                @csrf   
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="id" value="{{$editDataStack['id']}}">
                                                        <fieldset class="form-group">
                                                            <label for="Product Name">Product Code</label>
                                                            <input type="text" value="{{$editDataStack['product_code']}}"
                                                                   placeholder="Enter Product name" class="form-control" name="product_code" readonly="">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="Product Name">Product Name</label>
                                                            <input type="text" value="{{$editDataStack['name']}}"
                                                                   placeholder="Enter Product name" class="form-control" name="product_name" readonly="">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" placeholder="Enter Description" readonly="">{{$editDataStack['description']}}</textarea>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Purchased Price</label>
                                                            <input type="number" class="form-control" value="{{$editDataStack['purchased_price']}}" readonly="">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Selling Price</label>
                                                            <input type="number" class="form-control" value="{{$editDataStack['selling_price']}}" readonly="">
                                                        </fieldset>
                                                        </div>
                                                        <div  class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label>Select</label>
                                                            <select class="form-control" name="stock_type">
                                                                <option value="GRN">GRN</option>
                                                                <option value="Adjestment">Adjestment</option>
                                                            </select>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Current Stock</label>
                                                            <input type="number" class="form-control" value="0" name="stock">
                                                        </fieldset>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('product')}}"
                                                               class="btn btn-primary">View All</a>
                                                               <button type="submit" class="btn btn-success">Update
                                                            </button>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                @else
                                                <form action="{{route('product.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label for="Product Name">Product Name</label>
                                                            <input type="text" name="product_name" value="{{old('product_name')}}"
                                                                   placeholder="Enter Product name" class="form-control" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="Product Name">Product Code</label>
                                                            <input type="text" value=""
                                                                   placeholder="Enter Product Code" class="form-control" name="product_code">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" placeholder="Enter Description" name="description" required></textarea>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Purchased Price</label>
                                                            <input type="number" name="purchase_price" class="form-control" value="0">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Selling Price</label>
                                                            <input type="number" name="selling_price" class="form-control" value="0">
                                                        </fieldset>

                                                        <fieldset class="form-group">
                                                            <label>image</label>
                                                            <input type="file" name="file" class="form-control" accept=".png,.jpg,.jpeg">
                                                        </fieldset>
                                                        </div>
                                                        <div  class="col-md-6">
                                                            <div class="uploaded-image">
                                                                <img src="" id="upload_image">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('product')}}"
                                                               class="btn btn-primary">View All</a>
                                                            <button type="submit" class="btn btn-success">submit
                                                            </button>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                @endif
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


  <script type="text/javascript" src="printThis.js"></script>

  <!-- demo -->
  <script>
    $(document).ready(function() {
        $('#basic').on("click", function () {
          $('.dem').printThis({
            base: ""
          });
        });
    });

  </script>
<script type="text/javascript">
  $('.chk').on('click', function() {
        this.value = this.checked ? 1 : 0;
    }).change();
$(document).ready(function() {
    // $('#upload_image').hide();
    $('input[type="file"]').change(function(event) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var oldImg = $('#upload_image').attr('src', e.target.result);
                }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>

@endsection

@push('dashboard.scripts-footer')
@endpush

