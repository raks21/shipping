
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"><?php echo $page_title; ?></h3>
            <button type="button" class="btn btn-primary pull-right" style="    margin: 11px 6px;">+ Export</button>
            <button type="button" class="btn btn-primary pull-right" style="    margin: 11px 6px;">+ Import</button>
            <!--<button type="button" class="btn btn-primary pull-right" style="    margin: 11px 6px;">+ Add</button>-->
            <a class="btn btn-primary pull-right" style="margin: 11px 6px;" href="<?php echo site_url('party/add'); ?>">+ Add</a>
        </div>
        <div class="row mb">
            <!-- page start-->
            <?php if (!empty(@$notif)) { ?>
                <div id="signupalert" class="alert alert-<?php echo @$notif['type']; ?>">
                    <p><?php echo @$notif['message']; ?></p>
                    <span></span>
                </div>
            <?php } ?>

            <div class="content-panel">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th>Party Name</th>
                                <th>City</th>
                                <th class="hidden-phone">State Code</th>
                                <th class="hidden-phone">Phone</th>
                                <th class="hidden-phone">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($party as $value) { ?>
                                <tr class="gradeX">
                                    <td><?php echo $value->Party_Name; ?></td>
                                    <td><?php echo $value->City; ?></td>
                                    <td class="hidden-phone"><?php echo $value->State_Code; ?></td>
                                    <td class="center hidden-phone"><?php echo $value->Phone; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" onclick="return confirm('Want to edit?')" href="<?php echo site_url('party/edit/') . $value->Party_id; ?>" ><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" href="<?php echo site_url('party/delete/') . $value->Party_id; ?>" ><i class="fa fa-trash-o"></i></a>
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

