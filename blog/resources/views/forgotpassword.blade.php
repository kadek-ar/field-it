<!DOCTYPE html>
 <html>
 <head>
 	<title>Forgot Password</title>
 	<link rel="stylesheet" type="text/css" href="/css/style.css">
 	<script type="text/javascript" src="javascript.js"></script>
 </head>
 <body>
 <div class="resetpassword_box">

 	<img class="user" src="/img/letterR.png" alt="img woman">
 	<h3>Reset Password</h3>

 	<form name="resetpasswordform" onsubmit="return form1()">

 	<p>New Password</p>
 	<input type="password" name="pwd" placeholder="">
	 <br>

     <p>Confirm Password</p>
 	<input type="password" name="pwd" placeholder="">
	 <br>

	<div id="errorbox"></div><br>

	<a href="homepage">
		<input type="button" name="" value="RESET AND LOGIN" ><br><br>
	   </a>
     
       <a href="forgotpasswordcode">
		<input type="button" name="" value="Cancel" ><br><br>
	   </a>
 	
	 

 </form>
 </div>
 </body>
 </html> 