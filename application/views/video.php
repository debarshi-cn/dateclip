<?php require APPPATH."views/header.php"; ?>


<?php if(count($record)):?>
<img src="<?php echo site_url("uploads/video/".$record->dateclip);?>" /><br/><br/>
<?php endif;?>

<form class="cssform" name="property" id="property" method="POST" action="<?php echo site_url("video/add_video"); ?>"  enctype="multipart/form-data" >
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

<?php require APPPATH."/views/footer.php"; ?>