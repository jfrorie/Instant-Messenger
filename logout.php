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
		body {
			
		}
		</style>
		
		<?php
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
		
		header("Location:main.php");
		?>
		
		
	</head>
</html>