<?php
	$this->load->view('admin/vwHeader');
?>
<div class="container">
	<div class="row">

		<?php $this->load->view('admin/vwSidebar'); ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<ul class="breadcrumb">
				<li><a href='#'>Dashboard</a></li>
				<li class="active">User Management</li>
			</ul>

			<h1 class="page-header">User Management</h1>

			<div class="panel panel-default" >
		        <!-- Table -->
		        <table class="table table-striped table-hover">
		          	<thead>
		          		<tr>
		          			<th><input type="checkbox"></th>
		          			<th>Username</th>
		          			<th>Email</th>
		          			<th>Login Date</th>
		          			<th>Status</th>
		          			<th>Process</th>
		          		</tr>
		          	</thead>
		            <tbody>
		            	<tr>
		            		<td><input type="checkbox"></td>
		            		<td>debarshidas</td>
		            		<td>debarshid@capitalnumbers.com</td>
		            		<td>2014-10-04 09:21:45</td>
		            		<td>Active</td>
		            		<td>
		            			<a href='#' title='View'> <i class="fam-zoom"></i></a>
		            			<a href='#' title='Edit'><i class="fam-user-edit"></i></a>
		            			<a href='#' title='Block'><i class="fam-user-gray"></i></a>
		            			<a href='#' title='Delete'><i class="fam-user-delete"></i></a>
		            		</td>
		            	</tr>
		            	<tr>
		            		<td><input type="checkbox"></td>
		            		<td>debarshidas</td>
		            		<td>debarshid@capitalnumbers.com</td>
		            		<td>2014-10-04 09:21:45</td>
		            		<td>Active</td>
		            		<td>
		            			<a href='#' title='View'> <i class="fam-zoom"></i></a>
		            			<a href='#' title='Edit'><i class="fam-user-edit"></i></a>
		            			<a href='#' title='Block'><i class="fam-user-gray"></i></a>
		            			<a href='#' title='Delete'><i class="fam-user-delete"></i></a>
		            		</td>
		            	</tr>
		            	<tr>
		            		<td><input type="checkbox"></td>
		            		<td>debarshidas</td>
		            		<td>debarshid@capitalnumbers.com</td>
		            		<td>2014-10-04 09:21:45</td>
		            		<td>Active</td>
		            		<td>
		            			<a href='#' title='View'> <i class="fam-zoom"></i></a>
		            			<a href='#' title='Edit'><i class="fam-user-edit"></i></a>
		            			<a href='#' title='Block'><i class="fam-user-gray"></i></a>
		            			<a href='#' title='Delete'><i class="fam-user-delete"></i></a>
		            		</td>
		            	</tr>
		            	<tr>
		            		<td><input type="checkbox"></td>
		            		<td>debarshidas</td>
		            		<td>debarshid@capitalnumbers.com</td>
		            		<td>2014-10-04 09:21:45</td>
		            		<td>Active</td>
		            		<td>
		            			<a href='#' title='View'> <i class="fam-zoom"></i></a>
		            			<a href='#' title='Edit'><i class="fam-user-edit"></i></a>
		            			<a href='#' title='Block'><i class="fam-user-gray"></i></a>
		            			<a href='#' title='Delete'><i class="fam-user-delete"></i></a>
		            		</td>
		            	</tr>
		            	<tr>
		            		<td><input type="checkbox"></td>
		            		<td>debarshidas</td>
		            		<td>debarshid@capitalnumbers.com</td>
		            		<td>2014-10-04 09:21:45</td>
		            		<td>Active</td>
		            		<td>
		            			<a href='#' title='View'> <i class="fam-zoom"></i></a>
		            			<a href='#' title='Edit'><i class="fam-user-edit"></i></a>
		            			<a href='#' title='Block'><i class="fam-user-gray"></i></a>
		            			<a href='#' title='Delete'><i class="fam-user-delete"></i></a>
		            		</td>
		            	</tr>
		            	<tr>
		            		<td><input type="checkbox"></td>
		            		<td>debarshidas</td>
		            		<td>debarshid@capitalnumbers.com</td>
		            		<td>2014-10-04 09:21:45</td>
		            		<td>Active</td>
		            		<td>
		            			<a href='#' title='View'> <i class="fam-zoom"></i></a>
		            			<a href='#' title='Edit'><i class="fam-user-edit"></i></a>
		            			<a href='#' title='Block'><i class="fam-user-gray"></i></a>
		            			<a href='#' title='Delete'><i class="fam-user-delete"></i></a>
		            		</td>
		            	</tr>
		            	<tr>
		            		<td><input type="checkbox"></td>
		            		<td>debarshidas</td>
		            		<td>debarshid@capitalnumbers.com</td>
		            		<td>2014-10-04 09:21:45</td>
		            		<td>Active</td>
		            		<td>
		            			<a href='#' title='View'> <i class="fam-zoom"></i></a>
		            			<a href='#' title='Edit'><i class="fam-user-edit"></i></a>
		            			<a href='#' title='Block'><i class="fam-user-gray"></i></a>
		            			<a href='#' title='Delete'><i class="fam-user-delete"></i></a>
		            		</td>
		            	</tr>
		            </tbody>
		        </table>
		    </div>

			<ul class="pagination">
		        <li class="disabled"><a href="#"><<</a></li>
		        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
		        <li><a href="#">2</a></li>
		        <li><a href="#">3</a></li>
		        <li><a href="#">4</a></li>
		        <li><a href="#">5</a></li>
		        <li><a href="#">>></a></li>
		    </ul>
			<?php $this->load->view('admin/vwFooter'); ?>
        </div>
    </div>
</div><!-- /.container -->