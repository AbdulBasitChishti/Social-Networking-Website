<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once("config.php");
		$idc = $_GET['idc'];
		$result  = mysqli_query($mysqli, "DELETE FROM all_comments WHERE idc=$idc");
		$mysqli -> close();
		header("Location: profile.php");
	?>
</body>
</html>