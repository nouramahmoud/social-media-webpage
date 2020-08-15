<?php session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection,"marsdatabase");
$user_check = $_SESSION['userId'];
$query="select * from users where userId='$user_check'";
$ses_sql=mysqli_query($connection,$query);
$row=mysqli_fetch_assoc($ses_sql);
$username=$row["userName"];
$password=$row["userPassword"];
$photo=$row["userPhoto"];

?>

<!DOCTYPE html>
<html>
<head>
	<title>editprofile</title>
	<style type="text/css">
		body{
		  background-image: url("photo1.jpeg");
		  background-size: 100%;
		  background-repeat: no-repeat;
		  font-family:"Roboto";
		}
		.form-control{
			width: 97%;
		}

		.content{
			background-color: white;
			width: 400px;
			height: 478px;
			border-color: #770145;
			border:1px solid;
			margin-left: 32%;
			padding: 20px;
			border-radius: 10%;
			margin-top: 10%;

		}
		.exitbtn{
			float: right;
			margin-right: 10px;
			font-size: 20px;
			text-decoration: none;
			font-family: Tilda ;
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
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="content">
		<a class="exitbtn" href="profilePage.html">x</a>

    <h1>Edit Profile</h1>
	<div class="row">
        <form class="editform" role="form" method="Post" enctype="multipart/form-data">
          <div class="text-center">
          <img src="<?=$photo?>" class="currentprofile" alt="avatar">
          <h6 style="margin-top: 5px;">Upload a different photo...</h6>
          <center><input style="margin-top: -5px;" type="file" class="formcontrol" name="photo"></center>
          </div>
          <br>
          <label class="col-md-3 control-label">Username:</label>
          <input class="form-control" type="text" value="<?=$username?>" name="name">
          <br><br>
          <label class="col-md-3 control-label">Password:</label>
          <input class="form-control" type="password" value="<?=$password?>" name="pass">
          <br><br>
          <center><input style="margin-left: 5px;"type="submit" class="savebutton" value="Save Changes" name="submit"></center>
          
            
        </form>
      </div>
  </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
	if(isset($_FILES['photo'])){
	echo"uploaded";
	$file=$_FILES['photo'];
	$file_name = $file['name'];
    $file_type = $file ['type'];
    $file_size = $file ['size'];
    $file_path = $file ['tmp_name'];
	    if($file_name!="" && ($file_type="jpeg"||$file_type="png"||$file_type="gif")&& $file_size<=614400){

		    if(move_uploaded_file ($file_path,$file_name)){//"images" is just a folder name here we will load the file.
		     $newPhoto=$file_name;
		    }else
		    	$newPhoto=$photo;
	    }else
	      $newPhoto=$photo;
    $newName=$_POST['name'];
	$newPassword=$_POST['pass'];
    $sql="UPDATE users SET userName='$newName',userPassword='$newPassword',userPhoto='$newPhoto' where userId='$user_check'";
   if (mysqli_query($connection, $sql)) {
    echo "Record updated successfully";
    header("Location: userprofile.php");
} 
}  else{
	$newPhoto=$photo;
	$newPassword=$_POST['pass'];
    $sql="UPDATE users SET userName='$newName',userPassword='$newPassword',userPhoto='$newPhoto' where userId='$user_check'";
   if (mysqli_query($connection, $sql)) {
    echo "Record updated successfully";
    header("Location: userprofile.php");
 
} else {
    echo "Error updating record: " . mysqli_error($connection);
}
}}
mysqli_close($connection);
exit();

?>


