<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/website')}}/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/website')}}/css/animate.css">

    <link rel="stylesheet" href="{{asset('assets/website')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('assets/website')}}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('assets/website')}}/css/magnific-popup.css">

    <link rel="stylesheet" href="{{asset('assets/website')}}/css/aos.css">

    <link rel="stylesheet" href="{{asset('assets/website')}}/css/ionicons.min.css">

    <link rel="stylesheet" href="{{asset('assets/website')}}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{asset('assets/website')}}/css/jquery.timepicker.css">


    <link rel="stylesheet" href="{{asset('assets/website')}}/css/flaticon.css">
    <link rel="stylesheet" href="{{asset('assets/website')}}/css/icomoon.css">
    <link rel="stylesheet" href="{{asset('assets/website')}}/css/style.css">
</head>
<body class="goto-here">

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{route('website.index')}}">Vegefoods</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{route('website.index')}}" class="nav-link">Home</a></li>
                @auth('web')
                    <li class="nav-item active"><a href="javascript:void(0)" onclick="$('#logout_form').submit()" class="nav-link">logout</a></li>
                    <form id="logout_form" action="{{route('user.logout')}}" method="post">
                        @csrf

                    </form>
                @endauth


                <li class="nav-item cta cta-colored"><a href="" class="nav-link"><span class="icon-shopping_cart"></span>[{{auth('web')->user()->products()->count()}}]</a></li>

            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Featured Products</span>
                <h2 class="mb-4">Our Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @forelse($products as $product)

                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="{{asset('assets/website')}}/images/product-8.jpg" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">{{$product->name}}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>${{number_format($product->price,2,',')}}</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">

                                    <a href="javascript:void(0);" onclick="$('#buy_form_{{$product->id}}').submit()" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    <form id="buy_form_{{$product->id}}" action="{{route('products.buy',$product->id)}}" method="post">
                                        @csrf

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>
</section>

<section class="ftco-section img" style="background-image: url({{asset('assets/website')}}/images/bg_3.jpg);">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">

            </div>
        </div>
    </div>
</section>


<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
    </svg>
</div>


<script src="{{asset('assets/website')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/website')}}/js/jquery-migrate-3.0.1.min.js"></script>
<script src="{{asset('assets/website')}}/js/popper.min.js"></script>
<script src="{{asset('assets/website')}}/js/bootstrap.min.js"></script>
<script src="{{asset('assets/website')}}/js/jquery.easing.1.3.js"></script>
<script src="{{asset('assets/website')}}/js/jquery.waypoints.min.js"></script>
<script src="{{asset('assets/website')}}/js/jquery.stellar.min.js"></script>
<script src="{{asset('assets/website')}}/js/owl.carousel.min.js"></script>
<script src="{{asset('assets/website')}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('assets/website')}}/js/aos.js"></script>
<script src="{{asset('assets/website')}}/js/jquery.animateNumber.min.js"></script>
<script src="{{asset('assets/website')}}/js/bootstrap-datepicker.js"></script>
<script src="{{asset('assets/website')}}/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{asset('assets/website')}}/js/google-map.js"></script>
<script src="{{asset('assets/website')}}/js/main.js"></script>

</body>
</html>
