<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li class="active">Send Mail</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-envelope"></span> Send Mass Mail</h1>
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'massmail/send/', $attributes);
      	?>
      	<h2><small>Profile Selection</small></h2>

      	<div class="panel panel-default main" >
		  	<div class="form-group">
		  		<label for="inputName">Name</label>
		  		<input type="text" name="name" class="form-control" id="inputName" placeholder="Enter username" autocomplete="off" >
		  	</div>

		  	<div class="form-group">
		  		<div><label>Gender</label></div>
		  		<label class="checkbox-inline">
		  			<input type="checkbox" name="gender[]" id="inlineGenderMale" value="M"> Male
				</label>
				<label class="checkbox-inline">
				  	<input type="checkbox" name="gender[]" id="inlineGenderFemale" value="F"> Female
				</label>
		  	</div>

			<div class="form-group">
		  		<label for="inputLocation">Location</label>
		  		<input type="text" name="location" class="form-control" id="inputLocation" placeholder="Location" >
		  	</div>

		  	<div class="form-group has-feedback">
		  		<label for="inputDOB">Age Range</label>
		  		<div class="row">
			  		<div class="col-md-1">From</div>
			  		<div class="col-md-2">
			  			<input type="number" name="age_start" class="form-control" id="inputStartAge" min="1" max="100">
			  		</div>
			  		<div class="col-md-1">To</div>
			  		<div class="col-md-2">
			  			<input type="number" name="age_end" class="form-control" id="inputStartAge" min="1" max="100">
			  		</div>
			  		<div class="col-md-6"></div>
		  		</div>
		  	</div>

		  	<div class="form-group">
		  		<label for="selectStatus">Status</label>
		  		<select name="type" id="selectStatus" class="form-control" multiple size="2">
		  			<option value="active" >Active</option>
		  			<option value="inactive" >Inactive</option>
				</select>
			</div>

			<div class="form-group">
				<div class="checkbox">
					<label>
			      		<input type="checkbox"> Have DateClip ?
			      	</label>
			    </div>
			</div>

		</div>

	  	<h2><small>Compose	Message</small></h2>

	  	<div class="panel panel-default main" >
			<div class="form-group">
		  		<label for="inputSubject">Subject</label>
		  		<input type="text" name="subject" class="form-control" id="inputSubject" placeholder="Email subject" value="" required>
		  	</div>

		  	<div class="form-group">
		  		<label for="inputDesc">Message</label>
		  		<textarea style="height:30%" class="form-control" name="body" id="inputDesc" placeholder="Compose .." rows="3"></textarea>
		  	</div>

		  	<div class="checkbox">
		  		<label>
		  			<input type="checkbox"> Send as	email
		  		</label>
		  		<p class="help-block">It will send an email notification to the user</p>
		  	</div>

		</div>
	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Send Message</button>
	  	</div>
	</form>
</div>
<script>
jQuery('#inputDesc').wysihtml5();
</script>