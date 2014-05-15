<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
    <title><?php echo $page_title;?></title>

    <?php $this->load->view('admin/includes/css', $css_file); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>bootstrap-wysihtml5.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->

	<?php $this->load->view('admin/includes/js', $js_file); ?>
	<script src="<?php echo HTTP_JS_PATH; ?>wysihtml5-0.3.0.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>bootstrap3-wysihtml5.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("#checkall").click(function() {
				jQuery(".checkbox-item").prop('checked', this.checked);
			});

			jQuery(".calender-control").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});

			jQuery("a.userModalButton").on('click', function(e) {
				jQuery("#userDetailsModal .modal-content").load(jQuery(this).attr('data-src'));
			});

		});

		function popup_confirm(url, id) {

			var content = jQuery("#deleteConfirmModal .modal-footer").html();
			jQuery("#deleteConfirmModal .modal-footer").html('<form action="'+url+id+'" method="post">'+content+'</form>');
		}

		function check_repass(input, passid) {

	        if (input.value != jQuery('#'+passid).val()) {
	            input.setCustomValidity('Password Must be Matching.');
			} else {
				// input is valid -- reset the error message
				input.setCustomValidity('');
			}
		}
	</script>
  </head>
<body>
<?php $this->load->view('admin/includes/header'); ?>

<div class="container-fluid">
	<div class="row">
		<?php $this->load->view('admin/includes/sidebar'); ?>
		<?php $this->load->view($main_content); ?>
	</div>
	<div class="row">
		<?php $this->load->view('admin/includes/footer'); ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Confirm !!</h4>
		    </div>
		    <div class="modal-body">Are you sure you want to delete ?</div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        <button type="submit" class="btn btn-primary">Yes</button>
		    </div>
		</div>
	</div>
</div>
</body>
</html>