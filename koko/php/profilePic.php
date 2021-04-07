<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once('config.php');
		session_start();
		$user = $_SESSION['user'];
		$profile = basename($_FILES["profilePic"]["name"]);
		$directory = "../profilePics/";
		$file = $directory.$profile;
		$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
		if ($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png") {
			echo "File format not supported";
		}
		else{
			move_uploaded_file($_FILES['profilePic']['tmp_name'], $file);
			$path_to_profilePic = pathinfo($file, PATHINFO_FILENAME).".".pathinfo($file, PATHINFO_EXTENSION);
			$result = mysqli_query($mysqli, "UPDATE user_details SET profilePic='$path_to_profilePic' WHERE username='$user'");
			$mysqli -> close();
			header("Location: profile.php");
		}
	?>
</body>
</html>