<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style>
    .list-group-item {
      animation: fadein 0.5s;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      /*box-shadow: 2px 2px 10px #ccc;*/
      margin-bottom: 10px;
      padding: 10px;
    }

    @keyframes fadein {
      from { opacity: 0; }
      to   { opacity: 1; }
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
</style>

  <title>Sended Amount</title>
</head>
  <body>
    <div class="container">

      <x-side-bar />

      @if($type == 'send')
        <div class="container my-5">
          <h2 class="text-center mb-5">Sended Amount</h2>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{ $sendAmountDetail->receiver_name }}</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content }}</p>
                <small>Amount: {{ $sendAmountDetail->amount }}</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="sendAmountDetailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="sendAmountDetailModalLabel">Send Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Send To:</strong> {{ $sendAmountDetail->receiver_name }}</p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{ $sendAmountDetail->amount }}</p>
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
        <div class="container my-5">
          <h2 class="text-center mb-5">Received Amount</h2>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{ $sendAmountDetail->sender_name }}</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content }}</p>
                <small>Amount: {{ $sendAmountDetail->amount }}</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="sendAmountDetailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="sendAmountDetailModalLabel">Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Sender Name:</strong> {{ $sendAmountDetail->sender_name }}</p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{ $sendAmountDetail->amount }}</p>
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
        <div class="container my-5">
          <h2 class="text-center mb-5">Received From Admin</h2>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">Admin</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content ?? '' }}</p>
                <small>Amount: {{ $sendAmountDetail->amount }}</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="sendAmountDetailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="sendAmountDetailModalLabel">Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Sender :</strong> Admin</p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{ $sendAmountDetail->amount }}</p>
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
        <div class="container my-5">
          <h2 class="text-center mb-5">Deposit Requests</h2>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  @if($sendAmountDetail->status == '1')
                    <h5 class="mb-1" style="color: green">Approved  </h5>
                  @elseif($sendAmountDetail->status == '0')
                    <h5 class="mb-1" style="color: red">Cancel</h5>
                  @else
                    <h5 class="mb-1" style="color: blue">Pending</h5>
                  @endif
                  
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content ?? '' }}</p>
                <small>Amount: {{ $sendAmountDetail->amount }}</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="sendAmountDetailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="sendAmountDetailModalLabel">Deposit Detail</h5>
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
                        <p><strong>Amount:</strong> {{ $sendAmountDetail->amount }}</p>
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

      @if($type == 'status')
        <div class="container my-5">
          <h2 class="text-center mb-5">Deposit Requests</h2>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  @if($sendAmountDetail->status == '1')
                    <h5 class="mb-1" style="color: green">Approved  </h5>
                  @elseif($sendAmountDetail->status == '0')
                    <h5 class="mb-1" style="color: red">Cancel</h5>
                  @else
                    <h5 class="mb-1" style="color: blue">Pending</h5>
                  @endif
                  
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content ?? '' }}</p>
                <small>Amount: {{ $sendAmountDetail->amount }}</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="sendAmountDetailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="sendAmountDetailModalLabel">Deposit Detail</h5>
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
                        <p><strong>Amount:</strong> {{ $sendAmountDetail->amount }}</p>
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

      @if($type == 'payment')
        <div class="container my-5">
          <h2 class="text-center mb-5">Sended Amount</h2>

          <div class="list-group">
            @if(isset($sendAmountDetails[0]))
              @foreach($sendAmountDetails as $sendAmountDetail)
              <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modal{{ $loop->index }}">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{ $sendAmountDetail->receiver_name }}</h5>
                  <small>{{ $sendAmountDetail->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $sendAmountDetail->content }}</p>
                <small>Amount: {{ $sendAmountDetail->amount }}</small>
              </a>
              <!-- Modal -->
                <div class="modal fade" id="modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="sendAmountDetailModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="sendAmountDetailModalLabel">Send Amount Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Send To:</strong> {{ $sendAmountDetail->receiver_name }}</p>
                        <p><strong>Content:</strong> {{ $sendAmountDetail->content }}</p>
                        <p><strong>Amount:</strong> {{ $sendAmountDetail->amount }}</p>
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpG<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
