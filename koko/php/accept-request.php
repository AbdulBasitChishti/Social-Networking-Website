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
		$username = $_GET['username'];
		$result = mysqli_query($mysqli, "INSERT INTO friends(username, friend) VALUES ('$user', '$username')") ;
		$result2 = mysqli_query($mysqli, "INSERT INTO friends(username, friend) VALUES ('$username', '$user')") ;
		$result3 = mysqli_query($mysqli, "DELETE FROM friend_requests WHERE sent_to='$user' AND username='$username'");
		$mysqli -> close();
		header("Location: friends.php");
	?>
</body>
</html>