@extends('includes.master')

<style>
    #success_message{ display: none;}
</style>

@section('content')

    <div id="wrapper" class="go-section">
        <div class="row">
            <div class="container">
                <div class="container">
                    <!-- Form Name -->
                    <h2 class="text-center">Registration</h2>
                    <hr>
                        <form class="form-horizontal" action="{{route('user.reg.submit')}}" method="post"  id="registration_form">
                        {{csrf_field()}}
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input  name="name" placeholder="First Name" class="form-control"  type="text">
                                        </div>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">E-Mail</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                            <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                                        </div>
                                    </div>
                                </div>


                                <!-- Text input-->

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Phone</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                            <input name="phone" placeholder="Your Phone Number" class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>

                                <!-- Select Basic -->

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-6 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                            <select name="country" class="form-control selectpicker" >
                                                <option value=" " >Please select your Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->name}}">{{$country->nicename}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Text input-->

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Password</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input name="password" placeholder="Enter Password" class="form-control"  type="password">
                                        </div>
                                    </div>
                                </div>

                                <!-- Text input-->

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Confirm Password</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input name="password_confirmation" placeholder="Enter Confirm Password" class="form-control"  type="password">
                                        </div>
                                    </div>
                                </div>

                                <div id="resp" class="col-md-6 col-md-offset-3">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>* {{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>* {{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                    <strong>* {{ $errors->first('password') }}</strong>
                                </span>
                                    @endif
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-5 control-label"></label>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-block" >Register</button>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div><!-- /.container -->
                </div>
            </div>
    </div>
    </div>

@stop

@section('footer')
<script>
    $(document).ready(function() {
        $('#registration_form').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        stringLength: {
                            min: 2,
                        },
                        notEmpty: {
                            message: 'Please enter your first name'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your email address'
                        },
                        emailAddress: {
                            message: 'Please enter a valid email address'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your phone number'
                        },
                        numeric:{
                            message: 'Please enter a vaild phone number with area code'
                        },
                        stringLength: {
                            min: 9,
                            message: 'Please enter a vaild phone number with area code'
                        }
//                        ,
//                        phone: {
//                            country: 'US',
//                            message: 'Please enter a vaild phone number with area code'
//                        }
                    }
                },

                country: {
                    validators: {
                        notEmpty: {
                            message: 'Please select your country'
                        }
                    }
                },
                password: {
                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Please enter minimum 6 characters'
                        },
                        notEmpty: {
                            message: 'Please enter your password'
                        },
                        identical: {
                            field: 'password_confirmation',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        stringLength: {
                            min: 6
                        },
                        notEmpty: {
                            message: 'Please enter your confirm password'
                        },
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        })
            .on('success.form.bv', function(e) {
//                $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
//                $('#contact_form').data('bootstrapValidator').resetForm();
//
//                // Prevent form submission
//                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);
                $form.submit();
//                // Get the BootstrapValidator instance
//                var bv = $form.data('bootstrapValidator');
//
//                // Use Ajax to submit form data
//                $.post($form.attr('action'), $form.serialize(), function(result) {
//                    console.log(result);
//                }, 'json');
            });
    });


</script>
@stop