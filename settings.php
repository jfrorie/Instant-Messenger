<?php
// Start the session
session_start();
include 'connect.php';
include 'check_signed_in.php';
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
                        width: 200px;
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
			else{ ?>
			
				<br>Utilize This Form To Change Your Password: <br>
				<form id="settings" name="settings" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<label>New Password:</label>
				<input type="password" name="npass1" id="npass1" required> <br>
				<label>Confirm New Password:</label>
				<input type="password" name="npass2" id="npass2" required> <br>
				<label>Current Password:</label>
				<input type="password" name="opass" id="opass" required> <br><br>
				<input type="submit" value="SUBMIT" name="settingsButton">
				</form>
			<?php } ?>
		
		<br><br>
		
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

		</div>
	</body>
</html>
