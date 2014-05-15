<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li class="active">Update Profile</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-lock"></span> Update Profile</h1>

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
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'home/profile/', $attributes);
      	?>
      	<h2><small><span class="glyphicon glyphicon-user"></span> Profile Information</small></h2>

      	<div class="panel panel-default main" >
		  	<div class="form-group">
		  		<label for="inputName">Name <span style="color:red">*</span></label>
		  		<input type="text" name="name" class="form-control" id="inputName" value="<?php echo $admin[0]->name;?>" placeholder="Enter username" required >
		  	</div>

			<div class="form-group">
		  		<label for="inputEmail">Email Address:</label>
		  		<input type="text" name="location" class="form-control" id="inputEmail" value="<?php echo $admin[0]->email;?>" readonly placeholder="Location" >
		  		<p class="help-block">[ read-only ]</p>
		  	</div>

		</div>

	  	<h2><small><span class="glyphicon glyphicon-certificate"></span> Update Password</small></h2>
	  	<p class="help-block">[ All the 3 fields are required for updating password. ]</p>

	  	<div class="panel panel-default main" >
			<div class="form-group">
		  		<label for="inputPass">Current Password</label>
		  		<input type="password" name="password" class="form-control" id="inputPass" placeholder="Current Password" value="">
		  	</div>

		  	<div class="form-group">
		  		<label for="inputNewPass">New Password</label>
		  		<input type="password" name="new_pwd" class="form-control" id="inputNewPass" placeholder="New Password" value="" >
		  	</div>

		  	<div class="form-group">
		  		<label for="inputRePass">Re-type Password</label>
		  		<input type="password" name="re_pwd" oninput="check_repass(this, 'inputNewPass')" class="form-control" id="inputRePass" placeholder="Re-type Password" value="" >
		  	</div>

		</div>
	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Update Profile</button>
	  	</div>
	</form>
</div>