<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li class="active">Manage Settings</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-wrench"></span> Manage Settings</h1>

	<?php
		if ($this->session->flashdata('message_type')) {
			if($this->session->flashdata('message')) {

				echo '<div class="alert alert-'.$this->session->flashdata('message_type').' alert-dismissable">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				echo $this->session->flashdata('message');
				echo '</div>';
			}
		}
	?>

		<p>&nbsp;</p>
		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#site" data-toggle="tab">Site</a></li>
			<li><a href="#home" data-toggle="tab">Home Page</a></li>
			<li><a href="#credit" data-toggle="tab">Credit</a></li>
			<li><a href="#payment" data-toggle="tab">Payment Gateway</a></li>
			<li><a href="#video" data-toggle="tab">Video</a></li>
			<li><a href="#fb" data-toggle="tab">Facebook</a></li>
	  	</ul>

	  	<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'settings', $attributes);
      	?>
		<div class="tab-content">

			<div class="tab-pane active" id="site">

				<p>&nbsp;</p>
				<div class="form-group">
					<label for="inputSiteName">Site Name</label>
					<input type="text" class="form-control" id="inputSiteName" name="settings[site_name]" value="<?php echo $settings['site_name']; ?>">
				</div>

				<div class="form-group">
					<label for="inputGMail">General Email</label>
					<input type="text" class="form-control" id="inputGMail" name="settings[general_email]" value="<?php echo $settings['general_email']; ?>">
				</div>

				<div class="form-group">
					<label for="inputNMail">No-reply Email</label>
					<input type="text" class="form-control" id="inputNMail" name="settings[noreply_email]" value="<?php echo $settings['noreply_email']; ?>">
				</div>
			</div>
			<div class="tab-pane" id="home">

				<p>&nbsp;</p>
				<div class="form-group">
					<label for="inputMaleDateClip">Number of Male DateClips (For Annonymus	User)</label>
					<input type="text" class="form-control" id="inputMaleDateClip" name="settings[home_male_clip]" value="<?php echo $settings['home_male_clip']; ?>">
				</div>

				<div class="form-group">
					<label for="inputFemaleDateClip">Number of Female DateClips (For Annonymus User)</label>
					<input type="text" class="form-control" id="inputFemaleDateClip" name="settings[home_female_clip]" value="<?php echo $settings['home_female_clip']; ?>">
				</div>
			</div>

			<div class="tab-pane" id="credit">
				<p>&nbsp;</p>

			</div>

			<div class="tab-pane" id="payment">
				<p>&nbsp;</p>

			</div>

			<div class="tab-pane" id="video">
				<p>&nbsp;</p>
				<div class="form-group">
					<label for="inputClipSize">Upload DateClip Size</label>
					<input type="text" class="form-control" id="inputClipSize" name="settings[video_size]" value="<?php echo $settings['video_size']; ?>">
				</div>

				<div class="form-group">
					<label for="inputClipLength">DateClip Length</label>
					<input type="text" class="form-control" id="inputClipLength" name="settings[video_length]" value="<?php echo $settings['video_length']; ?>">
				</div>

				<div class="form-group">
					<label for="inputClipType">Allowed	DateClip File Type</label>
					<input type="text" class="form-control" id="inputClipType" name="settings[video_file_type]" value="<?php echo $settings['video_file_type']; ?>">
				</div>
			</div>

			<div class="tab-pane" id="fb">
				<p>&nbsp;</p>
				<div class="form-group">
					<label for="inputFBAppID">Facebook App ID</label>
					<input type="text" class="form-control" id="inputFBAppID" name="settings[fb_app_id]" value="<?php echo $settings['fb_app_id']; ?>">
					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> Wrong App ID can result front end malfunction</p>
				</div>

				<div class="form-group">
					<label for="inputFBKey">Facebook App Secret Key</label>
					<input type="text" class="form-control" id="inputFBKey" name="settings[fb_app_key]" value="<?php echo $settings['fb_app_key']; ?>">
					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> Wrong Secret Key can result front end malfunction</p>
				</div>
			</div>

	  	</div>

	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Save Settings</button>
		</div>

	</form>
</div>