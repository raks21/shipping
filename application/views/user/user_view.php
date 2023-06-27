<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Learn PHP CodeIgniter Framework with AJAX and Bootstrap</title>
        <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assests/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


        <div class="container">

        </center>
        <h3>Users</h3>
        <br />
        <a class="btn btn-success" href="user/register"><i class="glyphicon glyphicon-plus"></i> Add User</a>
        <br />
        <br />
        <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Mobile</th>
                    <th>Is Active</th>
                    <th style="width:125px;">Action
                        </p></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $usr) { ?>
                    <tr>
                        <td><?php echo $usr->username; ?></td>
                        <td><?php echo $usr->email; ?></td>
                        <td><?php echo $usr->mobile; ?></td>
                        <td><?php
                            if ($usr->is_active == 1) {
                                ?>
                                <i class="glyphicon glyphicon-check"></i>
                                <?php
                            } else {
                                ?>
                                <i class="glyphicon glyphicon-unchecked"></i>
                                <?php
                            }
                            ?></td>
                        <td>
                            <!--<a class="btn btn-warning" href="<?php echo "edit/" . $usr->users_id; ?>" ><i class="glyphicon glyphicon-pencil"></i></a>-->
                            <button class="btn btn-danger" onclick="delete_book(<?php echo $usr->users_id; ?>)"><i class="glyphicon glyphicon-remove"></i></button>


                        </td>
                    </tr>
                <?php } ?>



            </tbody>

            <tfoot>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Mobile</th>
                    <th>Is Active</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>

    </div>

    <script src="<?php echo base_url('assests/jquery/jquery-3.1.0.min.js') ?>"></script>
    <script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assests/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assests/datatables/js/dataTables.bootstrap.js') ?>"></script>


    <script type="text/javascript">
                            $(document).ready(function () {
                                $('#table_id').DataTable();
                            });
                            var save_method; //for save method string
                            var table;


                            function add_user()
                            {
                                save_method = 'add';
                                $('#form')[0].reset(); // reset form on modals
                                $('#modal_form').modal('show'); // show bootstrap modal
                                //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
                            }

                            function edit_book(id)
                            {
                                save_method = 'update';
                                $('#form')[0].reset(); // reset form on modals

                                //Ajax Load data from ajax
                                $.ajax({
                                    url: "<?php echo site_url('index.php/book/ajax_edit/') ?>/" + id,
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function (data)
                                    {

                                        $('[name="book_id"]').val(data.book_id);
                                        $('[name="book_isbn"]').val(data.book_isbn);
                                        $('[name="book_title"]').val(data.book_title);
                                        $('[name="book_author"]').val(data.book_author);
                                        $('[name="book_category"]').val(data.book_category);


                                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                                        $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title

                                    },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert('Error get data from ajax');
                                    }
                                });
                            }



                            function save()
                            {
                                var url;
                                if (save_method == 'add')
                                {
                                    url = "<?php echo site_url('index.php/user/user_add') ?>";
                                } else
                                {
                                    url = "<?php echo site_url('index.php/user/edit ') ?>";
                                }

                                // ajax adding data to database
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    data: $('#form').serialize(),
                                    dataType: "JSON",
                                    success: function (data)
                                    {
                                        //if success close modal and reload ajax table
                                        $('#modal_form').modal('hide');
                                        location.reload();// for reload a page
                                    },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert('Error adding / update data');
                                    }
                                });
                            }

                            function delete_book(id)
                            {
                                if (confirm('Are you sure delete this data?'))
                                {
                                    // ajax delete data from database
                                    $.ajax({
                                        url: "<?php echo site_url('index.php/user/user_delete') ?>/" + id,
                                        type: "POST",
                                        dataType: "JSON",
                                        success: function (data)
                                        {

                                            location.reload();
                                        },
                                        error: function (jqXHR, textStatus, errorThrown)
                                        {
                                            alert('Error deleting data');
                                        }
                                    });

                                }
                            }

    </script>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Book Form</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="user_code"/>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">User Name</label>
                                <div class="col-md-9">
                                    <input name="user_name" placeholder="User Name" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-9">
                                    <input name="user_password" placeholder="Password" class="form-control" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Conform</label>
                                <div class="col-md-9">
                                    <input name="user_confirm_password" placeholder="Confirm Password" class="form-control" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">User Status</label>
                                <div class="col-md-9">
                                    <input name="user_status" placeholder="User Status" class="form-control" type="text">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

</body>
</html>
