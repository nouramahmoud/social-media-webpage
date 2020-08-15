<?php

session_start();
$_SESSION['message'] ='';
$mysqli = new mysqli("localhost","root","","marsdatabase");
$lastsql="select userId from users ORDER BY userId DESC LIMIT 1";
$lastresult=$mysqli -> query( $lastsql ) ;
$value=mysqli_fetch_assoc($lastresult);
$lastuserId=$value['userId'];
$lastuserId++;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = $mysqli -> real_escape_string($_POST['name']);
		$email = $mysqli -> real_escape_string($_POST['email']);
        $password = $mysqli -> real_escape_string($_POST['password']);
        if(strlen($password) < 8) {
     	echo 'Password should be at least 8 characters in length.';
         }
        else{
        $sql = "SELECT * FROM users WHERE userEmail='$email'" ;
        $result = $mysqli -> query( $sql ) ;
        if( mysqli_num_rows($result) > 0 ){
        	echo "Sorry,this user already token";
        	
	    }else{
	    	
	    	$image = addslashes($_FILES['image']['name']);
		    if($image==""){
		    	$image="defaultavatar.jpeg";
		    }
	    	$sql = "INSERT INTO users (userId,userName,userEmail,userPassword,userPhoto) VALUES ('$lastuserId','$username','$email','$password','$image')";
		    $resultt = $mysqli -> query( $sql ) ;
		    header("location:index.php");
	    }
}
	}

?>

<html>
<head>
	<title>signup</title>
	<style type="text/css">
		body{
		  background-color: #F8E7F7;
		}
		.content{
			background-color: white;
			width: 400px;
			height: 400px;
			border-color: #770145;
			border:1px solid;
			margin-left: 32%;
			padding: 20px;
			border-radius: 10%;

		}
		.exitbtn{
			float: right;
			margin-right: 10px;
			font-size: 20px;
			text-decoration: none;
			font-family:"Roboto";
		}
		.currentprofile{
			width: 70px;
			height: 70px;
		}
		h1{
			color: #770145;
		}
        .savebutton{
        	background-color: #770145;
	        color: #FFFEFE;
			border-color: #770145;
			border-radius: 25%;
			width: 82px;
			height: 30px;
			font-size: 10px;
			text-align: center;
		
        }
	</style>

<body>
	<div class="content">
		<a class="exitbtn" href="index.php">x</a>

    <h1>sign up</h1>
	<div class="row">
        <form class="editform" role="form" action="registration.php" method="POST" enctype="multipart/form-data">
          <div class="text-center">
          <img src="defaultavatar.jpeg" class="currentprofile" alt="avatar">
          <h6 style="margin-top: -5px;">Upload a profile photo...</h6>
          <input style="margin-top: -5px;" name="image" type="file"accept="image/*" class="formcontrol">
        </div>
          <br>
          <label class="col-md-3 control-label">Username:</label>
          <input class="form-control" name="name" type="text" placeholder="enter you name" required>
          <br><br>
          <label class="col-md-3 control-label">Password:</label>
          <input class="form-control" name="password" type="password" placeholder="enter you password" required>
          <br><br>
          <label class="col-md-3 control-label">Email:</label>
          <input class="form-control" name="email"type="email" placeholder="enter you email" required>
          <br><br>
          <input style="margin-left: 5px;"type="submit" class="button" value="Save Changes" />
          
            
        </form>
      </div>
  </div>
</body>
</html>
