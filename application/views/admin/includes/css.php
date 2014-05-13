<!-- CSS added from script starts here -->
<?php
	if (is_array($css_file)) {

		foreach ($css_file as $file) {
?>
		<link href="<?php echo HTTP_CSS_PATH; ?><?php echo $file; ?>.css" rel="stylesheet" type="text/css" />
<?php
		}
	} else {
?>
		<link href="<?php echo HTTP_CSS_PATH; ?><?php echo $css_file;?>.css" rel="stylesheet" type="text/css" />
<?php
	}
?>
<!-- CSS added from script ends here -->