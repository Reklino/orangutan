<!doctype html>
<html lang="en" ng-app="app">
<head>
	<meta charset="UTF-8">
	<base href="/" />
	<title>Sleepy Monkey</title>

	<!-- CSS -->
	<link rel="stylesheet" href="stylesheets/screen.css">
	<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.css"> -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> <!-- load fontawesome -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'> <!-- load fonts -->

	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> <!-- load jQuery -->
	<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> load bootstrap js -->
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.5/angular.min.js"></script> <!-- load angular -->
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.5/angular-animate.js"></script> <!-- load angular animate -->
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.5/angular-route.js"></script> <!-- load angular routing -->
	<script src="js/vendor/ui-bootstrap-tpls-0.11.0.js"></script> <!-- load golden grid system -->
	<script src="js/vendor/GGS-custom.js"></script> <!-- load golden grid system -->



	<!-- ANGULAR -->
	<script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
	<script src="js/services/userService.js"></script> <!-- load main user services -->
	<script src="js/services/sortable.js"></script> <!-- load sorting and searching service -->
	<script src="js/services/breadcrumbs.js"></script> <!-- load breadcrumbs service -->
	<script src="js/app.js"></script> <!-- load our application -->


</head>

<body class="container" ng-controller="accessController">

	<div id="secondary" ng-class="sidebar" class="widget-area" role="complementary">
		<div ng-class="sidebar" class="sidebar">
			<ul>
				<li><a href="" ng-href="/"><i class="fa fa-header fa-2x"></i></a></li>
				<li>
					<a href=""><i class="fa fa-code fa-175x"></i></a>
					<ul>
						<li class="nav-label">Landing Pages</li>
					    <li><a ng-href="">New Landing Page</a></li>
					    <li><a ng-href="">Edit Landing Page</a></li>
					    <li><a ng-href="">View Landing Pages</a></li>
					</ul>
				</li>
				<li>
					<a href=""><i class="fa fa-desktop fa-175x"></i></a>
					<ul>
						<li class="nav-label">Site Previews</li>
					    <li><a ng-href="">New Site Preview</a></li>
					    <li><a ng-href="">Edit Site Preview</a></li>
					    <li><a ng-href="">View Site Previews</a></li>
					</ul>
				</li>
				<li>
					<a href=""><i class="fa fa-camera fa-175x"></i></a>
					<ul>
						<li class="nav-label">Ad Previews</li>
					    <li><a ng-href="">New Ad Preview</a></li>
					    <li><a ng-href="">Edit Ad Preview</a></li>
					    <li><a ng-href="">View Ad Previews</a></li>
					</ul>
				</li>
				<li class="toolbar-muted"><a href="" ng-href="/users"><i class="fa fa-child fa-2x"></i></a></li>
				<li class="toolbar-muted"><a href="" ng-href=""><i class="fa fa-flask fa-2x"></i></a></li>
				<li class="toolbar-muted"><a href="" ng-href=""><i class="fa fa-file-text fa-2x"></i></a></li>
				<li class="anchor-bottom toolbar-muted"><a href="" ng-href=""><i class="fa fa-question fa-2x"></i></a></li>
			</ul>
		</div>
	</div>

	<div id="primary" class="content-area">

		<nav id="site-navigation" class="main-navigation" role="navigation">

			<a class="navicon" ng-click="expandSidebar()"><div ng-class="sidebar" class="open-nav"><i></i></div></a>

			<a class="nav-link" ng-href="/">Sleepy Monkey</a>

			<div class="dropdown pull-right" on-toggle="toggled(open)" ng-hide="lvl4">
				<a class="dropdown-toggle" href="">Hi, {{ authUsername }}! <i class="fa fa-chevron-down"></i></a>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a ng-href="/users/{{ authId }}" ng-hide="lvl4" role="button">My Profile</a>
					<li><a ng-href="/password" ng-hide="lvl4" role="button">Change Password</a>
					<li class="divider">
					<li><a href="" ng-model="logout" ng-hide="lvl4" ng-click="logout()" role="button">Logout</a>
				</ul>
			</div>

			<a class="pull-right nav-link" ng-href="/login" ng-model="login" ng-show="lvl4" role="button">Login</a>

		</nav><!-- #site-navigation -->

		<main id="main" class="site-main" role="main">

			<div ng-view></div>

		</main><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="inner">
				<div class="wrapper">
					<ul class="site-footer-links">
						<li><a href="">XXX LPs</a></li>
						<li><a href="">XXX SPs</a></li>
						<li><a href="">XXX APs</a></li>
					</ul>
					<ul class="site-footer-links right">
						<li><a href="">Terms</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="">Help</a></li>
					</ul>
				</div>
			</div>
		</footer><!-- #colophon -->

	</div><!-- #primary -->

</body>
</html>