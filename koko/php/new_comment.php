<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once("config.php");
		date_default_timezone_set("Asia/Karachi");
		$comment = $_POST['comment'];
		$id = $_POST['id'];
		$date = date("F d-Y");
		session_start();
		$user = $_SESSION['user'];
		mysqli_query($mysqli, "INSERT INTO all_comments (id, comment, comment_date, username) VALUES ('$id', '$comment', '$date', '$user')");
		$mysqli -> close();
		header("Location: index.php");
	?>
</body>
</html>