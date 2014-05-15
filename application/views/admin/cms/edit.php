<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ul class="breadcrumb">
		<li><a href='<?php echo HTTP_ADMIN_PATH; ?>dashboard'>Dashboard</a></li>
		<li><a href='<?php echo HTTP_ADMIN_PATH; ?>cms'>CMS Management</a></li>
		<li class="active">Edit Content</li>
	</ul>

	<h1 class="page-header"><span class="glyphicon glyphicon glyphicon-pencil"></span> Edit Content</h1>

	<?php
		//form validation
		echo validation_errors();

		$attributes = array('class' => '', 'id' => '');
		echo form_open(HTTP_ADMIN_PATH.'cms/edit/'.$this->uri->segment(4), $attributes);
    ?>

    	<div class="form-group">
    		<label for="inputName">Page Name</label>
			<input required autofocus type="text" class="form-control" id="inputName" name="name" value="<?php echo $data_info[0]->name;?>">
		</div>

		<div class="form-group">
			<label for="inputTitle">Title</label>
			<input required type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $data_info[0]->title;?>">
		</div>

		<div class="form-group">
	  		<label for="inputDesc">Content</label>
	  		<textarea rows="15" class="form-control" name="description" id="inputDesc" placeholder="Content here" rows="3"><?php echo $data_info[0]->description; ?></textarea>
	  	</div>

	  	<div class="form-group">
			<label for="inputKeyword">Meta Keyword</label>
			<input type="text" class="form-control" id="inputKeyword" name="meta_keyword" value="<?php echo $data_info[0]->meta_keyword;?>">
		</div>

		<div class="form-group">
			<label for="inputMetaDesc">Meta Description</label>
			<textarea style="height: 20%" class="form-control" name="meta_description" id="inputMetaDesc"><?php echo $data_info[0]->meta_description;?></textarea>
		</div>

		<input type="hidden" name="id" value="<?php echo $data_info[0]->id;?>" />

		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Save CMS</button> or <a href="<?php echo HTTP_ADMIN_PATH; ?>cms">Cancel</a>
	<?php
		echo form_close();
	?>
</div>
<script>
jQuery('#inputDesc').wysihtml5();
</script>