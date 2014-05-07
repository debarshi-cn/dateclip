<?php
	$this->load->view('admin/vwHeader');
?>
<div class="container">
	<div class="row">

		<?php $this->load->view('admin/vwSidebar'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<ol class="breadcrumb">
			  	<li><a href="#">Dashboard</a></li>
			  	<li class="active">User Management</li>
			</ol>

			<h1 class="page-header"><span class="glyphicon glyphicon-user"></span> User Management</h1>

			<form class="form-horizontal" role="form">
			  <div class="row">
			    <div class="col-md-12">
				  <h2><small><span class="glyphicon glyphicon-search"></span> Search User</small></h2>
				</div>
			  </div>
			  <div class="form-group">
			    <label for="inputName" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="inputName" placeholder="Name">
			    </div>
			    <label for="inputEmail" class="col-sm-2 control-label">Email address</label>
			    <div class="col-sm-4">
			      <input type="email" class="form-control" id="inputEmail" placeholder="Email address">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputStatus" class="col-sm-2 control-label">Status</label>
			    <div class="col-sm-4">
			      <select name="status" class="form-control" id="inputStatus">
			      	<option>Select Status</option>
				  </select>
			    </div>
			    <label for="inputLocation" class="col-sm-2 control-label">Location</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="inputLocation" placeholder="Location">
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Search</button>
			    </div>
			  </div>
			</form>

			<form class="form-inline">
		      <div class="row spacer-top spacer-bottom">
		        <div class="col-md-8">
				    <select name="operation" class="form-control" id="inputOperation">
				      <option>Select Operation</option>
					</select>
					<button type="submit" class="btn btn-success">Submit</button>
			    </div>
			    <div class="col-md-4 text-right">
			      <button type="button" class="btn btn-success text-right">Add New User</button>
			  	</div>
			  </div>

			  <div class="panel panel-default" >
		        <!-- Table -->
		        <table class="table table-striped table-hover">
		          	<thead>
		          		<tr>
		          			<th><input type="checkbox"></th>
		          			<th>Name</th>
		          			<th>Email</th>
		          			<th>Location</th>
		          			<th>Status</th>
		          			<th>Action</th>
		          		</tr>
		          	</thead>
		            <tbody>
		            <?php foreach($users as $row) { ?>
		            	<tr>
		            		<td><input type="checkbox"></td>
		            		<td><?php echo $row['full_name'];?></td>
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
		            			<button type="button" class="btn btn-info btn-xs">
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

			<?php $this->load->view('admin/vwFooter'); ?>
        </div>
    </div>
</div><!-- /.container -->