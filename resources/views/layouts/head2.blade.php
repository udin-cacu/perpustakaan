<!DOCTYPE html>
<html lang="en">
<head>
	<title>Library - University</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

	<link rel="stylesheet" href="/content/css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="/content/css/animate.css">

	<link rel="stylesheet" href="/content/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/content/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="/content/css/magnific-popup.css">

	<link rel="stylesheet" href="/content/css/aos.css">

	<link rel="stylesheet" href="/content/css/ionicons.min.css">

	<link rel="stylesheet" href="/content/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="/content/css/jquery.timepicker.css">


	<link rel="stylesheet" href="/content/css/flaticon.css">
	<link rel="stylesheet" href="/content/css/icomoon.css">
	<link rel="stylesheet" href="/content/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.html"><i class="flaticon-university"></i>Library <br><small>University</small></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
						<a href="/" class="nav-link">Home</a>
					</li>
					<li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
						<a href="/about" class="nav-link">About</a>
					</li>
					<li class="nav-item {{ Request::is('petugas') ? 'active' : '' }}">
						<a href="/petugas" class="nav-link">Library Officer</a>
					</li>
					<li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
						<a href="/contact" class="nav-link">Contact</a>
					</li>

					<li class="nav-item cta"><a href="login" class="nav-link"><span>Login</span></a></li>
				</ul>
			</div>
		</div>
	</nav>
<!-- END nav -->