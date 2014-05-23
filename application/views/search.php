<h2>Search Settings</h2>
<?php
	//form validation
	echo validation_errors();

	$attributes = array('class' => '', 'id' => '');
	echo form_open(site_url("search"), $attributes);
?>
    <table border="0" width="50%">
	    <tr>
	        <td>I am :</td>
	        <td><input type="radio" id="gender_man" name="gender" value="M" <?php if ($search->gender == 'M') {echo "checked";}?> ><label for="gender_man">Man</label></td>
	        <td><input type="radio" id="gender_woman" name="gender" value="F" <?php if ($search->gender == 'F') {echo "checked";}?> ><label for="gender_woman">Woman</label></td>
	    </tr>
	    <tr><td>&nbsp;</td></tr>
	    <tr>
	        <td>Looking for :</td>
	        <td><input type="radio" id="looking_for_man" name="looking_for" value="M" <?php if ($search->looking_for == 'M') {echo "checked";}?> > <label for="looking_for_man">Man</label></td>
	        <td><input type="radio" id="looking_for_woman" name="looking_for" value="F" <?php if ($search->looking_for == 'F') {echo "checked";}?> > <label for="looking_for_woman">Woman</label></td>
	    </tr>
	    <tr><td>&nbsp;</td></tr>
	    <tr>
	        <td>
	            <label for="age_range_slider">Age Range:</label>
	        </td>
	        <td colspan="2">
	            <div id="age_range_slider"></div>
	            <div id="age_range_label"><?php echo $search->age_from;?> - <?php echo $search->age_to;?> years old</div>
	            <input type="hidden" name="age[min]" id="age_min" value="<?php echo $search->age_from;?>">
	            <input type="hidden" name="age[max]" id="age_max" value="<?php echo $search->age_to;?>">
	        </td>
	    </tr>
	    <tr><td>&nbsp;</td></tr>
	    <tr>
	        <td>
	            <label for="distance_range_slider">Distance in Miles:</label>
	        </td>
	        <td colspan="2">
	            <div id="distance_range_slider"></div>
	            <div id="distance_range_label"><?php echo $search->location_from;?> - <?php echo $search->location_to;?> miles away</div>
	            <input type="hidden" name="distance[min]" id="distance_min" value="<?php echo $search->location_from;?>">
	            <input type="hidden" name="distance[max]" id="distance_max" value="<?php echo $search->location_to;?>">
	        </td>
	    </tr>
	    <tr>
	    	<td></td>
	        <td> <input type="submit" id="button" name="submit" value="Submit" /></td>
	    </tr>
	</table>
</form>


<script type="text/javascript">
	jQuery(function() {

    	// SLIDER FOR AGE RANGE
        jQuery( "#age_range_slider" ).slider({
            range: true,
            min: 18,
            max: 99,
            values: [ <?php echo $search->age_from;?>, <?php echo $search->age_to;?> ],
            slide: function( event, ui ) {
            	jQuery( "#age_range_label" ).html(ui.values[0] + " - " + ui.values[1] + " years old" );
            	jQuery( "#age_min" ).val(ui.values[0]);
            	jQuery( "#age_max" ).val(ui.values[1]);
            }
        });


    	// SLIDER FOR DISTANCE
        jQuery( "#distance_range_slider" ).slider({
            range: true,
            min: 0,
            max: 250,
            values: [ <?php echo $search->location_from;?>, <?php echo $search->location_to;?> ],
            slide: function( event, ui ) {
            	jQuery("#distance_range_label").html(  ui.values[0] + " - " + ui.values[1] + " miles away" );
            	jQuery("#distance_min").val(ui.values[0]);
            	jQuery("#distance_max").val(ui.values[1]);
            }
        });
    });
</script>