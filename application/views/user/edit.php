
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <?php if (!empty(@$notif)) { ?>
            <div id="signupalert" class="alert alert-<?php echo @$notif['type']; ?>">
                <p><?php echo @$notif['message']; ?></p>
                <span></span>
            </div>
            <?php
        }
        ?>
        <form class="form-horizontal style-form" method="POST">
            <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> Advanced Table Example</h3>
                <button type="submit" name="edit_register" class="btn btn-primary pull-right" style=" margin: 11px 6px;">+ Save</button>
            </div>
            <div class="row mb">
                <!-- page start-->
                <div class="col-lg-12">
                    <div class="form-panel">

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">User Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" disabled="" name="username" placeholder="alphanumeric | 3-15 character" value="<?php echo $get_user->username; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">First Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="first_name" placeholder="Your First Name" value="<?php echo $get_user->first_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Last Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="last_name" placeholder="Your Last Name" value="<?php echo $get_user->last_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email" placeholder="abc@example.com" value="<?php echo $get_user->email; ?>">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Mobile</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="mobile" placeholder="9876543210" value="<?php echo $get_user->mobile; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" name="password" placeholder="alphanumeric | 3-12 character" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Confirm Password</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="alphanumeric | 3-12 character" value="">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- col-lg-12-->

                <!-- page end-->
            </div>
            <!-- /row -->
        </form>
    </section>
    <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

