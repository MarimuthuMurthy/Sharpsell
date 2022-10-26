<?php include "../CMS_TEMPLATE/includes/db.php" ?>
<?php include "../CMS_TEMPLATE/includes/header.php" ?>
<?php include "../CMS_TEMPLATE/includes/navigation.php" ?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
                $post_author = $_GET['author'];
            }
            $query = "select * from posts where post_author = '$post_author'";
            $select_all_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];


            ?>

                <h1 class="page-header">

                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    All post by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <img width="500" height="200" class="img-responsive" src="images/<?= $post_image; ?>" alt="<?php echo $post_title ?>">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>




            <?php } ?>
            <!-- Blog Comments -->

            <!-- Comments Form -->

            <?php
            if (isset($_POST['submit_comment'])) {
                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                if (!empty($the_post_id) && !empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                    $query = "insert into comments (comment_post_id , comment_author , comment_email ,comment_content , comment_status , comment_date)";
                    $query .= "values ('{$the_post_id}','{$comment_author}','{$comment_email}','{$comment_content}','unApproved',now())";
                    $result = mysqli_query($connection, $query) or die("query failed");
                    $update_count = "update posts set post_comment_count = post_comment_count+1 where post_id = '{$the_post_id}'";
                    $update_count_result = mysqli_query($connection, $update_count);
                } else {
                    echo "<script>alert('Fields cannt be empty')</script>";
                }
            }
            ?>








            <hr>

            <!-- Posted Comments -->








            <!-- Comment -->


        </div>

        <?php require_once "../CMS_TEMPLATE/includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>
    <?php require_once "../CMS_TEMPLATE/includes/footer.php";
