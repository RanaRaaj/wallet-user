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
                        <li class="breadcrumb-item"><a href="">Order</a>
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
                                            <th>Customer Name</th>
                                            <th>Order ID</th>
                                            <th>Packing Slip ID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; ?>
                                            @foreach($data as $value)
                                                <tr>
                                                    <td>{{ $count ?? '' }}</td>
                                                    <td>{{$value['name']}}</td>
                                                    <td>{{$value['order_id']}}</td>
                                                    <td>{{$value['slip_id']}}</td>
                                                    <td>
                                                        @if($value['status'] == 1)
                                                            Complete
                                                            @elseif($value['status'] == 2)
                                                            Cancel
                                                            @elseif($value['status'] == 3)
                                                            Delete
                                                            @elseif($value['status'] == 4)
                                                            Return
                                                            @elseif($value['status'] == 5)
                                                            Shipped
                                                            @else
                                                            Shipped
                                                        @endif
                                                    </td>
                                                    <td style="width: 100% !important;">
                                                        <a href="https://tools.usps.com/go/TrackConfirmAction?qtc_tLabels1={{$value['tracking_id']}}" target="_blank" edit-id="<?php echo $value->id; ?>" class="back_color btn btn-sm btn-info"> Track Online</a>
                                                        <a href="{{url('view_order' . $value->id)}}" edit-id="<?php echo $value->id; ?>" class="back_color btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                        <a href="#" data-id={{$count}} class="btn btn-sm btn-primary basiczo">Print</a>
                                                    </td>
                                                </tr>
                                                <!-- print order -->
                                                <div style="display: none;">
                                                    <div class="print-order{{$count}} twelve columns container" style="text-align: center;">
                                                        <!-- <h1 style="font-size: 60px;font-weight: bolder;padding-bottom: 6%;padding-top: 6%;">SHOPROFY</h1> -->
                                                        <h1 style="font-size: 40px;font-weight: bolder;">Packing Slip</h1>
                                                        <img style="width: 30%;" src="images/print-logo.png">
                                                        <div class="row">
                                                            <div class="col-6" style="text-align: left;padding-bottom: 1%;">
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;">{{$value['order_types']}} Order</h3>
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;"><span style="font-size: 30px;font-weight: bolder;">Invoice #: </span> <span>{{$value['slip_id']}}</span></h3>
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;"><span style="font-size: 30px;font-weight: bolder;">Order Date: </span>
                                                                  <?php
                                                                    $valz = str_replace("00:00:00", "",$value->date);
                                                                    $tim = str_replace("_", "",$valz);
                                                                  ?> 
                                                                 <span>{{$tim}}</span></h3>
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;"><span style="font-size: 30px;font-weight: bolder;">Order ID: </span> <span>{{$value['order_id']}}</span></h3>
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;"><span style="font-size: 30px;font-weight: bolder;">Shipping: </span> <span>{{$value['shipping_method']}}</span></h3>
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;"><span style="font-size: 30px;font-weight: bolder;">Tracking ID: </span> <span>{{$value['tracking_id']}}</span></h3>
                                                            </div>
                                                            <div class="col-6" style="text-align: left;padding-bottom: 1%;">
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;">Ship To</h3>
                                                                <h3 style=" font-size: 25px;">{{$value['name']}}</h3>
                                                                <h3 style="font-size: 25px;padding-bottom: 3%;"><pre style="font-size: 25px;">{{$value['address']}}&nbsp;{{$value['zip_code']}}</pre></h3>
                                                                <!-- <h3 style="font-size: 25px;"></h3> -->
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="table-head row" style="padding-top: 1%;border-top: 2px solid;border-bottom: 2px solid;padding-bottom: 1%;">
                                                                    <div class="col-4" style="text-align: left;">
                                                                        <h3 style="font-size: 28px;font-weight: 800;padding-bottom: 2%;">Product Name</h3><br>
                                                                        <?php
                                                                        $item = json_decode($value['item']);
                                                                        ?>
                                                                        @foreach($item as $val)
                                                                        @php
                                                                            $name = DB::table('products')->where('product_code',$val)->get()->first();
                                                                        @endphp
                                                                        <p style="font-size: 25px;">{{$name->name}}</p>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="col-2" style="text-align: right;">
                                                                        <h3 style="font-size: 30px;font-weight: 800;padding-bottom: 2%;">SKU</h3><br>
                                                                        <?php
                                                                        $item = json_decode($value['item']);
                                                                        ?>
                                                                        @foreach($item as $val)
                                                                        <p style="font-size: 25px;">{{$val}}</p>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="col-2" style="text-align: right;">
                                                                        <h3 style="font-size: 30px;font-weight: 800;padding-bottom: 2%;">QTY</h3><br>
                                                                        @for ($i = 0; $i < 4; $i++)
                                                                          @if($i==0)
                                                                          @if($value['quantity'] !='0')
                                                                          <p style="font-size: 25px;">
                                                                          {{$value['quantity']}}</p>
                                                                          @else
                                                                          <p style="font-size: 25px;">&nbsp; </p>
                                                                          @endif
                                                                          @endif
                                                                          @if($i==1)
                                                                          @if($value['quantity2'] != '0')
                                                                          <p style="font-size: 25px;">
                                                                          {{$value['quantity2']}}</p>
                                                                          @else
                                                                          <p style="font-size: 25px;">&nbsp; </p>
                                                                          @endif
                                                                          @endif
                                                                          @if($i==2)
                                                                          @if($value['quantity3'] != '0')
                                                                          <p style="font-size: 25px;">
                                                                          {{$value['quantity3']}}</p>
                                                                          @else
                                                                          <p style="font-size: 25px;">&nbsp; </p>
                                                                          @endif
                                                                          @endif
                                                                          @if($i==3)
                                                                          @if($value['quantity4'] != '0' && $value['quantity4']!='')
                                                                          <p style="font-size: 25px;">
                                                                          {{$value['quantity4']}}</p>
                                                                          @else
                                                                          <p style="font-size: 25px;">&nbsp; </p>
                                                                          @endif
                                                                          @endif
                                                                        @endfor
                                                                    </div>
                                                                    <div class="col-2" style="text-align: right;">
                                                                        <h3 style="font-size: 30px;font-weight: 800;padding-bottom: 2%;">PRICE</h3><br>
                                                                        @foreach($item as $key => $val)
                                                                          @if($key==0)
                                                                          <p style="font-size: 25px;">{{$value['unit_price']}}</p>
                                                                          @endif
                                                                          @if($key==1)
                                                                          <p style="font-size: 25px;">{{$value['unit_price2']}}</p>
                                                                          @endif
                                                                          @if($key==2)
                                                                          <p style="font-size: 25px;">{{$value['unit_price3']}}</p>
                                                                          @endif
                                                                          @if($key==3)
                                                                          <p style="font-size: 25px;">{{$value['unit_price4']}}</p>
                                                                          @endif
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="col-2" style="text-align: right;">
                                                                        <h3 style="font-size: 30px;font-weight: 800;padding-bottom: 2%;">TOTAL</h3><br>
                                                                        @foreach($item as $key => $val)
                                                                          @if($key==0)
                                                                          <p style="font-size: 25px;">${{$value['quantity']*$value['unit_price']}}</p>
                                                                          @endif
                                                                          @if($key==1)
                                                                          <p style="font-size: 25px;">${{$value['quantity2']*$value['unit_price2']}}</p>
                                                                          @endif
                                                                          @if($key==2)
                                                                          <p style="font-size: 25px;">${{$value['quantity3']*$value['unit_price3']}}</p>
                                                                          @endif
                                                                          @if($key==3)
                                                                          <p style="font-size: 25px;">${{$value['quantity4']*$value['unit_price4']}}</p>
                                                                          @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 row" style="padding-top: 2%; border-top: 2px solid;text-align: left; padding-bottom: 4%;">
                                                                <div class="col-6">
                                                                    <h3 style="font-weight: 800; font-size: 25px;">NOTE: </h3>
                                                                    <h3 style="font-size: 25px;">{{$value['note']}}</h3>
                                                                </div>
                                                                <div class="col-6" style="border-bottom: 2px solid;padding-bottom: 2%;">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 12%;">Subtotal </h3>
                                                                            <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 8%;">Shipping </h3>
                                                                        </div>
                                                                        <div class="col-6" style="text-align: right;">
                                                                            <h3 style="font-size: 25px;padding-bottom: 12%;">${{$value['quantity']*$value['unit_price']+$value['quantity2']*$value['unit_price2']+$value['quantity3']*$value['unit_price3']+$value['quantity4']*$value['unit_price4']}}</h3>
                                                                            <h3 style="font-size: 25px;padding-bottom: 8%;">${{$value['shipping']}}</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" style="border-top: 2px solid;padding-top: 4%;">
                                                                        <div class="col-6">
                                                                            <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 8%;">Order Total </h3>
                                                                        </div>
                                                                        <div class="col-6" style="text-align: right;">
                                                                            <h3 style="font-size: 25px;padding-bottom: 8%;">${{$value['quantity']*$value['unit_price']+$value['quantity2']*$value['unit_price2']+$value['quantity3']*$value['unit_price3']+$value['quantity4']*$value['unit_price4']+$value['shipping']}}</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-6">
                                                            <!-- <h1 style="font-size: 40px;font-weight: 800;padding-top: 3%;">THANKS FOR YOUR <br>BUSINESS!</h1><br>
                                                            <p style="font-size: 30px;font-weight: bold;">Need Help ? We're in here <br>support@shoprofy.com <br>www.Shoprofy.com <br><i class="fa fa-facebook"></i> <i class="fa fa-instagram"> </i> <i class="fa fa-telegram"></i></p> -->
                                                          </div>
                                                          <div class="col-6">
                                                            <div class="dem">
                                                            @php
                                                                $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                            @endphp
                                                              <img style="width: 75%;height: 175px;margin-top: 1%;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($value['slip_id'], $generatorPNG::TYPE_CODE_128)) }}"><br>
                                                              <p style="margin-left: 40px;font-size: 20px;">{{$value['slip_id']}}</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>

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
<script type="text/javascript" src="{{url(asset('printThis.js'))}}"></script>
<script>
$(document).ready(function() {
    $('#table').DataTable();
    //print order
    $('.basiczo').on("click", function () {
        var task_id = $( this ).attr( "data-id" );
        $('.print-order'+task_id).printThis({
        base: ""
      });
    });
});

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
