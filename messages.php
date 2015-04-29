<?php
// Start the session
session_start();
include 'check_signed_in.php';
?>
<?php
function viewMessages($username){
	
	
	$file = fopen("/var/www/html/Instant-Messenger/messages/$username-Messages.txt","r");
	if($file){
		while (!feof($file)) {
			$line = fgets($file);
			echo $line, "<br>";
		}
		
		fclose($file);
	}
	
	else{
		echo "You have no messages.<br><br><br>";
	}
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
			else{
				echo "<br>Here are your messages: ". $_SESSION["userName"] ."<br><br>";
				viewMessages($_SESSION["userName"]);
			
		?>

		
		<?php
			}
		?>
		
		</div>
		</body>

</html>
