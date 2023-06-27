<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo site_url('assests/lib/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo site_url('assests/lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="<?php echo site_url('assests/lib/jquery.backstretch.min.js'); ?>"></script>
<script>
    $.backstretch("<?php echo base_url('assests/img/login-bg.jpg'); ?>", {
        speed: 1200
    });
</script>
</body>

</html>
