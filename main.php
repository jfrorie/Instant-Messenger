<?php
// Start the session
session_start();
include 'connect.php';
include 'check_signed_in.php';
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
		<link rel="stylesheet" type="text/css" href="cb_style.css">
		<script type="text/javascript" src="chatjax.js"></script>
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
                <a href="upload.php">UPLOAD FILE</a> 
                <a href="messages.php"> VIEW MESSAGES</a>
                <a href="send_message.php">SEND MESSAGE</a> 
	</nav>
	
	<body>
		<?php
			echo "Welcome to A Highly Ungeneric Instant Messaging Service: ". $_SESSION["userName"] .".<br><br>";
		?>

		<?php
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
					echo "Users currently signed in:<br>";
                			while ($row = mysql_fetch_assoc($result)){
                				echo $row['user_name'], "<br>";
					}
				}
        		}
		echo "<br><br>"

		?>
		Random Chat: Room1 
		<!-- this sign in is currently dif from main accounts, modify chatjax.js login to change that -->
		<form onsubmit="signInOut();return false" id="signInForm">
		<input id="userName" type="text">
		<input id="signInButt" name="signIn" type="submit" value="Sign in">
		<span id="signInName">User name</span>
		</form>

		<div id="chatBox"></div>
		<div id="usersOnLine"></div>
		<form onsubmit="sendMessage();return false" id="messageForm">
		<input id="message" type="text">
		<input id="send" type="submit" value="Send">
		<div id="serverRes"></div></form>


	</body>
	
</html>
