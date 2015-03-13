<?php
// Start the session
session_start();
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
		<a href="account.php">REGISTER/LOGIN</a> 
		<a href="logout.php">LOGOUT</a>
	</nav>
	
	<body>
		<br>This page will contain resources to change user settings. <br><br><hr><br>
		<?php
			if ($_SESSION["userName"] == "GUEST")
			{
				echo "You must be logged in to use this functionality";
			}
		?>
	</body>
</html>