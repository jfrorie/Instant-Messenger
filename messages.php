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
                        margin: 0px; 
                        color: white;
                        background-image: url("background8.jpg");
                        background-size:cover;
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

                <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
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
				echo "Here are your messages: ". $_SESSION["userName"] ."<br><br>";
				viewMessages($_SESSION["userName"]);
			
		?>

		
		<?php
			}
		?>
		
		</div>
		</body>

</html>
