<?php
// Start the session
session_start();
include 'check_signed_in.php';
?>
<?php
function viewMessages($username){
	
	
	$file = fopen("/var/www/html/Instant-Messenger/messages/$username-Messages.txt","r");
	if($file){
		while (!feof($file)) {
			$line = fgets($file);
			echo $line, "<br>";
		}
		
		fclose($file);
	}
	
	else{
		echo "You have no messages.<br><br><br>";
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
		<?php
		if (!isset($_SESSION["userName"]))
		{
		$_SESSION["userName"] = "GUEST";
		}
		?>
		
		</head>
		<header>
	                <h1>Group 10's IM</h1>
		</header>
		
		<?php include "menu.php";?>
		
		<body>
		<?php
			if ($_SESSION["userName"] == "GUEST")
			{
				echo "<br>You must be logged in to use this functionality.";
			}
			else{
				echo "Here are your messages: ". $_SESSION["userName"] ."<br><br>";
				viewMessages($_SESSION["userName"]);
			
		?>

		
		<?php
			}
		?>
		
		</body>

</html>