<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>koko</title>
    <link rel="icon" href="../images/fav.png" type="image/png" sizes="16x16"> 
    
    <link rel="stylesheet" href="../css/main.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/color.css">
    <link rel="stylesheet" href="../css/responsive.css">

   	<script type="text/javascript" src="../js/checks.js"></script>

</head>
<body>
<!--<div class="se-pre-con"></div>-->

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
?>

<div class="theme-layout">
	
	<div class="responsive-header">
		<div class="mh-head first Sticky">
			<span class="mh-text">
				<a href="newsfeed.html" title=""><img src="../images/logo.jpeg" alt=""></a>
			</span>
		</div>
	</div><!-- responsive header -->
	
	<div class="topbar stick">
		<div class="logo">
			<a title="" href="#"><img src="../images/logo.jpeg"alt=""></a>
		</div>
		
		<div class="top-area">
			<ul class="main-menu">
				<li>
					<a href="#" title="">Home</a>
				</li>
				<li>
					<a href="#" title="">timeline</a>
					<ul>
						<li><a href="profile.php" title="">timeline</a></li>
						<li><a href="friends.php" title="">timeline friends</a></li>
						<li><a href="profile-photos.php" title="">timeline photos</a></li>
						<li><a href="profile-videos.php" title="">timeline videos</a></li>
						<li><a href="profile-text.php" title="">timeline text</a></li>
					</ul>
				</li>
				<li>
					<a href="#" title="">account settings</a>
					<ul>
						<li><a href="edit-password.php" title="">edit password</a></li>
						<li><a href="edit-profile-basic.php" title="">edit profile</a></li>
					</ul>
				</li>
				<li></li>
				<li>
					<a href="report.php" title="">Report Issue</a>
				</li>
			</ul>
			<div class="user-img">
				<?php
					echo "<img src='../profilePics/$profilePic' alt='' width='55' height='55'>";
				?>
			</div>
		</div>
	</div><!-- topbar -->
		
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
												<i class="ti-user"></i>
												<a href="profile.php" title="">View profile</a>
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
							</div><!-- sidebar -->
							<div class="col-lg-6">
								<div class="central-meta">
									<div class="new-postbox">
										<figure>
											<?php
												echo "<img src='../profilePics/$profilePic' alt=''>";
											?>
										</figure>
										<div class="newpst-input">
											<form method="post" action="new_post.php" enctype="multipart/form-data">
												<textarea rows="2" placeholder="write something" name="post_area"></textarea>
												<div class="attachments">
													<ul>
														<li>
															<i class="fa fa-image"></i>
															<label class="fileContainer">
																<input type="file" name="image_upload">
															</label>
														</li>
														<li>
															<i class="fa fa-video-camera"></i>
															<label class="fileContainer">
																<input type="file" name="video_upload">
															</label>
														</li>
														<li>
															<button type="submit">Post</button>
														</li>
													</ul>
												</div>
											</form>
										</div>
									</div>
								</div><!-- add post new box -->
								
								<?php
									$result_post = mysqli_query($mysqli, "SELECT * FROM all_posts WHERE username IN (SELECT friend FROM friends WHERE username='$user')
										UNION 
										SELECT * FROM all_posts WHERE username='$user'
										ORDER BY id DESC");
									while ($res = mysqli_fetch_array($result_post)) {
										$id = $res['id'];
										$posts = $res['post'];
										$post_time = $res['post_time'];
										$type = $res['type'];
										$username = $res['username'];
										$likes = $res['likes'];
										$dislikes = $res['dislikes'];
										$result_profilePicp = mysqli_query($mysqli, "SELECT profilePic FROM user_details WHERE username='$username'");
										while ($resProfilep = mysqli_fetch_array($result_profilePicp)) {
											$profilePicp = $resProfilep['profilePic'];
											if (is_null($profilePicp)) {
												$profilePicp = "../images/avatar.png";
											}
										}
										echo "<div class='central-meta item'>";
										echo "<div class='friend-info'>";
										echo "<figure><img src='../profilePics/$profilePicp'></figure>";
										echo "<div class='friend-name'>";
										echo "<ins><a href='time-line.html' title=''>$username</a></ins>";
										echo "<span>published: $post_time</span>";
										echo "</div>";
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
											echo "</div><p>$comment</p></div></li>";
										}
										echo "<li class='post-comment'>";
										echo "<div class='comet-avatar'>";
										echo "<img src='../profilePics/$profilePic' alt=''>";
										echo "</div><div class='post-comt-box'>";
										echo "<form method='post' action='new_comment.php'>";
										echo "<textarea placeholder='Post your comment' name='comment'></textarea>";
										echo "<input name='id' type='hidden' value='$id'>";
										echo "<button type='submit'>Add</button>";
										echo "</form></div></li></ul></div></div>";
									}
								?>
							</div><!-- centerl meta -->
							<div class="col-lg-3">
								<aside class="sidebar static">
									<div class="widget friend-list stick-widget">
										<h4 class="widget-title">Friends</h4>
										<ul id="people-list" class="friendz-list">
											<?php
												$users = mysqli_query($mysqli, "SELECT friend FROM friends WHERE username='$user'");
												while ($res = mysqli_fetch_array($users)) {
													$friend = $res['friend'];
													$result_profilePic = mysqli_query($mysqli, "SELECT profilePic FROM user_details WHERE username='$friend'");
													while ($resProfile = mysqli_fetch_array($result_profilePic)) {
														$profilePic = $resProfile['profilePic'];
														if (is_null($profilePic)) {
															$profilePic = "../images/avatar.png";
														}
													}
											?>

											<li>
												<figure>
													<?php
														echo "<img src='../profilePics/$profilePic' alt=''>";
													?>
												</figure>
												<div class="friendz-meta">
													<a><?php echo "$friend"; ?></a>
												</div>
											</li>
											<?php
												}
												$mysqli -> close();
											?>
										</ul>
									</div><!-- friends list sidebar -->
								</aside>
							</div><!-- sidebar -->
						</div>	
					</div>
				</div>
			</div>
		</div>	
	</section>

</div>	
	
	<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="../js/main.min.js"></script>
	<script src="../js/script.js"></script>
	<script src="../js/map-init.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

<?php
	if (isset($_SESSION['noOfFiles'])) {
		if ($_SESSION['noOfFiles'] == 1) {
			echo "<script>noOfFiles()</script>";
			$_SESSION['noOfFiles'] = 0;
		}
	}
	if (isset($_SESSION['format'])) {
		if ($_SESSION['format'] == 1) {
			echo "<script>format()</script>";
			$_SESSION['format'] = 0;
		}
	}
?>

</body>	
</html>