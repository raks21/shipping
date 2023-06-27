<?php
$dashboard = 'inactive';
$master = 'inactive';
$transaction = 'inactive';
$company = 'inactive';
$user = 'inactive';
$party = 'inactive';
$place = 'inactive';
$issueregister = 'inactive';
$issueregister_import = 'inactive';
$issueregister_reference = 'inactive';
$issueregister_reference_no = 'inactive';
$issueregister_export = 'inactive';
$printt = 'inactive';
$print_master = 'inactive';
$printt_reprint = 'inactive';
$report = 'inactive';
$report_issue = 'inactive';
$report_booking = 'inactive';
$soldetail = 'inactive';
$soldetail1 = 'inactive';
$single_booking = 'inactive';
$single_ref_booking = 'inactive';
?>
<section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="#" class="logo"> <img src="<?php echo base_url('assests/img/prowessNewlogo1111.png'); ?>" width="45"><b>PROWESS<span>SHIPPING</span></b></a>
        <!--logo end-->

        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
            </ul>
            <div class="nav pull-right top-menu" id="google_translate_element"></div>
        </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php
    //   echo current_url() . "<br />";

    $var = explode("http://localhost/shipping", current_url());
    $action = $var[1];

    switch ($action) {
        case 'dashboard':
            $dashboard = 'active';

            break;
        case 'company':

            $master = 'active';
            $company = 'active';
            break;
        case 'user':

            $master = 'active';
            $user = 'active';
            break;
        case 'party':
            $master = 'active';
            $party = 'active';
            break;
        case 'place':
            $master = 'active';
            $place = 'active';
            break;
        case 'soldetail':
            $transaction = 'active';
            $soldetail = 'active';
            break;
        case 'soldetail/sollist':
            $master = 'active';
            $soldetail1 = 'active';
            break;
        case 'issueregister':
            $transaction = 'active';
            $issueregister = 'active';
            break;
        case 'issueregister/import':
            $transaction = 'active';
            $issueregister_import = 'active';
            break;
        case 'issueregister/reference':
            $transaction = 'active';
            $issueregister_reference = 'active';
            break;
			case 'issueregister/referencenumber':
            $transaction = 'active';
            $issueregister_reference_no = 'active';
            break;
        case 'issueregister/export_booking':
            $transaction = 'active';
            $issueregister_export = 'active';
            break;
        case 'printt':
            $printt = 'active';
            $print_master = 'active';
            break;
        case 'printt/reprint':
            $print_master = 'active';
            $printt_reprint = 'active';
            break;
        case 'report/issue_register':
            $report = 'active';
            $report_issue = 'active';
            break;
        case 'report/customer_booking':
            $report = 'active';
            $report_booking = 'active';
            break;
        default:
            $class = '';
            break;
    }
    ?>
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <!--<h5 class="centered">Admin </h5>-->
                <h5 class="centered"><?php
                    echo $this->session->userdata['logged_in']['first_name'] . " " . $this->session->userdata['logged_in']['last_name'];
                    ?></h5>

                <li class="mt">
                    <a class="<?php echo $dashboard; ?>" href="<?php echo site_url('dashboard'); ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="<?php echo $master; ?>" href="javascript:;">
                        <i class="fa fa-desktop"></i>
                        <span>Masters</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $company; ?>"><a href="<?php echo site_url('company'); ?>">Company</a></li>
                        <li class="<?php echo $user; ?>"><a href="<?php echo site_url('user'); ?>">Users</a></li>
                        <li class="<?php echo $party; ?>"><a href="<?php echo site_url('party'); ?>">Party</a></li>
                        <li class="<?php echo $place; ?>"><a href="<?php echo site_url('place'); ?>">Place</a></li>
                        <li class="<?php echo $soldetail1; ?>"><a href="<?php echo site_url('soldetail/sollist'); ?>">Sol Details</a></li>
<!--<li><a href="<?php echo site_url('pincode'); ?>">Pincode</a></li>-->
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="<?php echo $transaction; ?>" href="javascript:;">
                        <i class="fa fa-desktop"></i>
                        <span>Transaction</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $issueregister; ?>"><a href="<?php echo site_url('issueregister'); ?>">Issue Register</a></li>
                        <li class="<?php echo $issueregister_import; ?>"><a href="<?php echo site_url('issueregister/import'); ?>">Import Consign Booking</a></li>
                        <li class="<?php echo $issueregister_reference; ?>"><a href="<?php echo site_url('issueregister/reference'); ?>">Import Reference Booking</a></li>
						<li class="<?php echo $issueregister_reference_no; ?>"><a href="<?php echo site_url('issueregister/referencenumber'); ?>">Import Fixed Reference </a></li>
                        <li class="<?php echo $soldetail; ?>"><a href="<?php echo site_url('soldetail'); ?>">Import Sol Details</a></li>
						<li class="<?php echo $issueregister_export; ?>"><a href="<?php echo site_url('issueregister/export_booking'); ?>">Export Booking</a></li>
                        <li class="<?php echo $single_booking; ?>"><a href="<?php echo site_url('issueregister/singlebooking'); ?>">Global Search</a></li>
						<li class="<?php echo $single_ref_booking; ?>"><a href="<?php echo site_url('issueregister/singleconsignmentbooking'); ?>">Single Consign Booking</a></li>
						<li class="<?php echo $single_ref_booking; ?>"><a href="<?php echo site_url('issueregister/singlereferencebooking'); ?>">Single Reference Booking</a></li>
						
                        <!--<li><a href="<?php echo site_url('issueregister/report'); ?>">Report</a></li>-->
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="<?php echo $print_master; ?>" href="javascript:;">
                        <i class="fa fa-desktop"></i>
                        <span>Print</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $printt; ?>"><a href="<?php echo site_url('printt'); ?>">Consignment Print</a></li>
                        <li class="<?php echo $printt_reprint; ?>"><a href="<?php echo site_url('printt/reprint'); ?>">Consignment re-Print</a></li>
						<li class="<?php echo $printt_reprint; ?>"><a href="<?php echo site_url('printt/mannualprint'); ?>">single ref Print</a></li>
                        <!--<li><a href="<?php echo site_url('issueregister/report'); ?>">Report</a></li>-->
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="<?php echo $report; ?>" href="javascript:;">
                        <i class="fa fa-desktop"></i>
                        <span>Report</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $report_issue; ?>"><a href="<?php echo site_url('report/issue_register'); ?>">Issue register </a></li>
                        <li class="<?php echo $report_booking; ?>"><a href="<?php echo site_url('report/customer_booking'); ?>">Customer Booking</a></li>
                        <!--<li><a href="<?php echo site_url('issueregister/report'); ?>">Report</a></li>-->
                    </ul>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->