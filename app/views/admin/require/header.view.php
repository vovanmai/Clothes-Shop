<?php 
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Dashboard - Ace Admin</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	
	<link rel="stylesheet" href="/public/admin/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/public/admin/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	
	<link rel="stylesheet" href="/public/admin/assets/css/bootstrap-duallistbox.min.css" />
	<link rel="stylesheet" href="/public/admin/assets/css/bootstrap-multiselect.min.css" />
	<link rel="stylesheet" href="/public/admin/assets/css/select2.min.css" />

	
	<link rel="stylesheet" href="/public/admin/assets/css/fonts.googleapis.com.css" />

	
	<link rel="stylesheet" href="/public/admin/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	
	<link rel="stylesheet" href="/public/admin/assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="/public/admin/assets/css/ace-rtl.min.css" />
	<link rel="stylesheet" href="/public/admin/assets/css/mystyle.css" />		
	<script src="/public/admin/assets/js/ace-extra.min.js"></script>

	
</head>


<body class="no-skin">
	<div id="navbar" class="navbar navbar-default ace-save-state">
		<div class="navbar-container ace-save-state" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>

			<div class="navbar-header pull-left">
				<a href="index.html" class="navbar-brand">
					<small>
						<i class="fa fa-leaf"></i>
						<?php
						echo $user[0]->fullname;
						?>
					</small>
				</a>
			</div>

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">

					<li class="light-blue dropdown-modal">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="/public/admin/assets/images/avatars/user.jpg" alt="Jason's Photo" />
							<span class="user-info">
								<small>Welcome,</small>
								<?php
								echo $user[0]->username;
								?>
							</span>

							<i class="ace-icon fa fa-caret-down"></i>
						</a>

						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

							<li>
								<a href="/admin/users/edit/<?php  
								echo   $user[0]->id;
								?>" >
								<i class="ace-icon fa fa-user"></i>
								Profile
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="/admin/logout">
								<i class="ace-icon fa fa-power-off"></i>
								Logout
							</a>
						</li>
					</ul>


				</li>
			</ul>
		</div>
	</div><!-- /.navbar-container -->
</div>