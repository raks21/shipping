
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
                <button type="submit" name="issue_register" class="btn btn-primary pull-right" onclick="$('#loading').show();" style=" margin: 11px 6px;">+ Save</button>
            </div>
            <div class="row mb">
                <!-- page start-->
                <div class="col-lg-12">
                    <div class="form-panel">

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Pre-Fix</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="prefix" id="prefix">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($get_prefix as $value) {
                                            ?>
                                            <option <?php if ($value->Prefix_Id == $this->session->userdata('prefix')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Prefix_Id ?>'><?php echo $value->Prefix_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label"> Consignment Qty</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="consignment_qty" placeholder="1-15 Numeric" value="">
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
                                            <option <?php if ($value->Party_id == $this->session->userdata('partyname')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Party_id ?>'><?php echo $value->Party_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <script type="text/javascript">
                                    document.getElementById('partyname').value = "<?php echo $_GET['partyname']; ?>";
                                </script>
                            </div>

                            <!--                            <div class="form-group">
                                                            <label class="col-sm-12 col-sm-12 control-label">to</label>
                                                            <div class="col-sm-12">
                                                                <input type="number" class="form-control" name="toissue" placeholder="5-15 Numeric" value="">
                                                            </div>
                                                        </div>-->
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Available Qty</label>
                                <div class="col-sm-12">
                                    <input type="text" disabled="disabled" class="form-control"  value="<?php echo $avail_qty; ?>">
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
