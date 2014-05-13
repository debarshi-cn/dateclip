<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>flag">Flag Management</a></li>
		<li class="active">Add Flag</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-flag"></span> Add Flag</h1>
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'flag/add', $attributes);
      	?>
		<div class="form-group">
			<label for="inputTitle">Flag</label>
			<input required autofocus type="text" class="form-control" id="inputTitle" name="title" value="">
		</div>

		<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Save Flag</button> or <a href="<?php echo HTTP_ADMIN_PATH; ?>flag">Cancel</a>
	  	</div>
	</form>
</div>