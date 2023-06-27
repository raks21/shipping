
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> <?php echo $page_title; ?></h3>
            <button type="button" class="btn btn-primary pull-right" style="    margin: 11px 6px;">+ Export</button>
            <button type="button" class="btn btn-primary pull-right" style="    margin: 11px 6px;">+ Import</button>
            <!--<button type="button" class="btn btn-primary pull-right" style="    margin: 11px 6px;">+ Add</button>-->
            <a class="btn btn-primary pull-right" style="margin: 11px 6px;" href="<?php echo site_url('user/register'); ?>">+ Add</a>
        </div>
        <div class="row mb">
            <!-- page start-->


            <div class="content-panel">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th class="hidden-phone">Phone</th>
                                <th class="hidden-phone">Is Active</th>
                                <th class="hidden-phone">Type</th>
                                <th class="hidden-phone">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user as $usr) { ?>
                                <tr class="gradeX">
                                    <td><?php echo $usr->username; ?></td>
                                    <td><?php echo $usr->email; ?></td>
                                    <td class="hidden-phone"><?php echo $usr->mobile; ?></td>
                                    <?php
                                    if ($usr->is_active == 1) {
                                        echo "<td class='hidden-phone'>active</td>";
                                    } else {
                                        echo "<td class='hidden-phone'>in active</td>";
                                    }
                                    ?>
                                    <!--<td class="hidden-phone"><?php echo $usr->is_active; ?></td>-->
                                    <!--<td class="hidden-phone"><?php echo $usr->user_type; ?></td>-->
                                    <?php
                                    if ($usr->user_type == 1) {
                                        echo "<td class='hidden-phone'>administrator </td>";
                                    } else {
                                        echo "<td class='hidden-phone'>Support</td>";
                                    }
                                    ?>
                                    <td>
                                        <a class="btn btn-primary btn-xs" onclick="return false;" href="<?php echo site_url('user/edit/') . $usr->users_id; ?>" ><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" href="<?php echo site_url('user/delete/') . $usr->users_id; ?>" ><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- page end-->
        </div>
        <!-- /row -->
    </section>
    <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

