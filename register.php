<?php
// Start the session
session_start();
include 'connect.php';
include 'check_signed_in.php';
?>
<?php
	function register($username,$password1,$password2){ 

		$errorMessage = '';
				  
		if (($password1!=$password2)){
			$errorMessage= "*Passwords do not match.";
				return $errorMessage;
		}
		
		$sql = "INSERT INTO users(user_name, user_pass, is_signed_in)
				VALUES('".$username."' , '".$password1."' , 0)";
                         
        	$result = mysql_query($sql);
		
		if(!$result) {
            		$errorMessage = 'Something went wrong while registering.';
        	}
        	
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
                <meta charset="utf-8">

                <title> Group 10's Instant Messenger </title>
                <style>
                header { 
                        background:#1E1E1E;
                        color: white;
                        text-align: center;
                        padding: 5px;
                }
                </style>
                
                <?php
                if (!isset($_SESSION["userName"]))
                {
                $_SESSION["userName"] = "GUEST";
                }
                ?>
                <link rel="stylesheet" type="text/css" href="cb_style.css">
                <script type="text/javascript" src="chatjax.js"></script>

                <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.css" rel="stylesheet">
                <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
        </head>
        <header>
                <h1>Group 10's IM</h1>
                <?php include "menu.php";?>

        </header>
        

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
			echo $error, "<br><br>", mysql_error();
	    	}
?>
		<?php 
		if (!isset($_SESSION["userName"]))
		{
		$_SESSION["userName"] = "GUEST";
		}
		?>
		
	</body>
</html>
