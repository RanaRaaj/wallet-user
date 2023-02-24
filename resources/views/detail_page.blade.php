<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <style>
    .list-group {
      margin-top: 4%;
    }
    .list-group-item {
      animation: fadein 0.5s;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      /*box-shadow: 2px 2px 10px #ccc;*/
      margin-bottom: 10px;
      padding: 10px;
    }
    a.list-group-item.list-group-item-action {
        background-color: hsl(273deg 77% 55%);
        border-radius: 16px !important;
        color: #ffff;
    }

    @keyframes fadein {
      from { opacity: 0; }
      to   { opacity: 1; }
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    a.back_arrow {
        margin: 9% 0%;
        font-size: 22px;
        color: #fff;
    }
</style>

  <title>Sended Amount</title>
</head>
  <body>
    <div class="container">

      <x-side-bar />

      @if($type == 'send')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Sended Amount</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{ $sendAmountDetail->receiver_name }}</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content }}</p>
                <small>Amount: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} {{$sendAmountDetail->type}}</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Send Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Send To:</strong> {{ $sendAmountDetail->receiver_name }}</p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p style="text-transform: uppercase;"><strong>Amount:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}} {{$sendAmountDetail->type}}</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p><strong>From Bank Name:</strong> {{ $sendAmountDetail->sender_bank_name }}</p>
                        <p><strong>From Bank Number:</strong> {{ $sendAmountDetail->sender_bank_number }}</p>
                        <p><strong>To Bank Name:</strong> {{ $sendAmountDetail->receiver_bank_name }}</p>
                        <p><strong>To Bank Number:</strong> {{ $sendAmountDetail->receiver_bank_number }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

      @if($type == 'rcv')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Received Amount</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{ $sendAmountDetail->sender_name }}</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content }}</p>
                <small>Amount: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Sender Name:</strong> {{ $sendAmountDetail->sender_name }}</p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}}</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

      @if($type == 'exchange')
        <div class="container my-5 news">
          <h2 class="text-center">Exchange Amount</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>
          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              @php
                $amount = json_decode($sendAmountDetail->exchange);
              @endphp
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <!-- <p class="mb-1">{{ $sendAmountDetail->content }}</p> -->
                <small> {{number_format($amount[0]->first, 2, '.', ',')}} @if($sendAmountDetail->type == 'vnd') VND @else USDT @endif To {{number_format($amount[0]->second, 2, '.', ',')}} @if($sendAmountDetail->type == 'vnd') USDT @else VND @endif</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Exchange Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Exchange Rate:</strong> {{number_format($sendAmountDetail->exchange_rate, 2, '.', ',')}}</p>
                        <!-- <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p> -->
                        <p><strong>Amount:</strong> {{number_format($amount[0]->first, 2, '.', ',')}} @if($sendAmountDetail->type == 'vnd') VND @else USDT @endif To {{number_format($amount[0]->second, 2, '.', ',')}} @if($sendAmountDetail->type == 'vnd') USDT @else VND @endif</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

      @if($type == 'admin_rcv')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Received From Admin</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">Admin</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content ?? '' }}</p>
                <small>Amount: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Sender :</strong> Admin</p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}}</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

      @if($type == 'profit')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Daily Interest Profit</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{ $sendAmountDetail->bank_name }}</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <!-- <p class="mb-1">{{ $sendAmountDetail->content ?? '' }}</p> -->
                <small>Amount: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Bank Name :</strong> {{ $sendAmountDetail->bank_name }}</p>
                        <p><strong>Bank Account Name:</strong> {{ $sendAmountDetail->account_name }}</p>
                        <p><strong>Bank Account Number:</strong> {{ $sendAmountDetail->account_number }}</p>
                        <p><strong>Added Amount:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}}</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

      @if($type == 'deposit')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Deposit Requests</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  @if($sendAmountDetail->status == '1')
                    <h5 class="mb-1" style="color: #03ff03">Approved  </h5>
                  @elseif($sendAmountDetail->status == '0')
                    <h5 class="mb-1" style="color: red">Cancel</h5>
                  @else
                    <h5 class="mb-1" style="color: blue">Pending</h5>
                  @endif
                  
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content ?? '' }}</p>
                <small>Amount: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Deposit Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Status :</strong>
                          @if($sendAmountDetail->status == '1')
                          Approved
                          @elseif($sendAmountDetail->status == '0')
                          Cancel
                          @else
                          Pending
                          @endif
                        </p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}}</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p><strong>Bank Name:</strong> {{ $sendAmountDetail->bank_name }}</p>
                        <p><strong>Account Name:</strong> {{ $sendAmountDetail->account_name }}</p>
                        <p><strong>Account Number:</strong> {{ $sendAmountDetail->account_number }}</p>
                        <p><strong>Approved Time:</strong> {{ $sendAmountDetail->approval_time }}</p>
                        <p><strong>Reason:</strong> {{ $sendAmountDetail->reason }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

      @if($type == 'status')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Deposit Requests</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  @if($sendAmountDetail->status == '1')
                    <h5 class="mb-1" style="color: #94dd94">Approved  </h5>
                  @elseif($sendAmountDetail->status == '0')
                    <h5 class="mb-1" style="color: red">Cancel</h5>
                  @else
                    <h5 class="mb-1" style="color: blue">Pending</h5>
                  @endif
                  
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content ?? '' }}</p>
                <small>Amount: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Deposit Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Status :</strong>
                          @if($sendAmountDetail->status == '1')
                          Approved
                          @elseif($sendAmountDetail->status == '0')
                          Cancel
                          @else
                          Pending
                          @endif
                        </p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}}</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p><strong>Bank Name:</strong> {{ $sendAmountDetail->bank_name }}</p>
                        <p><strong>Account Name:</strong> {{ $sendAmountDetail->account_name }}</p>
                        <p><strong>Account Number:</strong> {{ $sendAmountDetail->account_number }}</p>
                        <p><strong>Approved Time:</strong> {{ $sendAmountDetail->approval_time }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

      @if($type == 'withdraw')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Withdraw Requests</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  @if($sendAmountDetail->status == '1')
                    <h5 class="mb-1" style="color: #94dd94">Approved  </h5>
                  @elseif($sendAmountDetail->status == '0')
                    <h5 class="mb-1" style="color: red">Cancel</h5>
                  @else
                    <h5 class="mb-1" style="color: blue">Pending</h5>
                  @endif
                  
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content ?? '' }}</p>
                <small>Amount: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Withdraw Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Status :</strong>
                          @if($sendAmountDetail->status == '1')
                          Approved
                          @elseif($sendAmountDetail->status == '0')
                          Cancel
                          @else
                          Pending
                          @endif
                        </p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}}</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                        <p><strong>Bank Name:</strong> {{ $sendAmountDetail->bank_name }}</p>
                        <p><strong>Account Name:</strong> {{ $sendAmountDetail->account_name }}</p>
                        <p><strong>Account Number:</strong> {{ $sendAmountDetail->account_number }}</p>
                        <p><strong>Approved Time:</strong> {{ $sendAmountDetail->approval_time }}</p>
                        <p><strong>Reason:</strong> {{ $sendAmountDetail->reason }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

      @if($type == 'payment')
        <div class="container my-5 news">
          <h2 class="text-center mb-5">Sended Amount</h2>
          <a href="{{ url()->previous() }}" class="back_arrow"><i class="fa fa-arrow-left"></i></a>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{ $sendAmountDetail->receiver_name }}</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content }}</p>
                <small>Amount: {{number_format($sendAmountDetail->amount, 2, '.', ',')}} VND</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content news">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Send Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Send To:</strong> {{ $sendAmountDetail->receiver_name }}</p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{number_format($sendAmountDetail->amount, 2, '.', ',')}}</p>
                        <p><strong>Time:</strong> {{ $sendAmountDetail->created_at->diffForHumans() }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <p>No Record Found...</p>
            @endif
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
        </div>
      @endif

    </div>
    <!-- Optional JavaScript -->
  </body>
</html>
