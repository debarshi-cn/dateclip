<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li <?php echo $page == 'dashboard' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
    </ul>
    <ul class="nav nav-sidebar">
    	<li class="nav-sidebar-head">Management</li>
    	<li <?php echo $page == 'user' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/users">User Mangement</a></li>
        <li><a href="">Mass Messaging</a></li>
        <li><a href="">CMS</a></li>
        <li><a href="">Flag Mangement</a></li>
        <li><a href="">Coach Mangement</a></li>
        <li><a href="">Credit Plan Mangement</a></li>
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