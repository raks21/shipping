        
<!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-chart">
                <!--CUSTOM CHART START -->
                <div class="border-head">
                    <h3>USER VISITS</h3>
                </div>
                <div class="custom-bar-chart">
                    <ul class="y-axis">
                        <li><span>10.000</span></li>
                        <li><span>8.000</span></li>
                        <li><span>6.000</span></li>
                        <li><span>4.000</span></li>
                        <li><span>2.000</span></li>
                        <li><span>0</span></li>
                    </ul>
                    <div class="bar">
                        <div class="title">JAN</div>
                        <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">FEB</div>
                        <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">MAR</div>
                        <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">APR</div>
                        <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
                    </div>
                    <div class="bar">
                        <div class="title">MAY</div>
                        <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
                    </div>
                    <div class="bar ">
                        <div class="title">JUN</div>
                        <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
                    </div>
                    <div class="bar">
                        <div class="title">JUL</div>
                        <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
                    </div>
                </div>
                <!--custom chart end-->
                <div class="row mt">
                    <!-- SERVER STATUS PANELS -->
                    <div class="col-md-4 col-sm-4 mb">
                        <div class="grey-panel pn donut-chart">
                            <div class="grey-header">
                                <h5>SERVER LOAD</h5>
                            </div>
                            <canvas id="serverstatus01" height="120" width="120"></canvas>
                            <script>
                                var doughnutData = [{
                                        value: 70,
                                        color: "#FF6B6B"
                                    },
                                    {
                                        value: 30,
                                        color: "#fdfdfd"
                                    }
                                ];
                                var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                            </script>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p>Usage<br/>Increase:</p>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <h2>21%</h2>
                                </div>
                            </div>
                        </div>
                        <!-- /grey-panel -->
                    </div>
                    <!-- /col-md-4-->
                    <div class="col-md-4 col-sm-4 mb">
                        <div class="darkblue-panel pn">
                            <div class="darkblue-header">
                                <h5>DROPBOX STATICS</h5>
                            </div>
                            <canvas id="serverstatus02" height="120" width="120"></canvas>
                            <script>
                                var doughnutData = [{
                                        value: 60,
                                        color: "#1c9ca7"
                                    },
                                    {
                                        value: 40,
                                        color: "#f68275"
                                    }
                                ];
                                var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                            </script>
                            <p>April 17, 2014</p>
                            <footer>
                                <div class="pull-left">
                                    <h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
                                </div>
                                <div class="pull-right">
                                    <h5>60% Used</h5>
                                </div>
                            </footer>
                        </div>
                        <!--  /darkblue panel -->
                    </div>
                    <!-- /col-md-4 -->
                    <div class="col-md-4 col-sm-4 mb">
                        <!-- REVENUE PANEL -->
                        <div class="green-panel pn">
                            <div class="green-header">
                                <h5>REVENUE</h5>
                            </div>
                            <div class="chart mt">
                                <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                            </div>
                            <p class="mt"><b>$ 17,980</b><br/>Month Income</p>
                        </div>
                    </div>
                    <!-- /col-md-4 -->
                </div>
                <!-- /row -->


                <!-- /row -->

                <!-- /row -->
            </div>
            <!-- /col-lg-9 END SECTION MIDDLE -->
            <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->
            <div class="col-lg-3 ds">
                <!--COMPLETED ACTIONS DONUTS CHART-->
                <div class="donut-main">
                    <h4>COMPLETED ACTIONS & PROGRESS</h4>
                    <canvas id="newchart" height="130" width="130"></canvas>
                    <script>
                        var doughnutData = [{
                                value: 70,
                                color: "#4ECDC4"
                            },
                            {
                                value: 30,
                                color: "#fdfdfd"
                            }
                        ];
                        var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
                    </script>
                </div>
                <!--NEW EARNING STATS -->
                <div class="panel terques-chart">
                    <div class="panel-body">
                        <div class="chart">
                            <div class="centered">
                                <span>TODAY EARNINGS</span>
                                <strong>$ 890,00 | 15%</strong>
                            </div>
                            <br>
                            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                        </div>
                    </div>
                </div>
                <!--new earning end-->
                <!-- RECENT ACTIVITIES SECTION -->
                <h4 class="centered mt">RECENT ACTIVITY</h4>
                <!-- First Activity -->
                <div class="desc">
                    <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <div class="details">
                        <p>
                        <muted>Just Now</muted>
                        <br/>
                        <a href="#">Paul Rudd</a> purchased an item.<br/>
                        </p>
                    </div>
                </div>
                <!-- Second Activity -->
                <div class="desc">
                    <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <div class="details">
                        <p>
                        <muted>2 Minutes Ago</muted>
                        <br/>
                        <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                        </p>
                    </div>
                </div>
                <!-- Third Activity -->
                <div class="desc">
                    <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <div class="details">
                        <p>
                        <muted>3 Hours Ago</muted>
                        <br/>
                        <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
                        </p>
                    </div>
                </div>
                <!-- Fourth Activity -->
                <div class="desc">
                    <div class="thumb">
                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <div class="details">
                        <p>
                        <muted>7 Hours Ago</muted>
                        <br/>
                        <a href="#">Brando Page</a> purchased a year subscription.<br/>
                        </p>
                    </div>
                </div>
                <!-- USERS ONLINE SECTION -->

            </div>
            <!-- /col-lg-3 -->
        </div>
        <!-- /row -->
    </section>
</section>
<!--main content end-->

