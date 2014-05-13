<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>package">Package Management</a></li>
		<li class="active">Edit Package</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-shopping-cart"></span> Edit Package</h1>
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'package/edit/'.$this->uri->segment(4), $attributes);
      	?>
	  	<div class="form-group">
	  		<label for="inputName">Name</label>
	  		<input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php echo $data_info[0]->name; ?>" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="selectType">Type</label>
	  		<select name="type" id="selectType" class="form-control" required>
	  			<option value="">Select One</option>
	  			<option value="subscription" <?php echo ($data_info[0]->type == 'subscription')?'selected':''; ?>>Subscription</option>
	  			<option value="additional" <?php echo ($data_info[0]->type == 'additional')?'selected':''; ?>>Additional</option>
			</select>
		</div>

	  	<div class="form-group">
	  		<label for="inputDesc">Description</label>
	  		<textarea style="height: 20%" class="form-control" name="description" id="inputDesc" placeholder="Package description" rows="3"><?php echo $data_info[0]->description; ?></textarea>
	  	</div>

	  	<input type="hidden" name="id" value="<?php echo $data_info[0]->id;?>" >

	  	<div class="form-group">
	  		<label for="inputPrice">Price</label>
	  		<div class="input-group">
	  		 	<span class="input-group-addon">$</span>
	  		 	<input type="text" name="price" class="form-control" id="inputPrice" placeholder="Price" required value="<?php echo $data_info[0]->price; ?>">
	  		</div>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputCredit">Credit</label>
	  		<input type="text" name="credit" class="form-control" id="inputCredit" placeholder="Credit" required value="<?php echo $data_info[0]->credit; ?>">
	  	</div>

	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Save Package</button> or <a href="<?php echo HTTP_ADMIN_PATH; ?>package">Cancel</a>
	  	</div>
	</form>
</div>
<script>
jQuery('#inputDesc').wysihtml5();
</script>