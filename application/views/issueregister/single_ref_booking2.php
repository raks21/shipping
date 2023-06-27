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

                <button type="submit" name="single_booking" class="btn btn-primary pull-right"  onclick="$('#loading').show();" style=" margin: 11px 6px;">+ Save</button>

                <div class="row mb">
                    <!-- page start-->
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <div class="col-lg-5">

                                
								<div class="form-group">
								<?php //echo $this->session->userdata('ref_ins_id');
								if($this->session->userdata('ref_ins_id')){
									$varaa = $last_consin_no->Consignment_No;
								}else{
									$varaa = 100000;
								} 
								
								?>
                                    <label class="col-sm-12 col-sm-12 control-label"> Consignment No * </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="consignment_no" placeholder="3-25 char" value="<?php echo $varaa + 1; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Name * </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="consignee_name" placeholder="3-50 char" value="<?php echo $this->input->post('consignee_name'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Address lane 1</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="address1" placeholder="3-25 char" value="<?php echo $this->input->post('address1'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Address lane 2</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="address2" placeholder="3-25 char" value="<?php echo $this->input->post('address2'); ?>">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-5">
                                
								<div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Reference No *</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="reference_no" placeholder="3-25 char" value="<?php echo $this->input->post('reference_no'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Place *</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="place" placeholder="3-25 char" value="<?php echo $this->input->post('place'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Pincode *</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="pincode" placeholder="000000" value="<?php echo $this->input->post('pincode'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Service area</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="service" placeholder="3-25 char" value="<?php echo $this->input->post('service'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Weight</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="weight" placeholder="0.00" value="<?php echo $this->input->post('weight'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> No of pieces</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="pieces" placeholder="123" value="<?php echo $this->input->post('pieces'); ?>">
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