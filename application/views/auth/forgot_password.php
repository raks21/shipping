<div id="bg">
		<img src="http://localhost/econsult/assets/images/login-banner.jpeg" alt="">
	</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 login-box">
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title">Forgot password</h4>
                    </div>
                    <div class="card-content">

                        <form method="post" action="" class="form-horizontal" role="form">

                            <?php if (!empty(@$notif)) { ?>
                                <div id="signupalert" class="alert alert-<?php echo @$notif['type']; ?>">
                                    <p><?php echo @$notif['message']; ?></p>
                                    <span></span>
                                </div>
                            <?php } ?>

                            <div class="form-group label-floating">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $this->input->post('email'); ?>">
                            </div>

                            <div class="form-group label-floating">
                                <div class="control-label">
                                    <input type="submit" class="btn btn-primary btn-block" value=" &nbsp Reset &nbsp">
                                </div>                                           
                            </div>

                        </form>
                        <div class="form-group">
                            <div class="control">
                                Don't have an account ! <a href="<?php echo site_url('auth/register'); ?>">Sign Up | </a>
                                <a id="signinlink" href="<?php echo site_url('auth/login'); ?>">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





