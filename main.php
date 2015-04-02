<?php
// Start the session
session_start();
include 'connect.php';
include 'check_signed_in.php';
?>

<?php
function sendMessage($username,$message){
	$errorMessage = "";
	if($username == "GUEST"){
		$errorMessage = "GUEST cannot receive messages.";
		return $errorMessage;
	}

	$sql = "SELECT 
                        user_name
                FROM
                        users
                WHERE
                        user_name = '".$username."'";

        $result = mysql_query($sql);
        if(!$result){
                 $errorMessage = "Somthing went wrong when sending the message.";
        }
        else{
                if(mysql_num_rows($result) == 0)
                {
                    $errorMessage= "Invalid username";
                }
        }


	if($errorMessage == ""){
		//echo "message: ", $message, "<br>";
		$sender = $_SESSION["userName"];
		$file = fopen("$username-Messages.txt", "a+");
		if(!$file){
			$errorMessage = "File failed to open or be created.";
		}
		fwrite($file, "\r\n$sender:$message");
		
		fclose($file);
	}
		
	return $errorMessage;
}
?>

<?php

	if (isset($_POST['MessageButton'])){
		
		$username  = $_POST['username'];
		$message = $_POST['message'];
		
        $error = sendMessage($username, $message);
	}	
	
?>
<html>
	<head>
		<title> Group 10's Instant Messenger </title>
		<style>
		header { 
			background-color: black;
			color: white;
			text-align: center;
			padding: 5px;
		}
		nav {
			text-align: center
		}
		</style>
		
		<?php
		if (!isset($_SESSION["userName"]))
		{
		$_SESSION["userName"] = "GUEST";
		}
		?>
		
	</head>
	<header>
		<h1>A Highly Ungeneric Instant Messaging Service</h1>
	</header>
	
	<nav>
		<a href="main.php">HOME</a>
		<a href="settings.php">SETTINGS</a>
		<a href="account.php">LOGIN</a>
		<a href="register.php">REGISTER</a>
		<a href="logout.php">LOGOUT</a>
		<a href="messages.php">MESSAGES</a>
		<a href="upload.php">UPLOAD</a>
	</nav>
	
	<body>
		<?php
			echo "Welcome to A Highly Ungeneric Instant Messaging Service: ". $_SESSION["userName"] .".<br><br>";
		?>
		<iframe WIDTH="500" HEIGHT="500" title="Shoutbox" src="http://shoutbox.widget.me/window.html?uid=jqngob6w" frameborder="0" scrolling="auto"></iframe>
		<script src="http://shoutbox.widget.me/v1.js" type="text/javascript"></script>
		<br><br>

		<?php
			echo "Users currently signed in:<br>";
			 $sql = "SELECT 
                 	       user_name
                	FROM
                        	users
                	WHERE
                        	is_signed_in = '1'";

        		$result = mysql_query($sql);
        		if(!$result){
				echo "Somthing went wrong with the sql: ", mysql_error();
        		}
        		else{
                		if(mysql_num_rows($result) == 0){
                    			echo "No one is signed in";
                		}
				else{
                			while ($row = mysql_fetch_assoc($result)){
                				echo $row['user_name'], "<br>";
					}
				}
        		}

		?>
	</body>
	
</html>
