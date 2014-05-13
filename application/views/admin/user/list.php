<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li class="active">User Management</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-user"></span> User Management</h1>

	<?php
		if($this->session->flashdata('message_type')) {
			if($this->session->flashdata('message')) {

				echo '<div class="alert alert-'.$this->session->flashdata('message_type').' alert-dismissable">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				echo $this->session->flashdata('message');
				echo '</div>';
			}
		}
	?>
	<form class="form-horizontal" role="form" method="post">
		<div class="panel panel-default inner-spacer" >
			<div class="form-group">
			    <div class="col-md-12">
				  	<h2><small><span class="glyphicon glyphicon-search"></span> Search User</small></h2>
				</div>
			</div>
			<div class="form-group">
			    <label for="inputName" class="col-sm-1 control-label">Name</label>
			    <div class="col-sm-5">
			      	<input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php echo $search['full_name'];?>" />
			    </div>

			    <label for="inputEmail" class="col-sm-2 control-label">Email address</label>
			    <div class="col-sm-4">
			      	<input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email address" value="<?php echo $search['email'];?>" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="inputStatus" class="col-sm-1 control-label">Status</label>
			    <div class="col-sm-5">
			    	<select name="status" class="form-control" id="inputStatus">
			    		<option value="" selected>All </option>
			    		<option value="1" <?php if($search['status'] == "1") echo "selected";?>>Active</option>
			    		<option value="0" <?php if($search['status'] === "0") echo "selected";?>>In-active</option>
			    	</select>
			    </div>

			    <label for="inputLocation" class="col-sm-2 control-label">Location</label>
			    <div class="col-sm-4">
			    	<input type="text" name="location" class="form-control" id="inputLocation" placeholder="Location" value="<?php echo $search['location'];?>" />
			    </div>
			</div>

			<div class="form-group">
			    <div class="col-sm-offset-1 col-sm-11">
			    	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			    	<a class="btn btn-default" href="<?php echo HTTP_ADMIN_PATH; ?>users/index/reset">Reset</a>
			    </div>
			</div>
		</div>
	</form>
	<?php
		echo validation_errors();

		$attributes = array('class' => 'form-inline', 'id' => 'user-status-form');
		echo form_open(HTTP_ADMIN_PATH.'users/update_status', $attributes);
	?>
		<div class="row spacer-top spacer-bottom">
			<div class="col-sm-8">
				<select name="operation" class="form-control" id="inputOperation" required>
					<option value="">Select Operation</option>
				    <option value="active">Mark as Active</option>
				    <option value="inactive">Mark as In-active</option>
				</select>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>

			<div class="col-sm-4 text-right">
				<a class="btn btn-success text-right" href="<?php echo HTTP_ADMIN_PATH; ?>users/add"><span class="glyphicon glyphicon-plus"></span> Add New User</a>
			</div>
		</div>

		<div class="panel panel-default" >
			<!-- Table -->
		    <table class="table table-striped table-hover">
		    	<thead>
		    		<tr>
		          		<th><input type="checkbox" id="checkall"></th>
		          		<th><?php echo $sort_fields['full_name'];?></th>
		          		<th><?php echo $sort_fields['email'];?></th>
		          		<th><?php echo $sort_fields['location'];?></th>
		          		<th>Status</th>
		          		<th>Action</th>
		          	</tr>
		        </thead>
		        <tbody>
		            <?php if ($count_users == 0) { ?>
		            <tr>
		            	<td colspan="100%">Sorry!! No Records found.</td>
		            </tr>
		            <?php } ?>
		            <?php foreach($list as $user) { ?>
		            <tr>
		            	<td><input type="checkbox" name="item_id[<?php echo $user->id;?>]" class="checkbox-item" value="Y"></td>
		            	<td><a class="userModalButton" href="#" data-src="<?php echo HTTP_ADMIN_PATH; ?>users/details/<?php echo $user->id;?>" data-toggle="modal" data-target="#userDetailsModal"><?php echo $user->full_name;?></a></td>
		            	<td><?php echo $user->email;?></td>
		            	<td><?php echo $user->location;?></td>
		            	<td>
		            	<?php
		            		if ($user->status) {
		            			echo '<span class="label label-success">Active</span>';
		            		} else {
		            			echo '<span class="label label-danger">In-active</span>';
		            		}
		            	?>
		            	</td>
		            	<td>
		            		<a class="btn btn-info btn-xs" href="<?php echo HTTP_ADMIN_PATH; ?>users/edit/<?php echo $user->id;?>" title="Edit">
		            			<span class="glyphicon glyphicon-edit"></span> Edit
		            		</a>
		            	</td>
		            </tr>
		            <?php } ?>
		        </tbody>
		    </table>
		</div>
	</form>
	<?php echo $this->pagination->create_links(); ?>
</div>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg"">
		<div class="modal-content">
			<div class="modal-body">
				<!-- Remote data loads here -->
				<span class="glyphicon glyphicon-refresh"></span> Loading please wait ...
			</div>
		</div>
	</div>
</div>