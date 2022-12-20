@extends('admin.includes.master-admin')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Admin Dashboard! </h3>

        <div class="row" id="main" >
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ \App\UserAccount::count() }}</div>
                                <p class="titles">Total Customers!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('admin/customers')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-warning fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ \App\Withdraw::where('status','pending')->count() }}</div>
                                <p class="titles">Pending Withdraws!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('admin/withdraws')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-usd fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ count(\App\Transaction::where('status',1)->groupBy('transid')->get()) }}</div>
                                <p class="titles">Transaction Made!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('admin/transactions')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-usd fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ count(\App\Transaction::where('status',1)->where('type','deposit')->groupBy('transid')->get()) }}</div>
                                <p class="titles">Deposit Made!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('admin/transactions')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bank fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ count(\App\Transaction::where('status',1)->where('type','withdraw')->groupBy('transid')->get()) }}</div>
                                <p class="titles">Withdraw Made!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('admin/transactions')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-group fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="text-total">{{ \App\Subscribers::count() }}</div>
                                <p class="titles">Total Subscribers!</p>
                            </div>
                        </div>
                    </div>
                    <a class="panel-footer detail-link clearfix btn-block" href="{{url('admin/subscribers')}}"><span class="pull-left">View All</span><span class="pull-right"><i class="fa fa-chevron-circle-right"></i>
                    </span>
                    </a><!-- END panel-->
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