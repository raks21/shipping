
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> <?php echo $page_title; ?></h3>
            <form method="POST" class="pull-right" enctype="multipart/form-data">  
                <button type="submit" name="import_sol" onclick="$('#loading').show();" class="btn btn-primary" style=" margin: 11px 6px; float:left;">+ Import</button>
                <input type="file" name="sol_excel" style="float:left;    margin-top: 15px;">

            </form>
        </div>
        <div class="row mb">

            <?php if (!empty(@$notif)) { ?>
                <div id="signupalert" class="alert alert-<?php echo @$notif['type']; ?>">
                    <p><?php echo @$notif['message']; ?></p>
                    <span></span>
                </div>
            <?php } ?>
            <?php
            if ($this->session->flashdata('message')) {
                ?>
                <div id="signupalert" class="alert alert-<?php echo $this->session->flashdata('type'); ?>">
                    <p><?php echo $this->session->flashdata('message'); ?></p>  

                </div>
                <?php
            }
            ?>
            <!-- page start-->
            <div class="content-panel">
                

                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th>Sol No</th>
                                <th>City</th>
                                <th class="hidden-phone">Party_Name</th>
                                <th class="hidden-phone">PinCode</th>
                                <th class="hidden-phone">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sol_details as $value) { ?>
                                <tr class="gradeX">
                                    <td><?php echo $value->Sol_No; ?></td>
                                    <td><?php echo $value->City; ?></td>
                                    <td class="hidden-phone"><?php echo $value->Party_Name; ?></td>
                                    <td class="center hidden-phone"><?php echo $value->PinCode; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" onclick="return confirm('Want to edit?')" href="<?php echo site_url('party/edit/') . $value->Sol_No; ?>" ><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" href="<?php echo site_url('party/delete/') . $value->Sol_No; ?>" ><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- page end-->
        </div>
        <!-- /row -->
    </section>
    <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

