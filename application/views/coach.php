<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2 class="modal-title">Coach!</h2>
</div>
<div class="modal-body">
	<?php foreach ($coach_list as $val) {
		$string = str_replace(" ", "_", strtolower($val->coach));
		$token = substr($string, 0, 15);
	?>
	<input type="radio" class="radioBtnClass" id="<?php echo $token;?>" name="coach_id" value="<?php echo $val->id;?>" > <?php echo $val->coach;?><br/>
	<?php } ?>

	<input type="text" id="other_reason" name="other_reason" />
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	<button type="button" id="confirmCoach" data-dismiss="modal" class="btn btn-primary">Confirm</button>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {

		jQuery('#other_reason').hide();

		jQuery('input[name="coach_id"]').bind('change',function(){
		    var showOrHide = ($(this).attr('id') == 'other') ? true : false;
		    jQuery('#other_reason').toggle(showOrHide);
		});

		// FOR COACH
		jQuery("#confirmCoach").click(function() {

			if (jQuery("input[type='radio'].radioBtnClass").is(':checked')) {
			    var coach_id = jQuery("input[type='radio'].radioBtnClass:checked").val();
			} else {
				var coach_id = "";
			}

			if (coach_id == '') {
				alert('Please select a coach');
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

            jQuery.post("<?php echo site_url('home/add_user_flag_coach') ?>",{ dateclip_id : dateclip_id, coach_id : coach_id, other_reason: other_reason, type : "COACH" },
                function(data){
                    //alert(data);
                    jQuery("#ajax_msg").html(data);
                });
            });

      });
</script>