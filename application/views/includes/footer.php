<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
<!-- //

     FB.init({
       appId:'<?php echo $config['fb_app_id'];?>',
       cookie:true,
       status:true,
       xfbml:true
     });

     function LogoutFacebook() {
        //alert(22);
        FB.logout(function (response) {
            window.location.href = "<?php echo $logout_url;?>";
        });
    }

    function FacebookInviteFriends() {
        FB.ui({ method: 'apprequests',
           message: 'My diaolog...'});
    }
// -->
</script>

<footer>
	<p>&copy; 2014 DateClip LLC. All Rights Reserved.</p>
</footer>