
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <title>Prowess Shipping</title>

        <!-- Favicons -->
        <link href="<?php echo base_url('assests/img/favicon.png'); ?>" rel="icon">
        <link href="<?php echo base_url('assests/img/apple-touch-icon.png'); ?>" rel="icon">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		
        <!-- Bootstrap core CSS -->
        <link href="<?php echo site_url('assests/lib/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo site_url('assests/lib/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
        <link href="<?php echo site_url('assests/lib/advanced-datatable/css/demo_page.css'); ?>" rel="stylesheet" />
        <link href="<?php echo site_url('assests/lib/advanced-datatable/css/demo_table.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo site_url('assests/lib/advanced-datatable/css/DT_bootstrap.css'); ?>" />
        <!-- Custom styles for this template -->
        <link href="<?php echo site_url('assests/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('assests/css/style-responsive.css'); ?>" rel="stylesheet">
        <script type="text/javascript">
            (function (d) {
                d.getElementById('form').onsubmit = function () {
                    d.getElementById('submit').style.display = 'block';
                    d.getElementById('loading2').style.display = 'block';
                };
            }(document));
        </script>
        <style>
            #loading{
                width:100%;
                height:100%;
                position:fixed;
                z-index:9999;
                background:url("<?php echo base_url('assests/img/ajax-loader.gif'); ?>") no-repeat center center rgba(0,0,0,0.25)
            }
        </style>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    </head>
    <body>
        <div id="loading" style="display:none;">
        </div>

