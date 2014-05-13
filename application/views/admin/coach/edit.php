<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>coach">Coach Management</a></li>
		<li class="active">Edit Coach</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-tag"></span> Edit Coach</h1>
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'coach/edit/'.$this->uri->segment(4), $attributes);
      	?>
      	<div class="form-group">
      		<label for="inputTitle">Coach</label>
			<input required autofocus type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $data_info[0]->coach;?>">
		</div>

		<input type="hidden" name="id" value="<?php echo $data_info[0]->id;?>" />

      	<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Save Coach</button> or <a href="<?php echo HTTP_ADMIN_PATH; ?>coach">Cancel</a>
	  	</div>
	</form>
</div>