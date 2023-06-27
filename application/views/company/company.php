
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i><?php echo $page_title; ?></h3>
        <div class="row mb">
            <!-- page start-->


            <div class="content-panel">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Company_Address</th>
                                <th class="hidden-phone">Company_Tel</th>
                                <th class="hidden-phone">Engine version</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($company as $cmpny) { ?>
                                <tr class="gradeX">
                                    <td><?php echo $cmpny->Company_Name; ?></td>
                                    <td><?php echo $cmpny->Company_Address; ?></td>
                                    <td class="hidden-phone"><?php echo $cmpny->Company_Tel; ?></td>
                                    <td class="center hidden-phone">4</td>

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

