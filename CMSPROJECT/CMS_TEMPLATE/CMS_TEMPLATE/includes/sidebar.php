            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">




                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>



                <!-- Login page-->
                <div class="well">
                    <?php if (isset($_SESSION['role'])) {
                        echo "<h4>logged in as {$_SESSION['username']}</h4>";
                        echo "<a href='includes/logout.php' class='btn btn-primary'>Logout</a>";
                    } else {
                    ?>
                        <h4>Login</h4>
                        <form action="includes/login.php" method="post">
                            <div class="form-group">
                                <input name="username" placeholder="Enter username" type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <input name="password" placeholder="Enter password" type="password" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" name="login" type="submit">submit</button>
                                </span>
                            </div>
                        </form>
                    <?php } ?>

                    <!-- /.input-group -->
                </div>







                <!-- Blog Categories Well -->
                <div class="well">

                    <?php
                    $query = "select * from categories LIMIT 4";
                    $select_categories_sidebar = mysqli_query($connection, $query);
                    ?>

                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<li><a href = 'category.php?category= {$cat_id}'>{$cat_title}</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include 'widget.php' ?>

            </div>