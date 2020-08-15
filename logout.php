<?php
session_start();

unset($_SESSION);

session_destroy();

header("Location: index.php");



mysqli_close($connection);
      exit();
?>