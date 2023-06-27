<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>

        <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>
    <body>

        <div id="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-sm-12">

                    <br>
                    <form action="" method="GET">
                        <div class="input-group pull-right">
                            <input type="text" class="form-control" placeholder="Search For User" 
                                   name="UserName" value="<?php
                                   if (!empty($_GET['UserName'])) {
                                       echo $_GET['UserName'];
                                   }
                                   ?>">

                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                            </span>
                        </div> 
                    </form>


                    <table class="table table-bordered table-hover" border="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($results as $o) {
                                ?>
                                <tr>
                                    <td><?php echo $o->users_id; ?></td>
                                    <td><?php echo $o->username; ?></td>
                                    <td><?php echo $o->email; ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                    <ul class="pagination pull-right">
                        <!-- Show pagination links -->
                        <?php
                        foreach ($links as $link) {
                            echo "<li>" . $link . "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

    </body>
</html>