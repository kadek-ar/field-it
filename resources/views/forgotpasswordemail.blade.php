<!DOCTYPE html>
 <html>
 <head>
 	<title>Forgot Password Email</title>
 	<link rel="stylesheet" type="text/css" href="/css/style.css">
 	<script type="text/javascript" src="/js/apps.js"></script>
 </head>
 <body>
 <div class="resetpassword_box">

 	<img class="user" src="/img/letterR.png" alt="img woman">
 	<h3>Reset Password</h3>

 	<form name="resetpasswordform" onsubmit="return form1()">

 	<p>Email</p>
 	<form action="{{ url('/forgot_password') }}" method="post">

		@if(session('error'))
		<div>
			{{session('success')}}
		</div>
		@endif

		@if(session('success'))
		<div>
			{{session('success')}}
		</div>
		@endif

		<input type="email" name="email" id="email">

		<a href="forgotpasswordcode">
			<input type="button" name="" value="CONTINUE"><br><br>
		   </a>
		   <a href="login">
			<input type="button" name="" value="Cancel" ><br><br>
		   </a>
		

		 </form>

	<div id="errorbox"></div><br>

	
	 

 </form>
 </div>
 </body>
 </html> 