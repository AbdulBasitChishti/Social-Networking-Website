<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once("config.php");
		session_start();
		$user = $_SESSION['user'];
		$Full_Name = $_POST['Full_Name'];
		$Email = $_POST['Email'];
		$Phone = $_POST['Phone'];
		$DOB = $_POST['DOB'];
		$gender = $_POST['gender'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		$aboutMe = $_POST['aboutMe'];
		$result = mysqli_query($mysqli, "UPDATE user_details SET Full_Name='$Full_Name', Email='$Email', Phone='$Phone', DOB='$DOB', Gender='$gender', City='$city', Country='$country', About_Me='$aboutMe' WHERE username='$user'");
		$mysqli -> close();
		header("Location: about.php");
	?>
</body>
</html>