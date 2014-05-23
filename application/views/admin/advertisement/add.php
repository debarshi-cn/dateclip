<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>package">Advertisement Management</a></li>
		<li class="active">Add Advertisement</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-camera"></span> Add Advertisement</h1>
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open_multipart(HTTP_ADMIN_PATH.'advertisement/add', $attributes);
      	?>
	  	<div class="form-group">
	  		<label for="inputName">Title</label>
	  		<input type="text" name="title" class="form-control" id="inputName" placeholder="Title" value="<?php echo set_value('title'); ?>" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputDesc">Description</label>
	  		<textarea class="form-control" name="description" id="inputDesc" placeholder="Advertisement description" rows="3" required><?php echo set_value('description'); ?></textarea>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputName">Upload video</label>
	  		<input type="file" name="video" class="" id="inputName">
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
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Save Advertisement</button> or <a href="<?php echo HTTP_ADMIN_PATH; ?>advertisement">Cancel</a>
	  	</div>
	</form>
</div>
<script>
jQuery('#inputDesc').wysihtml5();
</script>