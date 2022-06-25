<!DOCTYPE html>
 <html>
 <head>
 	<title>Sign Up</title>
 	<link rel="stylesheet" type="text/css" href="/css/style.css">
 	<script type="text/javascript" src="resources/js/apps.js"></script>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
 </head>
 <body>
 <div class="signup_box">
 	<img class="user" src="/img/letterR.png" alt="img woman">
 	<h3>Sign Up</h3>

 	<form action="/register" method="post">
		@csrf
		<label>User Name</label>
		<input type="text" name="name" value="{{ old('name') }}" class="@error('name')is-invalid @enderror" placeholder="Enter username" required>
		@error('name')
			<div class="invalid-feedback">
				{{ $message }}
			</div>
		@enderror

		<label>Email</label>
		<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" class="@error('email')is-invalid @enderror" required>
		@error('email')
			<div class="invalid-feedback">
				{{ $message }}
			</div>
		@enderror

		<label>Password</label>
		<input type="password" name="password" placeholder="Password" class="@error('password')is-invalid @enderror" required>
		@error('password')
			<div class="invalid-feedback">
				{{ $message }}
			</div>
		@enderror

		<label>Retype Password</label>
		<input type="password" name="password_confirmation" class="@error('password_confirmation')is-invalid @enderror" placeholder="Re-Enter pasword" required><br>
		@error('password_confirmation')
			<div class="invalid-feedback">
				{{ $message }}
			</div>
		@enderror

		<button type="submit">Signup</button>

		{{-- <div id="errorbox"></div><br>

		<a href="login">
			<input type="button" name="" value="SIGNUP"><br><br>
		</a> --}}

	</form>
	<a href="login">Existing user, Login </a>
 </div>
 </body>
 </html>
