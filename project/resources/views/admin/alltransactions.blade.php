@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    {{--<div class="pull-right">--}}
                        {{--<a href="{!! url('admin/services/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Service</a>--}}
                    {{--</div>--}}
                    <h3>All Transactions</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th width="15%">Transaction ID#</th>
                                <th>Reason</th>
                                <th width="10%">Amount</th>
                                <th>Account</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{date('d F Y h:i:sa',strtotime($transaction->trans_date))}}</td>
                                        <td>{{$transaction->transid}}</td>
                                        <td>{{$transaction->reason}}</td>
                                        <td>${!! $transaction->amount !!}</td>
                                        <td>{{$transaction->mainacc->email}}</td>

                                        <td>
                                            <a href="transactions/{{$transaction->id}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View Details </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->


@stop

@section('footer')

@stop