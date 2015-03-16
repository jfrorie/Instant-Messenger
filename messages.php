<?php
// Start the session
session_start();
?>
<?php
function viewMessages($username){
	
	
	if(fopen("$username-Messages.txt","r")){
	$file = fopen("$username-Messages.txt","r");

		while (!feof($file)) {
			$line = fgets($file);
			echo $line, "<br>";
		}
		
		fclose($file);
	}
	
	else{
		echo "You have no messages.";
	}
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
		body {
			
		}
		</style>
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
		</nav>
		
		<body>
		<?php
			if ($_SESSION["userName"] == "GUEST")
			{
				echo "You must be logged in to use this functionality.";
			}
			else{ ?>
		<?php
			echo "Here are your messages: ". $_SESSION["userName"] ."<br><br>";
		viewMessages($_SESSION["userName"]);
			
			
			
		?>
		
		<?php
		}
		?>
		
		
		
		</body>

</html>