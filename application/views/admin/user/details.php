<?php if (isset($error)) :?>
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title"><span class="glyphicon glyphicon-remove-sign"></span> Error !!</h2>
    </div>
	<div class="modal-body"><?php echo $error;?></div>
<?php else:?>
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title"><span class="glyphicon glyphicon-user"></span> <?php echo $user[0]->full_name;?></h2>
    </div>
	<div class="modal-body">
		<div class="row">
			<label class="col-sm-3 control-label"><?php echo $user[0]->email;?></label>

		    <label class="col-sm-2 control-label">Birth Date:</label>
		    <div class="col-sm-3">
		    	<p class="form-control-static"><?php echo $user[0]->date_of_birth;?></p>
		    </div>

		    <label class="col-sm-2 control-label">Status:</label>
		    <div class="col-sm-2">
		    	<p class="form-control-static">
		    	<?php
		    		if ($user[0]->status == '1') {
		    			echo '<span class="label label-success">Active</span>';
		            } else {
		            	echo '<span class="label label-danger">In-active</span>';
		            }
		        ?>
		    	</p>
		    </div>
		</div>
		<div class="row spacer-bottom">
			<label class="col-sm-3 control-label"><?php echo $user[0]->location;?></label>

		    <label class="col-sm-2 control-label">Active Since:</label>
		    <div class="col-sm-3">
		    	<p class="form-control-static"><?php echo $user[0]->create_date;?></p>
		    </div>

		    <label class="col-sm-2 control-label">PP available:</label>
		    <div class="col-sm-2">
		    	<p class="form-control-static">2344</p>
		    </div>
		</div>

		<div class="row spacer-top">
			<div class="col-md-12" >
				<h4>Transaction	History</h4>

				<!-- Table -->
			    <table class="table table-striped table-hover">
			    	<thead>
			    		<tr>
			          		<th>Date</th>
			          		<th>Package</th>
			          		<th>Transaction ID</th>
			          		<th>Price</th>
			          		<th>Credit</th>
			          	</tr>
			        </thead>
			        <tbody>
			          	<tr>
			          		<td>01/02/2014</td>
			          		<td>Pack 1</td>
			          		<td>ARETR4875GD68SS65</td>
			          		<td>$ 5.99</td>
			          		<td>1000</td>
			          	</tr>
			          	<tr>
			          		<td>01/02/2014</td>
			          		<td>Pack 1</td>
			          		<td>ARETR4875GD68SS65</td>
			          		<td>$ 5.99</td>
			          		<td>1000</td>
			          	</tr>
			          	<tr>
			          		<td>01/02/2014</td>
			          		<td>Pack 1</td>
			          		<td>ARETR4875GD68SS65</td>
			          		<td>$ 5.99</td>
			          		<td>1000</td>
			          	</tr>
			          	<tr>
			          		<td>01/02/2014</td>
			          		<td>Pack 1</td>
			          		<td>ARETR4875GD68SS65</td>
			          		<td>$ 5.99</td>
			          		<td>1000</td>
			          	</tr>
			          	<tr>
			          		<td>01/02/2014</td>
			          		<td>Pack 1</td>
			          		<td>ARETR4875GD68SS65</td>
			          		<td>$ 5.99</td>
			          		<td>1000</td>
			          	</tr>
			          	<tr>
			          		<td>01/02/2014</td>
			          		<td>Pack 1</td>
			          		<td>ARETR4875GD68SS65</td>
			          		<td>$ 5.99</td>
			          		<td>1000</td>
			          	</tr>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
<?php endif;?>
