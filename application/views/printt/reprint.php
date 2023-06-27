
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

        <form class="form-horizontal style-form" method="POST">
            <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"><?php echo $page_title; ?> </h3>
                <button type="submit" name="issue_register" class="btn btn-primary pull-right" style=" margin: 11px 6px;">+ Print</button>
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
                                            <option <?php if ($value->Prefix_Id == $this->session->userdata('repri_prefix')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Prefix_Id ?>'><?php echo $value->Prefix_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label"> Range From</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="fromissue" placeholder="5-15 Numeric" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Party Name</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="partyname" onchange='this.form.submit()'>
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($get_party as $value) {
                                            ?>
                                            <option <?php if ($value->Party_id == $this->session->userdata('repri_partyname')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Party_id ?>'><?php echo $value->Party_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">to</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="toissue" placeholder="5-15 Numeric" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Available Qty</label>
                                <div class="col-sm-12">
                                    <input type="text" disabled="disabled" class="form-control"  value="<?php echo $repri_avail_qty; ?>">
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label"> Single Reference Booking</label>
                                <div class="col-sm-12">
                                    <input type="checkbox" name="ref_book" value="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">With Barcode</label>
                                <div class="col-sm-12">
                                    <input type="checkbox" name="withbarcode" value="1" checked>
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

