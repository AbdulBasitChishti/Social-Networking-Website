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
		$result = mysqli_query($mysqli, "INSERT INTO friend_requests(username, sent_to) VALUES ('$user', '$username')") or die("request not sent");
		$mysqli -> close();
		header("Location: friends.php");
	?>
</body>
</html>