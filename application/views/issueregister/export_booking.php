
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
                <button type="button" onclick="location.href = '<?php echo base_url(); ?>issueregister/exportCSV'" class="btn btn-primary pull-right" style=" margin: 11px 6px;">+ Export</button>
                <button type="submit" name="export_booking" onclick="$('#loading').show();" class="btn btn-primary pull-right" style=" margin: 11px 6px;">+ Submit </button>
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
                                            <option <?php if ($value->Prefix_Id == $this->session->userdata('exp_prefix')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Prefix_Id ?>'><?php echo $value->Prefix_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">From Date</label>
                                <div class="col-sm-12">
								<?php
								if(isset($_POST['Import_date_from'])){
									
								 $new_date_from = date('Y-m-d', strtotime($_POST['Import_date_from']));
								}else{
									 $new_date_from = date('Y-m-d');
								}
								?>
                                    <input type="date" class="form-control" name="Import_date_from" placeholder="date" value="<?php echo $new_date_from; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">Party Name</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="partyname" id="partyname">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($get_party as $value) {
                                            ?>
                                            <option <?php if ($value->Party_id == $this->session->userdata('exp_partyname')) { ?>selected="selected"<?php } ?>  value='<?php echo $value->Party_id ?>'><?php echo $value->Party_Name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-sm-12 control-label">To Date</label>
                                <div class="col-sm-12">
								<?php
								if(isset($_POST['Import_date_to'])){
									
								 $new_date_to = date('Y-m-d', strtotime($_POST['Import_date_to']));
								}else{
									 $new_date_to = date('Y-m-d');
								}
								?>
                                    <input type="date" class="form-control" name="Import_date_to" placeholder="date" value="<?php echo $new_date_to; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                        </div>
                    </div>
                </div>
                <!-- col-lg-12-->

                <!-- page end-->

                <div class="content-panel col-lg-12">
                    <div class="adv-table">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                            <thead>
                                <tr>
                                    <th>Consignment No</th>
									<th>Reference No</th>
                                    <th>Consignee_Name</th>
                                    <th class="hidden-phone">Consignee_Address1</th>
                                    <th class="hidden-phone">Consignee_Address2</th>
                                    <th class="hidden-phone">Place</th>
                                    <th class="hidden-phone">pincode</th>
                                    <th class="hidden-phone">weight</th>
                                    <th class="hidden-phone">pieces</th>
									<th class="hidden-phone">date</th>
                                </tr>
                            <tbody>
                                <?php foreach ($get_booking as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->Consignment_No; ?></td>
										<td><?php echo $value->Reference_No; ?></td>
                                        <td><?php echo trim($value->Consignee_Name); ?></td>
                                        <td><?php echo $value->Consignee_Address1; ?></td>
                                        <td><?php echo $value->Consignee_Address2; ?></td>
                                        <td><?php echo $value->Consignee_Place; ?></td>
                                        <td><?php echo $value->Consignee_Pincode; ?></td>
                                        <td><?php echo $value->Consignee_Weight; ?></td>
                                        <td><?php echo $value->No_Of_Pieces; ?></td>
										<td><?php echo date("d-m-Y", strtotime($value->Created_date)); ?></td>
                                    </tr>
                                <?php } ?>



                            </tbody>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </form>
    </section>
    <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

