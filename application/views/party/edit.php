
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
        <form class="form-horizontal style-form" method="POST">
            <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> <?php echo $page_title; ?></h3>
                <button type="submit" name="edit_party" class="btn btn-primary pull-right" style=" margin: 11px 6px;">+ Save</button>
            </div>
            <div class="row mb">
                <!-- page start-->
                <div class="col-lg-12">
                    <div class="form-panel">

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Party Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="partyname" placeholder="3-30 character" value="<?php echo $get_party->Party_Name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Address(Lane 1)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="address1" placeholder="Lane 1" value="<?php echo $get_party->Party_Address1; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Address(Lane 2)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="address2" placeholder="Lane 2" value=" <?php echo $get_party->Party_Address2; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">City</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="city" placeholder="9876543210" value="<?php echo $get_party->City; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Pincode</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="pincode" placeholder="111111" value="<?php echo $get_party->State_Code; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Phone</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="phone" placeholder="9876543210" value="<?php echo $get_party->Phone; ?>">
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

