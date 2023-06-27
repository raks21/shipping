<html>
    <head>
        <title>Excel import</title>
    </head>
    <body>
        <h1>Excel import</h1>
        <?php
        echo form_open_multipart('Excel_import/import_data');
        echo form_upload('file');
        echo '<br/>';
        echo form_submit(null, 'Upload');
        echo form_close();
        ?>
        <h4>Total data : <?php echo $num_rows; ?></h4>


        <form class="md-form" method="POST" enctype="multipart/form-data">
            <div class="file-field">
                <div class="btn btn-primary btn-sm float-left">
                    <span>Choose files</span>
                    <input type="file" multiple>
                </div>
            </div>
        </form>
    </body>
</html>