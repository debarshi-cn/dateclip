<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li><a href="<?php echo HTTP_ADMIN_PATH; ?>dashboard">Dashboard</a></li>
		<li class="active">Update Profile</li>
	</ol>

	<h1 class="page-header"><span class="glyphicon glyphicon-lock"></span> Update Profile</h1>
		<?php
			//form validation
			echo validation_errors();

			$attributes = array('class' => '', 'id' => '');
			echo form_open(HTTP_ADMIN_PATH.'profile/update/', $attributes);
      	?>
      	<h2><small><span class="glyphicon glyphicon-user"></span> Profile Information</small></h2>

      	<div class="panel panel-default main" >
		  	<div class="form-group">
		  		<label for="inputName">Name</label>
		  		<input type="text" name="name" class="form-control typeahead" id="inputName" value="<?php echo $admin[0]->name;?>" placeholder="Enter username"  >
		  	</div>

			<div class="form-group">
		  		<label for="inputEmail">Email Address:</label>
		  		<input type="text" name="location" class="form-control" id="inputEmail" value="<?php echo $admin[0]->email;?>" readonly placeholder="Location" >
		  		<p class="help-block">[ read-only ]</p>
		  	</div>

		</div>

	  	<h2><small><span class="glyphicon glyphicon-certificate"></span> Update Password</small></h2>

	  	<div class="panel panel-default main" >
			<div class="form-group">
		  		<label for="inputPass">Current Password</label>
		  		<input type="password" name="password" class="form-control" id="inputPass" placeholder="Current Password" value="" required>
		  	</div>

		  	<div class="form-group">
		  		<label for="inputNewPass">New Password</label>
		  		<input type="password" name="new_pwd" class="form-control" id="inputNewPass" placeholder="New Password" value="" required>
		  	</div>

		  	<div class="form-group">
		  		<label for="inputRePass">Re-type Password</label>
		  		<input type="password" name="re_pwd" class="form-control" id="inputRePass" placeholder="Re-type Password" value="" required>
		  	</div>

		</div>
	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Update Profile</button>
	  	</div>
	</form>
</div>
<script>
	jQuery(function() {

		jQuery( "#inputName" )
	    // don't navigate away from the field on tab when selecting an item
	    .bind( "keydown", function( event ) {
	    	if ( event.keyCode === $.ui.keyCode.TAB &&
		    	$( this ).data( "ui-autocomplete" ).menu.active ) {
			      	event.preventDefault();
	        	}
	      	})
	    .autocomplete({
	    	source: function( request, response ) {
	    		$.getJSON( "<?php echo HTTP_ADMIN_PATH;?>ajax/get_user_list/"+extractLast( request.term ), '', response );
	       	},
	        search: function() {
	        	// custom minLength
		        var term = extractLast( this.value );
		        if ( term.length < 2 ) {
		        	return false;
	          	}
	        },
	        focus: function() {
	        	// prevent value inserted on focus
		        return false;
	        },
	        select: function( event, ui ) {
	        	var terms = split( this.value );
		        // remove the current input
		        terms.pop();
		        // add the selected item
		        terms.push( ui.item.value );
		        // add placeholder to get the comma-and-space at the end
		        terms.push( "" );
		        this.value = terms.join( ", " );
		        return false;
	        }
	  	});

      	jQuery('#inputDesc').wysihtml5();
	});

	function split( val ) {
		return val.split( /,\s*/ );
  	}

  	function extractLast( term ) {
  	  	return split( term ).pop();
  	}
</script>