<?php
// Start the session
session_start();
include 'connect.php';
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
		$sql = "UPDATE users
                 SET is_signed_in = is_signed_in - 1
                WHERE
                        user_name = '".$_SESSION["userName"]."'";

     	   	$result = mysql_query($sql);
        	if(!$result){
                	$errorMessage = "You are signed out, Somthing went wrong when updating is_singed_in variable.";
        	}

		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
		
		header("Location:main.php");
		?>
		
		
	</head>
</html>
