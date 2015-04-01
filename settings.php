<?php
// Start the session
session_start();
include 'connect.php';
?>

<?php
	function settings($oldpass,$password1,$password2){
		$errorMessage = '';

		//Check if oldpass is correct
		$sql = "SELECT 
                        user_name
                FROM
                        users
                WHERE
                        user_pass = '".$oldpass."'";

	        $result = mysql_query($sql);
        	if(!$result){
                	 $errorMessage = "Somthing went wrong with the sql.";
        	}

        	else{
                	if(mysql_num_rows($result) == 0) {
				$errorMessage= "Current password is incorrect.";
                        	return $errorMessage;
                	}
        	}

		//make sure new password matches
		if (($password1==$password2)){
			changePass($oldpass,$password1);
		}
		else {
			$errorMessage= "Passwords do not match.";
				return $errorMessage;
		}		
		return $errorMessage;
		
	}
?>

<?php	
	function changePass($oldpass,$password1){
		$sql = "UPDATE users
              	SET user_pass = '".$password1."'
                WHERE
                        user_name = '".$_SESSION["userName"]."'";     

                $result = mysql_query($sql);         
                if(!$result){   
                         $errorMessage = "Somthing went wrong with the sql.";
                }

                else{
                        if(mysql_num_rows($result) == 0) {
                                $errorMessage= "Username dose not exsit.";
                                return $errorMessage;
                        }
                }

	}
?>

<?php
	if (isset($_POST['settingsButton'])){
			$oldpass  = $_POST['opass'];
			$password1 = $_POST['npass1'];
			$password2 = $_POST['npass2'];
			$error = settings($oldpass,$password1,$password2);
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
		<br>This page will contain resources to change user settings. <br><br><hr><br>
		<?php
			if ($_SESSION["userName"] == "GUEST")
			{
				echo "You must be logged in to use this functionality.";
			}
			else{ ?>
			
				Utilize This Form To Change Your Password: <br>
				<form id="settings" name="settings" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				New Password:
				<input type="password" name="npass1" id="npass1" required> <br>
				Confirm New Password:
				<input type="password" name="npass2" id="npass2" required> <br>
				Enter Current Password to Alter Settings:
				<input type="password" name="opass" id="opass" required> <br>
				<input type="submit" value="SUBMIT" name="settingsButton">
				</form>
			<?php } ?>
		
		<br><hr><br>
		
		<?php 
  
		if (isset($_POST['settingsButton'])){
			if ($error == '') {
				echo "Settings were successfully changed.<br><br>";
			}
			else {
				echo $error, "<br><br>", mysql_error();   
			}
		}
		
		?>
	</body>
</html>
