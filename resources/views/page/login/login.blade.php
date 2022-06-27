<!DOCTYPE html>
 <html>
 <head>
 	<title>Login</title>
 	<link rel="stylesheet" type="text/css" href="/css/style.css">
 	<script defer src="apps.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	{{-- @laravelPWA --}}
	<!-- Web Application Manifest -->
	<link rel="manifest" href="https://field-it.herokuapp.com/manifest.json">
	<!-- Chrome for Android theme color -->
	<meta name="theme-color" content="#1A4D2E">

	<!-- Add to homescreen for Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="application-name" content="Field-It">
	<link rel="icon" sizes="512x512" href="/images/icons/logops-512x512.png">

	<!-- Add to homescreen for Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Field-It">
	<link rel="apple-touch-icon" href="/images/icons/logops-512x512.png">


	<link href="/images/icons/splash-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-750x1334.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-1242x2208.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-828x1792.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-1242x2688.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-1536x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-1668x2224.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-1668x2388.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
	<link href="/images/icons/splash-2048x2732.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

	<!-- Tile for Win8 -->
	<meta name="msapplication-TileColor" content="#1A4D2E">
	<meta name="msapplication-TileImage" content="/images/icons/logops-512x512.png">

	<script type="text/javascript">
		// Initialize the service worker
		if ('serviceWorker' in navigator) {
			navigator.serviceWorker.register('/serviceworker.js', {
				scope: '.'
			}).then(function (registration) {
				// Registration was successful
				console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
			}, function (err) {
				// registration failed :(
				console.log('Laravel PWA: ServiceWorker registration failed: ', err);
			});
		}
	</script>
 </head>
 <body>
 <div class="bg-white login_box">

 	{{-- <img class="user" src="/img/letterR.png" alt="img woman"> --}}
	<div style="position: absolute;
				margin-left: 73%;
				width: 115px;
				top: 108px">
		<img class="user h-auto text-center" style="width: 163px" src="/img/logops.png" alt="img woman">
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
			<input type="password" name="password" id="password" class="form-control @error('email')is-invalid @enderror" placeholder="Password" required><br>
			@error('password')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div id="errorbox"></div>

		<!-- <a href="homepage"> -->
		<input type="submit" name="" class="btn btn-primary w-100" value="LOGIN"><br><br>
		<!-- </a> -->

		{{-- <div class="form-group">
			<label class="label-agree-term"> <span> <span> </span></span>
				<a href="{{ url('/forgot_password') }}">Forgot Password</a>
			</label>
		</div> --}}
		<a href="signup">Not registered? <span>Create an account</span></a>

	</form>
 </div>
 </body>
 </html>
