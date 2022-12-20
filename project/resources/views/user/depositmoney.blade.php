@extends('user.includes.master')

@section('content')

<div id="wrapper" class="go-section">
    <div class="row">
        <div class="container">
            <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <!-- Form Name -->
                <h2 class="text-center">Deposit Money</h2>

                <form role="form" method="POST" id="payment_form" action="{{route('payment.submit')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select class="form-control" onChange="meThods(this)" id="formac" name="method" required>
                            <option value="Paypal" selected>Paypal</option>
                            <option value="Stripe">Credit Card</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="total" placeholder="Deposit Amount" required>
                    </div>

                    <div id="stripes" style="display: none;">
                        <div class="form-group">
                            <input type="text" class="form-control" name="card" placeholder="Card Number">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="cvv" placeholder="CVV">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="month" placeholder="Month">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="year" placeholder="Year">
                        </div>
                    </div>

                    <input type="hidden" name="acc" value="{{$user->id}}" />

                    <div id="paypals">
                        <input type="hidden" name="cmd" value="_xclick" />
                        <input type="hidden" name="no_note" value="1" />
                        <input type="hidden" name="lc" value="UK" />
                        <input type="hidden" name="currency_code" value="USD" />
                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                    </div>

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
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-ocean btn-block"><strong>Deposit</strong></button>
                        </div>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
    <script type="text/javascript">
        function meThods(val) {
            var action1 = "{{route('payment.submit')}}";
            var action2 = "{{route('stripe.submit')}}";
            if (val.value == "Paypal") {
                $("#payment_form").attr("action", action1);
                $("#stripes").hide();
            }
            if (val.value == "Stripe") {
                $("#payment_form").attr("action", action2);
                $("#stripes").show();
            }
        }
    </script>
@stop