
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
        <?php
        if ($this->session->flashdata('message')) {
            ?>
            <div id="signupalert" class="alert alert-<?php echo $this->session->flashdata('type'); ?>">
                <p><?php echo $this->session->flashdata('message'); ?></p>  

            </div>
            <?php
        }
        ?>

        <form class="form-horizontal style-form" method="POST" enctype="multipart/form-data">
            <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"><?php echo $page_title; ?> </h3>
                <button type="submit" name="import_consignment" onclick="$('#loading').show();" class="btn btn-primary pull-right" style=" margin: 11px 6px;">+ Import</button>
            </div>
            <div class="row mb">
                <!-- page start-->
                <div class="col-lg-12">
                    <div class="form-panel">

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Pre-Fix</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="prefix">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($get_prefix as $value) {
                                            ?>
                                            <option <?php if ($value->Prefix_Id == $this->session->userdata('imp_prefix')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Prefix_Id ?>'><?php echo $value->Prefix_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label"> Consignment From</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="fromissue" placeholder="5-15 Numeric" value="<?php echo $this->input->post('fromissue'); ?>">
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="col-sm-12 col-sm-12 control-label" title="Import Excel"> Import Excel </label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" name="excel_file" value="">
                                </div>
                            </div>



                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Party Name</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="partyname" onchange='this.form.submit()' id="partyname">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($get_party as $value) {
                                            ?>
                                            <option <?php if ($value->Party_id == $this->session->userdata('imp_partyname')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Party_id ?>'><?php echo $value->Party_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">to</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="toissue" placeholder="5-15 Numeric" value="<?php echo $this->input->post('toissue'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Available Qty</label>
                                <div class="col-sm-12">
                                    <input type="text" disabled="disabled" class="form-control"  value="<?php echo $imp_avail_qty; ?>">
                                </div>
                            </div>
							<div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label">Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" name="s_date" id="s_date" class="form-control"  value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <!-- col-lg-12-->

                <!-- page end-->
                <!-- page start-->
                <div class="col-lg-12">
                    <div>
                        <h4><i class="fa fa-angle-right"></i> Import Excel Format with Consignment No :</h4>
                        <div class="alert alert-warning alert-dismissable">
                            Consignee_Name | Consignee_Address1 | Consignee_Address2 | Consignee_Address3 | Consignee_Place | Consignee_Pincode | Consignee_Weight | No_Of_Pieces | Consignment_No
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

