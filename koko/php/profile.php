<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Profile</title>
    <link rel="icon" href="../images/fav.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="../css/main.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/color.css">
    <link rel="stylesheet" href="../css/responsive.css">

</head>
<body>

	<?php
		session_start();
		if (!isset($_SESSION['user'])) {
			header("Location: login.php");
		}
		$user = $_SESSION['user'];
		include_once("config.php");
		$result_profilePic = mysqli_query($mysqli, "SELECT profilePic FROM user_details WHERE username='$user'");
		while ($resProfile = mysqli_fetch_array($result_profilePic)) {
			$profilePic = $resProfile['profilePic'];
			if (is_null($profilePic)) {
				$profilePic = "../images/avatar.png";
			}
		}
		$result_coverPic = mysqli_query($mysqli, "SELECT coverPic FROM user_details WHERE username='$user'");
		while ($resCover = mysqli_fetch_array($result_coverPic)) {
			$coverPic = $resCover['coverPic'];
			if (is_null($coverPic)) {
				$coverPic = "../images/avatar.png";
			}
		}
	?>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	
	<div class="responsive-header">
		<div class="mh-head first Sticky">
			<span class="mh-text">
				<a href="../newsfeed.html" title=""><img src="../images/logo.jpeg" alt=""></a>
			</span>
		</div>
	</div><!-- responsive header -->
	
	<div class="topbar stick" style="padding-top: 10px">
		<div class="logo">
			<a title="" href="../newsfeed.html"><img src="../images/logo.jpeg" alt=""></a>
		</div>
	</div><!-- topbar with logout -->
	
	<section>
		<div class="feature-photo">
			<figure>
				<?php
					echo "<img alt='' src='../coverPics/$coverPic'>";
				?>
			</figure>
			<form class="edit-phto" method="post" action="coverPic.php" enctype="multipart/form-data">
				<i class="fa fa-camera-retro"></i>
				<label class="fileContainer">
					Edit Cover Photo
				<input type="file" name="coverPic" onchange="submit()">
				</label>
			</form>
			<div class="container-fluid">
				<div class="row merged">
					<div class="col-lg-2 col-sm-3">
						<div class="user-avatar">
							<figure>

								<?php
									echo "<img alt='' src='../profilePics/$profilePic'>";
								?>

								<form class="edit-phto" method="post" action="profilePic.php" enctype="multipart/form-data">
									<i class="fa fa-camera-retro"></i>
									<label class="fileContainer">
										Edit Display Photo
										<input type="file" name="profilePic" onchange="submit()">
									</label>
								</form>
							</figure>
						</div>
					</div>
					<div class="col-lg-10 col-sm-9">
						<div class="timeline-info">
							<ul>
								<li class="admin-name">
									<?php
										echo "<h5>$user</h5>";
									?>
								</li>
								<li>
									<a data-ripple="" title="" href="#" class="active">time line</a>
									<a data-ripple="" title="" href="profile-photos.php" class="">Photos</a>
									<a data-ripple="" title="" href="profile-videos.php" class="">Videos</a>
									<a data-ripple="" title="" href="profile-text.php" class="">Text</a>
									<a data-ripple="" title="" href="friends.php" class="">Friends</a>
									<a data-ripple="" title="" href="about.php" class="">about</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="row" id="page-contents">
							<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="widget">
										<h4 class="widget-title">Shortcuts</h4>
										<ul class="naves">
											<li>
												<i class="ti-home"></i>
												<a href="index.php" title="">home</a>
											</li>
											<li>
												<i class="fa fa-edit"></i>
												<a href="edit-profile-basic.php" title="">edit profile</a>
											</li>
											<li>
												<i class="ti-image"></i>
												<a href="profile-photos.php" title="">images</a>
											</li>
											<li>
												<i class="ti-video-camera"></i>
												<a href="profile-videos.php" title="">videos</a>
											</li>
											<li>
												<i class="ti-text"></i>
												<a href="profile-text.php" title="">text</a>
											</li>
											<li>
												<i class="fa fa-users"></i>
												<a href="friends.php" title="">friends</a>
											</li>
											<li>
												<i class="ti-id-badge"></i>
												<a href="about.php" title="">about</a>
											</li>
											<li>
												<i class="ti-power-off"></i>
												<a href="logout.php" title="">Logout</a>
											</li>
										</ul>
									</div><!-- Shortcuts -->
								</aside>
							</div>
							<div class="col-lg-8">	
								<?php
									$result_post = mysqli_query($mysqli, "SELECT * FROM all_posts WHERE username='$user'
										UNION
										SELECT * FROM all_posts WHERE id IN (SELECT DISTINCT id FROM all_comments WHERE username='$user')
										ORDER BY id DESC");
									while ($res = mysqli_fetch_array($result_post)) {
										$id = $res['id'];
										$posts = $res['post'];
										$post_time = $res['post_time'];
										$type = $res['type'];
										$username = $res['username'];
										$likes = $res['likes'];
										$dislikes = $res['dislikes'];
										$result_profilePics = mysqli_query($mysqli, "SELECT profilePic FROM user_details WHERE username='$username'");
										while ($resProfiles = mysqli_fetch_array($result_profilePics)) {
											$profilePics = $resProfiles['profilePic'];
											if (is_null($profilePics)) {
												$profilePics = "../images/avatar.png";
											}
										}
										echo "<div class='central-meta item'>";
										echo "<div class='user-post'>";
										echo "<div class='friend-info'>";
										echo "<figure><img src='../profilePics/$profilePics'></figure>";
										echo "<div class='friend-name'>";
										echo "<ins><a href='time-line.html' title=''>$username</a></ins>";
										echo "<span>published: $post_time</span>";
										echo "</div>";
										if ($user == $username) {
											echo "<div style='float: right'>";
											echo "<a class='we-reply' href=\"post-delete.php?id=$id\" onClick=\"return confirm('Are you sure you want to delete this post?')\" title='Delete'><i class='fa fa-trash fa-2x' style='color: red'></i></a></div>";	
										}
										echo "<div class='post-meta'>";
										if ($type == "pic") {
											echo "<img src='../posts/$posts' alt=''>";
										}
										elseif ($type == 'text') {
											echo "$posts";
										}
										elseif ($type == 'video') {
											echo "<video width=100% controls><source src='../posts/$posts'></video>";
										}
										echo "</div></div>";
										?>

										<div class="we-video-info">
											<ul>
												<li>
													<span class="like" data-toggle="tooltip" title="like">
														<?php echo "<a href=\"like.php?id=$id\">"; ?><i class="fa fa-thumbs-up fa-2x"></i></a>
														<ins style="margin-left: 12px; font-size: 15px"><?php echo"$likes";?></ins>
													</span>
												</li>
												<li>
													<span class="dislike" data-toggle="tooltip" title="dislike">
														<?php echo "<a href=\"dislike.php?id=$id\">"; ?><i class="fa fa-thumbs-down fa-2x"></i></a>
														<ins style="margin-left: 12px; font-size: 15px"><?php echo"$dislikes"; ?></ins>
													</span>
												</li>
											</ul>
										</div>

										<?php
										$result_comment = mysqli_query($mysqli, "SELECT * FROM all_comments WHERE id='$id' ORDER BY idc DESC");
										echo "<div class='coment-area'>";
										echo "<ul class='we-comet'>";
										while ($resc = mysqli_fetch_array($result_comment)) {
											$comment = $resc['comment'];
											$comment_date = $resc['comment_date'];
											$usernamec = $resc['username'];
											$idc = $resc['idc'];
											$result_profilePicc = mysqli_query($mysqli, "SELECT profilePic FROM user_details WHERE username='$usernamec'");
											while ($resProfilec = mysqli_fetch_array($result_profilePicc)) {
												$profilePicc = $resProfilec['profilePic'];
												if (is_null($profilePicc)) {
													$profilePicc = "../images/avatar.png";
												}
											}
											echo "<li><div class='comet-avatar'>";
											echo "<img src='../profilePics/$profilePicc' alt=''>";
											echo "</div><div class='we-comment'>";
											echo "<div class='coment-head'>";
											echo "<h5><a href='time-line.html' title=''>$usernamec</a></h5>";
											echo "<span>$comment_date</span>";
											if ($user == $usernamec) {
												echo "<div style='float: right'>";
												echo "<a class='we-reply' href=\"comment-delete.php?idc=$idc\" onClick=\"return confirm('Are you sure you want to delete this comment?')\" title='Delete'><i class='fa fa-trash fa-lg' style='color: red'></i></a></div>";	
											}	
											echo "</div><p>$comment</p></div></li>";
										}
										echo "</ul></div></div></div>";
									}
									$mysqli -> close();
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>	
	
	<script src="../js/main.min.js"></script>
	<script src="../js/script.js"></script>
	<script src="../js/map-init.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</body>	

</html>