<!-- FOR LIKES -->
<?php if ($type == "LIKE") { ?>
<div id="alert alert-success">
	<h3>Your like was success fully saved for future use.</h3>
</div>
<?php } ?>

<!-- FOR DISLIKES -->
<?php if ($type == "DISLIKE") { ?>
<div id="alert alert-danger">
	<h3>Your Dislike for this dateclip was success fully saved for future use.</h3>
</div>
<?php } ?>

<!-- FOR FLAG -->
<?php if ($type == "FLAG") { ?>
<div id="alert alert-danger">
    <h3>This dateclip is flaged by you and has been marked for review. </h3>
</div>
<?php } ?>

<!-- FOR COACH -->
<?php if ($type == "COACH") { ?>
<div id="alert alert-danger">
	<h3>This dateclip has been coached by you. </h3>
</div>
<?php } ?>