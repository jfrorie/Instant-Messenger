<?php
// Start the session
session_start();
include 'connect.php';
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
                body{
		<div align = center>  
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
                        width: 180px;
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
		
		<p> Please register here: </p>
		<form name="register" id="register" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label>USERNAME:</label> 
		<input type="text" name="username" required> <br>
		<label>PASSWORD:</label> 
		<input type="password" name="pass1" id="pass1" required> <br>
		<label>CONFIRM PASSWORD:</label>
		<input type="password" name="pass2" id="pass2" required> <br>
		<input type="submit" value="SUBMIT" name="registerButton">
		</form>
		
		
		
		
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
		
</div>
	</body>
</html>
