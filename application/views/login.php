<div class="container">
<?php echo $login_url;?>
    <form class="form-signin" role="form">
        <?php if (!@$user_profile):  // call var_dump($user_profile) to view all data ?>
            <!-- <div class="row">
                <div class="col-lg-12 text-center">
                    <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" style="width: 140px; height: 140px;">
                    <h2><?=$user_profile['name']?></h2>
                    <a href="<?=$user_profile['link']?>" class="btn btn-lg btn-default btn-block" role="button">View Profile</a>
                    <a href="javascript:LogoutFacebook();" class="btn btn-lg btn-primary btn-block" role="button">Logout</a>
                </div>
            </div> -->
        <?php //else: ?>
            <h2 class="form-signin-heading">Login with Facebook</h2>
            <a href="<?= $login_url ?>" class="btn btn-lg btn-primary btn-block" role="button">Login</a>
        <?php endif; ?>

    </form>

    <a href='#' onclick="FacebookInviteFriends();"> Facebook Invite Friends</a>

</div> <!-- /container -->