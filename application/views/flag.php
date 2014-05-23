<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2 class="modal-title">Why would you like to flag this DateClip ?</h2>
</div>
<div class="modal-body">
	<?php foreach ($flag_list as $val) {
		$string = str_replace(" ", "_", strtolower($val->flag));
		$token = substr($string, 0, 15);
	?>
	<input type="radio" class="radioBtnClass" id="<?php echo $token;?>" name="flag_id" value="<?php echo $val->id;?>" > <?php echo $val->flag;?><br/>
	<?php } ?>

	<input type="text" id="other_reason" name="other_reason" />
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" id="confirmFlag" data-dismiss="modal" class="btn btn-primary">Confirm</button>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {

		jQuery('#other_reason').hide();

		jQuery('input[name="flag_id"]').bind('change',function(){
		    var showOrHide = ($(this).attr('id') == 'other') ? true : false;
		    jQuery('#other_reason').toggle(showOrHide);
		});


        jQuery("#confirmFlag").click(function() {

            //$('#flagModal').hide();

            if (jQuery("input[type='radio'].radioBtnClass").is(':checked')) {
			    var flag_id = jQuery("input[type='radio'].radioBtnClass:checked").val();
			} else {
				var flag_id = "";
			}

			if (flag_id == '') {
				alert('Please select a flag');
				return false;
			}

			if (jQuery('#other_reason').val() != "") {
	    		var other_reason = jQuery('#other_reason').val();
	    	} else {
	    		var other_reason = "";
	    	}

			if (jQuery('#other_reason').css('display') != "none" && other_reason == "") {
				alert('Please enter a reason');
				return false;
			}

            var dateclip_id = jQuery("#dateclip_id").val();

            jQuery.post("<?php echo site_url('home/add_user_flag_coach') ?>",{ dateclip_id : dateclip_id, flag_id : flag_id, other_reason: other_reason, type : "FLAG" },
                function(data){
                    //alert(data);
                    jQuery("#ajax_msg").html(data);
            });
   		});

	});
</script>