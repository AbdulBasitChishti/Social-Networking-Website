<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once("config.php");
		$friend = $_GET['friend'];
		session_start();
		$user = $_SESSION['user'];
		$result = mysqli_query($mysqli, "DELETE FROM friends WHERE username='$user' AND friend='$friend'");
		$result2 = mysqli_query($mysqli, "DELETE FROM friends WHERE username='$friend' AND friend='$user'");
		$mysqli -> close();
		header("Location: friends.php");
	?>
</body>
</html>