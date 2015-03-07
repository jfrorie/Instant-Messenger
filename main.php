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
		<?php
			echo "Welcome to A Highly Ungeneric Instant Messaging Service: ". $_SESSION["userName"] .".<br>"
		?>
		This page will contain the primary functionality of this project, but for now is empty because I am not working on that bit.
	</body>
	
</html>