<!DOCTYPE html>
 <html>
 <head>
 	<title>Login</title>
 	<link rel="stylesheet" type="text/css" href="/css/style.css">
 	<script defer src="apps.js"></script>
 </head>
 <body>
 <div class="login_box">

 	<img class="user" src="/img/letterR.png" alt="img woman">
 	<h3>Login</h3>

 	<form name="loginform" onsubmit="return form1()">

 	<p>User Name</p>
 	<input type="text" name="username" placeholder="Enter username">

 	<p>Password</p>
 	<input type="password" name="pwd" placeholder="Password"><br>

	<div id="errorbox"></div><br>
	
	<a href="homepage">
 	<input type="button" name="" value="LOGIN"><br><br>
	</a>

	<div class="form-group">
		<label class="label-agree-term"> <span> <span> </span></span>
			<a href="{{ url('/forgot_password') }}">Forgot Password</a>
		</label>
	</div>
 	<a href="signup">Not registered? <span>Create an account</span></a>

 </form>
 </div>
 </body>
 </html> 