@extends('admin.layouts.layout')
@section('dashboard.content-view')
<style type="text/css">
.box {
  width: 12%;
}
.uploaded-image img {
  width: 100%;
}
p span {
  background: #80ff80;
  color: #000;
  padding: 1%;
  font-weight: bold;
}
.print-order {
    text-align: center;
}
.btn-group.bootstrap-select.show-tick.form-control {
  border: 1px solid;
}
@media print {

.showz{font-size:24px;font-weight:500;} }
textarea {display:block;}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">

    <!-- BEGIN: Content-->
<script src="//code.jquery.com/jquery-1.12.3.js"></script>

    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
            <div class="breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Order</a>
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
                                                            <label for="Order Type">Order Type</label>
                                                            <input type="text" class="form-control" value="{{$data['order_types']}}" disabled="">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="Customer Name">Customer Name</label>
                                                            <input type="text" name="customer_name" value="{{$data['name']}}"
                                                                   placeholder="Enter Customer name" class="form-control" disabled="">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control" placeholder="Enter Customer Address" name="address" disabled="">{{$data['address']}}</textarea>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Order ID</label>
                                                            <input class="form-control" type="text" placeholder="Enter order Id" value="{{$data['order_id']}}" name="order_id" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div  class="col-md-6">
                                                        <p style="text-align: right;width: 100%;color: #94dd94;font-weight: bold;font-size: 20px;margin-bottom: 0">
                                                            @if($data['status'] == 1)
                                                            Complete
                                                            @elseif($data['status'] == 2)
                                                            Cancel
                                                            @elseif($data['status'] == 3)
                                                            Delete
                                                            @elseif($data['status'] == 4)
                                                            Return
                                                            @elseif($data['status'] == 5)
                                                            Shipped
                                                            @else
                                                            Shipped
                                                            @endif
                                                        </p>
                                                        <fieldset class="form-group">
                                                            <label>Slip ID</label>
                                                            <input class="form-control" type="text" placeholder="Enter order Id" value="{{$data['slip_id']}}" name="order_id" disabled="">
                                                        </fieldset>
                                                        @php
                                                          $date = Carbon\Carbon::parse($data->date)->format('Y-m-d');
                                                        @endphp 
                                                        <fieldset class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d',strtotime($data["date"])) ?>" placeholder="Enter ..." disabled="">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Zip Code</label>
                                                            <input class="form-control" type="number" placeholder="Enter Zip Code" value="{{$data['zip_code']}}" name="zip_code" disabled="">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" type="email" placeholder="Enter customer name" value="{{$data['email']}}" name="email" disabled="">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Tracking ID</label>
                                                            <input class="form-control" type="text" placeholder="Enter tracking Id" value="{{$data['tracking_id']}}" name="tracking_id" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item</label>
                                                            <input type="text" name="item1" value="{{$item[0]}}" class="form-control" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice" type="number" name="unit_price1" value="{{$data['unit_price'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity" value="{{$data['quantity'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item</label>
                                                            <input type="text" name="item1" value="{{$item[1] ?? ''}}" class="form-control" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice1" type="number" name="unit_price2" value="{{$data['unit_price2'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity2" value="{{$data['quantity2'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item</label>
                                                            <input type="text" name="item1" value="{{$item[2] ?? ''}}" class="form-control" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice2" type="number" name="unit_price3" value="{{$data['unit_price3'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity3" value="{{$data['quantity3'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item</label>
                                                            <input type="text" name="item1" value="{{$item[3] ?? ''}}" class="form-control" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice2" type="number" name="unit_price3" value="{{$data['unit_price4'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity3" value="{{$data['quantity4'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <fieldset class="form-group">
                                                            <label>Shipping Method</label>
                                                            <input class="form-control" type="text" name="shipping_method" placeholder="Enter shipping method" value="{{$data['shipping_method']}}" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <fieldset class="form-group">
                                                            <label>Shipping</label>
                                                            <input class="form-control" type="number" name="shipping" value="{{$data['shipping']}}" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Note</label>
                                                            <input class="form-control" type="text" value="{{$data['note']}}" name="note" placeholder="Enter note" disabled="">
                                                        </fieldset>
                                                        <p style="margin-top: 2%;">
                                                            <?php 
                                                                $Total = $data['unit_price']*$data['quantity']+$data['shipping'];
                                                             ?>
                                                             <?php 
                                                                $Aactal = $less*$data['unit_price'];
                                                                $A_Total = $Total - $Aactal;
                                                             ?>
                                                            <span>Order Total - ${{$Total}}</span>
                                                            <span>Actual Total - ${{$A_Total}}</span>
                                                        </p>
                                                        </div>
                                                    </div>


                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            @if($data['status'] == 0 || $data['status'] == 5 || $data['status'] == 1)
                                                            <a href="{{url('edit_order' . $data['id'])}}"
                                                               class="btn btn-primary">Edit</a>
                                                            <a><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Return</button></a>
                                                            @endif
                                                            @if($data['status'] == 0)
                                                            <a data-id="<?php echo $data->id; ?>" data-url="cancel_order" data-back="view_order<?php echo $data->id; ?>" class="btn btn-danger cancel">Cancel</a>
                                                            <a data-id="<?php echo $data->id; ?>" data-url="delete_order" data-back="order" class="btn btn-danger delete">Delete</a>
                                                            
                                                            @endif
                                                            @if($data['status'] != 1 && $data['status'] != 2)
                                                            <a data-id="<?php echo $data->id; ?>" data-url="complete_order" data-back="view_order<?php echo $data->id; ?>" class="btn btn-success complete">Complete</a>
                                                            @endif
                                                            <a id="basicz" href="#"
                                                               class="btn btn-primary">Print</a>
                                                            <a><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalzo">Order History</button></a>
                                                            <a><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalz">Note</button></a>
                                                            <a href="{{route('order')}}"
                                                               class="btn btn-primary">View All</a>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                                <!-- print order -->
                                                <div style="display: none;">
                                                    <div class="print-order twelve columns container" style="text-align: center;">
                                                        <!-- <h1 style="font-size: 60px;font-weight: 800;padding-bottom: 6%;padding-top: 6%;">SHOPROFY</h1> -->
                                                        <h1 style="font-size: 40px;font-weight: bolder;">Packing Slip</h1>
                                                        <img style="width: 27%;" src="images/print-logo.png">
                                                        <div class="row">
                                                            <div class="col-6" style="text-align: left;padding-bottom: 1%;">
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;">{{$data['order_types']}} Order</h3>
                                                                <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 3%;">Packing Slip #: <span class="showz" class="showz" style="font-size: 25px">{{$data['slip_id']}}</span></h3>
                                                                <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 3%;">Order Date: 
                                                                    <?php
                                                                    $valz = str_replace("00:00:00", "",$data->date);
                                                                    $tim = str_replace("_", "",$valz);
                                                                  ?> 
                                                                 <span class="showz" style="font-size: 25px">{{$tim}}</span></h3>
                                                                <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 3%;">Order ID: <span class="showz" style="font-size: 25px">{{$data['order_id']}}</span></h3>
                                                                <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 3%;">Shipping: <span class="showz" style="font-size: 25px">{{$data['shipping_method']}}</span></h3>
                                                            </div>
                                                            <div class="col-6" style="text-align: left;padding-bottom: 2%;">
                                                                <h3 style="font-weight: 800; font-size: 25px;padding-bottom: 3%;">Ship To</h3>
                                                                <h3 style=" font-size: 25px;">{{$data['name']}}</h3>
                                                                <h3 style="font-size: 25px;padding-bottom: 3%;"><pre style="font-size: 25px;">{{$data['address']}}&nbsp;{{$data['zip_code']}}</pre></h3>
                                                            </div>
                                                            <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 3%;">Tracking ID: <span class="showz" style="font-size: 25px">{{$data['tracking_id']}}</span></h3>
                                                            <table class="table" style="border-top: 2px solid;padding-top: 1%;padding-bottom: 1%;font-size: 25px;text-align: left;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Name</th>
                                                                        <th>SKU</th>
                                                                        <th style="text-align: right;">QTY</th>
                                                                        <th style="text-align: right;">PRICE</th>
                                                                        <th style="text-align: right;">TOTAL</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($item as $key => $val)
                                                                    <tr>
                                                                        <td>
                                                                            @php
                                                                                $name = DB::table('products')->where('product_code',$val)->get()->first();
                                                                            @endphp
                                                                            {{$name->name}}
                                                                        </td>
                                                                        <td>{{$val}}</td>
                                                                        @if($key==0)
                                                                        <td class="showz" style="text-align: right;">{{$data['quantity']}}</td>
                                                                        <td class="showz" style="text-align: right;">${{$data['unit_price']}}</td>
                                                                        <td class="showz" style="text-align: right;">${{$data['quantity']*$data['unit_price']}}</td>
                                                                        @endif
                                                                        @if($key==1)
                                                                        <td class="showz" style="text-align: right;">{{$data['quantity2']}}</td>
                                                                        <td class="showz" style="text-align: right;">${{$data['unit_price2']}}</td>
                                                                        <td class="showz" style="text-align: right;">${{$data['quantity2']*$data['unit_price2']}}</td>
                                                                        @endif
                                                                        @if($key==2)
                                                                        <td class="showz" style="text-align: right;">{{$data['quantity3']}}</td>
                                                                        <td class="showz" style="text-align: right;">${{$data['unit_price3']}}</td>
                                                                        <td class="showz" style="text-align: right;">${{$data['quantity3']*$data['unit_price3']}}</td>
                                                                        @endif
                                                                        @if($key==3)
                                                                        <td class="showz" style="text-align: right;">{{$data['quantity4']}}</td>
                                                                        <td class="showz" style="text-align: right;">${{$data['unit_price4']}}</td>
                                                                        <td class="showz" style="text-align: right;">${{$data['quantity4']*$data['unit_price4']}}</td>
                                                                        @endif
                                                                    </tr>
                                                                    @endforeach
                                                                    @if($key < 1)
                                                                    <tr><td>&nbsp;</td></tr>
                                                                    @endif
                                                                    @if($key < 2)
                                                                    <tr><td>&nbsp;</td></tr>
                                                                    @endif
                                                                    @if($key < 3)
                                                                    <tr><td>&nbsp;</td></tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                            <div class="col-12 row" style="padding-top: 2%; border-top: 2px solid;text-align: left; padding-bottom: 4%;">
                                                                <div class="col-6">
                                                                    <h3 style="font-weight: 800; font-size: 25px;">NOTE: </h3>
                                                                    <h3 style="font-size: 25px;">{{$data['note']}}</h3>
                                                                </div>
                                                                <div class="col-6" style="border-bottom: 2px solid;padding-bottom: 2%;">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 12%;">Subtotal </h3>
                                                                            <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 8%;">Shipping </h3>
                                                                        </div>
                                                                        <div class="col-6" style="text-align: right;">
                                                                            <h3 class="showz" style="font-size: 25px;padding-bottom: 12%;">${{$data['quantity']*$data['unit_price']+$data['quantity2']*$data['unit_price2']+$data['quantity3']*$data['unit_price3']+$data['quantity4']*$data['unit_price4']}}</h3>
                                                                            <h3 style="font-size: 25px;padding-bottom: 8%;">${{$data['shipping']}}</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" style="border-top: 2px solid;padding-top: 4%;">
                                                                        <div class="col-6">
                                                                            <h3 style="font-weight: 800; font-size: 30px;padding-bottom: 8%;">Order Total </h3>
                                                                        </div>
                                                                        <div class="col-6" style="text-align: right;">
                                                                            <h3 class="showz" style="font-size: 25px;padding-bottom: 8%;">${{$data['quantity']*$data['unit_price']+$data['quantity2']*$data['unit_price2']+$data['quantity3']*$data['unit_price3']+$data['quantity4']*$data['unit_price4']+$data['shipping']}}</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-6">
                                                            <div class="dem">
                                                            @php
                                                                $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                            @endphp
                                                              <img style="width: 75%;height: 175px;margin-top: -25%;" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($data['slip_id'], $generatorPNG::TYPE_CODE_128)) }}"><br>
                                                              <p style="margin-left: 50px;font-size: 30px;">{{$data['slip_id']}}</p>
                                                            </div>
                                                            <!-- <h1 style="font-size: 40px;font-weight: 800;padding-top: 3%;">THANKS FOR YOUR <br>BUSINESS!</h1><br>
                                                            <p style="font-size: 30px;font-weight: bold;">Need Help ? We're in here <br>support@shoprofy.com <br>www.Shoprofy.com <br><i class="fa fa-facebook"></i> <i class="fa fa-instagram"> </i> <i class="fa fa-telegram"></i></p> -->
                                                          </div>
                                                          <div class="col-6">
                                                            
                                                          </div>
                                                        </div>
                                                        <!-- <div class="top-slip">
                                                            <h1>Packing Slip</h1>
                                                            <h2>SHOPROFY</h2>
                                                            <p>{{$data['order_types']}} Order</p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h4>Ship To:</h4>
                                                                <p></p>
                                                                <p>{{$data['name']}}</p>
                                                                <p>{{$data['address']}}</p>
                                                            </div>
                                                            <div class="col-6" style="text-align: left;">
                                                                <h4>Packing Slip #: <span>{{$data['slip_id']}}</span></h4>
                                                                <h4>Order #: <span>{{$data['order_id']}}</span></h4>
                                                                <h4>Order Date: <span>{{$data['date']}}</span></h4>
                                                                <h4>Shipping Date: <span>{{$data['date']}}</span></h4>
                                                                <h4>Shipping: <span>{{$data['shipping']}}</span></h4>
                                                                <h4>Tracking ID: <span>{{$data['tracking_id']}}</span></h4>
                                                            </div>
                                                            <div class="col-12">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>QTY</th>
                                                                            <th>SKU</th>
                                                                            <th>Item Description</th>
                                                                            <th>Price</th>
                                                                            <th>Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <!-- Modal Order History -->
                                                <div class="modal fade" id="exampleModalzo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="width: 104%;">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Order History</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Note</th>
                                                                        <th>Qnt</th>
                                                                        <th>Remarks</th>
                                                                        <th>date</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(isset($history))
                                                                        @foreach($history as $his)
                                                                            <tr>
                                                                                <td>{{$his['note']}}</td>
                                                                                <td>{{$his['quantity']}}</td>
                                                                                @if($his['remark'] =='on')
                                                                                <td>Good Item</td>
                                                                                @else
                                                                                <td>{{$his['remark']}}</td>
                                                                                @endif
                                                                                <td>{{$his['created_at']->format('Y-m-d')}}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Order Notes</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                    <form action="{{url('addNote')}}" method="post">
                                                        @csrf
                                                      <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{$data['id']}}">
                                                            <label>Office Note</label>
                                                            <textarea class="form-control" name="note" rows="3">{{$data['after_note'] ?? ''}}</textarea>
                                                            <p>
                                                                Last Modification - {{$data['updated_at']}}
                                                            </p>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save Note</button>
                                                      </div>
                                                    </form>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Return Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                    <form action="{{url('return/order')}}" method="post">
                                                        @csrf
                                                      <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{$data['id']}}">
                                                            <select class="form-control" name="reason" required>
                                                                <option>-Select Return reason-</option>
                                                                <option value="damage">Damage</option>
                                                                <option value="late">Late Received</option>
                                                                <option value="wrong">Wrong Item</option>
                                                                <option value="defective">item defective or doesn't work</option>
                                                            </select>
                                                            <label>Return Quantity</label>
                                                            <input min="1" type="number" name="quantity" class="form-control" required><br>
                                                            <label>Good item</label>
                                                            <input type="checkbox" name="good">
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Complete Return</button>
                                                      </div>
                                                    </form>
                                                    </div>
                                                  </div>
                                                </div>
                                                @elseif(isset($editData))
                                                <form action="{{url('order/update')}}" method="post"
                                                      enctype="multipart/form-data"> 
                                                @csrf   
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="id" value="{{$editData['id']}}">
                                                            <input type="hidden" name="slip_id" value="{{$editData['slip_id']}}">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Order Type</label>
                                                            <select class="form-control" name="order_type">
                                                                <option>{{$editData['order_types']}}</option>
                                                                @foreach($order_type as $ot)
                                                                <option value="{{$ot['order_type']}}">{{$ot['order_type']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="Customer Name">Customer Name</label>
                                                            <input type="text" name="customer_name" value="{{$editData['name']}}"
                                                                   placeholder="Enter Customer name" class="form-control" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control" placeholder="Enter Customer Address" name="address" required>{{$editData['address']}}</textarea>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Order ID</label>
                                                            <input class="form-control" type="text" placeholder="Enter order Id" value="{{$editData['order_id']}}" name="order_id" required>
                                                        </fieldset>
                                                        </div>
                                                        <div  class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label>Slip ID</label>
                                                            <input class="form-control" type="text" placeholder="Enter order Id" value="{{$editData['slip_id']}}" name="order_id" disabled="">
                                                        </fieldset>
                                                        @php
                                                          $date = Carbon\Carbon::parse($editData->date)->format('Y-m-d');
                                                        @endphp                            
                                                        <fieldset class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d',strtotime($editData["date"])) ?>" placeholder="Enter ..." required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Zip Code</label>
                                                            <input class="form-control" type="number" placeholder="Enter Zip Code" value="{{$editData['zip_code']}}" name="zip_code" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" type="email" placeholder="Enter customer name" value="{{$editData['email']}}" name="email" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Tracking ID</label>
                                                            <input class="form-control" type="text" placeholder="Enter tracking Id" value="{{$editData['tracking_id']}}" name="tracking_id" required>
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item Code</label>
                                                            <input type="text" name="" value="{{$item[0]}}" class="form-control" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice" type="number" name="unit_price1" value="{{$editData['unit_price'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity" value="{{$editData['quantity'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item Code</label>
                                                            <input type="text" name="" value="{{$item[1] ?? ''}}" class="form-control" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice1" type="number" name="unit_price2" value="{{$editData['unit_price2'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity2" value="{{$editData['quantity2'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item Code</label>
                                                            <input type="text" name="" value="{{$item[2] ?? ''}}" class="form-control" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice2" type="number" name="unit_price3" value="{{$editData['unit_price3'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity3" value="{{$editData['quantity3'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item Code</label>
                                                            <input type="text" name="" value="{{$item[3] ?? ''}}" class="form-control" disabled="">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice2" type="number" name="unit_price3" value="{{$editData['unit_price4'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity3" value="{{$editData['quantity4'] ?? ''}}" disabled="">
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <fieldset class="form-group">
                                                            <label>Shipping Method</label>
                                                            <input class="form-control" type="text" name="shipping_method" placeholder="Enter shipping method" value="{{$editData['shipping_method']}}" required>
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <fieldset class="form-group">
                                                            <label>Shipping</label>
                                                            <input class="form-control" type="number" name="shipping" value="{{$editData['shipping']}}" required>
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Note</label>
                                                            <input class="form-control" type="text" value="{{$editData['note']}}" name="note" placeholder="Enter note" required>
                                                        </fieldset>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center m-2"
                                                         style="border-top: 1px solid black">
                                                        <fieldset class="form-group center m-2">
                                                            <a href="{{route('order')}}"
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
                                                <form action="{{route('order.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Order Type</label>
                                                            <select class="form-control" name="order_type">
                                                                <option>-Select Order Type-</option>
                                                                @foreach($order_type as $ot)
                                                                <option value="{{$ot['order_type']}}">{{$ot['order_type']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="Customer Name">Customer Name</label>
                                                            <input type="text" name="customer_name" value="{{old('customer_name')}}"
                                                                   placeholder="Enter Customer name" class="form-control">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control" placeholder="Enter Customer Address" name="address"></textarea>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Order ID</label>
                                                            <input class="form-control" type="text" placeholder="Enter order Id" name="order_id" required>
                                                        </fieldset>
                                                        </div>
                                                        <div  class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter ...">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Zip Code</label>
                                                            <input class="form-control" type="number" placeholder="Enter Zip Code" name="zip_code">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" type="email" placeholder="Enter customer name" name="email">
                                                        </fieldset>
                                                        <br>
                                                        <fieldset class="form-group">
                                                            <label>Tracking ID</label>
                                                            <input class="form-control" type="text" placeholder="Enter tracking Id" name="tracking_id">
                                                        </fieldset>
                                                        </div>
                                                        <div class="comb row col-md-12">
                                                            <div class="col-md-12">
                                                            <fieldset class="form-group">
                                                                <label for="Order Type">Item</label>
                                                                <select class="form-control" name="item1" id="item">
                                                                    <option>Select Item</option>
                                                                    @foreach($all_product as $ot)
                                                                    <option value="{{$ot['product_code']}}" myTag="{{$ot['selling_price']}}">{{$ot['name']}} - {{$ot['product_code']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                    <fieldset class="form-group">
                                                                        <label>Unit Price</label>
                                                                        <input class="form-control" id="unitPrice" type="number" name="unit_price1" value="0" required>
                                                                    </fieldset>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                    <fieldset class="form-group">
                                                                        <label>Qty</label>
                                                                        <input class="form-control" type="number" name="quantity1" value="0" required>
                                                                    </fieldset>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item</label>
                                                            <select class="form-control" name="item2" id="item">
                                                                <option>Select Item</option>
                                                                @foreach($all_product as $ot)
                                                                <option value="{{$ot['product_code']}}" myTag="{{$ot['selling_price']}}">{{$ot['name']}} - {{$ot['product_code']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice1" type="number" name="unit_price2" value="0" required>
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity2" value="0" required>
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item</label>
                                                            <select class="form-control" name="item3" id="item">
                                                                <option>Select Item</option>
                                                                @foreach($all_product as $ot)
                                                                <option value="{{$ot['product_code']}}" myTag="{{$ot['selling_price']}}">{{$ot['name']}} - {{$ot['product_code']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice2" type="number" name="unit_price3" value="0" required>
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity3" value="0" required>
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Item</label>
                                                            <select class="form-control" name="item4" id="item">
                                                                <option>Select Item</option>
                                                                @foreach($all_product as $ot)
                                                                <option value="{{$ot['product_code']}}" myTag="{{$ot['selling_price']}}">{{$ot['name']}} - {{$ot['product_code']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Unit Price</label>
                                                                    <input class="form-control" id="unitPrice2" type="number" name="unit_price4" value="0" required>
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <fieldset class="form-group">
                                                                    <label>Qty</label>
                                                                    <input class="form-control" type="number" name="quantity4" value="0" required>
                                                                </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <fieldset class="form-group">
                                                            <label>Shipping Method</label>
                                                            <input class="form-control" type="text" name="shipping_method" placeholder="Enter shipping method">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-3">
                                                        <fieldset class="form-group">
                                                            <label>Shipping</label>
                                                            <input class="form-control" type="number" name="shipping" value="0">
                                                        </fieldset>
                                                        </div>
                                                        <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="Order Type">Note</label>
                                                            <input class="form-control" type="text" name="note" placeholder="Enter note">
                                                        </fieldset>
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
        $('#item').change(function() {
            var myTag = $('option:selected', this).attr('mytag');
            console.log(myTag);
            $('#unitPrice').val(myTag);
        });

        //print order
        $('#basicz').on("click", function () {
          $('.print-order').printThis({
            base: ""
          });
        });

    });

  </script>


@endsection

@push('dashboard.scripts-footer')
<script src="{{asset('assets/dashboard/app-assets/vendors/js/extensions/sweetalert2.all.js')}}" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->

    <script src="{{asset('assets/dashboard/assets/js/scripts.js')}}" type="text/javascript"></script>
@endpush

