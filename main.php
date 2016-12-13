<?php
	define("UPLOAD_DIR", "afs/cad.njit.edu/u/t/n/tn64/public_html/UPLOADS/");
	if (!empty($_FILES["myFile"])){
		$myFile = $_FILES["myFile"];
		if($myFile["error"] !== UPLOAD_ERR_OK){
			echo"<p>An error occured.</p>";
			exit;
		}
		$name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
		$i = 0;
		$parts = pathinfo($name);
		while (file_exists(UPLOAD_DIR . $name)) {
			$i++;
			$name = $parts["filename"] . "-" . "." . $parts["extension"];
		}
		$success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);
		if (!success){
			echo "<p>Unable to save file.</p>";
			print_r($_FILES);
			exit;
	}
	chmod(UPLOAD_DIR . $name, 0644);
	echo 'Uploaded '.$name. '.';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<h1><center> Practice with File Uploads </center></h1>
	</head>
	<body>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="myFile">
			<br><br><br>
			<input type="submit" value="Upload!">
		</form>
	</body>
</html>
