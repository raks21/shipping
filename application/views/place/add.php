
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
        }//print_r($state);
        ?>
        <form class="form-horizontal style-form" method="POST">
            <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> <?php echo $page_title; ?></h3>
                <button type="submit" name="add_place" class="btn btn-primary pull-right" style=" margin: 11px 6px;">+ Save</button>
            </div>
            <div class="row mb">
                <!-- page start-->
                <div class="col-lg-12">
                    <div class="form-panel">

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Place Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="placename" placeholder="3-30123 character" value="<?php echo $this->input->post('placename'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Address</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $this->input->post('address'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Contact Person</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="contactperson" placeholder="Contact Person" value="<?php echo $this->input->post('contactperson'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Phone</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="phone" placeholder="9876543210" value="<?php echo $this->input->post('phone'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Place Type</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="placetype">
                                        <!--<option value="">select</option>-->
                                        <option value="D">D</option>
                                        <option value="L">L</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Place Remark</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="placeremark" placeholder="remark" value="<?php echo $this->input->post('placeremark'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">State</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="state">
                                        <?php
                                        foreach ($state as $value) {
                                            echo "<option value='$value->State_id'>$value->State</option>";
                                        }
                                        ?>
                                    </select>
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

