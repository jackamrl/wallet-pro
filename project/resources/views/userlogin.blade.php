@extends('includes.master')

@section('content')

<div id="wrapper" class="go-section">
    <div class="row">
        <div class="container">
            <div class="container">
                <!-- Form Name -->
                <h2 class="text-center">Login</h2>
                <hr>

                <form role="form" method="POST" action="{{ route('user.login.submit') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <input name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" type="email" required>
                                <p id="emailError" class="errorMsg"></p>
                            </div>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <input name="password" placeholder="Password" class="form-control"  type="password" required>
                                <p id="passError" class="errorMsg"></p>
                            </div>
                        </div>
                    </div>

                    <div id="resp" class="col-md-6 col-md-offset-3">
                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('email'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-5 control-label"></label>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-ocean btn-block" id="LoginButton"><strong>Login</strong></button>
                        </div>
                        <div class="col-md-2" style="margin-top: 10px;">
                            <a href="{{route('user.forgotpass')}}" class="pull-right">Forgot Password?</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')

@stop