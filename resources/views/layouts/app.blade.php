<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <style>
	.fakeimg {
	height: 200px;
	background: #aaa;
	}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-dark navbar-dark">
		<a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav me-auto">

			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ms-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('home') }}">HOME</a>
					</li>
					@if (Route::has('login'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}" title="login">
								<i class="fas fa-sign-in-alt"></i>
							</a>
						</li>
					@endif

					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}" title="register">
								<i class="fas fa-user-plus"></i>
							</a>
						</li>
					@endif
				@else
					<li class="nav-item">
						<a class="nav-link" href="{{ route('home') }}">HOME</a>
					</li>
					@if( Auth::user()->isAdmin() or Auth::user()->isClient() )
					<li class="nav-item">
						<a class="nav-link" href="{{ route('products.index') }}" title="Products">
							<i class="fas fa-list"></i>
						</a>
					</li>
					@endif
					@if( Auth::user()->isAdmin() )
					<li class="nav-item">
						<a class="nav-link" href="{{ route('invoices.index') }}" title="Invoices">
							<i class="fas fa-file"></i>
						</a>
					</li>
					@endif
					<li class="nav-item">
						<a class="nav-link">{{ Auth::user()->name }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('logout') }}" title="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
							<i class="fas fa-sign-out-alt"></i>
						</a>
					</li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						{{ csrf_field() }}
					</form>
				@endguest
			</ul>
		</div>
	</nav>
	
	<div class="text-center py-8 text-4xl font-bold">
		<h1>Invoice management</h1>
	</div>
    
    @yield('content')

	<div class="jumbotron text-center" style="margin-bottom:0;margin-top:20;">
	  <!-- Grid container -->
	  <div class="container">
		<!-- Section: Social media -->
		<section class="mb-2">
		  <!-- Facebook -->
		  <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark">
			  <i class="fab fa-facebook-f"></i>
		  </a>

		  <!-- Twitter -->
		  <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark">
			  <i class="fab fa-twitter"></i>
		  </a>

		  <!-- Google -->
		  <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark">
			  <i class="fab fa-google"></i>
		  </a>

		  <!-- Instagram -->
		  <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark">
			  <i class="fab fa-instagram"></i>
		  </a>

		  <!-- Linkedin -->
		  <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark">
			  <i class="fab fa-linkedin"></i>
		  </a>
		  
		  <!-- Github -->
		  <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button" data-mdb-ripple-color="dark">
			  <i class="fab fa-github"></i>
		  </a>
		</section>
		<!-- Section: Social media -->
	  </div>
	  <!-- Grid container -->

	  <!-- Copyright -->
	  <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
		@MyInvoiceManagement By:
		<a class="hover:underline" href="https://www.linkedin.com/in/jose-solorzano-4307b372/" target="_blank">José Solorzano</a>
	  </div>
	  <!-- Copyright -->
	</div>
    
</body>
</html>
