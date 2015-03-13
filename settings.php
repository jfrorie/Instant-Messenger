<?php
// Start the session
session_start();
?>

<?php
	function settings($oldpass,$password1,$password2){
		$errorMessage = '';
		
		//make sure old password matches records
		$file = fopen("users.txt","r");
		while (!feof($file)) {
			$line = fgets($file);
			$arr = explode('-', $line);
			if($arr[0] == $_SESSION['userName'] && $arr[1] == $oldpass) {
					$flag = true;
			}
		}
		fclose($flile);
		
		if ($flag == false){
			$errorMessage= "*Current password is incorrect.";
			return $errorMessage;
		}
		
		//make sure new password matches
		if (($password1==$password2) && flag == true){
			changePass($oldpass,$password1);
		}
		else {
			$errorMessage= "*Passwords do not match.";
				return $errorMessage;
		}
		
		return $errorMessage;
		
	}
?>

<?php	
	function changePass($oldpass,$password1){
		$newFile = array(); $i = 0;
		$userName = $_SESSION['userName'];
		$file = fopen("users.txt", "r");
		//write the lines you want to keep to an array then append the changed version of line to end, write back to file
		while (!feof($file)) {
			$newFile[$i] = fgets($file);
			++$i;
		}
		fclose($flile);
		$file = fopen("users.txt", "w");
		foreach($newFile as $line) {	
			if (!strstr($line, "$userName-$oldpass" )) fwrite($file, $line);
		}
		fwrite($file, "\r$userName-$password1");
		fclose($file);
		return $i;
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
	</nav>
	
	<body>
		<br>This page will contain resources to change user settings. <br><br><hr><br>
		<?php
			if ($_SESSION["userName"] == "GUEST")
			{
				echo "You must be logged in to use this functionality";
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
				echo $error, "<br><br>";   
			}
		}
		
		?>
	</body>
</html>