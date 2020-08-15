<?php
include('login.php');
if(isset($_session['userId'])){
	header("location: userprofile.php");

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login and Registration form design</title>
	<link rel="stylesheet" href="login.css">
</head>

<body>
<h1><u><b> Mars </b></u></h1>
<form method="POST"> 
<input type="email" name="email" placeholder="Email address"  required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
<input type="submit" name="LogIn" value="Log In"><br>

<p>______________or___________</p>
<input type="button" name="Register" value="Register"
onclick="location.href='registration.php';">
</form>

</body>
</html>
