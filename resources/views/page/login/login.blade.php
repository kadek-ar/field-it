<!DOCTYPE html>
 <html>
 <head>
 	<title>Login</title>
 	<link rel="stylesheet" type="text/css" href="/css/style.css">
 	<script defer src="apps.js"></script>
	<link rel="icon" href="{{ asset('/images/icons/logops-512x512.png') }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<!-- PWA  -->
	<meta name="theme-color" content="#6777ef"/>
	<link rel="apple-touch-icon" href="{{ asset('/images/icons/logops-512x512.png') }}">
	{{-- <link rel="apple-touch-icon" href="https://field-it.herokuapp.com/images/icons/logops-512x512.png"> --}}
	<link rel="manifest" href="{{ asset('/manifest.json') }}">
	{{-- <link rel="manifest" href="https://field-it.herokuapp.com/manifest.json"> --}}
 </head>
 <body>
 <div class="bg-white login_box">

 	{{-- <img class="user" src="/img/letterR.png" alt="img woman"> --}}
	<div style="position: absolute;
				margin-left: 73%;
				width: 115px;
				top: 108px">
		<img class="user h-auto text-center" style="width: 163px" src="/img/logops.webp" alt="img woman">
	</div>
 	<h3 style="padding-top: 82px" class="text-black">Login</h3>

	@if(session()->has('loginError'))
		<div class="alert alert-danger alert-dismissible fade show" role="start">
			{{ session('loginError')}}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif

 	<form action="/login" method="post">
		@csrf
		<div class="mb-3">
			<label class="text-black">Email</label>
			<input type="email" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}" class="form-control @error('email')is-invalid @enderror"  required>
			@error('email')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>
		<div>
			<label class="text-black">Password</label>
			<input type="password" name="password" id="password" class="form-control @error('email')is-invalid @enderror" placeholder="Enter Password" required><br>
			@error('password')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div id="errorbox"></div>

		<!-- <a href="homepage"> -->
		<input type="submit" name="" class="btn btn-success w-100" value="LOGIN"><br><br>
		<!-- </a> -->

		{{-- <div class="form-group">
			<label class="label-agree-term"> <span> <span> </span></span>
				<a href="{{ url('/forgot_password') }}">Forgot Password</a>
			</label>
		</div> --}}
		<a href="signup">Not registered? <span>Create an account</span></a>

	</form>
 </div>
	<script src="{{ asset('/sw.js') }}"></script>
	<script>
		if (!navigator.serviceWorker.controller) {
			navigator.serviceWorker.register("/sw.js").then(function (reg) {
				console.log("Service worker has been registered for scope: " + reg.scope);
			});
		}
	</script>	
 </body>
 </html>
