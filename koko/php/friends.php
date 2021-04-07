<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Friends</title>
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
			<span class="mh-btns-left">
				<a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
			</span>
			<span class="mh-text">
				<a href="../newsfeed.html" title=""><img src="../images/logo2.png" alt=""></a>
			</span>
			<span class="mh-btns-right">
				<a class="fa fa-sliders" href="#shoppingbag"></a>
			</span>
		</div>
		<div class="mh-head second">
			<form class="mh-form">
				<input placeholder="search" />
				<a href="#/" class="fa fa-search"></a>
			</form>
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
									<a data-ripple="" title="" href="profile.php" class="">time line</a>
									<a data-ripple="" title="" href="profile-photos.php" class="">Photos</a>
									<a data-ripple="" title="" href="profile-videos.php" class="">Videos</a>
									<a data-ripple="" title="" href="profile-text.php" class="">Text</a>
									<a data-ripple="" title="" href="#" class="active">Friends</a>
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
								<div class="central-meta">
									<div class="frnds">
										<ul class="nav nav-tabs">
											 <li class="nav-item"><a class="active" href="#frends" data-toggle="tab">My Friends</a></li>
											 <li class="nav-item"><a class="" href="#frends-req" data-toggle="tab">Friend Requests</a></li>
											 <li class="nav-item"><a class="" href="#sent-reqs" data-toggle="tab">Sent Requests</a></li>
										</ul>
										<div class="tab-content">
										  <div class="tab-pane active fade show " id="frends" >
											<ul class="nearby-contct">
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
															<div class="nearly-pepls">
																<figure>
																	<?php
																		echo "<a href='' title=''><img src='../profilePics/$profilePic' alt=''></a>";
																	?>
																</figure>
																<div class="pepl-info">
																	<h4><a href="time-line.html" title=""><?php echo "$friend"; ?></a></h4>
																	<?php
																	echo "<a href='unfriend.php?friend=$friend' title='' class='add-butn more-action' data-ripple=''>unfriend</a>";
																	?>
																</div>
															</div>
														</li>
														<?php
													}
												?>
											</ul>
										</div>
										<div class="tab-pane active fade hide " id="frends-req" >
											<ul class="nearby-contct">
												<?php
													$requesters = mysqli_query($mysqli, "SELECT username FROM friend_requests WHERE sent_to='$user'");
													while ($requester = mysqli_fetch_array($requesters)) {
														$username = $requester['username'];
														$result_profilePic = mysqli_query($mysqli, "SELECT profilePic FROM user_details WHERE username='$username'");
														while ($resProfile = mysqli_fetch_array($result_profilePic)) {
															$profilePic = $resProfile['profilePic'];
															if (is_null($profilePic)) {
																$profilePic = "../images/avatar.png";
															}
														}
														?>
														<li>
															<div class="nearly-pepls">
																<figure>
																	<?php
																		echo "<a href='' title=''><img src='../profilePics/$profilePic' alt=''></a>";
																	?>
																</figure>
																<div class="pepl-info">
																	<h4><a href="time-line.html" title=""><?php echo "$username"; ?></a></h4>
																	<?php
																		echo "<a href='accept-request.php?username=$username' title='' class='add-butn' data-ripple=''>accept</a>";
																	?>
																</div>
															</div>
														</li>
														<?php
													}
													echo "<hr style=\"border-width: 10px; background: lightblue; opacity: 0.5\">";
													$users = mysqli_query($mysqli, "SELECT Username FROM user WHERE Username<>'$user' AND Username NOT IN (SELECT username FROM friend_requests WHERE sent_to='$user') AND Username NOT IN (SELECT friend FROM friends WHERE username='$user') AND Username NOT IN (SELECT sent_to FROM friend_requests WHERE username='$user')");
													while ($res = mysqli_fetch_array($users)) {
														$username = $res['Username'];
														$result_profilePic = mysqli_query($mysqli, "SELECT profilePic FROM user_details WHERE username='$username'");
														while ($resProfile = mysqli_fetch_array($result_profilePic)) {
															$profilePic = $resProfile['profilePic'];
															if (is_null($profilePic)) {
																$profilePic = "../images/avatar.png";
															}
														}
														?>
														<li>
															<div class="nearly-pepls">
																<figure>
																	<?php
																		echo "<a href='' title=''><img src='../profilePics/$profilePic' alt=''></a>";
																	?>
																</figure>
																<div class="pepl-info">
																	<h4><a href="time-line.html" title=""><?php echo "$username"; ?></a></h4>
																	<?php
																		echo "<a href='send-request.php?username=$username' title='' class='add-butn' data-ripple=''>add friend</a>";
																	?>
																</div>
															</div>
														</li>
														<?php
													}
												?>
											</ul>
										</div>
										<div class="tab-pane active fade hide " id="sent-reqs" >
											<ul class="nearby-contct">
												<?php
													$requests = mysqli_query($mysqli, "SELECT sent_to FROM friend_requests WHERE username='$user'");
													while ($request = mysqli_fetch_array($requests)) {
														$username = $request['sent_to'];
														$result_profilePic = mysqli_query($mysqli, "SELECT profilePic FROM user_details WHERE username='$username'");
														while ($resProfile = mysqli_fetch_array($result_profilePic)) {
															$profilePic = $resProfile['profilePic'];
															if (is_null($profilePic)) {
																$profilePic = "../images/avatar.png";
															}
														}
														?>
														<li>
															<div class="nearly-pepls">
																<figure>
																	<?php
																		echo "<a href='' title=''><img src='../profilePics/$profilePic' alt=''></a>";
																	?>
																</figure>
																<div class="pepl-info">
																	<h4><a href="time-line.html" title=""><?php echo "$username"; ?></a></h4>
																</div>
															</div>
														</li>
														<?php
													}
													$mysqli -> close();
												?>
											</ul>
										</div>
									  </div>
									</div>
								</div>
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