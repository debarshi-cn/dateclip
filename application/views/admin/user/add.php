<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>users">User Management</a></li>
		<li class="active">Add User</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-user"></span> Add User</h1>
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'users/add', $attributes);
      	?>
	  	<div class="form-group">
	  		<label for="inputFullName">Full name</label>
	  		<input type="text" name="full_name" class="form-control" id="inputFullName" placeholder="Full name" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputFirstName">First name</label>
	  		<input type="text" name="first_name" class="form-control" id="inputFirstName" placeholder="First name" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputLastName">Last name</label>
	  		<input type="text" name="last_name" class="form-control" id="inputLastName" placeholder="Last name" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputEmail">Email address</label>
	  		<input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email address" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="">Gender</label>
	  		<div class="radio">
			  <label for="checkboxMale">
			    <input type="radio" name="gender" id="checkboxMale" value="M" checked>
			    Male
			  </label>
			</div>
			<div class="radio">
			  <label for="checkboxFemale">
			    <input type="radio" name="gender" id="checkboxFemale" value="F">
			    Female
			  </label>
			</div>
		</div>

		<div class="form-group has-feedback">
	  		<label for="inputDOB">Date of Birth</label>
	  		<input type="text" name="date_of_birth" class="form-control" id="inputDOB" placeholder="Date of birth"> <span class="form-control-feedback glyphicon glyphicon-calendar"></span>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputLocation">Location</label>
	  		<input type="text" name="location" class="form-control" id="inputLocation" placeholder="Location" >
	  	</div>

	  	<div class="form-group">
	  		<label for="">Status</label>
	  		<div class="radio">
			  <label for="checkboxActive">
			    <input type="radio" name="status" id="checkboxActive" value="1" checked>
			    Active
			  </label>
			</div>
			<div class="radio">
			  <label for="checkboxinactive">
			    <input type="radio" name="status" id="checkboxinactive" value="0" >
			    In-active
			  </label>
			</div>
		</div>

	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Save User</button> or <a href="<?php echo HTTP_ADMIN_PATH; ?>users">Cancel</a>
	  	</div>
	</form>
</div>