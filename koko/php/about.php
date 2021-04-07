<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>About</title>
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
									<a data-ripple="" title="" href="friends.php" class="">Friends</a>
									<a data-ripple="" title="" href="#" class="active">about</a>
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
									<h4 class="widget-title">Edit info</h4>
									<ul class="naves">
										<li>
											<i class="ti-info-alt"></i>
											<a title="" href="edit-profile-basic.php">Basic info</a>
										</li>
										<li>
											<i class="ti-lock"></i>
											<a title="" href="edit-password.php">change password</a>
										</li>
									</ul>
								</div>									
								</aside>
							</div><!-- sidebar -->
							<div class="col-lg-8">
								<div class="central-meta">
									<div class="about">
										<div class="personal">
											<h5 class="f-title"><i class="ti-info-alt"></i> Personal Info</h5>
											<?php
												$result = mysqli_query($mysqli, "SELECT * FROM user_details WHERE username='$user'");
												while ($res = mysqli_fetch_array($result)) {
													$name = $res['Full_Name'];
													$email = $res['Email'];
													$phone = $res['Phone'];
													$address = $res['City'].", ".$res['Country'];
													$aboutMe = $res['About_Me'];
													$gender = $res['Gender'];
												}
											?>
											<p><?php echo "$aboutMe"; ?></p>
										</div>
										<div class="d-flex flex-row mt-2">
											<div class="tab-content">
												<div class="tab-pane fade show active" id="basic" >
													<ul class="basics">
														<li><i class="ti-user"></i><?php echo"$name"; ?></li>
														<li><i class="ti-map-alt"></i><?php echo"$address"; ?></li>
														<li><i class="ti-mobile"></i><?php echo"$phone"; ?></li>
														<li style="text-transform: none"><i class="ti-email"></i><?php echo"$email"; ?></li>
														<li><i class="fa fa-transgender"></i><?php echo "$gender"; ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>	
							</div><!-- centerl meta -->
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