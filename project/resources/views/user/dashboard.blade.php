@extends('user.includes.master')

@section('content')

<div id="wrapper" class="go-section">
    <div class="row">
        <div class="container">
            <div class="container">
                <!-- Form Name -->
                <div class="row">
                    <div class="col-sm-6 col-md-6 panel-left">
                        <h2 style="margin-top: 10px;">User Dashboard</h2>
                    </div>
                    <div class="col-sm-6 col-md-6 panel-right">
                        <h4 class="username-right">{{$user->name}}<div class="uemail">{{$user->email}}</div></h4>
                    </div>
                </div>
                <hr style="margin-top: 0;">
                <div class="col-sm-3 col-md-3 panel-left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Current Balance
                            <h1 style="margin-bottom: 0;font-weight: 600;">{{number_format((float)$user->current_balance, 2, '.', '')}} </h1>
                            <h3 style="margin: 0">USD</h3>
                        </div>
                    </div>
                    @if(count($requests) > 0)
                        <a href="{{route('account.requests')}}">
                            <div class="alert alert-success">
                                <strong>
                                    Pending Requests <span class="label label-success pull-right">{{count($requests)}}</span>
                                </strong>
                            </div>
                        </a>
                    @endif

                    @if(count($withdraws) > 0)
                        <a href="{{route('account.withdraws')}}">
                            <div class="alert alert-info">
                                <strong>
                                    Pending Withdraws <span class="label label-primary pull-right">{{count($withdraws)}}</span>
                                </strong>
                            </div>
                        </a>
                    @endif
                </div>
                <div class="col-sm-9 col-md-9 panel-right">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>Recent Transactions</h4>
                            <div class="row" style="background-color: #1a242f;color: #FFF;">
                                <div class="col-xs-3 col-sm-3 col-md-2 text-center">
                                    Date
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7">
                                    <div>Action</div>
                                    {{--<div>Payment Recieved</div>--}}
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 pull-right">
                                    <div class="pull-right">Amount</div>
                                </div>
                            </div>
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @forelse($transactions as $transaction)
                                <div class="panel panel-defaults">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-titles">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$transaction->transid}}" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="more-less glyphicon glyphicon-plus"></i>
                                                <div class="row">
                                                    <div class="col-xs-2 col-sm-2 col-md-1 text-center">
                                                        <strong>{{strtoupper(date('F d',strtotime($transaction->trans_date)))}}</strong>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-7">
                                                        <div>{{$transaction->reason}}</div>
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3 pull-right">
                                                        <strong class="pull-right {{$transaction->type}}">{{$transaction->sign}}${{$transaction->amount}}</strong><br>
                                                        @if($transaction->fee != 0)
                                                            <span class="pull-right fee">Fee ${{$transaction->fee}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{$transaction->transid}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6 info">
                                                    @if($transaction->type == "credit")
                                                        <div><strong>From:</strong> {{$transaction->accfrom->email}}</div>
                                                        <div><strong>Name:</strong> {{$transaction->accfrom->name}}</div>
                                                        <div><strong>Date:</strong> {{date('d F Y h:i:sa',strtotime($transaction->trans_date))}}</div>
                                                    @elseif($transaction->type == "debit")
                                                        <div><strong>To:</strong> {{$transaction->accto->email}}</div>
                                                        <div><strong>Name:</strong> {{$transaction->accto->name}}</div>
                                                        <div><strong>Date:</strong> {{date('d F Y h:i:sa',strtotime($transaction->trans_date))}}</div>
                                                    @elseif($transaction->type == "withdraw")
                                                        <div><strong>Withdraw Method:</strong> {{$transaction->withdrawid->method}}</div>
                                                        <div><strong>{{$transaction->withdrawid->method}} Account:</strong> {{($transaction->withdrawid->method == "Bank"? $transaction->withdrawid->iban : $transaction->withdrawid->email)}}</div>
                                                        <div><strong>Date:</strong> {{date('d F Y h:i:sa',strtotime($transaction->trans_date))}}</div>
                                                    @elseif($transaction->type == "deposit")
                                                        <div><strong>Deposit Method:</strong> {{$transaction->deposit_method}}</div>
                                                        <div><strong>{{$transaction->deposit_method}} Transaction:</strong> {{$transaction->deposit_transid}}</div>
                                                        @if($transaction->deposit_method == "Stripe")
                                                            <div><strong>{{$transaction->deposit_method}} Charge ID:</strong> {{$transaction->deposit_chargeid}}</div>
                                                        @endif
                                                        <div><strong>Date:</strong> {{date('d F Y h:i:sa',strtotime($transaction->trans_date))}}</div>
                                                    @endif
                                                    <hr>
                                                    <div><strong>Transaction#:</strong> {{$transaction->transid}}</div>
                                                </div>
                                                <div class="col-md-6 info">
                                                    <div><strong>{{$transaction->reason}} Amount:</strong> <span>${{$transaction->amount}}</span></div>
                                                    <div><strong>Charge:</strong> <span>${{$transaction->fee}}</span></div>
                                                    <hr>
                                                    <div><strong>Total:</strong> <span>${{$transaction->amount + $transaction->fee}}</span></div>
                                                    <div><strong>Reference:</strong> {{$transaction->reference}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            </div><!-- panel-group -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
<script>
    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
@stop