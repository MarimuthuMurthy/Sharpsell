<?php include "../CMS_TEMPLATE/includes/db.php" ?>
<?php require_once "../CMS_TEMPLATE/includes/header.php" ?>
<?php require_once "../CMS_TEMPLATE/includes/navigation.php" ?>




<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">



            <?php

            if (isset($_GET['category'])) {
                $post_category_id = $_GET['category'];

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    $query = "select * from posts where post_category_id = '{$post_category_id}' ";
                } else {
                    $query = "select * from posts where post_category_id = '{$post_category_id}' and post_status = 'published'";
                }


                // $query = "select * from posts where post_category_id = '{$post_category_id}' and post_status = 'published'";
                $select_all_posts_query = mysqli_query($connection, $query);
                if (mysqli_num_rows($select_all_posts_query) < 1) {
                    echo "<h1 class = 'text-center'>NO POSTS AVAILABLE</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 50);


            ?>

                        <h1 class="page-header">

                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?= $post_id ?>"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                        <hr>
                        <img width="500" height="200" class="img-responsive" src="images/<?= $post_image; ?>" alt="<?php echo $post_title ?>">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>




            <?php }
                }
            } else {
                header("Location: index.php");
            } ?>










        </div>

        <?php require_once "../CMS_TEMPLATE/includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>
    <?php require_once "../CMS_TEMPLATE/includes/footer.php";
