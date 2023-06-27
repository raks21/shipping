<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<style>
    div.withconsign {
        <?php
        if (isset($_POST['check_booking'])) {
            echo "display: display;";
        } else {
            echo "display: none;";
        }
        ?>

    }
</style>

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


        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"><?php echo $page_title; ?> </h3>
            <button value="Refresh Page" class="btn btn-primary pull-right" style=" margin: 11px 6px;" onClick="window.location.href = window.location.href"> Refresh </button>
        </div>
        <form class="form-horizontal style-form" name="form1" method="POST">
            <div class="row mb">
                <!-- page start-->
                <div class="col-lg-12">
                    <div class="form-panel">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label"> Reference / Consignment No </label>
                                <div class="col-sm-12s">
                                    <input type="text" class="form-control" name="consignee_no" placeholder="5-15 char" value="<?php echo $this->session->userdata('chk_con_no'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">  </label>
                                <div class="col-sm-12">
                                    <button type="submit" name="check_booking" class="btn btn-primary pull-right"  onclick="$('#loading').show();" style=" margin: 11px 6px;">+ Check </button>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- col-lg-12-->

                <!-- page end-->
            </div>
        </form>
        <!-- /row -->

        <!-- Single consignment booking from start -->
        <div class="withoutconsign">
            <?php
            $pre_ = "";
            if (is_array($consign_data)) {
                foreach ($consign_data as $value) {
                    $pre_ = str_replace(' ', '', $value->Prefix_Id);
                }
            } else {
                $pre_ = "";
            }

            $ids_ = "";
            if (is_array($consign_data)) {
                foreach ($consign_data as $value) {
                    $ids_[] = str_replace(' ', '', $value->Issuereg_Id);
                }
            }
            ?>
            <form class="form-horizontal style-form" name="form2" method="POST">

                <!--<button type="submit" name="single_booking"
                <?php
                if ($single_avail_qty == 0 && $ids_ == "") {
                    if ($ids_ == "") {
                        echo "disabled='disabled'";
                    }
                }
                ?>
                        class="btn btn-primary pull-right"  onclick="$('#loading').show();" style=" margin: 11px 6px;">+ Save</button>-->

                <div class="row mb">
                    <!-- page start-->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label">Pre-Fix</label>
                                    <div class="col-sm-12">
                                        <select <?php
                                        if ($ids_ != "") {
                                            echo "disabled";
                                        }
                                        ?> class="form-control" name="prefix" id="prefix">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($get_prefix as $value) {
                                                ?>
                                                <option <?php
                                                if (is_array($consign_data)) {
                                                    foreach ($consign_data as $val1) {
                                                        $pre_ = str_replace(' ', '', $val1->Prefix_Id);
                                                        //$pre_ = str_replace(' ', '', $consign_data[0]->Prefix_Id);
                                                    }
                                                } else {
                                                    $pre_ = "";
                                                }
                                                if ($value->Prefix_Id == $pre_) {
                                                    if ($pre_ != "") {
                                                        echo "selected='selected'";
                                                    }
                                                }
                                                ?> 
                                                    <?php if ($value->Prefix_Id == $this->session->userdata('single_prefix')) { ?>selected="selected"<?php } ?>
                                                    value='<?php echo $value->Prefix_Id ?>'><?php echo $value->Prefix_Name ?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>

                                    </div>
                                </div>
								
								 <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Consignment No </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="consignee_name" placeholder="3-25 char" value="<?php
                                        if (is_array($consign_data)) {
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignment_No);
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Name </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="consignee_name" placeholder="3-25 char" value="<?php
                                        if (is_array($consign_data)) {
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignee_Name);
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Address lane 1</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="address1" placeholder="3-25 char" value="<?php
                                        if (is_array($consign_data)) {
                                            //  echo str_replace('  ', '', $consign_data[0]->Consignee_Address1);
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignee_Address1);
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Address lane 2</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="address2" placeholder="3-25 char" value="<?php
                                        if (is_array($consign_data)) {
                                            //echo str_replace('  ', '', $consign_data[0]->Consignee_Address2);
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignee_Address2);
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label">Party Name</label>
                                    <div class="col-sm-12">
                                        <select  <?php
                                        if ($ids_ != "") {
                                            echo "disabled";
                                        }
                                        ?>  class="form-control" name="partyname" onchange='this.form.submit()' id="partyname">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($get_party as $value) {
                                                ?>
                                                <option <?php
                                                if (is_array($consign_data)) {
                                                    foreach ($consign_data as $val2) {
                                                        $pre_ = str_replace(' ', '', $val2->Party_Id);
                                                    }
                                                } else {
                                                    $pre_ = "";
                                                }
                                                if ($value->Party_id == $pre_) {
                                                    echo "selected='selected'";
                                                }
                                                ?> 
                                                    <?php if ($value->Party_id == $this->session->userdata('single_partyname')) { ?>selected="selected"<?php } ?>
                                                    value='<?php echo $value->Party_id ?>'><?php echo $value->Party_Name ?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
                                    </div>
                                    <script type="text/javascript">
                                        document.getElementById('partyname').value = "<?php echo $_GET['partyname']; ?>";
                                    </script>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Reference No</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="reference_no" placeholder="3-25 char" value="<?php
                                        if (is_array($consign_data)) {
                                            //           echo str_replace('  ', '', $consign_data[0]->Consignee_Place);
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Reference_No);
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Place</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="place" placeholder="3-25 char" value="<?php
                                        if (is_array($consign_data)) {
                                            //           echo str_replace('  ', '', $consign_data[0]->Consignee_Place);
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignee_Place);
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Pincode</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="pincode" placeholder="000000" value="<?php
                                        if (is_array($consign_data)) {
                                            //  echo str_replace('  ', '', $consign_data[0]->Consignee_Pincode);
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignee_Pincode);
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Service area</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="service" placeholder="3-25 char" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Available Qty</label>
                                    <div class="col-sm-12">
                                        <input type="text" disabled="disabled" class="form-control"  value="<?php echo $single_avail_qty; ?>">
                                    </div>
                                </div>
								<?php
									$newDate = '';
                                        if (is_array($consign_data)) {
                                            //           echo str_replace('  ', '', $consign_data[0]->Consignee_Place);
                                            foreach ($consign_data as $value) {
                                                $dates = str_replace('  ', '', $value->Created_date);
												$newDate = date("Y-m-d", strtotime($dates));
											  }
                                        }
                                        ?>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label">Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" disabled name="date" id="s_date" class="form-control"  value="<?php echo $newDate; ?>">
                                    </div>
									
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Weight</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="weight" placeholder="0.00" value="<?php
                                        if (is_array($consign_data)) {
                                            //  echo str_replace('  ', '', $consign_data[0]->Consignee_Weight);
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignee_Weight);
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> No of pieces</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="pieces" placeholder="123" value="<?php
                                               if (is_array($consign_data)) {
                                                   //  echo str_replace('  ', '', $consign_data[0]->No_Of_Pieces);
                                                   foreach ($consign_data as $value) {
                                                       echo str_replace('  ', '', $value->No_Of_Pieces);
                                                   }
                                               }
                                               ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- col-lg-12-->

                    <!-- page end-->
                </div>
            </form>
        </div>
        <?php ?>
        <!-- Single consignment booking from end -->
    </section>
    <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

<script>
    var today = moment().format('YYYY-MM-DD');
    document.getElementById("s_date").value = today;
</script>