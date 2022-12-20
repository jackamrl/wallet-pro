@extends('user.includes.master')

@section('content')

<div id="wrapper" class="go-section">
    <div class="row">
        <div class="container">
            <div class="container">
                <!-- Form Name -->
                <h2 class="text-center">Request Money</h2>

                <form role="form" method="POST" action="{{ route('account.request.submit') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <input name="email" id="reqemail" value="{{ old('email') }}" placeholder="Enter Email" class="form-control" type="email" required>
                                <p id="recieverError" class="errorMsg"></p>
                            </div>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <input name="amount" placeholder="Request Amount" value="{{ old('amount') }}" class="form-control"  type="text" required>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <textarea class="form-control" name="reference" rows="6" placeholder="Referance(Optional)">{{ old('reference') }}</textarea>
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
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-5 control-label"></label>
                        <div class="col-md-2">
                            <button type="submit" id="sbmtbtn" class="btn btn-ocean btn-block"><strong>Request</strong></button>
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
    $("#reqemail").change(function(){

        var email = $(this).val();
        $.ajax({
            type: "GET",
            url: '{{url('/')}}/checkacc/'+email,
            success: function (data) {
                if ($.trim(data) === "not"){
                    $("#recieverError").html("No Account Found with this email.");
                    $("#sbmtbtn").attr('disabled',true);
                }else {
                    $("#recieverError").html("");
                    $("#sbmtbtn").attr('disabled',false);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@stop