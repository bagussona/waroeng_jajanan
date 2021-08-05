<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	{{-- <link rel="icon" href="{{asset('favicon.ico')}}"> --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" />

    @yield('title')

	<link rel="stylesheet" href="{{ asset('ecommerce/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/linericon/style.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/owl-carousel/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/lightbox/simpleLightbox.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/nice-select/css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/animate-css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/vendors/jquery-ui/jquery-ui.css') }}">

	<link rel="stylesheet" href="{{ asset('ecommerce/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('ecommerce/css/responsive.css') }}">
</head>

<body onload="realtimeClock()">
	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="top_menu row m0">
            <div class="container-fluid">
                <div class="float-left">
                    <p><i class="fa fa-whatsapp"></i>  +6282128796431</p>
				</div>
                <div class="float-left">
                    <div id="clock"></div>
                </div>
				<div class="float-right">
					<ul class="right_side">
						{{-- <li><a href="login.html">Login/Register</a></li> --}}
                        @guest

                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sign-in"></i> Sign In</a>
                            <ul class="dropdown-menu">
                                    <li class="nav-link">
                                        <i class="fa fa-sign-in"></i><a href="{{ route('login') }}" class="nav-link">Sign In</a>
                                    </li>
                                    <li class="nav-link">
                                        <i class="fa fa-user-plus"></i><a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                                    </li>
                            </ul>
                        </li>
                    </ul>
                        @endguest

                        @auth

                        <div class="float-right">

                            <li class="nav-item dropdown">
                                <strong>Selamat Datang.. 👋</strong>
                                {{-- <strong>{{ Auth::user()->name }}</strong> --}}
                                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle" style="width: 25px; height: 25px;" src="{{ Auth::user()->avatar }}" alt="admin@waroengjajanan.com">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header text-left">
                                    <strong>Signed in as</strong><br>
                                    <strong>{{ Auth::user()->name }}</strong>
                                    <div class="divider"> <hr> </div>
                                </div>

                                {{-- @if(Auth::check()) --}}
                                {{-- @if (Auth::user()->roles->name == 'admin') --}}
                                @if (Auth::user()->role_names[0] == 'admin' || Auth::user()->role_names[0] == 'staff')
                                <a class="dropdown-item text-left" href="{{ route('home') }}">
                                    <i class="fa fa-bar-chart"></i><strong> Dashboard</strong>
                                </a>
                                <div class="dropdown-header text-left">
                                <div class="divider"> <hr> </div>
                                </div>
                                @endif
                                {{-- @endif --}}
                                <div class="divider"></div>
                                <a class="dropdown-item text-left" href="{{ route('front.UserProfile') }}">
                                    <i class="fa fa-user"></i><strong> Profile</strong>
                                </a>
                                <div class="divider"></div>
                                <a class="dropdown-item text-left" href="{{ route('front.notfound') }}">
                                    <i class="fa fa-heart"></i><strong> Loved</strong>
                                </a>
                                <div class="divider"></div>
                                <a class="dropdown-item text-left" href="{{ route('front.notfound') }}">
                                    <i class="fa fa-shopping-cart"></i><strong> Orders</strong>
                                </a>
                                <div class="divider"></div>
                                </a>
                                <div class="divider"></div>
                                <a class="dropdown-item text-left" href="{{ route('front.notfound') }}">
                                    <i class="fa fa-envelope"></i><strong> Message</strong>
                                </a>
                                <div class="divider"></div>

                                <div class="dropdown-header text-left">
                                    <div class="divider"> <hr> </div>
                                </div>
                                <div class="divider"></div>
                                <a class="dropdown-item text-left" href="{{ route('front.notfound') }}">
                                    <i class="fa fa-cog"></i><strong> Settings</strong>
                                </a>
                                <a class="dropdown-item text-left" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <strong><i class="fa fa-sign-out"></i></strong><strong> Sign Out </strong>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </div>
                        </div>
                        @endauth
				</div>
			</div>
		</div>
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ url('/') }}">
						<img src="{{ asset('ecommerce/img/logo/logo-waroeng-jajanan.png') }}" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					 aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<div class="row w-100">
							<div class="col-lg-7 pr-0">
								@include('layouts.ecommerce.menu')
							</div>

							<div class="col-lg-5">

                                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                    <hr>
									<hr>
                                    @auth
									<li class="nav-item">
										<a href="{{ route('front.UserProfile') }}" class="icons">
											<i class="fa fa-user" aria-hidden="true"></i>
										</a>
									</li>
									<hr>

									<li class="nav-item">
                                        <a href="{{ route('front.notfound') }}" class="icons">
											<i class="fa fa-heart-o" aria-hidden="true"><span class="badge bg-warning"> {{ 0 }} </span></i>
                                        </a>
                                    </li>

                                    @endauth
                                    <hr>
                                    <li class="nav-item">
                                        <a href="{{ route('front.list_cart') }}" class="icons">
                                            <i class="lnr lnr lnr-cart"><span class="badge bg-warning">
                                                {{ $licart }}</span></i>
                                        </a>
                                    </li>
									<hr>
								</ul>

							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================Header Menu Area =================-->

    @yield('content')

	<!--================ start footer Area  =================-->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6 class="footer_title">About Us</h6>
						<p>{{ env('APP_NAME') }} adalah umkm yang sedang berkembang, {{ env('APP_NAME') }} ini berbasis online, untuk membeli jajanan cukup pesan lewat webapp.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6 class="footer_title">Subscribe {{ env('APP_NAME')}} </h6>
						<p>Dapatkan kabar terbaru mengenai jajanan yang akan di display!</p>
						<div id="mc_embed_signup">
							<form target="_blank" action=""
							 method="get" class="subscribe_form relative">
								<div class="input-group d-flex flex-row">
									<input name="email" placeholder="email address.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Input yur email.. '"
									 required="" type="email">
									<button class="btn sub-btn">
										<span class="lnr lnr-arrow-right"></span>
									</button>
								</div>
								<div class="mt-10 info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-footer-widget instafeed">
						<h6 class="footer_title">Galery {{ env('APP_NAME') }}</h6>
						<ul class="list instafeed d-flex flex-wrap">
							<li>
								<img src="{{ asset('ecommerce/img/instagram/Image-01.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/img/instagram/Image-02.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/img/instagram/Image-03.png') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/img/instagram/Image-04.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/img/instagram/Image-05.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/img/instagram/Image-06.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/img/instagram/Image-07.jpg') }}" alt="">
							</li>
							<li>
								<img src="{{ asset('ecommerce/img/instagram/Image-08.jpg') }}" alt="">
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget f_social_wd">
						<h6 class="footer_title">Follow Us</h6>
						<p>Let us be social</p>
						<div class="f_social">
							<a href="https://www.facebook.com/bsona1">
								<i class="fa fa-facebook"></i>
							</a>
							<a href="https://www.instagram.com/bagus_sona">
								<i class="fa fa-instagram"></i>
							</a>
							<a href="https://www.github.com/bagussona">
								<i class="fa fa-github"></i>
							</a>
							<a href="https://www.linkedin.com/in/bagus-sonarangga/">
								<i class="fa fa-linkedin"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row footer-bottom d-flex justify-content-between align-items-center">
				<p class="col-lg-12 footer-text text-center">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    All rights reserved | This template is made with
                    <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://daengweb.id" target="_blank">Daengweb</a> and rebuild by <a href="https://github.com/bagussona">Bagus</a>
				</p>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->

	<script src="{{ asset('ecommerce/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/popper.js') }}"></script>
	<script src="{{ asset('ecommerce/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/stellar.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/lightbox/simpleLightbox.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/isotope/isotope-min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/flipclock/timer.js') }}"></script>
	<script src="{{ asset('ecommerce/vendors/counter-up/jquery.counterup.js') }}"></script>
	<script src="{{ asset('ecommerce/js/mail-script.js') }}"></script>
	<script src="{{ asset('ecommerce/js/theme.js') }}"></script>
    <script src="{{ asset('ecommerce/js/clock.js') }}"></script>
@yield('js')
</body>
</html>
