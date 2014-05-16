<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li><a href="#">Reports</a></li>
		<li class="active">Finance</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-inbox"></span> Finance Report</h1>

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
				  	<h2><small><span class="glyphicon glyphicon-search"></span> Search Transactions</small></h2>
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
			    <label for="inputPriceFrom" class="col-sm-2 control-label">Price From</label>
			    <div class="col-sm-4">
			    	<input type="text" name="price_from" class="form-control" id="inputPriceFrom" placeholder="Price From" value="<?php echo $search['price_from'];?>" />
			    </div>

			    <label for="inputPriceTo" class="col-sm-2 control-label">Price To</label>
			    <div class="col-sm-4">
			    	<input type="text" name="price_to" class="form-control" id="inputPriceTo" placeholder="Price To" value="<?php echo $search['price_to'];?>" />
			    </div>
			</div>

			<div class="form-group">
			    <div class="col-sm-offset-1 col-sm-11">
			    	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			    	<a class="btn btn-default" href="<?php echo HTTP_ADMIN_PATH; ?>report/finance/reset">Reset</a>
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
			  		<li><a href="#">Print</a></li>
			  		<li class="divider"></li>
			  		<li><a href="#">CSV</a></li>
			  	</ul>
			</div>
		</div>



		<div class="panel panel-default" >
			<!-- Table -->
		    <table class="table table-striped table-hover">
		    	<thead>
		    		<tr>
		          		<th>Name</th>
		          		<th>Transaction ID</th>
		          		<th>Date</th>
		          		<th>Package</th>
		          		<th>Type</th>
		          		<th>Amount</th>
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
		            	<td><?php echo $row->full_name;?></td>
		            	<td><?php echo $row->transaction_id;?></td>
		            	<td><?php echo date("m/d/Y h:i a",strtotime($row->purchase_date));?></td>
		            	<td><?php echo $row->package_name;?></td>
		            	<td><?php echo ucfirst($row->package_type);?></td>
		            	<td class="text-right">$ <?php echo number_format($row->package_price,2);?></td>
		            </tr>
		            <?php } ?>
		        </tbody>
		    </table>
		</div>
	</form>
</div>