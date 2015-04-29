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
		label{
                        display: inline-block;
                        width: 100px;
                }
                input {
                        display: inline-block;
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
		<?php
                if ( (!isset($_SESSION["userName"])) || ($_SESSION["userName"] == "GUEST") ){
                        include "menu_guest.php";
                }
                else{
                        include "menu.php";
                }
                ?>


        </header>
        

	<body>
		<div align = center>		

		<?php
			if ($_SESSION["userName"] == "GUEST")
			{
				echo "<br>You must be logged in to use this functionality.";
			}
			else{ 
				echo "<br>Send a message ". $_SESSION["userName"] .".<br><br>";
		?>
		<form id="sendMessage" name="sendMessage" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label>RECIPIENT:</label>  
		<input type="text" name ="username" required>  <br>
		<label>MESSAGE:</label>  
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
	</div>
	</body>
	
</html>
