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

    <!-- Custom styles for this template -->
    <link href="<?php echo HTTP_CSS_PATH; ?>signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->

	<?php $this->load->view('admin/includes/js', $js_file); ?>
	<script type="text/javascript">
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
    <div class="container">
        <form class="form-signin panel" role="form" method="post" action="">
        <h2 class="form-signin-heading">Recover Password</h2>
        <?php
        	echo validation_errors();
        ?>
        <?php if(isset($error)):?>
        <div class="alert alert-danger">
        	<?php echo $error;?>
        </div>
        <?php endif;?>
        <input type="password" class="form-control" placeholder="New Password" name="new_pwd" id="new_pwd" required="required" oninput="check_repass(this, 're_new_pwd')" autofocus>
        <input type="password" class="form-control" placeholder="Retype Password" name="re_new_pwd" id="re_new_pwd" required="required" oninput="check_repass(this, 'new_pwd')">
        <input type="hidden" name="key" value="<?php echo $user_info->enc_key;?>"  />
        <a href="<?php echo base_url(); ?>admin">Click here for login</a>
        <br /><br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>