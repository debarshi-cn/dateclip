<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $page_title;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo HTTP_CSS_PATH; ?>signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->

    <?php $this->load->view('admin/includes/js', $js_file); ?>
  </head>

  <body>
    <div class="container">
    	<form class="form-signin panel" role="form" method="post" action="<?php echo base_url(); ?>admin/home/do_login">

        <h2 class="form-signin-heading">DateClip Admin Login</h2>
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
        <?php if(isset($error)):?>
        <div class="alert alert-danger alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        	<?php echo $error;?>
        </div>
        <?php endif;?>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <br />
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <a href="<?php echo base_url(); ?>admin/home/forgot_password/">Forgot Password?</a>
        <br /><br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>