<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>VSM - @yield('title')</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/Ionicons/css/ionicons.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker3.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/admin-lte/css/AdminLTE.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="{{ asset('plugins/admin-lte/css/skins/_all-skins.min.css', ENV('SSL_FLAG')) }}">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="{{ asset('css/app.css', ENV('SSL_FLAG')) }}">

		@yield('contentCss')
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a href="{{ url('/') }}" class="logo">
					<span class="logo-mini"><b>X</b></span>
					<span class="logo-lg">
						<b>Vector Space Model</b>
					</span>
				</a>
				<nav class="navbar navbar-static-top">
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span class="hidden-xs">{{ Auth::User()->email }}</span>
								</a>
								<ul class="dropdown-menu">
									<li class="user-header">
										<p>
											{{ Auth::User()->email }}
										</p>
									</li>
									<li class="user-footer">
										<div class="row">
											<div class="col-md-7">
												<!-- <a href="{{ url('change-password') }}" class="btn btn-block btn-default">Ubah Password</a> -->
											</div>
											<div class="col-md-5">
												<a href="{{ url('logout') }}" class="btn btn-block btn-default">Logout</a>
											</div>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<aside class="main-sidebar">
				@include('layouts.sidebar')
			</aside>
			<div class="content-wrapper">
				<section class="content main-content">
					<div class="box box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">@yield('title')</h3>
						</div>
						<div class="box-body" style="min-height: 550px;">
							<div id="mainAlert"></div>
							@yield('content')
						</div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 1.0
				</div>
				<strong>Copyright &copy; <?php date('Y') ?> <a href="#"></a>.</strong> All rights reserved.
			</footer>
		</div>
		<script src="{{ asset('plugins/jquery/jquery.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/fastclick.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/admin-lte/js/adminlte.min.js', ENV('SSL_FLAG')) }}"></script>

		<script src="{{ asset('plugins/moment.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/iCheck/icheck.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/select2/js/select2.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/datatables/datatables.net/js/jquery.dataTables.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/datatables/datatables.net-bs/js/dataTables.bootstrap.min.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('plugins/jquery.blockUI.js', ENV('SSL_FLAG')) }}"></script>
		<script src="{{ asset('js/app.js', ENV('SSL_FLAG')) }}"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
		<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
		@yield('contentJs')
	</body>
</html>
