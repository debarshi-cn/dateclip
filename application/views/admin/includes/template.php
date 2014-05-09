<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
    <title><?php echo $page_title;?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>dashboard.css" rel="stylesheet">

    <link href="<?php echo HTTP_CSS_PATH; ?>jquery-ui-1.10.4.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->

    <!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2"></script>
	<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery-ui-1.10.4.min.js"></script>
	<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>bootstrap.min.js"></script>
	<script type="text/javascript">
		jQuery( document ).ready(function() {
			jQuery( "#checkall" ).click(function() {
				$('.checkbox-item').prop('checked', this.checked);
			});

			jQuery( "#inputDOB" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
		});
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
</body>
</html>