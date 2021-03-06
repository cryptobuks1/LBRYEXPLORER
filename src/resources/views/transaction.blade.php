@extends('minimalUI.blank')

@section('icon', 'pe-7s-diamond')
@section('title', 'LBRY Transaction '.$transaction->small_hash)

@section('content')

<div class="row">
  <div class="col-lg-5 mb-4 mb-lg-0">
    <div class="main-card mb-3 card">
      <div class="card-header">Overview</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Hash
              </div>
                {{ $transaction->hash }}
            </div>
          </div>
          @if ($transaction->block_hash_id != 'MEMPOOL')
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Block Height
              </div>
                <a class="" href="{{ route('blocks', $transaction->block_height) }}">{{ $transaction->block_height }}</a>
                ({{ $transaction->confirmations }} confirmations)
            </div>
          </div>
          @endif
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Time Created
                <span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Represents the time this transaction was created on the explorer"></span>
              </div>
                {{ $transaction->created_at }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Block Time
                <span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="The time the first confirmation of this transaction happened on the blockchain"></span>
              </div>
                @if ($transaction->block_hash_id != 'MEMPOOL')
                  {{ $transaction->created_time }}
                @else
                  Transaction not yet mined (MEMPOOL)
                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Amount
              </div>
                {{ $transaction->value }} LBC
            </div>
          </div>
          @if (($transaction->block_hash_id != 'MEMPOOL') && (!$inputs[0]->is_coinbase))
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Fee
              </div>
                {{ $transaction->fee }} LBC
            </div>
          </div>
          @endif
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Size
              </div>
                {{ $transaction->transaction_size }} kB
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Inputs
              </div>
                {{ $transaction->input_count }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Outputs
              </div>
                {{ $transaction->output_count }}
            </div>
          </div>




        </div>
    </div>
  </div>
  <!--<div class="col-lg-4 mb-4 mb-lg-0">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                  <div class="widget-content p-0">
                      <div class="widget-content-outer">
                          <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                  <div class="text-primary">Time Created</div>
                              </div>
                              <div class="widget-content-right">
                                  <div class="">{{ $transaction->created_at }}</div>
                              </div>
                          </div>
                      </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="widget-content p-0">
                      <div class="widget-content-outer">
                          <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                  <div class="text-primary">Block Time</div>
                              </div>
                              <div class="widget-content-right">
                                  <div class="">
                                    @if ($transaction->block_hash_id != 'MEMPOOL')
                                      {{ $transaction->created_time }}
                                    @else
                                      MEMPOOL
                                    @endif
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </li>
                @if ($transaction->block_hash_id != 'MEMPOOL')
                  <li class="list-group-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                  <div class="text-primary">Block Height</div>
                                </div>
                                <div class="widget-content-right font-weight-bold">
                                    <a class="" href="{{ route('blocks', $transaction->block_height) }}">{{ $transaction->block_height }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                  <div class="text-primary">Confirmations</div>
                                </div>
                                <div class="widget-content-right font-weight-bold">
                                    <div class="">{{ $transaction->confirmations }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </li>
                @endif
                <li class="list-group-item">
                  <div class="widget-content p-0">
                      <div class="widget-content-outer">
                          <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                  <div class="text-primary">Amount</div>
                              </div>
                              <div class="widget-content-right">
                                  <div class="widget-numbers text-success">{{ $transaction->value }} LBC</div>
                              </div>
                          </div>
                      </div>
                  </div>
                </li>
                @if (($transaction->block_hash_id != 'MEMPOOL') && (!$inputs[0]->is_coinbase))
                  <li class="list-group-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="text-primary">Fee</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger">{{ $transaction->fee }} LBC</div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </li>
                @endif
                <li class="list-group-item">
                  <div class="widget-content p-0">
                      <div class="widget-content-outer">
                          <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                  <div class="text-primary">Size</div>
                              </div>
                              <div class="widget-content-right">
                                  <div class="">{{ $transaction->transaction_size }} kB</div>
                              </div>
                          </div>
                      </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="widget-content p-0">
                      <div class="widget-content-outer">
                          <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                  <div class="text-primary">Inputs</div>
                              </div>
                              <div class="widget-content-right">
                                  <div class="">{{ $transaction->input_count }}</div>
                              </div>
                          </div>
                      </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="widget-content p-0">
                      <div class="widget-content-outer">
                          <div class="widget-content-wrapper">
                              <div class="widget-content-left">
                                  <div class="text-primary">Outputs</div>
                              </div>
                              <div class="widget-content-right">
                                  <div class="">{{ $transaction->output_count }}</div>
                              </div>
                          </div>
                      </div>
                  </div>
                </li>
            </ul>
        </div>
    </div>
  </div>-->

  <div class="col-lg-7 mb-4 mb-lg-0">
    <div class="main-card mb-3 card">
      <div class="card-header">Details</div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5 mb-4 mb-sm-0">
            <h5 class="card-title">{{ $transaction->input_count }} inputs</h5>

            @foreach ($inputs as $input)
              <div class="card-shadow-primary border mb-3 card card-body border-primary">
                @if ($input->is_coinbase)
                  <h5 class="card-title">Block Reward</h5>
                  New Coins
                @else
                  <h5 class="card-title">{{ $input->value }} LBC</h5>
                  <p>
                    from <a href="{{ route('address', $input->address) }}">{{ $input->address }}</a> <a href="{{ route('transactions', $input->prevout_hash) }}">(output)</a>
                  </p>
                @endif
              </div>
            @endforeach

          </div>

          <div class="">
            <i class="fa fa-8x fa-angle-right icon-gradient bg-malibu-beach"> </i>
          </div>

          <div class="col-sm-5 mb-4 mb-sm-0">
            <h5 class="card-title">{{ $transaction->output_count }} outputs</h5>

            @foreach ($outputs as $output)
              <div class="card-shadow-info border mb-3 card card-body border-info">
                <h5 class="card-title">
                  {{ $output->value }} LBC
                  <div
                  @switch ($output->opcode_friendly[0])
                    @case('N')
                      class="mb-2 mr-2 badge badge-success">
                      @break

                    @case('U')
                      class="mb-2 mr-2 badge badge-info">
                      @break

                    @case('S')
                      class="mb-2 mr-2 badge badge-alternate">
                      @break

                    @default
                      @break

                  @endswitch
                  {{ $output->opcode_friendly }}</div>
                </h5>
                <p>
                  to
                  @foreach ($output->address_list as $recipient_address)
                    <a href="{{ route('address', $recipient_address) }}">{{ $recipient_address }}</a>
                    @if ($output->is_spent)
                      <a href="{{ route('transactions', $output->spent_hash) }}">(spent)</a>
                    @else
                      (unspent)
                    @endif
                  @endforeach
                </p>
              </div>
            @endforeach
          </div>
        </div>



      </div>
    </div>
  </div>

</div>

@endsection
