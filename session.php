<?php

$conn= mysqli_connect("localhost", "root" ,"", "marsdatabase");
session_start();

$user_check = $_SESSION['userId'];

$query="select userId from users where userId='$user_check'";
$ses_sql=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($ses_sql);
$login_session=$row['userId'];

?>