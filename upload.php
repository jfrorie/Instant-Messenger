<?php
session_start();
?>

<html>
	<head>
		<title>Group 10's Instant Messenger</title>
		<style>
		header {
			background-color: black;
			color: white;
			text-align: center;
			padding: 5px;
		}
		nav {
			text-align: center
		}
		body {
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


	<?php
	if($_SESSION["userName"] == "GUEST"){
		echo "<br>You are logged in as a GUEST.<br>You are not allowed to upload files.";
	}
	else{
	?>
	<body>
		<h2>Upload File</h2>
		<form action="upload.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="file" id="file">
			<input type="submit" value="upload" name="sumbit">
		</form>
	
	<br>
	<h2>Uploaded Files</h2>

	<?php
		
		$handle = opendir('uploads/');
	
		if($handle) {
			while(false !== ($entry = readdir($handle))) {
				if($entry != "." && $entry != ".."){
					echo "<a href=\"uploads/$entry\">$entry</a><br>";
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

		$allowed = array('txt', 'pdf', 'doc', 'ppt', 'jpg', 'png', 'jpeg');
	
		$checkUpload = 1;	
		$checkExists = 'uploads/' . $file_name;
		$file_destination = 'uploads/' . $file_name;

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
