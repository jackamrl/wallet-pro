<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="keywords" content="{{$code[0]->meta_keys}}">
    <meta name="author" content="GeniusOcean">
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />
    <title>{{$settings[0]->title}}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('assets/css/genius1.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/genius-slider.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/genius-gallery.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lightbox.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
</head>
<body>
<div id="cover"></div>
<div class="theme2">
    <div class="row">
        <div class="pull-left gologo">
            <a href="{{ url('/') }}"><img class="img-responsive" src="{{ URL::asset('assets/images/logo')}}/{{$settings[0]->logo}}" alt="Lawyer Directory"></a>
        </div>
    </div>

    <nav class="navbar navbar-bootsnipp " role="navigation" id="nav_bar">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="animbrand">
                    <div class="navbar-brand" href=""></div>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('user.account') }}" class="">Dashboard</a></li>
                    <li><a href="{{ route('account.send') }}" class="">Send</a></li>
                    <li><a href="{{ route('account.request') }}" class="">Request</a></li>
                    <li><a href="{{ route('account.deposit') }}" class="">Deposit</a></li>
                    <li><a href="{{ route('account.withdraw') }}" class="">Withdraw</a></li>
                    <li><a href="{{ route('account.transactions') }}" class="">Transections</a></li>
                    <li><a href="{{ route('account.settings') }}" class="">Settings</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    @yield('content')

<footer>

    <div class="go-top">
        <a id="gtop" href="javascript:;"><i class="fa fa-angle-up"></i></a>
    </div>

<div class="row">
    <div class="col-md-3 about">
        <h4>About Us</h4>
        <p>{{$settings[0]->about}}</p>
    </div>
    <div class="col-md-3 address">
        <h4>Address</h4>
        <p>Street Address: {{$settings[0]->address}}</p>
        <p>Phone: {{$settings[0]->phone}}</p>
        <p>Fax:  {{$settings[0]->fax}}</p>
        <p>Email: {{$settings[0]->email}}</p>
    </div>
    <div class="col-md-3">
        <div class="socicon text-center">
                        @if($sociallinks[0]->f_status == "enable")
                            <a href="{{$sociallinks[0]->facebook}}" class="facebook"><i class="fa fa-facebook"></i></a>
                        @endif
                        @if($sociallinks[0]->t_status == "enable")
                            <a href="{{$sociallinks[0]->twiter}}" class="twitter"><i class="fa fa-twitter"></i></a>
                        @endif
                        @if($sociallinks[0]->g_status == "enable")
                            <a href="{{$sociallinks[0]->g_plus}}" class="google"><i class="fa fa-google"></i></a>
                        @endif
                        @if($sociallinks[0]->link_status == "enable")
                            <a href="{{$sociallinks[0]->linkedin}}" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        @endif
                    </div>
    </div>      
    <div class="col-md-3 text-center">
        <form action="{{action('FrontEndController@subscribe')}}" method="post">
            {{csrf_field()}}
            <h4>Subscription:</h4>
            <input type="text" id="email" class="form-control" placeholder="Enter Email" name="email" required>
            <p id="resp">
            @if(Session::has('subscribe'))

                    {{ Session::get('subscribe') }}
            @endif
            </p>
            <button id="subs" class="btn btn-ocean">Subscribe</button>
        </form>
    </div>
</div>
      

<div class="c-line"></div>


            <div class="text-center">
                {!! $settings[0]->footer !!}
            </div>

</footer>
</div>
    <!-- jQuery -->
    <script src="{{ URL::asset('assets/js/jquery.js')}}"></script>
    <script src="{{ URL::asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/wow.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jquery.smooth-scroll.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>

    <script src="{{ URL::asset('assets/js/jquery.mixitup.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/lightbox.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/plugins.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ URL::asset('assets/js/genius.js')}}"></script>
    <script src="{{ URL::asset('assets/js/genius-slider.js')}}"></script>
    {!! $code[0]->google_analytics !!}
    @yield('footer')
    
    <script>
              new WOW().init();
    </script>
<script>

	$(window).load(function(){
                setTimeout(function(){
                $('#cover').fadeOut(1000);
                },1000)
            });


    $(document).ready(function(){

        $('.project_list').mixItUp({
            animation: {
                effects: 'fade translateZ(-100px)'
            }
        });
    });

    jQuery(document).ready(function($) {
        "use strict";
        $('#customers-testimonials').owlCarousel( {
            loop: true,
            center: true,
            items: 3,
            margin: 30,
            autoplay: true,
            dots:true,
            nav:true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });

        $('.category').owlCarousel( {
            loop: true,
            items: 4,
            margin: 20,
            autoplay: true,
            dots:true,
            nav:true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });

    });
</script>
</body>
</html>