<?php
// Start the session
session_start();
?>
<?php
	function register($username,$password1,$password2){ 

		$errorMessage = '';
				  
		if (($password1!=$password2)){
			$errorMessage= "*Passwords do not match.";
				return $errorMessage;
		}
		
		$file = fopen("users.txt","a+");
	    rewind($file);
		while (!feof($file)) {
			$line = fgets($file);
			$arr = explode('-', $line);
			if($arr[0] == $username) {
				$errorMessage = "*Username taken.";
				break;
			}
		}
				  
	    if($errorMessage == ''){
			$file = fopen("users.txt","a+");
					
			fwrite($file, "\r\n$username-$password1");
					
			 }
			fclose($flile);
			return $errorMessage;
			}
?>

<?php
	if (isset($_POST['registerButton'])){
			$username  = $_POST['username'];
			$password1 = $_POST['pass1'];
			$password2 = $_POST['pass2'];
			$error = register($username,$password1,$password2);
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
			text-align: center;
		}
		.error {color: #FF0000;}
		</style>
		
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
		
		
		<p> Please register here:
		<form name="register" id="register" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		USERNAME: 
		<input type="text" name="username" required> <br>
		PASSWORD:
		<input type="password" name="pass1" id="pass1" required> <br>
		CONFIRM PASSWORD:
		<input type="password" name="pass2" id="pass2" required>
		<input type="submit" value="SUBMIT" name="registerButton">
		</form>
		<br> <hr>
		
		
		
		
<?php 
  
    if (isset($_POST['registerButton'])){

		if ($error == '') {
			echo " $username was successfully registered.<br><br>";
		}
		else 
			echo $error, "<br><br>";           
    }
?>
		<?php 
		if (!isset($_SESSION["userName"]))
		{
		$_SESSION["userName"] = "GUEST";
		}
		echo "Username is " . $_SESSION["userName"] .".<br>";
		?>
		
	</body>
</html>