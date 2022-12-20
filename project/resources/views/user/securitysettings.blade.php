@extends('user.includes.master')

@section('content')

<div id="wrapper" class="go-section">
    <div class="row">
        <div class="container">
            <div class="container">
                <!-- Form Name -->
                {{--<h2 class="text-center">Account Settings</h2>--}}
                <ul class="nav nav-tabs">
                    <li><a href="{{route('account.settings')}}">Account Settings</a></li>
                    <li class="active"><a href="{{route('account.security')}}">Security Settings</a></li>
                </ul>

                        <h3 class="text-center">Change Password</h3>
                        <form method="POST" action="{{ action('UserAccountController@passchange',['id' => $user->id]) }}">
                            {{ csrf_field() }}

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Current Password: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="cpass" placeholder="Current Password" class="form-control" type="password" required>

                                    </div>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">New Password: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="newpass" placeholder="New Password" class="form-control"  type="password" required>

                                    </div>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Confirm Password: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="renewpass" placeholder="Confirm New Password" class="form-control"  type="password" required>

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
                            <div id="resp" class="col-md-6 col-md-offset-3">
                                @if ($errors->has('error'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif
                            </div>
                            <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-5 control-label"></label>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-ocean btn-block"><strong>Update Password</strong></button>
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
    </script>
@stop