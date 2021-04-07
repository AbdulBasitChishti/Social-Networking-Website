<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once("config.php");
		$id = $_GET['id'];
		$result = mysqli_query($mysqli, "DELETE FROM all_posts WHERE id=$id");
		$result2  = mysqli_query($mysqli, "DELETE FROM all_comments WHERE id=$id");
		$mysqli -> close();
		header("Location: profile.php");
	?>
</body>
</html>