<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include_once("config.php");
		date_default_timezone_set("Asia/Karachi");
		$post_time = date("F d-Y  g:i A");
		$image = basename($_FILES["image_upload"]["name"]);
		$video = basename($_FILES["video_upload"]["name"]);
		$post_area = $_POST['post_area'];
		session_start();
   		$user = $_SESSION['user']; 
        if ($image != null &&  $video == null && $post_area == null) {
			$directory = "../posts/";
			$file = $directory.$image;
			$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
			if ($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png") {
				$_SESSION['format']=1;
			}
			else {
				move_uploaded_file($_FILES["image_upload"]["tmp_name"], $file);
				$path_to_post = pathinfo($file, PATHINFO_FILENAME).".".pathinfo($file, PATHINFO_EXTENSION);
				mysqli_query($mysqli, "INSERT INTO all_posts (post, type, post_time, username) VALUES ('$path_to_post', 'pic', '$post_time', '$user')");
				$mysqli -> close();
			}			
		}	

		elseif ($video != null &&  $image == null && $post_area == null) {
			$directory = "../posts/";
			$file = $directory.$video;
			$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
			if ($file_type != "mp4" && $file_type != "mkv" && $file_type != "mov" && $file_type != "avi" && $file_type != "gif" && $file_type != "webm") {
				$_SESSION['format']=1;
			}
			else {
				move_uploaded_file($_FILES["video_upload"]["tmp_name"], $file);
				$path_to_post = pathinfo($file, PATHINFO_FILENAME).".".pathinfo($file, PATHINFO_EXTENSION);
				mysqli_query($mysqli, "INSERT INTO all_posts (post, type, post_time, username) VALUES ('$path_to_post', 'video', '$post_time', '$user')");
				$mysqli -> close();
			}			
		}

		elseif ($post_area != null && $video == null &&  $image == null) {
				mysqli_query($mysqli, "INSERT INTO all_posts (post, type, post_time, username) VALUES ('$post_area', 'text', '$post_time', '$user')");
				$mysqli -> close();		
		}

		elseif (($image != null && $video != null) || ($image != null && $post_area != null) || ($post_area != null && $video != null)) {
			$_SESSION['noOfFiles']=1;
		}	
		header("Location: index.php");
	?>
</body>
</html>