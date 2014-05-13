<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>package">Package Management</a></li>
		<li class="active">Add Package</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-shopping-cart"></span> Add Package</h1>
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'package/add', $attributes);
      	?>
	  	<div class="form-group">
	  		<label for="inputName">Name</label>
	  		<input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php echo set_value('name'); ?>" required>
	  	</div>

	  	<div class="form-group">
	  		<label for="selectType">Type</label>
	  		<select name="type" id="selectType" class="form-control" required>
	  			<option value="">Select One</option>
	  			<option value="subscription" <?php echo (set_value('type') == 'subscription')?'selected':''; ?>>Subscription</option>
	  			<option value="additional" <?php echo (set_value('type') == 'additional')?'selected':''; ?>>Additional</option>
			</select>
		</div>

	  	<div class="form-group">
	  		<label for="inputDesc">Description</label>
	  		<textarea class="form-control" name="description" id="inputDesc" placeholder="Package description" rows="3"><?php echo set_value('description'); ?></textarea>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputPrice">Price</label>
	  		<div class="input-group">
	  		 	<span class="input-group-addon">$</span>
	  		 	<input type="text" name="price" class="form-control" id="inputPrice" placeholder="Price" required value="<?php echo set_value('price'); ?>">
	  		</div>
	  	</div>

	  	<div class="form-group">
	  		<label for="inputCredit">Credit</label>
	  		<input type="text" name="credit" class="form-control" id="inputCredit" placeholder="Credit" required value="<?php echo set_value('credit'); ?>">
	  	</div>

	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Save Package</button> or <a href="<?php echo HTTP_ADMIN_PATH; ?>package">Cancel</a>
	  	</div>
	</form>
</div>