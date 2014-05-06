<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
    <title>DateClip Admin Panel</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
     <link href="<?php echo HTTP_CSS_PATH; ?>fam-icons.css" rel="stylesheet">
  </head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url(); ?>admin/dashboard">DateClip Admin Panel</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li <?php echo $page == 'dashboard' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Credit</a></li>
							<li><a href="#">Homepage</a></li>
							<li><a href="#">Facebook</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Profile</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo base_url(); ?>admin/home/logout">Logout</a></li>
						</ul>
					</li>
					<li><a href="#">Help</a></li>
				</ul>
			</div>
		</div>
    </div>