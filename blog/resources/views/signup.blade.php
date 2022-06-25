<!DOCTYPE html>
 <html>
 <head>
 	<title>Sign Up</title>
 	<link rel="stylesheet" type="text/css" href="/css/style.css">
 	<script type="text/javascript" src="resources/js/apps.js"></script>
 </head>
 <body>
 <div class="signup_box">
 	<img class="user" src="/img/letterR.png" alt="img woman">
 	<h3>Sign Up</h3>

 	<form name="signupform" onsubmit="return form2()">

 	<p>User Name</p>
 	<input type="text" name="signup_username" placeholder="Enter username">

 	<p>Email</p>
 	<input type="email" name="signup_useremail" placeholder="Enter email">

 	<p>Password</p>
 	<input type="password" name="signup_pwd" placeholder="Password">

 	<p>Retype Password</p>
 	<input type="password" name="repwd" placeholder="Re-Enter pasword"><br>
 	<div id="errorbox"></div><br>

	 <a href="login">
		<input type="button" name="" value="SIGNUP"><br><br>
	   </a>
 	
 	
 	<a href="login">Existing user, Login </a>
 </form>
 </div>
 </body>
 </html> 