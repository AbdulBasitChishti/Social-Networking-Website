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
		$cover = basename($_FILES["coverPic"]["name"]);
		$directory = "../coverPics/";
		$file = $directory.$cover;
		$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
		if ($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png") {
			echo "File format not supported";
		}
		else{
			move_uploaded_file($_FILES['coverPic']['tmp_name'], $file);
			$path_to_coverPic = pathinfo($file, PATHINFO_FILENAME).".".pathinfo($file, PATHINFO_EXTENSION);
			$result = mysqli_query($mysqli, "UPDATE user_details SET coverPic='$path_to_coverPic' WHERE username='$user'");
			$mysqli -> close();
			header("Location: profile.php");
		}
	?>
</body>
</html>