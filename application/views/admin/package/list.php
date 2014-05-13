<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li class="active">Package Management</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-shopping-cart"></span> Package Management</h1>

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

	<div class="row spacer-top spacer-bottom">
		<div class="col-sm-12 text-right">
			<a class="btn btn-success text-right" href="<?php echo HTTP_ADMIN_PATH; ?>package/add"><span class="glyphicon glyphicon-plus"></span> Add New Package</a>
		</div>
	</div>

	<div class="panel panel-default" >
		<!-- Table -->
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>Price</th>
					<th>Credit</th>
		          	<th>Action</th>
		        </tr>
		    </thead>
		    <tbody>
		    <?php
		    	if ($list) {

		    		foreach ($list as $key => $obj) {
		    ?>
			   	<tr>
			   		<td><?php echo $obj->name;?></td>
			   		<td><?php echo ucfirst($obj->type);?></td>
			   		<td><?php echo number_format($obj->price,2);?></td>
			   		<td><?php echo $obj->credit;?></td>
			   		<td width="15%">
			   			<a class="btn btn-info btn-xs" href='<?php echo HTTP_ADMIN_PATH; ?>package/edit/<?php echo $obj->id;?>' title='Edit'>
			   				<span class="glyphicon glyphicon-edit"></span> Edit
			            </a>
			            <a class="btn btn-danger btn-xs" href="javascript:;" onclick="return popup_confirm('<?php echo HTTP_ADMIN_PATH; ?>package/delete/', '<?php echo $obj->id;?>');" data-toggle="modal" data-target="#deleteConfirmModal" title="Delete">
			            	<span class="glyphicon glyphicon-remove"></span> Delete
			            </a>
			        </td>
			    </tr>
			<?php
		    		}
		    	} else {
		    ?>
		        <tr>
		        	<td colspan="100%">Sorry!! No Records found.</td>
		        </tr>
		    <?php
		        }
		    ?>
		    </tbody>
		</table>
	</div>
</div>