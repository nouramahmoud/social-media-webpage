<?php
session_start();
$error='';

if (isset($_POST['LogIn'])) {
	$email=$_POST['email'];
	$password=$_POST['password'];
	$connection=mysqli_connect("localhost","root","","marsdatabase");
	mysqli_select_db($connection,"marsdatabase");

    $query=mysqli_query($connection,"select * from users where userPassword='$password'  AND userEmail='$email' ");
    $noOfRows=mysqli_num_rows($query);
   if ($noOfRows == 1)
{
	$row=mysqli_fetch_assoc($query);
	$_SESSION["userId"]=$row["userId"];
	header("Location: userprofile.php");
	
	}
else
	
	{
	   header("Location: index.php");
	}

mysqli_close($connection);
exit();
	
}