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


$postquery="select * from posts where userId='$user_check' ORDER BY posts.postId DESC";  
$sql=mysqli_query($connection,$postquery);
$num_of_rows=mysqli_num_rows($sql);

?>
<!DOCTYPE html>
<html>
<head>
	<title>My profile</title>
	<link rel="stylesheet" type="text/css" href="profileStyle.css" media="all">
  <style type="text/css">
    .likedPost{
      width: 300px;
      height: 100px;
      background-color: #eabedf;
      border-radius: 5%;
      margin-left: 23px;
      /*margin-top: 5px;*/
      overflow: auto;

    }
    .likedposts{
      display: flex;
     flex-wrap: wrap;
     align-content: initial;
     width: 350px; 
     height: 400px;
     overflow: auto;
     padding: 5px;
      background-color: white;
       margin-top: 13%;
        margin-left: 3%;
         border-radius: 5%;
         box-shadow: inset 0 0 11px #d0d0d0;
    }
  </style>
</head>
<body style="overflow: auto;font-family:'Roboto';">
	<br>
 <div>
   <a class="homelink" href="profile.php">Home</a>
   <a class="profilelink" href="">Profile</a>
   <a class="profilelink" href="Logout.php" style="color: #FFE2E1;
  text-decoration: none;
  clear: right;
  font-size: 140%; margin-left: 31px;">Logout</a>
  <a class="delete" href="deleteaccount.php">DeleteAcc?</a>
 </div>
   <div class="userinfo">

	   <img class="profilephoto" src="<?= $photo?>" >
	   <p class="username"><?= $username?></p>
	   <a class="editProfile" href="editProfile.php">edit profile</a>
   </div>

   <div class="userpostApost">
   	 <p class="createPost">Create post</p>
   	 <form method="post">
   	 	<textarea class="texttype" name="status" placeholder="What's on your mind?"></textarea>
   	 	<input type="submit" name="postit" class="postbutton" value="post">
   	 </form>
   </div>
   <?php
$lastQuery="select postId from posts ORDER BY postId DESC LIMIT 1";
$lastsql=mysqli_query($connection,$lastQuery);
$value=mysqli_fetch_assoc($lastsql);
$lastPostId=$value['postId'];
$lastPostId++;

extract($_POST);
if(isset($postit))
  {
  $msg="<pre>$status</pre>";
  
  $query2="INSERT INTO posts(postId, userId, postDescription,likebutton,chatbutton) VALUES ('$lastPostId','$user_check','$msg','$lastPostId','$user_check')";
  mysqli_query($connection,$query2);
   header("Location: userprofile.php");

  }
?>

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
  
  

   <div class="likedposts" >
   <h1>liked posts</h1>
    <?php
     $likeQuery="select posts.* FROM users JOIN posts JOIN likes ON users.userId=likes.userId AND posts.postId=likes.postId WHERE users.userId=$user_check";
     $likeSql=mysqli_query($connection,$likeQuery);
     $numl_of_rows=mysqli_num_rows($likeSql);
     for ($i=0; $i < $numl_of_rows; $i++) { 
       $rowl=mysqli_fetch_assoc($likeSql);
       $userpid=$rowl["userId"];
       $postersql=mysqli_query($connection,"select userPhoto, userName FROM users WHERE userId=$userpid");
       $rowp=mysqli_fetch_assoc($postersql);

    ?>
     <div class="likedPost">
      <img class="postprofilephoto" src="<?= $rowp["userPhoto"]?>">
      <p class="firstPostname"><?= $rowp["userName"]?></p>
      <div class="firstpostcontent"><?= $rowl["postDescription"]?></div>
      </div>
    <?php }?>
   </div>
</body>
</html>
<?php mysqli_close($connection);
      exit();
?>
