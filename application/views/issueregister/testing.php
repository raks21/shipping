
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> <?php echo $page_title; ?></h3>
            <form method="POST" class="pull-right" enctype="multipart/form-data">  
                <button type="submit" name="import_consignment" class="btn btn-primary" style=" margin: 11px 6px; float:left;">+ Import</button>
                <input type="file" name="import_excel" style="float:left;    margin-top: 15px;">

            </form>
            <a class="btn btn-primary pull-right" style="margin: 11px 6px;" href="<?php echo site_url('place/add'); ?>">+ Add</a>

        </div>
        <div class="row mb">
            <!-- page start-->


            <div class="content-panel">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th>Place_name</th>
                                <th>Place_off_address</th>
                                <th class="hidden-phone">Contact Person</th>
                                <th class="hidden-phone">Phone</th>
                                <th class="hidden-phone">Action</th>
                            </tr>
                        </thead>
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

