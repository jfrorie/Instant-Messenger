<?php
// Start the session
session_start();
include 'connect.php';
?>

<?php
function sendMessage($username,$message){
	$errorMessage = "";
	if($username == "GUEST"){
		$errorMessage = "GUEST cannot receive messages.";
		return $errorMessage;
	}
	$sql = "SELECT 
                        user_name
                FROM
                        users
                WHERE
                        user_name = '".$username."'";
        $result = mysql_query($sql);
        if(!$result){
                 $errorMessage = "Somthing went wrong when sending the message.";
        }
        else{
                if(mysql_num_rows($result) == 0)
                {
                    $errorMessage= "Invalid username";
                }
        }
	if($errorMessage == ""){
		//echo "message: ", $message, "<br>";
		$sender = $_SESSION["userName"];
		//$file = fopen("/var/wwww/html/Instant-Messenger/messages/$username-Messages.txt", "a+");
		$file = fopen("/var/www/html/Instant-Messenger/messages/$username-Messages.txt", "a+");
		if(!$file){
			$errorMessage = "File failed to open or be created.";
		}
		fwrite($file, "\r\n$sender:$message");
		
		fclose($file);
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
				echo "Send a message ". $_SESSION["userName"] .".<br><br>";
		?>
		<form id="sendMessage" name="sendMessage" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		RECIPIENT:  
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
			echo $error, "<br><br>", mysql_error();           
    }
	?>
	
	<?php
	}
	?>
	</body>
	
</html>