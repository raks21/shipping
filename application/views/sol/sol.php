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
                <button type="submit" name="import_sol" class="btn btn-primary pull-right" onclick="$('#loading').show();" style=" margin: 11px 6px;">+ Import</button>
            </div>
            <div class="row mb">
                <!-- page start-->
                <div class="col-lg-12">
                    <div class="form-panel">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Party Name</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="partyname" id="partyname">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($get_party as $value) {
                                            ?>
                                            <option <?php if ($value->Party_id == $this->session->userdata('sol_partyname')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Party_id ?>'><?php echo $value->Party_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <script type="text/javascript">
                                    document.getElementById('partyname').value = "<?php echo $_GET['partyname']; ?>";
                                </script>
                            </div>

                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Sol Import</label>
                                <div class="col-sm-12">
                                    <input type="file" name="sol_excel" style="float:left; margin-top: 15px;">

                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="col-lg-12">
                    <div>
                        <h4><i class="fa fa-angle-right"></i> Import Excel Format should be :</h4>
                        <div class="alert alert-warning alert-dismissable">
                            Sol_No | Party Name | Address1 | Address2 | Address3 | City | Pin Code | Remark1 | Remark2 | 
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



