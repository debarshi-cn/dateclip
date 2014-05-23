<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
    <title><?php echo $site_name;?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH; ?>jquery-ui-1.10.4.min.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->

	<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery-ui-1.10.4.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>bootstrap.min.js"></script>
  </head>
<body>

<div class="container">
	<?php $this->load->view('includes/header'); ?>
	<?php $this->load->view($main_content); ?>
	<?php $this->load->view('includes/footer'); ?>
</div>
</body>
</html>