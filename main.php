<?php
// Start the session
session_start();
?>
<?php
function sendMessage($username,$message){
	$errorMessage = "Invalid username";
	if($username == "GUEST"){
		$errorMessage = "GUEST cannot receive messages.";
		return $errorMessage;
	}
	$file = fopen("users.txt","r");
	   
		while (!feof($file)) {
			$line = fgets($file);
			$arr = explode('-', $line);
			if($arr[0] == $username) {
				$errorMessage = "";
				break;
			}
		}
	fclose($flile);
	
	if($errorMessage == ""){
		$sender = $_SESSION["userName"];
		$file2 = fopen("$username-Messages.txt", "a+");
		fwrite($file2, "\r\n$sender:$message");
		
		fclose($file2);
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
	</nav>
	
	<body>
		<?php
			echo "Welcome to A Highly Ungeneric Instant Messaging Service: ". $_SESSION["userName"] .".<br><br>";
			
		?>
		
		<?php
			if ($_SESSION["userName"] == "GUEST")
			{
				echo "You must be logged in to use this functionality.";
			}
			else{ 
				echo "Send a Message<br><br>";
		?>
		<form id="sendMessage" name="sendMessage" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		USERNAME:  
		<input type="text" name ="username" required>  <br>
		MESSAGE:  
		<input type="message" name="message" required> <br> <br>
		<input type="submit" value="SUBMIT" name="MessageButton" >
		</form>
		

		
	<?php 
  
    if (isset($_POST['MessageButton'])){

		if ($error == "") {
			echo "Message successfully sent.<br><br>";
		}
		else 
			echo $error, "<br><br>";           
    }
	?>
	
	<?php
	}
	?>
	</body>
	
</html>