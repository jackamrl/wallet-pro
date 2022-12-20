@extends('user.includes.master')

@section('content')

<div id="wrapper" class="go-section">
    <div class="row">
        <div class="container">
            <div class="container">
                <!-- Form Name -->
                <h2 class="text-center">Withdraw Money</h2>

                <form role="form" method="POST" action="{{ route('account.withdraw.submit') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <select class="form-control" name="methods" id="withmethod" required>
                                    <option value="">Select Withdraw Method</option>
                                    <option value="Paypal">Paypal</option>
                                    <option value="Skrill">Skrill</option>
                                    <option value="Payoneer">Payoneer</option>
                                    <option value="Bank">Bank</option>
                                </select>
                                <p id="methodError" class="errorMsg"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <input name="amount" placeholder="Withdraw Amount" value="{{ old('amount') }}" class="form-control"  type="text" required>
                            </div>
                        </div>
                    </div>

                    <div id="paypal" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <input name="acc_email" value="{{ old('email') }}" placeholder="Enter Account Email" class="form-control" type="email">
                                    <p id="recieverError" class="errorMsg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bank" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <select class="form-control" name="acc_country">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->name}}">{{$country->nicename}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <input name="iban" value="{{ old('iban') }}" placeholder="Enter IBAN/Account No" class="form-control" type="text">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <input name="acc_name" value="{{ old('accname') }}" placeholder="Enter Account Name" class="form-control" type="text">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <input name="address" value="{{ old('address') }}" placeholder="Enter Address" class="form-control" type="text">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <input name="swift" value="{{ old('swift') }}" placeholder="Enter Swift Code" class="form-control" type="text">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <textarea class="form-control" name="reference" rows="6" placeholder="Additional Referance(Optional)">{{ old('reference') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div id="resp" class="col-md-6 col-md-offset-3">
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
                        @if($settings[0]->withdraw_fee > 0)
                            <span class="help-block">
                                <strong>Withdraw Fee ${{ $settings[0]->withdraw_fee }} will deduct from your account.</strong>
                            </span>
                        @endif
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-5 control-label"></label>
                        <div class="col-md-2">
                            <button type="submit" id="sbmtbtn" class="btn btn-ocean btn-block"><strong>Withdraw</strong></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
    <script>
        {{--$("#reqemail").change(function(){--}}

            {{--var email = $(this).val();--}}
            {{--$.ajax({--}}
                {{--type: "GET",--}}
                {{--url: '{{url('/')}}/checkacc/'+email,--}}
                {{--success: function (data) {--}}
                    {{--if ($.trim(data) === "not"){--}}
                        {{--$("#recieverError").html("No Account Found with this email.");--}}
                        {{--$("#sbmtbtn").attr('disabled',true);--}}
                    {{--}else {--}}
                        {{--$("#recieverError").html("");--}}
                        {{--$("#sbmtbtn").attr('disabled',false);--}}
                    {{--}--}}
                {{--},--}}
                {{--error: function (data) {--}}
                    {{--console.log('Error:', data);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

        $("#withmethod").change(function(){
            var method = $(this).val();
            if(method == "Bank"){

                $("#bank").show();
                $("#bank").find('input, select').attr('required',true);

                $("#paypal").hide();
                $("#paypal").find('input').attr('required',false);

            }
            if(method != "Bank"){
                $("#bank").hide();
                $("#bank").find('input, select').attr('required',false);

                $("#paypal").show();
                $("#paypal").find('input').attr('required',true);
            }
            if(method == ""){
                $("#bank").hide();
                $("#paypal").hide();
            }

        })


    </script>
@stop