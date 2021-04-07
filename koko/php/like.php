<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once("config.php");
		$id = $_GET['id'];
		$result = mysqli_query($mysqli, "SELECT likes FROM all_posts WHERE id='$id'");
		while ($res = mysqli_fetch_array($result)) {
			$likes = $res['likes'];
			$result2 = mysqli_query($mysqli, "UPDATE all_posts SET likes=$likes+1 WHERE id='$id'");
		}
		$mysqli -> close();
		header("Location: index.php");
	?>
</body>
</html>