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

<?php if(count($dateclip)):?>
<img src="<?php echo site_url(UPLOAD_DATECLIP_DIR.$dateclip->dateclip);?>" width="200"  /><br/><br/>
<?php endif;?>

<form method="POST" action="<?php echo site_url("dateclip/upload"); ?>" enctype="multipart/form-data" >
    <table>
	    <tr>
	        <td>Select Video :</td>
	        <td><input type="file" id="video" name="video" ></td>
	    </tr>
	    <tr>
	        <td> <input type="submit" id="button" name="submit" value="Submit" /></td>
	    </tr>
	</table>
</form>