<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="#">Reports</a></li>
		<li class="active">Credit</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-stats"></span> Credit Report</h1>

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
				  	<h2><small><span class="glyphicon glyphicon-search"></span> Search Credit</small></h2>
				</div>
			</div>
			<div class="form-group">
			    <label for="inputName" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-4">
			      	<input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?php echo $search['name'];?>" />
			    </div>

			    <label for="inputTransaction" class="col-sm-2 control-label">Transaction ID</label>
			    <div class="col-sm-4">
			      	<input type="text" name="transaction" class="form-control" id="inputTransaction" placeholder="Transaction ID" value="<?php echo $search['transaction'];?>" />
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

			<div class="form-group has-feedback">
			    <label for="inputCreditFrom" class="col-sm-2 control-label">Credit From</label>
			    <div class="col-sm-4">
			    	<input type="text" name="credit_from" class="form-control" id="inputCreditFrom" placeholder="Credit From" value="<?php echo $search['credit_from'];?>" />
			    </div>

			    <label for="inputCreditTo" class="col-sm-2 control-label">Credit To</label>
			    <div class="col-sm-4">
			    	<input type="text" name="credit_to" class="form-control" id="inputCreditTo" placeholder="Credit To" value="<?php echo $search['credit_to'];?>" />
			    </div>
			</div>

			<div class="form-group">
			    <div class="col-sm-offset-1 col-sm-11">
			    	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			    	<a class="btn btn-default" href="<?php echo HTTP_ADMIN_PATH; ?>report/credit/reset">Reset</a>
			    </div>
			</div>
		</div>
	</form>
	<?php
		$attributes = array('class' => 'form-inline', 'id' => 'user-status-form');
		echo form_open(HTTP_ADMIN_PATH.'report/message_update_status', $attributes);
	?>
		<div class="row spacer-top spacer-bottom">
			<div class="btn-group col-md-2 col-sm-3 pull-right">
			  	<button type="button" class="btn btn-info">Export to</button>
			  	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			  		<span class="caret"></span>
			  		<span class="sr-only">Toggle Dropdown</span>
			  	</button>
			  	<ul class="dropdown-menu" role="menu">
			  		<li><a href="javascript:window.print();">Print</a></li>
			  		<li class="divider"></li>
			  		<li><a href="<?php echo HTTP_ADMIN_PATH.'report/credit/csv';?>">CSV</a></li>
			  	</ul>
			</div>
		</div>



		<div class="panel panel-default" >
			<!-- Table -->
		    <table class="table table-striped table-hover">
		    	<thead>
		    		<tr>
		          		<th>Name</th>
		          		<th>Email</th>
		          		<th>Credit Point</th>
		          	</tr>
		        </thead>
		        <tbody>
		            <?php if (count($list) == 0) { ?>
		            <tr>
		            	<td colspan="100%">Sorry!! No Records found.</td>
		            </tr>
		            <?php } ?>
		            <?php foreach($list as $row) { ?>
		            <tr>
		            	<td><a class="userModalButton" href="#" data-src="<?php echo HTTP_ADMIN_PATH; ?>users/details/<?php echo $row->user_id;?>" data-toggle="modal" data-target="#userDetailsModal"><?php echo $row->full_name;?></a></td>
		            	<td><?php echo $row->email;?></td>
		            	<td><?php echo $row->credit;?></td>
		            </tr>
		            <?php } ?>
		        </tbody>
		    </table>
		</div>
	</form>
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