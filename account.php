<?php
// Start the session
session_start();
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
		if (!empty($_REQUEST["usernameL"] )) 
		{
		$_SESSION["userName"] = $_REQUEST["usernameL"];
		}
		else if (!empty($_REQUEST["usernameR"])) 
		{	
		$_SESSION["userName"] = $_REQUEST["usernameR"];
		}
		else if (!isset($_SESSION["userName"]))
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
		<a href="account.php">REGISTER/LOGIN</a>
		<a href="logout.php">LOGOUT</a>
	</nav>
	
	<body>
		
     
		<p> If you already have an account please use the following form to login: <br> </p>
		<form id="login method="get">
		USERNAME:  
		<input type="text" name ="usernameL">  <br>
		PASSWORD:  
		<input type="password" name="passUNSECL"> <br> <br>
		<input type="submit" value="SUBMIT" >
		</form>
		<br><hr><br>
		
		<p> If you do not have an account please register here:
		<form id="register" method="post" >
		USERNAME: 
		<input type="text" name="usernameR" required> <br>
		EMAIL:
		<input type="text" name="emailR" required><br>
		PASSWORD:
		<input type="password" name="pass1" required> <br>
		CONFIRM PASSWORD:
		<input type="password" name="pass2" required> <br> <br>
		<input type="submit" value="SUBMIT">
		</form>
		<br> <hr>
		
		<?php 
		echo "Username is " . $_SESSION["userName"] .".<br>";
		?>
		
	</body>
</html>