
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> <?php echo $page_title; ?></h3>
        </div>
        <div class="row mb">
            <!-- page start-->


            <div class="content-panel">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th>Sol No</th>
                                <th class="hidden-phone">Party_Name</th>
                                <th>City</th>
                                <th class="hidden-phone">PinCode</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($sol_details as $value) {
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo $value->Sol_No; ?></td>
                                    <td class="hidden-phone"><?php echo $value->Party_Name; ?></td>
                                    <td><?php echo $value->City; ?></td>
                                    <td class="center hidden-phone"><?php echo $value->PinCode; ?></td>

                                </tr>
                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- page end-->
            <!-- page end-->

        </div>
        <!-- /row -->
    </section>
    <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

