

<?php include "includes/admin_header.php" ?>


<div id="wrapper">


    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">


                    <h1 class="page-header">
                        Welcome to admin
                        <small><?= $_SESSION['username'] ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->



            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    $no_of_posts_query = "select * from posts";
                                    $execute_no_of_posts = mysqli_query($connection, $no_of_posts_query);
                                    $no_of_posts = mysqli_num_rows($execute_no_of_posts);
                                    ?>
                                    <div class='huge'><?= $no_of_posts ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a  href="./posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


                                    <?php
                                    $no_of_comments = record_count('comments');
                                    // $no_of_comments_query = "select * from comments";
                                    // $execute_no_of_comments = mysqli_query($connection, $no_of_comments_query);
                                    // $no_of_comments = mysqli_num_rows($execute_no_of_comments);
                                    ?>
                                    <div class='huge'><?= $no_of_comments ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    // $no_of_users_query = "select * from users";
                                    // $execute_no_of_users = mysqli_query($connection, $no_of_users_query);
                                    $no_of_users = record_count('users');
                                    ?>



                                    <div class='huge'><?= $no_of_users ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    // $no_of_category_query = "select * from categories";
                                    // $execute_no_of_category = mysqli_query($connection, $no_of_category_query);
                                    $no_of_category = record_count('categories');
                                    ?>



                                    <div class='huge'><?= $no_of_category ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php
            // $published_post_query = "select * from posts where post_status = 'Published'";
            // $execute_published_post = mysqli_query($connection, $published_post_query);
            $no_of_published_post = check_status('posts','post_status','Published');

            // $draft_post_query = "select * from posts where post_status = 'Draft'";
            // $execute_draft_post = mysqli_query($connection, $draft_post_query);
            $no_of_draft_post = check_status('posts','post_status','Draft');

            // $unapproved_comment_query = "select * from comments where comment_status = 'unapproved'";
            // $execute_unapproved_comment = mysqli_query($connection, $unapproved_comment_query);
            $no_of_unapproved_comment = check_status('comments','comment_status','unapproved');

            // $user_subscriber_query = "select * from users where user_role = 'Subscriber'";
            // $execute_user_subscriber = mysqli_query($connection, $user_subscriber_query);
            $no_of_user_subscriber = check_role('users','user_role','Subscriber');
            ?>



            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'Count'],

                            <?php

                            $elements_text = ['Active Post','Published posts', 'Draft posts', 'Comments', 'pending comments', 'Users', 'Subscribers count', 'Categories'];
                            $element_count = [$no_of_posts,$no_of_published_post, $no_of_draft_post, $no_of_comments, $no_of_unapproved_comment, $no_of_users, $no_of_user_subscriber, $no_of_category];


                            for ($i = 0; $i < 7; $i++) {
                                echo "['{$elements_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }

                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>







            <div class = "row">
            <style>
            #chartdiv {
            width: 100%;
            height: 500px;
            }
            </style>
                                <!-- Chart code -->
            <script>
            am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
            am5themes_Animated.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/radar-chart/
            var chart = root.container.children.push(am5radar.RadarChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "panX",
            wheelY: "zoomX",
            innerRadius: am5.percent(20),
            startAngle: -90,
            endAngle: 180
            }));

            var data = [];
            <?php
                for($i = 0 ; $i<7 ;$i++)
                {
            ?>
                data.push({
                    category:"<?= $elements_text[$i]?>",
                    value:<?= $element_count[$i]?>,
                    full:100,
                    columnSettings:{
                        fill: chart.get("colors").getIndex(<?= $i?>)
                    }
                });
                    
            <?php } ?>
            
            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/radar-chart/#Cursor
            var cursor = chart.set("cursor", am5radar.RadarCursor.new(root, {
            behavior: "zoomX"
            }));

            cursor.lineY.set("visible", false);

            // Create axes and their renderers
            // https://www.amcharts.com/docs/v5/charts/radar-chart/#Adding_axes
            var xRenderer = am5radar.AxisRendererCircular.new(root, {
            //minGridDistance: 50
            });

            xRenderer.labels.template.setAll({
            radius: 10
            });

            xRenderer.grid.template.setAll({
            forceHidden: true
            });

            var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
            renderer: xRenderer,
            min: 0,
            max: 100,
            strictMinMax: true,
            numberFormat: "#'%'",
            tooltip: am5.Tooltip.new(root, {})
            }));


            var yRenderer = am5radar.AxisRendererRadial.new(root, {
            minGridDistance: 20
            });

            yRenderer.labels.template.setAll({
            centerX: am5.p100,
            fontWeight: "500",
            fontSize: 18,
            templateField: "columnSettings"
            });

            yRenderer.grid.template.setAll({
            forceHidden: true
            });

            var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
            categoryField: "category",
            renderer: yRenderer
            }));

            yAxis.data.setAll(data);


            // Create series
            // https://www.amcharts.com/docs/v5/charts/radar-chart/#Adding_series
            var series1 = chart.series.push(am5radar.RadarColumnSeries.new(root, {
            xAxis: xAxis,
            yAxis: yAxis,
            clustered: false,
            valueXField: "full",
            categoryYField: "category",
            fill: root.interfaceColors.get("alternativeBackground")
            }));

            series1.columns.template.setAll({
            width: am5.p100,
            fillOpacity: 0.08,
            strokeOpacity: 0,
            cornerRadius: 20
            });

            series1.data.setAll(data);


            var series2 = chart.series.push(am5radar.RadarColumnSeries.new(root, {
            xAxis: xAxis,
            yAxis: yAxis,
            clustered: false,
            valueXField: "value",
            categoryYField: "category"
            }));

            series2.columns.template.setAll({
            width: am5.p100,
            strokeOpacity: 0,
            tooltipText: "{category}: {valueX}%",
            cornerRadius: 20,
            templateField: "columnSettings"
            });

            series2.data.setAll(data);

            // Animate chart and series in
            // https://www.amcharts.com/docs/v5/concepts/animations/#Initial_animation
            series1.appear(1000);
            series2.appear(1000);
            chart.appear(1000, 100);

            }); // end am5.ready()
            </script>

            <!-- HTML -->
            <div id="chartdiv"></div>
            </div>


















        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>