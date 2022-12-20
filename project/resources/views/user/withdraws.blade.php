@extends('user.includes.master')

@section('content')

<div id="wrapper" class="go-section">
    <div class="row">
        <div class="container">
            <div class="container">
                <!-- Form Name -->

                <div class="col-sm-3 col-md-3 panel-left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Current Balance
                            <h1 style="margin-bottom: 0;font-weight: 600;">{{number_format((float)$user->current_balance, 2, '.', '')}} </h1>
                            <h3 style="margin: 0">USD</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-md-9 panel-right">
                    <div class="panel panel-default">

                        <div class="panel-body table-responsive">
                            <h4>Pending Withdraws</h4>
                            <div id="resp">
                                @if(Session::has('message'))
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                @if(Session::has('error'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr style="background-color: #1a242f; color: #FFF">
                                    <th>Withdraw Method</th>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th>Withdraw Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($withdraws as $withdraw)
                                <tr>
                                    <td>{{$withdraw->method}}</td>
                                    @if($withdraw->method == "Bank")
                                        <td>{{$withdraw->iban}}</td>
                                    @else
                                        <td>{{$withdraw->acc_email}}</td>
                                    @endif
                                    <td>${{$withdraw->amount}}</td>
                                    <td>{{date('Y-m-d',strtotime($withdraw->created_at))}}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No Request Pending.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade-scale" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg modal-request">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Accept Payment Request</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="reqdetails">

                </div>
                <div class="row">
                    <form role="form" id="accept-form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <textarea class="form-control" name="reference" rows="4" placeholder="Referance(Optional)">{{ old('reference') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-block"><strong>Accept</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
<script>
    function accept(id){
        $.get('{{url('/')}}/account/requestsdetails/'+id, function(response){
            $("#accept-form").attr('action','{{url('/')}}/account/acceptrequest/'+id);
            $("#reqdetails").html(response);
        });
    }
</script>
@stop