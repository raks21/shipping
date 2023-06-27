<div id="login-page">
    <div class="container">

        <form class="form-login" method="POST">
            <h2 class="form-login-heading">sign in now</h2>
            <?php if (!empty(@$notif)) { ?>
                <div id="login-alert" class="alert alert-<?php echo @$notif['type']; ?> col-sm-12"><?php echo @$notif['message']; ?></div>
            <?php } ?>
            <div class="login-wrap">
                <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $this->input->post('username'); ?>" autofocus>      
                <br>
                <input id="login-password" type="password" class="form-control" name="password">
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me

                </label>
                <button class="btn btn-theme btn-block" name="userlogin" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
            </div>

        </form>
    </div>
</div>
