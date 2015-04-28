<?php
// Start the session
session_start();
include 'connect.php';
include 'check_signed_in.php';
?>
<html>
	<head>
		<meta charset="utf-8">

		<title> Group 10's Instant Messenger </title>
		<style>
		header { 
			background:#1E1E1E;
			color: white;
			text-align: center;
			padding: 5px;
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

		<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.css" rel="stylesheet">
		<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
	</head>
	<header>
		<h1>Group 10's IM</h1>
		<?php include "menu.php";?>

	</header>
	

	
	<body onbeforeunload="signInForm.signInButt.name='signOut';signInOut()" onload="hideShow('hide')" >
		<?php
			
			echo "<br>Welcome to A Highly Ungeneric Instant Messaging Service: ". $_SESSION["userName"] .".<br><br>";
		?>
		<?php
			 $sql = "SELECT 
                 	       user_name
                	FROM
                        	users
                	WHERE
                        	is_signed_in > 0";
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
		<input id="signInButt" name="signIn" type="submit" value="Connect">
		<span id="signInName">Alias</span>
		</form>
		<div id="chatBox"></div>
		<div id="usersOnLine"></div>
		<form onsubmit="sendMessage();return false" id="messageForm">
		<input id="message" type="text">
		<input id="send" type="submit" value="Send">
		<div id="serverRes"></div></form>
		
	</body>
	
</html>

