<?php
                
	session_start();
	$owner_check=$_SESSION["friend"];
    $user_check = $_SESSION['userId'];
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection,"marsdatabase");
    $query="select * from users where userId='$owner_check'";            
    $ses_sql=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($ses_sql);
    $username=$row["userName"];
    $photo=$row["userPhoto"];
	$postquery="select * from posts where userId='$owner_check' ORDER BY posts.postId DESC";  
   $sql=mysqli_query($connection,$postquery);
     $num_of_rows=mysqli_num_rows($sql);
    if (isset($_POST['button'])) {
      header("Location: message.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
    body{
      background-image: url("photo1.jpeg");

     background-size:100% auto;
     background-attachment: cover;
     background-color: #F8E7F7;
     width: 100%;
     height: auto;
     background-repeat: no-repeat;
     font-family:"Roboto";
 
}
 .profilephoto{
    border-radius: 50%;
    width: 200px;
    height: 200px;
    margin:31px;
    float: left;
 }
  .username{
    color:#FFE2E1;
    
    font-size: 37px;
 }

.setofposts{
    width: 60%;
    height: 100% auto;
    margin-top: 10%;
      flex-wrap: wrap;
    align-content: initial;
    float: right;
    
}

.setofposts > div{
    width: 643px;
    height: auto;
    background-color: white;
    border-radius: 5%;
    margin-left: 79px; 
    margin-bottom:20px; 


}
.postprofilephoto{
    width: 50px;
    height: 50px;
    float: left;
    margin: 10px;
}
.firstPostname{
    color: #770145;
    font-size: 26px;
    margin: 10px;
}
.firstpostcontent{
    margin-top: 20px;
}
.contentimage{
    width: 300px;
    height: 350px;
}
.likeicon{
    width: 20px;
    height: 20px;
}
.likeicon{
    float: left;
    clear: none; 
    margin-left: 10px;

}
.numberoflikes{
    color: #770145;
    float: left;
    clear: none;
}
.buttonlike:active{
  background-color: #770145;
  color: white;
}
.buttonlike{
    width: 643px;
    height: 50px;
    margin-top: 10px;
    background-color: white;
    color: #770145;
    font-size: 20px;
    border-style: solid none none none;
}
.homelink{

  color: #FFE2E1;
  text-decoration: none;
  margin-left: 66%;
  margin-top: 35%;
  clear: right;
  margin-right: 30px; 
  font-size: 140%;


 }
  .profilelink{

  color: #FFE2E1;
  text-decoration: none;
  clear: right;
  font-size: 140%;
 }
 .messagebutton{
    width: 5%;
    height: 5%;
    border-radius: 20%
 }
 .submit{
    width: 5%;
    height: 5%;
    border-radius: 20%;
    background-color: #770145;
    color: white;
 }
  </style></head>
<body>
    <a class="homelink" href="profile.php">Home</a>
   <a class="profilelink" href="userprofile.php">Profile</a>

  <img class="profilephoto" src="<?=$photo?>">
  <br><br><br>
  <p class="username"><?=$username?></p>
  <form method="post">
  <button type="submit" name="button" class="submit">
  Start chat
  </button>
  </form>
     <?php for ($i=0; $i < $num_of_rows; $i++) { 
     $row=mysqli_fetch_assoc($sql);
     $postid=$row["postId"];
     $countQuery="select postId from likes where postId=$postid";
     $countSql=mysqli_query($connection,$countQuery);
     $countresult=mysqli_num_rows($countSql);
    ?>
   <div class="setofposts">
    <div class="firstPost" style="overflow: auto;">
        <img class="postprofilephoto" src="<?= $photo?>">
        <p class="firstPostname"><?= $username?></p>
        <div class="firstpostcontent"><?= $row["postDescription"]?></div>
        <br>
        <div style="display: inline-block; width: 84px;">
        <img class="likeicon"src="like.jpeg">
        <p class="numberoflikes" style="color: #770145"><?= $countresult?></p>
      <p class="liketext"> likes</p>
      </div>
      <button class="buttonlike">like</button>
    </div>
    <br> <br> <br>
   </div>
  <?php }?>
</body>
</html>