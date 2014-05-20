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
				<p class="navbar-text">Welcome <a class="active"><?php echo $this->session->userdata('name');?></a></p>
				<!-- ! <small>. -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="optional <?php echo $page == 'dashboard' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
						<li <?php echo $page == 'settings' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>settings"><span class="glyphicon glyphicon-wrench"></span> Manage Settings</a></li>
						<li <?php echo $page == 'profile' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>home/profile"><span class="glyphicon glyphicon-lock"></span> Profile</a></li>
						<li class="optional divider"></li>
				    	<li class="optional <?php echo $page == 'user' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>users"><span class="glyphicon glyphicon-user"></span> User Mangement</a></li>
				        <li class="optional <?php echo $page == 'massmail' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>massmail"><span class="glyphicon glyphicon-envelope"></span> Mass Messaging</a></li>
				        <li class="optional <?php echo $page == 'cms' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>cms"><span class="glyphicon glyphicon glyphicon-pencil"></span> CMS</a></li>
				        <li class="optional <?php echo $page == 'flag' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>flag"><span class="glyphicon glyphicon-flag"></span> Flag Mangement</a></li>
				        <li class="optional <?php echo $page == 'coach' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>coach"><span class="glyphicon glyphicon-tag"></span> Coach Mangement</a></li>
				        <li class="optional <?php echo $page == 'package' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>package"><span class="glyphicon glyphicon-shopping-cart"></span> Credit Plan Mangement</a></li>
				    	<li class="optional divider"></li>
				    	<li class="optional <?php echo $page == 'report-dateclip' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>report/dateclip"><span class="glyphicon glyphicon-facetime-video"></span> Flagged DateClips</a></li>
				        <li class="optional <?php echo $page == 'report-message' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>report/message"><span class="glyphicon glyphicon-flag"></span> Flagged Messages</a></li>
				        <li class="optional <?php echo $page == 'report-finance' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>report/finance"><span class="glyphicon glyphicon-list-alt"></span> Finance Report</a></li>
				        <li class="optional <?php echo $page == 'report-credit' ? 'active' : '' ?>"><a href="<?php echo HTTP_ADMIN_PATH; ?>report/credit"><span class="glyphicon glyphicon-stats"></span> Credit Report</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo HTTP_ADMIN_PATH; ?>home/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>