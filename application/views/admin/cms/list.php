<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li class="active">CMS Management</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon glyphicon-pencil"></span> CMS Management</h1>

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

	</div>

	<div class="panel panel-default" >
		<!-- Table -->
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Title</th>
					<th>Page Type</th>
		          	<th>Last Updated</th>
		          	<th>Action</th>
				</tr>
			</thead>
		    <tbody>
		    <?php
		        if (count($list) > 0) {

		        	foreach ($list as $key => $obj) {
		    ?>
		        <tr>
		        	<td><?php echo $obj->title;?></td>
		        	<td><?php echo ucfirst(str_replace('_', ' ',$obj->page_type));?></td>
		            <td><?php echo $obj->last_updated;?></td>
		        	<td width="15%">
		        		<a class="btn btn-info btn-xs" href='<?=base_url()?>admin/cms/edit/<?php echo $obj->id;?>' title='Edit'>
		        			<span class="glyphicon glyphicon-edit"></span> Edit
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