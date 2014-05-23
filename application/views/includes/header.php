<h1><a href="<?php echo site_url();?>">DateClip.com</a></h1>

<?php if ($this->session->userdata('LOGGED_IN')):?>
<div class="col-lg-12">
	<img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?php echo $this->session->userdata('fb_user_id'); ?>/picture?type=large" style="width:80px; height:70px;">
	<h4><?php echo $user_data['full_name']; ?>, <?php echo $user_data['age']; ?></h4>
	<h5><?php echo $user_data['credit'];?> Passion Points</h5>
</div>
<?php //print_r($user_data);?>
<ul>
	<li><a href="<?php echo site_url("dateclip");?>">Edit Dateclip</a></li>
	<li><a href="<?php echo site_url("search");?>">Search Settings</a></li>
	<li><a href="<?php echo site_url("search");?>">Invite Friends</a></li>
	<li><a href="<?php echo site_url("search");?>">Get Passion Points</a></li>
	<li><a href="javascript:LogoutFacebook();">Logout</a></li>
</ul>

<?php else: ?>
<a href="<?php echo $login_url; ?>" class="btn btn-lg btn-primary btn-block" role="button">Login with Facebook</a>
<?php endif; ?>