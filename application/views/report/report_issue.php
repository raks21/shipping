
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->

<section id="main-content">
    <section class="wrapper">
        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"><?php echo $page_title; ?></h3>

        </div>
        <div class="row mb">
            <!-- page start-->


            <div class="content-panel">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th>Available Qty</th>
                                <th>Prefix</th>
                                <th class="hidden-phone">Party Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $this->load->model('party_model');
                            //$this->party_model->get_party_by_id($id);
                            foreach ($get_issue_reg as $value) {
                                ?>
                                <tr class="gradeX">
                                    <td><?php echo $value->cnt; ?></td>
                                    <td><?php
                                        print_r($this->party_model->get_prefix_by_id($value->Prefix_Id)->Prefix_Name);
                                        ?></td>
                                    <td class="hidden-phone"><?php
                                        print_r($this->party_model->get_party_by_id($value->Party_Id)->Party_Name);
                                        ?></td>

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

