<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		session_start();
		include_once("config.php");
		$newPass = $_POST['newPass'];
		$conPass = $_POST['conPass'];
		$oldPass = $_POST['oldPass'];
		if ($newPass != $conPass) {
			$_SESSION['match'] = 1;
		}
		else{
			$user = $_SESSION['user'];
			$result = mysqli_query($mysqli, "SELECT Password FROM user WHERE Username='$user'");
			while ($res = mysqli_fetch_array($result)) {
				$pass = $res['Password'];
				if ($oldPass != $pass) {
					$_SESSION['correct'] = 1;
				}
				else{
					$result2 = mysqli_query($mysqli, "UPDATE user SET Password='$newPass' WHERE Username='$user'");
				}
			}
		}
		$mysqli -> close();
		header("Location: edit-password.php");
	?>
</body>
</html>