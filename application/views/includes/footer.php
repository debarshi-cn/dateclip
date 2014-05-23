<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
<!-- //

     FB.init({
       appId:'1411258222480134',
       cookie:true,
       status:true,
       xfbml:true
     });

     function LogoutFacebook() {
        //alert(22);
        FB.logout(function (response) {
            window.location.href = "<?php echo site_url('home/logout');?>";
        });
    }

    function FacebookInviteFriends() {
        FB.ui({ method: 'apprequests',
           message: 'My diaolog...'});
    }
// -->
</script>
<br /><br /><br /><br /><br />

<footer>
	<p>&copy; 2014 DateClip LLC. All Rights Reserved.</p>
</footer>