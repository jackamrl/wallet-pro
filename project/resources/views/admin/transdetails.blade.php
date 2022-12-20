@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/transactions') !!}" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Transaction Details</h3>
                    
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Transaction ID#</strong></td>
                                    <td>{{$transaction->transid}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Action:</strong></td>
                                    <td>{{$transaction->reason}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Transaction Amount:</strong></td>
                                    <td>{{$transaction->amount}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Fee:</strong></td>
                                    <td>{{$transaction->fee}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Total Amount:</strong></td>
                                    <td>{{$transaction->amount + $transaction->fee}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Account:</strong></td>
                                    <td>{{$transaction->mainacc->email}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Account Holder Name:</strong></td>
                                    <td>{{$transaction->mainacc->name}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Account Holder Phone:</strong></td>
                                    <td>{{$transaction->mainacc->phone}}</td>
                                </tr>

                                @if($transaction->type == "credit")
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>{{$transaction->reason}} From:</strong></td>
                                    <td>{{$transaction->accfrom->email}}</td>
                                </tr>
                                @elseif($transaction->type == "debit")
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>{{$transaction->reason}} To:</strong></td>
                                        <td>{{$transaction->accto->email}}</td>
                                    </tr>
                                @elseif($transaction->type == "deposit")

                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Deposit Method:</strong></td>
                                        <td>{{$transaction->deposit_method}}</td>
                                    </tr>
                                        @if($transaction->deposit_method=="Stripe")
                                            <tr>
                                                <td width="30%" style="text-align: right;"><strong>{{$transaction->deposit_method}} Charge ID:</strong></td>
                                                <td>{{$transaction->deposit_chargeid}}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong>{{$transaction->deposit_method}} Transection ID:</strong></td>
                                            <td>{{$transaction->deposit_transid}}</td>
                                        </tr>
                                @elseif($transaction->type == "withdraw")
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>{{$transaction->reason}} Method:</strong></td>
                                        <td>{{$transaction->withdrawid->method}}</td>
                                    </tr>
                                    @if($transaction->withdrawid->method != "Bank")
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong>{{$transaction->withdrawid->method}} Email:</strong></td>
                                            <td>{{$transaction->withdrawid->acc_email}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong>{{$transaction->withdrawid->method}} Account:</strong></td>
                                            <td>{{$transaction->withdrawid->iban}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong>Account Name:</strong></td>
                                            <td>{{$transaction->withdrawid->acc_name}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong>Country:</strong></td>
                                            <td>{{ucfirst(strtolower($transaction->withdrawid->country))}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong>Address:</strong></td>
                                            <td>{{$transaction->withdrawid->address}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong>{{$transaction->withdrawid->method}} Swift Code:</strong></td>
                                            <td>{{$transaction->withdrawid->swift}}</td>
                                        </tr>
                                    @endif

                                @endif
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Transaction Date:</strong></td>
                                    <td>{{$transaction->trans_date}}</td>
                                </tr>

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