<?php
session_start();
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
        

	<?php
	if($_SESSION["userName"] == "GUEST"){
		echo "<br>You are logged in as a GUEST.<br>You are not allowed to upload files.";
	}
	else{
	?>
	<body>
		<h2>Upload File</h2>
		<p><b>Allowed file formats: txt, pdf, doc, docx, ppt, pptx, jpg, png</b></p>
		<form action="upload.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="file" id="file">
			<input type="submit" value="upload" name="sumbit">
		</form>
	
	<br>
	<h2>Uploaded Files</h2>
	<?php

		$dir ="/var/www/html/Instant-Messenger/uploads/" .  $_SESSION["userName"] . "/";
		$dir_temp = "/Instant-Messenger/uploads/" . $_SESSION["userName"] . "/";
		if(!file_exists($dir)){
			mkdir($dir,0777);
		}

		$handle = opendir($dir);
	
		if($handle) {
			while(false !== ($entry = readdir($handle))) {
				if($entry != "." && $entry != ".."){
					echo "<a href=\"$dir_temp$entry\">$entry</a><br>";
				}
			}
			closedir($handle);
		}
	?>
	<br>
	<?php
	if(isset($_FILES['file'])){
		$file = $_FILES['file'];
	
		$file_name = $file['name'];
		$file_temp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));
		$allowed = array('txt', 'pdf', 'doc', 'ppt', 'jpg', 'png', 'jpeg','docx', 'pptx');
	
		$checkUpload = 1;	
		$checkExists = $dir . $file_name;
		$file_destination = $dir . $file_name;
		if($file_name == NULL){
			echo "Select a file";
		}
		else{
			if($file_error === 0){
				$checkUpload = 1;
			}
			else{
				echo "<br>There was an error with the file.";
				$checkUpload = 0;
			}
			if(file_exists($checkExists)){
				echo "<br>A file with the same name already exists.";
				echo "<br>Change name of file if you still wish to upload.";
				$checkUpload = 0;
			}
		
			if($file_size > 2097152) {
				echo "<br>File size is too big.";
				$checkUpload = 0;
			}
	
			if(!in_array($file_ext, $allowed)){	
				echo "<br>File type not allowed.";
				echo " ";
				$checkUpload = 0;
			}
			if($checkUpload == 0){
				echo "<br>File was not uploaded.";
			}
			else{
				if(move_uploaded_file($file_temp, $file_destination)){
					echo "<br>The file " . $file_name . " has been uploaded.";
					echo"<br><a href='upload.php'>Click to see updated list</a>";
				}
				else{
					echo "<br>File was not uploaded.";
				}
			}
		}
	}
}
	?>
	</body>
</html>

