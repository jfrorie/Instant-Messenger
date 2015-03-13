<?php
// Start the session
session_start();
?>
<?php
function login($username,$password){
	$errorMessage = "Invalid username or password";
	$file = fopen("users.txt","r");
	
	while (!feof($file)) {
			$line = fgets($file);
			$arr = explode('-', $line);
<<<<<<< HEAD
			if($arr[0] == $username && $arr[1] == $password) {
=======
			if($arr[0] == $username && $arr[0] ==  $password) {
>>>>>>> origin/master
					$_SESSION['userName'] = $username;
					$errorMessage = "";
			}
	}
	
	return $errorMessage;

	
}
?>

<?php

	if (isset($_POST['loginButton'])){
		
		$username  = $_POST['username'];
		$password = $_POST['password'];
		
        $error = login($username, $password);
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
	</nav>
	
	<body>
		
 <?php
	if( $_SESSION["userName"] == "GUEST"){
	?>
		<p> Please use the following form to login: <br> </p>
		<form id="login" name="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		USERNAME:  
		<input type="text" name ="username" required>  <br>
		PASSWORD:  
		<input type="password" name="password" required> <br> <br>
		<input type="submit" value="SUBMIT" name="loginButton" >
		</form>
		<br><hr><br>
<?php
	}
	else{
?>
	<p> You are logged on as: <?php echo $_SESSION["userName"]; ?> <br> </p>
<?php
	}
?>

<?php 
  
    if (isset($_POST['loginButton'])){

		if ($error == '') {
			echo " $username was successfully logged in.<br><br>";
		
		}
		else 
			echo $error, "<br><br>";           
    }
?>


	</body>
</html>
