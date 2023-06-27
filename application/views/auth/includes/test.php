
<div class="content" >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 login-box">
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title">Customer Login</h4>
                    </div>
                    <div class="card-content">
                        <?php if (!empty(@$notif)) { ?>
                            <div id="login-alert" class="alert alert-<?php echo @$notif['type']; ?> col-sm-12"><?php echo @$notif['message']; ?></div>
                        <?php } ?>
                        <form method="post" action="" role="form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">User Name</label>
                                        <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $this->input->post('username'); ?>" >                                        
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Password</label>
                                        <input id="login-password" type="password" class="form-control" name="password">
                                    </div>
                                    <!--                                    <div class="input-group">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                                                                </label>
                                                                            </div>
                                                                        </div>-->
                                </div>
                            </div>
                            <div style="margin-top:15px">
                                <div class="col-sm-12 controls">
                                    <input type="submit" class="btn btn-success btn-block" value=" Login ">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 control">
                                    Don't have an account ! <a href="<?php echo site_url('auth/register'); ?>">Sign Up Here | </a>
                                    <a href="<?php echo site_url('auth/forgot_password'); ?>">Forgot password?</a>
                                </div>
                            </div>    
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



