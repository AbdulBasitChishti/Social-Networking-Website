<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once("config.php");
		$id = $_GET['id'];
		$result = mysqli_query($mysqli, "SELECT dislikes FROM all_posts WHERE id='$id'");
		while ($res = mysqli_fetch_array($result)) {
			$dislikes = $res['dislikes'];
			$result2 = mysqli_query($mysqli, "UPDATE all_posts SET dislikes=$dislikes+1 WHERE id='$id'");
		}
		$mysqli -> close();
		header("Location: index.php");
	?>
</body>
</html>