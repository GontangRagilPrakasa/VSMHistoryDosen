<!DOCTYPE html>
<html lang="en">

<head>
  	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Vector Space Model - @yield('title')</title>

	<!-- Favicons -->
	<link rel="stylesheet" href="{{ asset('web/img/favicon.png') }}" rel="icon">
	<link rel="stylesheet" href="{{ asset('web/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link rel="stylesheet" href="{{ asset('web/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('web/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('web/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('web/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('web/vendor/venobox/venobox.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('web/vendor/aos/aos.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap.min.css') }}">
	<!-- Template Main CSS File -->
	<link rel="stylesheet" href="{{ asset('web/css/style.css') }}" rel="stylesheet">

	@yield('contentCss')
</head>

<body>
	<!-- ======= Top Bar ======= -->
  	<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    	<div class="container d-flex">
      		<div class="contact-info mr-auto">
        		<i class="icofont-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
        		<i class="icofont-phone"></i> +62 12345
      		</div>
      		<div class="social-links">
        		<a href="#" class="twitter"><i class="icofont-twitter"></i></a>
		        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
		        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
      		</div>
    	</div>
  	</div>

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top">
		<div class="container d-flex align-items-center">
		  	<h1 class="logo mr-auto"><a href="{{ url('/') }}">Penentuan <span>Vector Space Model.</span></a></h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			 <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a> -->

			<nav class="nav-menu d-none d-lg-block">
				<ul>
					<li class="active"><a href="{{ url('/') }}">Home</a></li>
					<li><a href="#">Blog</a></li>
			  		<li><a href="#">Hubungi Kami</a></li>
			  		<li><a href="{{ url('/login') }}">Login</a></li>
				</ul>
			</nav><!-- .nav-menu -->
		</div>
	</header>
	<!-- End Header -->

	<!-- ======= Hero Section ======= -->
  	<section class="align-items-center"></section>
  	<!-- End Hero -->

  	@yield('content')

	<!-- ======= Footer ======= -->
	<footer id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">

					<div class="col-lg-4 col-md-6 footer-contact">
						<h3>Dosen<span>.</span></h3>
						<p>
						Jalan in aja yuk <br>
						Nusa Tenggara Barat, +62 535022<br>
						Indonesia <br><br>
						<strong>Phone:</strong> +1 5589 55488 55<br>
						<strong>Email:</strong> info@example.com<br>
						</p>
					</div>

					<div class="col-lg-4 col-md-6 footer-links">
						<h4>Website Lainya</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Nusa Tenggara Barat</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Kabupaten Nusa Tenggara Barat</a></li>
						</ul>
					</div>

					<div class="col-lg-4 col-md-6 footer-links">
						<h4>Sosial Media</h4>
						<div class="social-links mt-3">
							<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
							<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
							<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="container py-4">
			<div class="copyright">
				&copy; Copyright <strong><span>BizLand</span></strong>. All Rights Reserved
			</div>
		</div>
	</footer>
	<!-- End Footer -->

	<div id="preloader"></div>
	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

	<!-- Vendor JS Files -->
	<script src="{{ asset('web/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('web/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('web/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('web/vendor/php-email-form/validate.js') }}"></script>
	<script src="{{ asset('web/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('web/vendor/counterup/counterup.min.js') }}"></script>
	<script src="{{ asset('web/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('web/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('web/vendor/venobox/venobox.min.js') }}"></script>
	<script src="{{ asset('web/vendor/aos/aos.js') }}"></script>
	<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

	<!-- Template Main JS File -->
	<script src="{{ asset('web/js/main.js') }}"></script>

	{{-- Highcharts --}}
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	@yield('contentJs')
</body>
</html>