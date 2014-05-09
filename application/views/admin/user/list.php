

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<ol class="breadcrumb">
			  	<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
			  	<li class="active">User Management</li>
			</ol>

			<h1 class="page-header"><span class="glyphicon glyphicon-user"></span> User Management</h1>

			<?php
			if($this->session->flashdata('flash_message')){
				if($this->session->flashdata('flash_message') == 'updated')
				{
					echo '<div class="alert alert-success alert-dismissable">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					echo '<strong>Well done!</strong> user successfully added.';
					echo '</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					echo '<strong>Oh snap!</strong> user already exists.';
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
			      <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php echo $search['name_selected'];?>" />
			    </div>
			    <label for="inputEmail" class="col-sm-2 control-label">Email address</label>
			    <div class="col-sm-4">
			      <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email address" value="<?php echo $search['email_selected'];?>" />
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputStatus" class="col-sm-1 control-label">Status</label>
			    <div class="col-sm-5">
			      <select name="status" class="form-control" id="inputStatus">
			      	<option value="" selected>All </option>
			      	<option value="1" <?php if($search['status_selected'] == "1") echo "selected";?>>Active</option>
			      	<option value="0" <?php if($search['status_selected'] === "0") echo "selected";?>>In-active</option>
				  </select>
			    </div>
			    <label for="inputLocation" class="col-sm-2 control-label">Location</label>
			    <div class="col-sm-4">
			      <input type="text" name="location" class="form-control" id="inputLocation" placeholder="Location" value="<?php echo $search['location_selected'];?>" />
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-1 col-sm-11">
			      <button type="submit" class="btn btn-primary">Search</button>
			      <button type="reset" class="btn btn-default" onclick="window.location='users/index/reset'">Reset</button>
			    </div>
			  </div>
			</div>
			</form>

			<form class="form-inline" method="post">
		      <div class="row spacer-top spacer-bottom">
		        <div class="col-sm-8">
				    <select name="operation" class="form-control" id="inputOperation">
				      <option value="">Select Operation</option>
				      <option value="active">Mark as Active</option>
				      <option value="inactive">Mark as In-active</option>
					</select>
					<button type="submit" class="btn btn-success">Submit</button>
			    </div>
			    <div class="col-sm-4 text-right">
			      <button type="button" class="btn btn-success text-right" onclick="window.location='users/add'">Add New User</button>
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
		            <?php foreach($users as $row) { ?>
		            	<tr>
		            		<td><input type="checkbox" class="checkbox-item" vlaue="<?php echo $row['id'];?>"></td>
		            		<td><a href="#"><?php echo $row['full_name'];?></a></td>
		            		<td><?php echo $row['email'];?></td>
		            		<td><?php echo $row['location'];?></td>
		            		<td>
		            		<?php
		            			if ($row['status']) {
		            				echo '<span class="label label-success">Active</span>';
		            			} else {
		            				echo '<span class="label label-danger">In-active</span>';
		            			}
		            		?>
		            		</td>
		            		<td>
		            			<button type="button" class="btn btn-info btn-xs" onclick="window.location='users/edit/<?php echo $row['id'];?>'">
								  <span class="glyphicon glyphicon-edit"></span> Edit
								</button>
		            		</td>
		            	</tr>
		            <?php } ?>
		            </tbody>
		        </table>
		      </div>
		    </form>
		    <?php echo $this->pagination->create_links(); ?>
        </div>
