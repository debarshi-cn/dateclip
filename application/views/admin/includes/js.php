<!-- JS added from script starts here -->
<?php
	if(is_array($js_file)) {

		foreach ($js_file as $value) {
?>
		<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?><?php echo $value; ?>.js"></script>
<?php
		}
	} else {
?>
		<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?><?php echo $js_file; ?>.js"></script>
<?php
	}
?>
<!-- JS added from script ends here -->