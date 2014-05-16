<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="#">Reports</a></li>
		<li class="active">Flagged DateClips</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-facetime-video"></span> Flagged DateClips</h1>

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
				  	<h2><small><span class="glyphicon glyphicon-search"></span> Search Flagged DateClips</small></h2>
				</div>
			</div>
			<div class="form-group">
			    <label for="inputName" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-4">
			      	<input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php echo $search['name'];?>" />
			    </div>

			    <label for="inputReported" class="col-sm-2 control-label">Reported By</label>
			    <div class="col-sm-4">
			      	<input type="text" name="reported" class="form-control" id="inputReported" placeholder="Reported By" value="<?php echo $search['reported'];?>" />
			    </div>
			</div>

			<div class="form-group has-feedback">
			    <label for="inputDateFrom" class="col-sm-2 control-label">Date From</label>
			    <div class="col-sm-4">
			    	<input type="text" name="date_from" class="form-control calender-control" id="inputDateFrom" placeholder="Date From" value="<?php echo $search['date_from'];?>" /> <span class="form-control-feedback glyphicon glyphicon-calendar"></span>
			    </div>

			    <label for="inputDateTo" class="col-sm-2 control-label">Date To</label>
			    <div class="col-sm-4">
			    	<input type="text" name="date_to" class="form-control calender-control" id="inputDateTo" placeholder="Date To" value="<?php echo $search['date_to'];?>" />
			    	<span class="form-control-feedback glyphicon glyphicon-calendar"></span>
			    </div>
			</div>

			<div class="form-group">
			    <div class="col-sm-offset-1 col-sm-11">
			    	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			    	<a class="btn btn-default" href="<?php echo HTTP_ADMIN_PATH; ?>report/dateclip/reset">Reset</a>
			    </div>
			</div>
		</div>
	</form>
	<?php
		$attributes = array('class' => 'form-inline', 'id' => 'user-status-form');
		echo form_open(HTTP_ADMIN_PATH.'report/dateclip_update_status', $attributes);
	?>
		<div class="row spacer-top spacer-bottom">
			<div class="col-sm-8">
				<select name="operation" class="form-control" id="inputOperation" required>
					<option value="">Select Operation</option>
				    <option value="accepted">Mark as Accepted</option>
				    <option value="rejected">Mark as Rejected</option>
				</select>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</div>

		<div class="panel panel-default" >
			<!-- Table -->
		    <table class="table table-striped table-hover">
		    	<thead>
		    		<tr>
		          		<th><input type="checkbox" id="checkall"></th>
		          		<th>Name</th>
		          		<th>Reported By</th>
		          		<th>Date</th>
		          		<th>Reason</th>
		          		<th>Status</th>
		          		<th>Action</th>
		          	</tr>
		        </thead>
		        <tbody>
		            <?php if ($count == 0) { ?>
		            <tr>
		            	<td colspan="100%">Sorry!! No Records found.</td>
		            </tr>
		            <?php } ?>
		            <?php foreach($list as $row) { ?>
		            <tr>
		            	<td><input type="checkbox" name="item_id[<?php echo $row->id;?>]" class="checkbox-item" value="Y"></td>
		            	<td><a class="userModalButton" href="#" data-src="<?php echo HTTP_ADMIN_PATH; ?>users/details/<?php echo $row->user_id;?>" data-toggle="modal" data-target="#userDetailsModal"><?php echo $row->user_name;?></a></td>
		            	<td><a class="userModalButton" href="#" data-src="<?php echo HTTP_ADMIN_PATH; ?>users/details/<?php echo $row->reporter_id;?>" data-toggle="modal" data-target="#userDetailsModal"><?php echo $row->reporter_name;?></a></td>
		            	<td><?php echo date("m/d/Y h:i a",strtotime($row->create_date));?></td>
		            	<td><?php echo $row->flag;?> <?php echo ($row->other)?"- ".$row->other:'';?></td>
		            	<td>
		            	<?php
		            		if ($row->status == 'accepted') {
		            			echo '<span class="label label-success">Flag Accepted</span>';
		            		} else if ($row->status == 'rejected') {
		            			echo '<span class="label label-danger">Flag Rejected</span>';
		            		} else {
		            			echo '<span class="label label-primary">Pending</span>';
		            		}
		            	?>
		            	</td>
		            	<td>
		            		<a class="btn btn-info btn-xs userModalButton" href="#" data-src="<?php echo HTTP_ADMIN_PATH; ?>users/details/<?php echo $row->dateclip_id;?>" data-toggle="modal" data-target="#userDetailsModal">
		            			<span class="glyphicon glyphicon-edit"></span> View Clip
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