<?php
// Start the session
session_start();
include 'connect.php';
?>

<?php

//phpinfo();

?>

<?php
function login($username,$password){
	$errorMessage = "";

	 $sql = "SELECT 
			user_name
		FROM
			users
		WHERE
			user_name = '".$username."'
		AND
                        user_pass = '".$password."'";	

	$result = mysql_query($sql);
        if(!$result){
		 $errorMessage = "Somthing went wrong when signing in.";
	}
	else{
		if(mysql_num_rows($result) == 0)
                {
                    $errorMessage= "Invalid username or password.";
                }
		$row = mysql_fetch_assoc($result);
		$_SESSION['userName']  = $row['user_name'];
	}

	 $sql = "UPDATE users
                SET is_signed_in = '1'
                WHERE
                        user_name = '".$_SESSION["userName"]."'";

	$result = mysql_query($sql);
	if(!$result){
                 $errorMessage = "You are signed in, Somthing went wrong when updating is_singed_in variable.";
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
		<a href="upload.php">UPLOAD</a>
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
			echo "$username was successfully logged in.<br><br>";
		
		}
		else 
			echo $error, "<br><br>", mysql_error();           
    }
?>


	</body>
</html>
