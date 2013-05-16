<!DOCTYPE html>
<html>
<head>
	<title>Platypus</title>

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu|Anonymous+Pro' rel='stylesheet'/>
	<link rel="stylesheet" href="<?php echo THEME_URL; ?>/css/fonts/HVD-Comic-Serif-Pro-fontfacekit/stylesheet.css" />
	<!-- Stylesheets -->
	<!-- 	jQuery UI -->
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/ui-lightness/jquery-ui.min.css" />
    <!-- 	My Style -->
	<link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>/css/style.css" />
	<!-- 	Tags Input -->
	<link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>/css/jquery.tagit.css" />
	<!-- 	iCheck and iRadio -->
	<link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>/css/flat/_all.css" />
	<!-- 	MultiSelect jQuery -->
	<link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>/css/jquery.multiselect.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>/css/jquery.multiselect.filter.css" />


	<!-- Scripts -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

	<!-- 	jQuery Multiselect Widget -->
    <script type="text/javascript" src="<?php echo THEME_URL; ?>/js/jquery.multiselect.js"></script>
    <script type="text/javascript" src="<?php echo THEME_URL; ?>/js/jquery.multiselect.filter.js"></script>
    
    <!-- 	Tag It -->
	<script type="text/javascript" src="<?php echo THEME_URL; ?>/js/tag-it.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_URL; ?>/js/jquery.icheck.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_URL; ?>/js/Chart.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_URL; ?>/js/prefixfree.min.js"></script>
	
</head>
<body>
	<a class="backToTop" style="opacity: 1; display: block; position: fixed; bottom: 4px;"></a>
	<div class="topBar">
		<div id="logo"><a href="<?php echo URL; ?>">Platypus</a></div>
		<?php if (is_user_logged_in()): ?>
		<div class="menu">
			<a href="<?php echo URL; ?>">Home</a>
			<a href="<?php echo URL; ?>/my-courses">My Courses</a>
			<a href="<?php echo URL; ?>/explore">Explore</a>
		</div>
		<div class="searchContainer">
			<input class="search" type="text" placeholder="Search" />
		</div>
		<div id="loginLinkContainer">
			<a class="notifications">3</a>
			<div class="loginWelcome">
				<a class="target">Welcome, <?php echo $_SESSION['name']; ?></a>
				<div class="welcomeScreen">
					<div class="sageata"></div>
					<div class="welcomeContainer">
						<ul>
							<li><a href="<?php echo URL; ?>/account-settings">Account Settings</a></li>
							<li><a href="<?php echo URL; ?>/my-courses">My Courses</a></li>
							<li><a href="<?php echo URL; ?>/favorites">Favorites</a></li>
							<li><a href="<?php echo URL; ?>/add-course">Add Course</a></li>
							<li><a href="<?php echo URL; ?>/log-out">Log Out</a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
		<?php else: ?>
		<div id="loginLinkContainer">
			<a class="loginLink">Login/Register</a>
		</div>
		<?php endif; ?>
	</div>
	<div id="pattern"></div>