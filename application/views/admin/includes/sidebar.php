<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li <?php echo $page == 'dashboard' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
    </ul>
    <ul class="nav nav-sidebar">
    	<li class="nav-sidebar-head">Management</li>
    	<li <?php echo $page == 'user' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>users">User Mangement</a></li>
        <li <?php echo $page == 'massmail' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>massmail">Mass Messaging</a></li>
        <li><a href="">CMS</a></li>
        <li <?php echo $page == 'flag' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>flag">Flag Mangement</a></li>
        <li <?php echo $page == 'coach' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>coach">Coach Mangement</a></li>
        <li <?php echo $page == 'package' ? 'class="active"' : '' ?>><a href="<?php echo HTTP_ADMIN_PATH; ?>package">Credit Plan Mangement</a></li>
    </ul>
    <ul class="nav nav-sidebar">
    	<li class="nav-sidebar-head">Reports</li>
    	<li><a href="">Flagged DateClips</a></li>
        <li><a href="">Flagged Messages</a></li>
        <li><a href="">Finance Report</a></li>
        <li><a href="">Credit Report</a></li>
    </ul>
    <ul class="nav nav-sidebar">
    	<li class="nav-sidebar-head">Settings</li>
        <li><a href="">Credit Settings</a></li>
        <li><a href="">Homepage Settings</a></li>
        <li><a href="">Facebook Settings</a></li>
    </ul>
</div>