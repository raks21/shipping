
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row" style="background:ccc;"><h3 style="float:left; padding-left: 10px;"> <?php echo $title; ?></h3>
            <form method="POST" class="pull-right" enctype="multipart/form-data">  
                <button type="submit" name="import_place" class="btn btn-primary" style=" margin: 11px 6px; float:left;">+ Import</button>
                <input type="file" name="place_excel" style="float:left;    margin-top: 15px;">

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
                                <th>Pincode</th>
                                <th>City</th>
                                <th class="hidden-phone">State</th>
                                <th class="hidden-phone">Hub</th>
                                <th class="hidden-phone">Sector</th>
                                <th class="hidden-phone">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pincode as $value) { ?>
                                <tr class="gradeX">
                                    <td><?php echo $value->PINCODE; ?></td>
                                    <td><?php echo $value->CITY; ?></td>
                                    <td class="hidden-phone"><?php echo $value->STATE; ?></td>
                                    <td class="center hidden-phone"><?php echo $value->HUB; ?></td>
                                    <td class="center hidden-phone"><?php echo $value->SECTOR; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" onclick="return confirm('Want to edit?')" href="<?php echo site_url('place/edit/') . $value->Place_Code; ?>" ><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" href="<?php echo site_url('place/delete/') . $value->Place_Code; ?>" ><i class="fa fa-trash-o"></i></a>
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

