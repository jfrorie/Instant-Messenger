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
		body{
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			margin: 0px;
			color: white;
			background-image: url("background8.jpg");
			background-size:cover;
		}
		h1{
			font-weight: lighter;
			margin: .67em 0;
			font-size: 36px; 

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
		<h1>Group 10's IM</h1>
				
		<?php
                if ( (!isset($_SESSION["userName"])) || ($_SESSION["userName"] == "GUEST") ){
			include "menu_guest.php";
                }
		else{
			include "menu.php";
		}
                ?>


	</header>
	

	
	<body onbeforeunload="signInForm.signInButt.name='signOut';signInOut()" onload="hideShow('hide')" >
		<div align = center>
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
	

		Public Chat 
		<!-- this sign in is currently dif from main accounts, modify chatjax.js login to change that -->
		<form onsubmit="signInOut();return false" id="signInForm">
		<input id="userName" value = "<?php echo $_SESSION["userName"]; ?>" type="text">
		<input id="signInButt" name="signIn" type="submit" value="Connect">
		<span id="signInName">Alias</span>
		</form>
		<div id="usersOnLine"></div>
		<div id="chatBox"></div>
		<form onsubmit="sendMessage();return false" id="messageForm">
		<input id="message" type="text">
		<input id="send" type="submit" value="Send">
		<div id="serverRes"></div></form>
	</div>		
	<br><br>
	</body>
	
</html>

