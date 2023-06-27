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
<?php
//echo "<pre />";
//print_r($get_place);
?>
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
		//print_r($consign_data);
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
							
                                <label class="col-sm-12 col-sm-12 control-label"> Consignment No </label>
                                <div class="col-sm-12s">
								<?php
								
								$sess = $this->session->userdata('con_upd_id') ;
								
								
								
								if($sess){
									$sess = $sess + 1;
								}else{
									$sess = $sess;
								}
								
								if (is_array($consign_data)) {
									
								if($sess != $consign_data[0]->Consignment_No){
									$sess = $consign_data[0]->Consignment_No;
								}
								}
								
								
								
								
									
								?>
                                    <input type="text" class="form-control" name="consignee_no" placeholder="5-15 char" value="<?php echo $sess; ?>">
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

            $ids_ = array();
            if (is_array($consign_data)) {
                foreach ($consign_data as $value) {
                    $ids_[] = str_replace(' ', '', $value->Issuereg_Id);
                }
            }
            ?>
            <form class="style-form" name="form2" method="POST">  
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
                                        ?> class="form-control" name="prefix" id="prefix" tabindex=1>
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
                                        <input type="text" tabindex=2 readonly class="form-control" name="consignment_no" placeholder="3-25 char" value="<?php 
										if (is_array($consign_data)) {
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignment_No);
                                            }
                                        }  ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Name </label>
                                    <div class="col-sm-12">
                                        <input type="text" tabindex=3 class="form-control" name="consignee_name" placeholder="3-50 char" value="<?php
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
                                        <input type="text" tabindex=4 class="form-control" name="address1" placeholder="3-25 char" value="<?php
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
                                        <input type="text" tabindex=5 class="form-control" name="address2" placeholder="3-25 char" value="<?php
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
                                        ?>  class="form-control" name="partyname" id="partyname" tabindex=7>
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
                                        <input type="text" class="form-control" tabindex=8 name="reference_no" placeholder="3-25 char" value="<?php
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
                                        <input type="text" class="form-control" id="autouser" name="place" tabindex=9 placeholder="3-25 char" value="<?php 
										if (is_array($consign_data)) {
                                            foreach ($consign_data as $value) {
                                                echo str_replace('  ', '', $value->Consignee_Place);
                                            }
                                        }  ?>">
                                    </div>
                                </div>
								
								
<!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
  
     $( "#autouser" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        // url: "http://192.168.100.100/shipping_test/issueregister/placeList",
        url: "localhost/shipping/issueregister/placeList",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#autouser').val(ui.item.label); // display the selected text
       $('#userid').val(ui.item.value); // save selected id to input
       return false;
      }
     });

  });
  </script>
								
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Pincode</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control"  name="pincode" tabindex=10 placeholder="000000" value="<?php
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
                                        <input type="text" class="form-control" name="service" placeholder="3-25 char" tabindex=11 value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label">Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" readonly name="date" id="s_date" class="form-control" tabindex=12  value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> Weight</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="weight" tabindex=13 placeholder="0.00" value="<?php
                                        if (is_array($consign_data)) {
                                          //  echo str_replace('  ', '', $consign_data[0]->Consignee_Weight);
                                            foreach ($consign_data as $value) {
												 $wt = str_replace('  ', '', $value->Consignee_Weight);
												if($wt == ''){
													echo '0.1';
												}else{
														echo str_replace('  ', '', $value->Consignee_Weight);
												}
                                                
                                            }
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-sm-12 control-label"> No of pieces</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="pieces" tabindex=14 placeholder="123" value="<?php
                                               if (is_array($consign_data)) {
                                                   //  echo str_replace('  ', '', $consign_data[0]->No_Of_Pieces);
                                                   foreach ($consign_data as $value) {
                                                       $np = str_replace('  ', '', $value->No_Of_Pieces);
													   if($np == ''){
													echo '1';
												}else{
														echo str_replace('  ', '', $value->No_Of_Pieces);
												}
                                                   }
                                               }
                                               ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                <button type="submit" name="single_booking" class="btn btn-primary pull-right"  
				                onclick="$('#loading').show();" style=" margin: 11px 6px;"  tabindex=15>+ Save</button>
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
