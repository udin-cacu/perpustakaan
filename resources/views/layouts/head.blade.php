<!DOCTYPE html>
<html lang="en">
<head>
	<title>Library - University</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

	<style>
		<style>
		/* Mencegah dropdown tertutup terlalu cepat saat mouse bergerak */
		.nav-item.dropdown:hover .dropdown-menu {
			display: block;
			margin-top: 0.5rem; /* biar sedikit turun */
		}

		.nav-item.dropdown .dropdown-menu {
			transition: all 0.25s ease;
		}

		.dropdown-menu:hover {
			display: block;
		}

		
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const dropdown = document.getElementById('userDropdown');
			const menu = dropdown.nextElementSibling;

			dropdown.addEventListener('mouseover', () => {
				new bootstrap.Dropdown(dropdown).show();
			});

			dropdown.addEventListener('mouseleave', () => {
				setTimeout(() => {
					if (!menu.matches(':hover')) {
						new bootstrap.Dropdown(dropdown).hide();
					}
				}, 2000);
			});

			menu.addEventListener('mouseleave', () => {
				new bootstrap.Dropdown(dropdown).hide();
			});
		});
	</script>

</style>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.html"><i class="flaticon-university"></i> Library <br><small>University</small></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
						<a href="/home" class="nav-link">Home</a>
					</li>
					<li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
						<a href="/about" class="nav-link">About</a>
					</li>
					<li class="nav-item {{ Request::is('books') ? 'active' : '' }}">
						<a href="/books" class="nav-link">Books</a>
					</li>
					<li class="nav-item {{ Request::is('petugas') ? 'active' : '' }}">
						<a href="/petugas" class="nav-link">Library Officer</a>
					</li>
					<li class="nav-item {{ Request::is('konfirmasipinjam') ? 'active' : '' }}">
						<a href="/konfirmasipinjam" class="nav-link">My Loan</a>
					</li>
					<li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
						<a href="/contact" class="nav-link">Contact</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link d-flex align-items-center" href="#" id="userDropdown" role="button"
						data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" style="text-decoration:none;">

						{{-- Nama User --}}
						<span class="fw-semibold text-dark me-2">{{ Auth::user()->name }}</span>

						{{-- Foto Profil --}}
						@if(Auth::user()->photo && file_exists(public_path('content/images/' . Auth::user()->photo)))
						<img src="{{ asset('content/images/' . Auth::user()->photo) }}" 
						alt="User Photo"
						class="rounded-circle border border-2 border-light shadow-sm me-1"
						width="36" height="36" style=" vertical-align:middle; margin-left:8px;">
						@else
						<div class="d-inline-flex justify-content-center align-items-center bg-light rounded-circle border border-2 border-light shadow-sm align-middle me-1"
						style="width:36px; height:36px; vertical-align:middle; margin-left:8px;">
						<i class="fas fa-user text-secondary" style="font-size:18px; line-height:1;"></i>
					</div>
					@endif

					{{-- Icon dropdown di kanan nama --}}
					<i class="fas fa-chevron-down text-muted small ms-1"></i>
				</a>

				{{-- Dropdown Menu --}}
				<ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-1 py-2" aria-labelledby="userDropdown" style="min-width: 180px;">


					{{-- Header kecil di dalam dropdown --}}
					<li class="px-3 py-2 text-center border-bottom">
						<strong class="d-block text-dark">{{ Auth::user()->name }}</strong>
						<small class="text-muted">{{ Auth::user()->email }}</small>
					</li>

					{{-- Profile link --}}
					<li>
						<a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile') }}">
							<i class="ni ni-single-02 text-primary me-2"></i> Profile
						</a>
					</li>

					<li><hr class="dropdown-divider"></li>

					{{-- Logout link --}}
					<li>
						<a class="dropdown-item text-danger d-flex align-items-center py-2" href="{{ route('logout') }}"
						onclick="event.preventDefault(); event.stopPropagation(); document.getElementById('logout-form').submit();">
						<i class="ni ni-user-run me-2"></i> Logout
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
						@csrf
					</form>
				</li>
			</ul>
		</li>




	</ul>
</div>
</div>
</nav>
<!-- END nav -->