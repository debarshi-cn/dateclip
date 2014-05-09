<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
		<li><a href="<?php echo base_url(); ?>admin/users">User Management</a></li>
		<li class="active">Edit User</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-user"></span> Edit User</h1>
		<?php
			if($this->session->flashdata('flash_message')){
				if($this->session->flashdata('flash_message') == 'updated')
				{
					echo '<div class="alert alert-success alert-dismissable">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					echo '<strong>Well done!</strong> user updated with success.';
					echo '</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
					echo '</div>';
				}
			}

			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open('admin/users/edit/'.$this->uri->segment(4).'', $attributes);
      	?>
	  	<div class="form-group">
	  		<label for="inputFullName">Full name</label>
	  		<input type="text" name="full_name" class="form-control" id="inputFullName" placeholder="Full name" value="<?php echo $user[0]['full_name'];?>" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputFirstName">First name</label>
	  		<input type="text" name="first_name" class="form-control" id="inputFirstName" placeholder="First name" value="<?php echo $user[0]['first_name'];?>" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputLastName">Last name</label>
	  		<input type="text" name="last_name" class="form-control" id="inputLastName" placeholder="Last name" value="<?php echo $user[0]['last_name'];?>" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputEmail">Email address</label>
	  		<input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email address" value="<?php echo $user[0]['email'];?>" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="">Gender</label>
	  		<div class="radio">
			  <label for="checkboxMale">
			    <input type="radio" name="gender" id="checkboxMale" value="M" <?php if($user[0]['gender'] != "F") echo "checked";?>>
			    Male
			  </label>
			</div>
			<div class="radio">
			  <label for="checkboxFemale">
			    <input type="radio" name="gender" id="checkboxFemale" value="F" <?php if($user[0]['gender'] == "F") echo "checked";?>>
			    Female
			  </label>
			</div>
		</div>

		<div class="form-group has-feedback">
	  		<label for="inputDOB">Date of Birth</label>
	  		<input type="text" name="date_of_birth" class="form-control" id="inputDOB" placeholder="Date of birth" value="<?php echo $user[0]['date_of_birth'];?>"> <span class="form-control-feedback glyphicon glyphicon-calendar"></span>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputLocation">Location</label>
	  		<input type="text" name="location" class="form-control" id="inputLocation" placeholder="Location" value="<?php echo $user[0]['location'];?>">
	  	</div>

	  	<div class="form-group">
	  		<label for="">Status</label>
	  		<div class="radio">
			  <label for="checkboxActive">
			    <input type="radio" name="status" id="checkboxActive" value="1" <?php if($user[0]['status'] != "0") echo "checked";?>>
			    Active
			  </label>
			</div>
			<div class="radio">
			  <label for="checkboxinactive">
			    <input type="radio" name="status" id="checkboxinactive" value="0" <?php if($user[0]['status'] == "0") echo "checked";?>>
			    In-active
			  </label>
			</div>
		</div>

	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary">Save User!</button> or <a href="<?php echo base_url(); ?>admin/users">Cancel</a>
	  	</div>
	</form>
</div>