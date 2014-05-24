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

<h2>Home</h2>
<div id="ajax_msg"></div>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-wrap="false">

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
  <?php $i = 1;?>
  <?php foreach ($list as $value) : ?>
    <div class="item <?php echo ($i == 1)?"active":"";?>">
      <img src="<?php echo site_url(UPLOAD_DATECLIP_DIR.$value->dateclip);?>" width="400" title="">
      <div class="carousel-caption"></div>
      <input type="text" name="dateclip_id" id="dateclip_id" value="<?php echo $value->id;?>" >
    </div>
    <?php $i++;?>
  <?php endforeach; ?>
  </div>

</div>

<?php if (count($list) > 0) { ?>
<h2>Rate Me</h2>
<a class="btn btn-info btn-xs clickButton" href='javascript:;' id="like" title='Like'>Like</a>&nbsp;&nbsp;
<a class="btn btn-info btn-xs clickButton" href='javascript:;' id="dislike" title='Dislike'>Dislike</a>&nbsp;&nbsp;
<a class="btn btn-info btn-xs modalButton" href="javascript:;" data-src="<?php echo site_url("home/flag"); ?>" data-toggle="modal" data-target="#popModal">Flag</a>&nbsp;&nbsp;
<a class="btn btn-info btn-xs modalButton" href="javascript:;" data-src="<?php echo site_url("home/coach"); ?>" data-toggle="modal" data-target="#popModal">Coach</a>&nbsp;&nbsp;
<?php }?>

<!-- Modal -->
<div class="modal fade bs-example-modal-xs" id="popModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-body">

				<!-- Remote data loads here -->
				<span class="glyphicon glyphicon-refresh"></span> Loading please wait ...
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            	<button type="button" id="confirmFlag" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>


<script class="secret-source">
<!-- //
	jQuery(document).ready(function($) {

		// Initially pause the slider
		jQuery('#carousel-example-generic').carousel('pause');

		jQuery("a.modalButton").on('click', function(e) {
			jQuery("#popModal .modal-content").load(jQuery(this).attr('data-src'));
        });


        jQuery("a.clickButton").click(function() {
            var type = jQuery(this).attr('id');
            var dateclip_id = $("#dateclip_id").val();

            alert($("#dateclip_id").css('display'))
            alert(dateclip_id);
            return false;
            jQuery.post("<?php echo site_url('home/add_user_like_dislike') ?>",{ dateclip_id : dateclip_id, type : type.toUpperCase() },
                function(data){
                    //alert(data);
                    jQuery("#ajax_msg").html(data);

                    if (type.toUpperCase() == "LIKE") {
                    	jQuery('#carousel-example-generic').carousel('prev');
                    } else {
                    	jQuery('#carousel-example-generic').carousel('next');
                    }
                    jQuery('#carousel-example-generic').carousel('pause');
			});
        });

	});

// -->
</script>