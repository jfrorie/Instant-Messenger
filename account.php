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
		<script>
			function checkRegistration() 
			{
				 var pas1 = document.getElementById("pass1").value;
				 var pas2 = document.getElementById("pass2").value;
				 var flag = true;
				 if ((pas1!=pas2)){
					 document.getElementById('passError').innerHTML="*Passwords do not match.";
					 flag= false;
				 }
				var z = document.getElementById("email").value;
				var atpos = z.indexOf("@"); 
				var dotpos = z.lastIndexOf("."); 
				if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=z.length) {
					document.getElementById('emailError').innerHTML="*Email is invalid.";
					flag= false;
				}
				return flag;
			}
		</script>
		
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
		<form id="login" name="login" method="get">
		USERNAME:  
		<input type="text" name ="usernameL" required>  <br>
		PASSWORD:  
		<input type="password" name="passUNSECL" required> <br> <br>
		<input type="submit" value="SUBMIT" >
		</form>
		<br><hr><br>
		
		<p> If you do not have an account please register here:
		<form name="register" id="register" method="post" onsubmit="return checkRegistration()">
		USERNAME: 
		<input type="text" name="usernameR" required> <br>
		EMAIL:
		<input type="text" name="email" id="email" required><div id="emailError"></div>
		PASSWORD:
		<input type="password" name="pass1" id="pass1" required> <br>
		CONFIRM PASSWORD:
		<input type="password" name="pass2" id="pass2" required>
		<div id="passError"></div><br>
		<input type="submit" value="SUBMIT">
		</form>
		<br> <hr>
		
		<?php 
		echo "Username is " . $_SESSION["userName"] .".<br>";
		?>
		
	</body>
</html>