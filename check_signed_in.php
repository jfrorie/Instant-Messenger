<?php
include 'connect.php';
	
	$sql = "SELECT * FROM users
                WHERE
                        user_name = '".$_SESSION['userName']."'
		AND
			is_signed_in = '1'";
	
	$result = mysql_query($sql);
	if(!$result){
		echo mysql_error();		
	}
	else{
		//echo "no sql error <br>";
		if(mysql_num_rows($result) == 0){
			//echo "no rows <br>";
			if( $_SESSION['userName'] != GUEST && isset($_SESSION['userName']) ){
			//	echo "not guest<br>";
				$sql = "UPDATE users
                		SET is_signed_in = '0'  
               			WHERE
                        		user_name = '".$_SESSION["userName"]."'";

   	        	     	$result = mysql_query($sql);
        	        	if(!$result){
					echo mysql_error();
        	        	}
	
        	        	// remove all session variables
                		session_unset(); 

                		// destroy the session 
                		session_destroy(); 	
				}
		}
	}

?>
