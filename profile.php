<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection,"marsdatabase");
$user_check = $_SESSION['userId'];
$query="select users.*, posts.* FROM posts JOIN users on users.userId=posts.userId ORDER BY posts.postId DESC";
$sql=mysqli_query($connection,$query);
$num_of_rows=mysqli_num_rows($sql);
for ($i=0; $i < $num_of_rows; $i++) { 
  $row=mysqli_fetch_assoc($sql);
  $postsarray[$i][0]=$row["postId"];
  $postsarray[$i][1]=$row["userPhoto"];
  $postsarray[$i][2]=$row["userName"];
  $postsarray[$i][3]=$row["chatbutton"];
  $postsarray[$i][4]=$row["likebutton"];
  $postsarray[$i][5]=$row["postDescription"];
  $postsarray[$i][6]=$row["userId"];
}

 for ($i=0; $i < sizeof($postsarray); $i++) { 
    if (isset($_POST[$postsarray[$i][4]])) {
        $postID=$postsarray[$i][4];
        $check ="select * FROM likes WHERE userId='$user_check' and postId='$postID' ";
        $checksql=mysqli_query($connection,$check);
        $num_of_likes=mysqli_num_rows($checksql);
        if($num_of_likes==0){
        $likeQuery="insert INTO likes( userId, postId) VALUES ('$user_check','$postID')";
        mysqli_query($connection,$likeQuery);
        }else{
          echo "you already like it";
        }
        
  }

    if (isset($_POST[$postsarray[$i][2]])) {
        $friend=$postsarray[$i][6];
        if ($friend==$user_check) {
          header("Location: userprofile.php");
        }else{


        $_SESSION["friend"]=$friend;
        $_SESSION["userId"]=$user_check;
        header("Location: friend.php");
      }
  }
  }
  for ($i=0; $i < sizeof($postsarray); $i++) { 
    if (isset($_GET[$postsarray[$i][3]])) {
        $post_owner=$postsarray[$i][6];
        if($post_owner==$user_check){
          echo "<p style='margin:auto;'>you can't chat with your self<p>";
        } 
        else{
        $Pquery="select * FROM messages where (userId=$user_check and ownerId=$post_owner) OR (userId=$post_owner and ownerId=$user_check)";
        $Psql=mysqli_query($connection,$Pquery);
        $Pnum_of_rows=mysqli_num_rows($Psql);


    ?>
    <div class="chatPopup" id="chatPopup">
    <form method="post">
   <input type="button" class="btncancel" onclick="window.location.href='profile.php';" value="X" name="btncancel">
   </form>
   <p><?= $postsarray[$i][2]?></p>
   <img src="<?= $postsarray[$i][1]?>" class="friendchatphoto">
   <div class="chatbox" style="height: 225px;">
     <?php
      if($Pnum_of_rows>0){
        $counter=$Pnum_of_rows;
          do{
             $Prow=mysqli_fetch_assoc($Psql);
            if ($Prow["ownerId"]==$post_owner) {?>
            <div class="chat self">
                 <p class="chat-message"><?=$Prow["message"]?></p>
            </div>
            <?php }
            else{?>
             <div class="chat friend">
             <p class="chat-message" style="color: white;"><?=$Prow["message"]?></p>
             </div>
          <?PHP }
          $counter--;
        }while($counter>0);}?>
    </div>
    
    <form method="POST" id="form">
    <div class="chat-form">
      <input type="text" name="message" placeholder="Type Your Message" />
      <input type="submit" name="submit" value="Send" class="chatbutton">
    </div>
      </form>
  </div>
  <?php }}
  }

    if (isset($_POST['submit'])) {
      $message = $_POST['message'];
      
      $sqll = "insert into messages(userId, ownerId, message) VALUES ('$user_check','$post_owner','$message')";
      mysqli_query($connection,$sqll);
          
              
        }

?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="home.css">
  <style type="text/css">
    .friendButton{
     background-color: white;
     border-style: none;
    }
  </style>
</head>
<body>
<div class="main">
    <div class= "nav">
      <a style="font-size: 140%;" href = "userprofile.php">Profile</a>
      <a style="font-size: 140%;" href = "">Home</a>
      <a style="font-size: 140%;" href = "game.php">Games</a>
    </div>

    <div class = "header">
    <p class="mars">Mars</p>
    
  </div>
    
    
</div>
<?php for ($i=0; $i < $num_of_rows; $i++) { 
     $postid=$postsarray[$i][0];
     $countQuery="select postId from likes where postId=$postid";
     $countSql=mysqli_query($connection,$countQuery);
     $countresult=mysqli_num_rows($countSql);

    ?>
<div class="setofposts">
    <div class="firstPost" style="overflow: auto;">
      <img class="postprofilephoto" src="<?= $postsarray[$i][1]?>">
      <form method="post" >
        <button type="submit" name="<?= $postsarray[$i][2]?>" class="friendButton">
         <p class="firstPostname"><?= $postsarray[$i][2]?></p>
        </button>
      </form>
      <form method="get" id="<?= $postsarray[$i][3]?>" >
      <input class="chatbutton" name="<?= $postsarray[$i][3]?>" value="let's chat" type="submit">
      
      </form>
      <form method="post" id="<?= $postsarray[$i][4]?>">
      <div class="firstpostcontent"><?= $postsarray[$i][5]?></div>
      <br>
      <div style="display: inline-block; width: 84px;">
      <img class="likeicon"src="like.jpeg">
      <p class="numberoflikes" style="color: #770145"><?= $countresult?></p>
      </div>

      <input class="buttonlike" name="<?= $postsarray[$i][4]?>" value="like" type="submit" onclick="buttonFunction(this)" >
    </form>
    </div>
  </div>
  
  <?php
 }
 
?>
    
    
    
  <script type="text/javascript">
    function buttonFunction(el) {
      if (el.style.backgroundColor == "white") {
          el.style.backgroundColor = "#770145";
        el.style.color="white";
      }else{
        el.style.backgroundColor = "white";
        el.style.color="#770145";
      }
     }
  </script>
  <script>
$(document).ready(function(){
    $('form').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "profile.php",
            data:{message:$('textarea[name="message"]').val()},
            async:true,
            success: function(result){
                //do something
            }
        });
   });
});
</script>
</body>
</html>

