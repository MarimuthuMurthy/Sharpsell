<?php include "../CMS_TEMPLATE/includes/db.php" ?>
<?php require_once "../CMS_TEMPLATE/includes/header.php" ?>
<?php require_once "../CMS_TEMPLATE/includes/navigation.php" ?>




<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
            }
            $query = "select * from posts where post_id = '$post_id'";
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
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <img width="500" height="200" class="img-responsive" src="images/<?= $post_image; ?>" alt="<?php echo $post_title ?>">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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
                $query = "insert into comments (comment_post_id , comment_author , comment_email ,comment_content , comment_status , comment_date)";
                $query .= "values ('{$the_post_id}','{$comment_author}','{$comment_email}','{$comment_content}','unApproved',now())";
                $result = mysqli_query($connection, $query) or die("query failed");
                $update_count = "update posts set post_comment_count = post_comment_count+1 where post_id = '{$the_post_id}'";
                $update_count_result = mysqli_query($connection , $update_count);
            }
            ?>






            <div class="well">

                <h4>Leave a Comment:</h4>
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div role="form">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your comment</label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php

            $query = "select *  from comments where comment_post_id = {$post_id} ";
            $query .= "and comment_status = 'approved' ";
            $query .= "order by comment_id DESC";
            $select_comment_query = mysqli_query($connection , $query);
            while($row = mysqli_fetch_assoc($select_comment_query))
            {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

            ?>
                <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?= $comment_author?>
                        <small><?= $comment_date ?></small>
                    </h4>
                    <?= $comment_content ?>
                </div>
            </div>

            <?php }?>

            





            <!-- Comment -->
            

        </div>

        <?php require_once "../CMS_TEMPLATE/includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>
    <?php require_once "../CMS_TEMPLATE/includes/footer.php";
