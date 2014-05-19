<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">DateClip Admin Panel</a>
		</div>

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<p class="navbar-text"><span class="glyphicon glyphicon-user"></span> Welcome <a class="active"><?php echo $this->session->userdata('name');?></a>! <small>Last login: <?php echo $this->session->userdata('last_login');?></small>.</p>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li <?php echo $page == 'settings' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>settings">Manage Settings</a></li>
						<li <?php echo $page == 'profile' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>home/profile">Profile</a></li>

						<li class="divider"></li>
						<li><a href="<?php echo HTTP_ADMIN_PATH; ?>home/logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>