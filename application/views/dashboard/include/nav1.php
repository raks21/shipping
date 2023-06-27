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
        <a href="#" class="logo"> <img src="<?php echo site_url('assests/img/prowessNewlogo1111.png'); ?>" width="45"><b>PROWESS<span>SHIPPING</span></b></a>
        <!--logo end-->

        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <p class="centered">Admin </p>
                <h5 class="centered">Sam Soffes</h5>
                <li class="mt">
                    <a class="active" href="<?php echo site_url('dashboard'); ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-desktop"></i>
                        <span>Masters</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo site_url('company'); ?>">Company</a></li>
                        <li><a href="<?php echo site_url('user'); ?>">Users</a></li>
                        <li><a href="<?php echo site_url('party'); ?>">Party</a></li>
                        <li><a href="<?php echo site_url('place'); ?>">Place</a></li>
                    </ul>
                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->