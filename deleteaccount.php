<?php
session_start();
$user_check = $_SESSION['userId'];
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection,"marsdatabase");
$query="delete FROM users WHERE userId='$user_check'";
if(mysqli_query($connection,$query)){

unset($_SESSION);

session_destroy();

header("Location: index.php");


}else{
	echo "can't delete account";
}

mysqli_close($connection);
      exit();
?>