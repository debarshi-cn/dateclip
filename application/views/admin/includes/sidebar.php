<div class="col-xs-3 col-sm-3 col-md-2 hidden-print sidebar">
	<ul class="nav nav-sidebar">
		<li <?php echo $page == 'dashboard' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
		<li <?php echo $page == 'settings' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>settings"><span class="glyphicon glyphicon-wrench"></span> Manage Settings</a></li>
    	<li class="nav-sidebar-head">Management</li>
    	<li <?php echo $page == 'user' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>users"><span class="glyphicon glyphicon-user"></span> User Mangement</a></li>
        <li <?php echo $page == 'massmail' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>massmail"><span class="glyphicon glyphicon-envelope"></span> Mass Messaging</a></li>
        <li <?php echo $page == 'cms' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>cms"><span class="glyphicon glyphicon glyphicon-pencil"></span> CMS</a></li>
        <li <?php echo $page == 'flag' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>flag"><span class="glyphicon glyphicon-flag"></span> Flag Mangement</a></li>
        <li <?php echo $page == 'coach' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>coach"><span class="glyphicon glyphicon-tag"></span> Coach Mangement</a></li>
        <li <?php echo $page == 'package' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>package"><span class="glyphicon glyphicon-shopping-cart"></span> Credit Plan Mangement</a></li>
    	<li class="nav-sidebar-head">Reports</li>
    	<li <?php echo $page == 'report-dateclip' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>report/dateclip"><span class="glyphicon glyphicon-facetime-video"></span> Flagged DateClips</a></li>
        <li <?php echo $page == 'report-message' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>report/message"><span class="glyphicon glyphicon-flag"></span> Flagged Messages</a></li>
        <li <?php echo $page == 'report-finance' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>report/finance"><span class="glyphicon glyphicon glyphicon-list-alt"></span> Finance Report</a></li>
        <li <?php echo $page == 'report-credit' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>report/credit"><span class="glyphicon glyphicon-stats"></span> Credit Report</a></li>
    </ul>
</div>