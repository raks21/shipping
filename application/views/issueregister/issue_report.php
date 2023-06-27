
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> <?php echo $page_title; ?></h3>
            <!--            <form method="POST" class="pull-right" enctype="multipart/form-data">  
                            <button type="submit" name="import_consignment" class="btn btn-primary" style=" margin: 11px 6px; float:left;">+ Import</button>
                            <input type="file" name="import_excel" style="float:left;    margin-top: 15px;">
            
                        </form>
                        <a class="btn btn-primary pull-right" style="margin: 11px 6px;" href="<?php echo site_url('place/add'); ?>">+ Add</a>-->

        </div>

        <?php
        if ($this->session->flashdata('message')) {
            ?>
            <div id="signupalert" class="alert alert-<?php echo $this->session->flashdata('type'); ?>">
                <p><?php echo $this->session->flashdata('message'); ?></p>  

            </div>
            <?php
        }
        ?>

        <div class="row mb">
            <!-- page start-->


            <div class="content-panel">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th>Consignment No</th>
                                <th>Consignee_Name</th>
                                <th class="hidden-phone">Consignee_Place</th>
                                <th class="hidden-phone">Consignee_Pincode</th>
                                <th class="hidden-phone">Party_Name</th>
                                <th class="hidden-phone">Prefix_Name</th>
                                <th class="hidden-phone">Is printed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($get_print_list as $value) { ?>
                                <tr>
                                    <td><?php echo $value->Consignment_No; ?></td>
                                    <td><?php echo $value->Consignee_Name; ?></td>
                                    <td><?php echo $value->Consignee_Place; ?></td>
                                    <td><?php echo $value->Consignee_Pincode; ?></td>
                                    <td><?php echo $value->Party_Name; ?></td>
                                    <td><?php echo $value->Prefix_Name; ?></td>
                                    <?php
                                    if ($value->is_printed == 1) {
                                        ?>
                                        <td><span class="label label-success label-mini">Yes</span></td>
                                        <?php
                                    } else {
                                        ?>
                                        <td><span class="label label-warning label-mini">No</span></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            <?php } ?>



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

