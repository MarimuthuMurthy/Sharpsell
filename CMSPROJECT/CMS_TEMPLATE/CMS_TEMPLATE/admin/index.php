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
                        <a href="./posts.php">
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
                                    $no_of_comments_query = "select * from comments";
                                    $execute_no_of_comments = mysqli_query($connection, $no_of_comments_query);
                                    $no_of_comments = mysqli_num_rows($execute_no_of_comments);
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
                                    $no_of_users_query = "select * from users";
                                    $execute_no_of_users = mysqli_query($connection, $no_of_users_query);
                                    $no_of_users = mysqli_num_rows($execute_no_of_users);
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
                                    $no_of_category_query = "select * from categories";
                                    $execute_no_of_category = mysqli_query($connection, $no_of_category_query);
                                    $no_of_category = mysqli_num_rows($execute_no_of_category);
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
                $draft_post_query = "select * from posts where post_status = 'draft'";
                $execute_draft_post = mysqli_query($connection, $draft_post_query);
                $no_of_draft_post = mysqli_num_rows($execute_draft_post);

                $unapproved_comment_query = "select * from comments where comment_status = 'unapproved'";
                $execute_unapproved_comment = mysqli_query($connection, $unapproved_comment_query);
                $no_of_unapproved_comment = mysqli_num_rows($execute_unapproved_comment);

                $user_subscriber_query = "select * from users where user_role = 'Subscriber'";
                $execute_user_subscriber = mysqli_query($connection, $user_subscriber_query);
                $no_of_user_subscriber = mysqli_num_rows($execute_user_subscriber);
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

                            $elements_text = ['Active Post','Draft posts','Comments','pending comments','Users','Subscribers count','Categories'];
                            $element_count = [$no_of_posts,$no_of_draft_post,$no_of_comments,$no_of_unapproved_comment,$no_of_users,$no_of_user_subscriber,$no_of_category];


                            for($i = 0 ; $i<7; $i++)
                            { 
                                echo "['{$elements_text[$i]}'".","."{$element_count[$i]}],";
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


















        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>