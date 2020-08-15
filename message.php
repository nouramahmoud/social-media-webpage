<?php
                
	session_start();
	$user_check = $_SESSION['userId'];
	$owner_check=$_SESSION["friend"];

	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection,"marsdatabase");
	$query="select * FROM messages where (userId=$user_check and ownerId=$owner_check) OR (userId=$owner_check and ownerId=$user_check)";
    $sql=mysqli_query($connection,$query);
    $num_of_rows=mysqli_num_rows($sql);
    

    $userPhotoQuery="select userPhoto from users where userId=$user_check ";
    $userphotosql=mysqli_query($connection,$userPhotoQuery);
    $Uphotorow=mysqli_fetch_assoc($userphotosql);
    $userphoto=$Uphotorow["userPhoto"];

    $ownerPhotoQuery="select userPhoto from users where userId=$owner_check ";
    $ownerphotosql=mysqli_query($connection,$ownerPhotoQuery);
    $Ophotorow=mysqli_fetch_assoc($ownerphotosql);
    $ownerphoto=$Ophotorow["userPhoto"];
    
?>
<html>
<head>
	<title>Message Page Design</title>
	<style type="text/css">
		body {
			background-image:url("Photo1.jpeg");
            background-size: cover;
            font-family:"Roboto";
            

        }
    
        h1{
        	padding-top: 90px;
	        padding-left: 40px;
	        font-family:"Roboto";
	        font-size: 50px;
	        font-style: oblique;
	        color: #fafafa;
        }
       *{
			margin:0;
			padding: 0;
			font-family:"Roboto";
			box-sizing: border-box; 
		}

		.chatbox{
			width: 540px;
			min-width: 290px;
			height: 480px;
			padding:40px;
			background: #fafafa;
			margin: 40px auto;
			margin-right: 40px ;
			border-radius: 25px;
			box-shadow: 0 3px #ccc;
		}


		.chatlogs{
			padding: 10px;
			width: 100%;
			height: 350px;
			position: center;
			background: #fafafa; 
			overflow-x:hidden;
			overflow-y: scroll;
		}

		.chatlogs::-webkit-scrollbar{
			width: 10px;
        }

		.chatlogs::-webkit-scrollbar-thumb{
			border-radius: 5px;
			background: rgba(0,0,0,0.1);
		}
		.chat{
			display: flex;
			flex-flow: row wrap;
			align-items: flex-start;
			margin-bottom: 10px;
		}

		.chat .user-photo{
			width: 60px;
			height: 60px;
			background: #ccc;
			border-radius:60%;
			overflow: hidden;
		}

		.chat .user-photo img{
			width: 100%;
		}

		.chat .chat-message{
			width: 70%;
			padding: 13px;
			margin: 5px 10px 0;
			background: #EEE1E0;
			border-radius: 50px;
			font-size: 19px;
		}

		.chat .chat-message .p{
			width: 70%;
			padding: 13px;
			margin: 5px 10px 0;
			background: #EEE1E0;
			border-radius: 50px;
			font-size: 19px;
		}

		.friend .chat-message {
			background: #770145;
		}


		.self .chat-message{
			background: #EEE1E0;
			order: -1;

		}

		.chat-form{
			margin-top: 20px;
			display: flex;
			align-items: flex-start;
		}

		.chat-form textarea{
			background: #fff;
			width:100%;
			height: 40px;
			border: 3px solid #eee;
			border-radius: 2px;
			resize: none;
			padding: 20px;
			font-size: 18px;
			color: black;
		}


		.chatform button:hover{
			background: #770145;
		}
		
		a{
	text-decoration: none;
	color: white;
	margin: 5px;
}
    </style>

</head>
<body>

	<h1>Chat With Post Owner </h1>
	<a style="font-size: 140%; margin-left: 14%;" href = "userprofile.php">Profile</a>
      <a style="font-size: 140%;" href = "profile.php">Home</a>
	<div class="chatbox">
		<div class="chatlogs">
			<?php
		   for ($i=0; $i < $num_of_rows; $i++) { 
             $row=mysqli_fetch_assoc($sql);
              if ($row["ownerId"]==$owner_check) {?>

              	    <div class="chat self">
						<div class="user-photo"><img src="<?= $userphoto ?>"></div>
						<p class="chat-message"><?=$row["message"]?></p>
      		        </div>
              	
              <?php }
              else{?>
              	<div class="chat friend">
						<div class="user-photo"><img src="<?= $ownerphoto ?>"></div>
						<p class="chat-message" style="color: white;"><?=$row["message"]?></p>
				    </div>
                   
            <?php  }
             
      		 } ?>
		</div>
		<form method="POST">
		<div class="chat-form">
			<input type="text" name="message" style="width: 370px; height: 50px;background: #fff;width:100%;height: 40px;border: 3px solid #eee;border-radius: 2px;resize: none;padding: 20px;font-size: 18px;color: black;" placeholder="Type Your Message" />
			
			<input type="submit" name="submit" style="height: 50px;width: 110px;background: #770145;padding: 5px 15px;font-size: 30px;color: #fff;border: none;margin: 0 10px;border-radius: 3px;box-shadow:0 3px 0 #770145;cursor: pointer; 

			-webkit-transition:background .2s ease;
			-moz-transition:background .2s ease;
			-o-transition:background .2s ease;" value="Send" >
		</div>
	    </form>
	    <?php
           if (isset($_POST['submit'])) {
					$message = $_POST['message'];
					$sqll = "insert into messages(userId, ownerId, message) VALUES ('$user_check','$owner_check','$message')";
					mysqli_query($connection,$sqll);
				    header("Location: message.php");	
			        
				}
	    ?>

	</div>
</body>

</html>
<?php mysqli_close($connection);
      exit(); ?>