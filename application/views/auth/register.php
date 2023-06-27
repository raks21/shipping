<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <h2>Register</h2>

            <form method="post" action="" role="form">
                <?php if (!empty(@$notif)) { ?>
                    <div id="signupalert" class="alert alert-<?php echo @$notif['type']; ?>">
                        <p><?php echo @$notif['message']; ?></p>
                        <span></span>
                    </div>
                <?php } ?>

                <div class="form-group label-floating">
                    <label for="username" class="control-label">User Name</label>
                    <input type="text" class="form-control" name="username" placeholder="alphanumeric | 3-15 character" value="<?php echo $this->input->post('username'); ?>">
                </div>
                <div class="form-group label-floating">
                    <label for="firstname" class="control-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Your First Name" value="<?php echo $this->input->post('first_name'); ?>">
                </div>
                <div class="form-group label-floating">
                    <label for="lastname" class="control-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Your Last Name" value="<?php echo $this->input->post('last_name'); ?>">
                </div>
                <div class="form-group label-floating">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="abc@example.com" value="<?php echo $this->input->post('email'); ?>">
                </div>
                <div class="form-group label-floating">
                    <label for="mobile" class="control-label">Mobile</label>
                    <input type="number" class="form-control" name="mobile" placeholder="9876543210" value="<?php echo $this->input->post('mobile'); ?>">
                </div>
                <div class="form-group label-floating">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="alphanumeric | 3-12 character" value="<?php echo $this->input->post('password'); ?>">
                </div>
                <div class="form-group label-floating">
                    <label for="icode" class="control-label">Retype Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="alphanumeric | 3-12 character" value="<?php echo $this->input->post('confirm_password'); ?>">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label"></label>
                    <div class="icheck pl40">
                        <?php
                        $checked = '';
                        if (count($_POST)) {
                            if ($this->input->post('is_active'))
                                $checked = 'checked';
                        } else
                            $checked = 'checked';
                        ?>
                        <input type="checkbox" name="is_active" value="1" <?php echo $checked; ?>> <label>Active</label>
                    </div>
                </div>


                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-primary" value=" &nbsp Sign Up &nbsp">
                    </div>                                           
                </div>
            </form>
            <div class="form-group">
                <div class="col-md-12 control">
                    Already Registered ! <a id="signinlink" href="<?php echo site_url('auth/login'); ?>">Sign In</a>
                </div>
            </div>
        </div>
    </body>
</html>






