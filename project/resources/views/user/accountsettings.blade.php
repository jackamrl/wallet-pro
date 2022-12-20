@extends('user.includes.master')

@section('content')

<div id="wrapper" class="go-section">
    <div class="row">
        <div class="container">
            <div class="container">
                <!-- Form Name -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="{{route('account.settings')}}">Account Settings</a></li>
                    <li><a href="{{route('account.security')}}">Security Settings</a></li>
                </ul>

                        <h3 class="text-center">Update Account</h3>
                        <form role="form" method="POST" action="{{ route('account.update',['id' => $user->id]) }}">
                            {{ csrf_field() }}

                            <div class="row">
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
                            </div>
                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Account Email: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="email" value="{{ $user->email }}" placeholder="Enter Email" class="form-control" type="email" disabled>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Full Name: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="name" value="{{ $user->name }}" placeholder="Full Name" class="form-control" type="text">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Gender: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="gender">
                                            <option value="">Select Gender</option>
                                            @if($user->gender == "Male")
                                                <option value="Male" selected>Male</option>
                                            @else
                                                <option value="Male">Male</option>
                                            @endif
                                            @if($user->gender == "Female")
                                                <option value="Female" selected>Female</option>
                                            @else
                                                <option value="Female">Female</option>
                                            @endif
                                            @if($user->gender == "Other")
                                                <option value="Other" selected>Other</option>
                                            @else
                                                <option value="Other">Other</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Phone: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="phone" value="{{ $user->phone }}" placeholder="Phone Number" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Fax: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="fax" value="{{ $user->fax }}" placeholder="Fax Number" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Country: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="country">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                @if($user->country == $country->name)
                                                    <option value="{{$country->name}}" selected>{{$country->nicename}}</option>
                                                @else
                                                    <option value="{{$country->name}}">{{$country->nicename}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Address: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="address" value="{{ $user->address }}" placeholder="Address" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">City: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="city" value="{{ $user->city }}" placeholder="City" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3"><span class="pull-right">Postal Code: </span></label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="zip" value="{{ $user->zip }}" placeholder="Postal Code" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-5 control-label"></label>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-ocean btn-block"><strong>Update Settings</strong></button>
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