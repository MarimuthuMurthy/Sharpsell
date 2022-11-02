<?php include "../CMS_TEMPLATE/includes/db.php" ?>
<?php include "../CMS_TEMPLATE/includes/header.php" ?>
<?php include "../CMS_TEMPLATE/includes/navigation.php" ?>
<?php require_once "admin/functions1.php" ?>

<?php
if (isset($_POST['liked'])) {
    //step1 : Fetching the right post
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $searchPost = "select * from posts where post_id = '{$post_id}'";
    $postResultExecute = mysqli_query($connection, $searchPost);
    $postResult = mysqli_fetch_array($postResultExecute);
    $likes = $postResult['likes'];

    //step2 : update post with likes
    mysqli_query($connection, "update posts set likes=$likes+1 where post_id = $post_id");

    //step3 : create likes for post
    mysqli_query($connection, "insert into likes(user_id , post_id) values($user_id , $post_id)");

    exit();
}
if (isset($_POST['unliked'])) {
    //step1 : Fetching the right post
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $searchPost = "select * from posts where post_id = '{$post_id}'";
    $postResultExecute = mysqli_query($connection, $searchPost);
    $postResult = mysqli_fetch_array($postResultExecute);
    $likes = $postResult['likes'];

    //step2 : delete likes
    mysqli_query($connection, "delete from likes where post_id = $post_id and user_id=$user_id");

    //step3 : update likes (incrementing)
    mysqli_query($connection, "update posts set likes=$likes-1 where post_id = $post_id");

    exit();
}
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
                $view_count_query = "update posts set post_view_count = post_view_count+1 where post_id = {$post_id}";
                mysqli_query($connection, $view_count_query) or die("connection failed 2 " . mysqli_error($connection));

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    $query = "select * from posts where post_id =$post_id";
                } else {
                    $query = "select * from posts where post_id = '$post_id' and post_status ='published'";
                }
                $select_all_posts_query = mysqli_query($connection, $query) or die("connection failed " . mysqli_error($connection));
                if (mysqli_num_rows($select_all_posts_query) < 1) {
                    echo "<h1 class='text-center'>NO POSTS AVAILABLE</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];


            ?>

                        <h1 class="page-header">

                            posts
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?= $post_user ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                        <hr>
                        <img width="500" height="200" class="img-responsive" src="images/<?= $post_image; ?>" alt="<?php echo $post_title ?>">
                        <hr>
                        <p><?php echo $post_content ?></p>


                        <?php
                        if (isLoggedIn()) { ?>
                            <div class="row">
                                <p class="pull-right"><a 
                                class="<?= userLikedThisPost($post_id) ? 'unLike' : 'Like' ?>" 
                                href=""><span class="glyphicon glyphicon-thumbs-up"
                                data-toggle = "tooltip"
                                data-placement="top"
                                title="<?php echo userLikedThisPost($post_id)?'I liked this post before':'want to like this post'?>"
                                ></span>
                                <?= userLikedThisPost($post_id) ? 'unLike' : 'Like' ?>
                            </a></p>
                            </div>

                        <?php  } else { ?>
                            <div class="row">
                                <p class="pull-right">You need to login to like this post <a href="login.php">LOGIN</a></p>
                            </div>
                        <?php }
                        ?>


                        <hr>

                        <div class="row">
                            <p class="pull-right">Like : <?= getPostLikes($post_id) ?></p>
                        </div>
                        <div class="clearfix">

                        </div>


                    <?php }
                    ?>
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
                        } else {
                            echo "<script>alert('Fields cannt be empty')</script>";
                        }
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
                    $select_comment_query = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_comment_query)) {
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];

                    ?>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?= $comment_author ?>
                                    <small><?= $comment_date ?></small>
                                </h4>
                                <?= $comment_content ?>
                            </div>
                        </div>

            <?php }
                }
            } else {
                header("Location: index.php");
            } ?>







            <!-- Comment -->


        </div>

        <?php require_once "../CMS_TEMPLATE/includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>
    <?php require_once "../CMS_TEMPLATE/includes/footer.php"; ?>
    <script>
        $(document).ready(function() {
            $("[data-toggle='tooltip']").tooltip();
            var post_id = <?= $post_id; ?>;
            var user_id = <?= loggedInUserId() ?>;
            //like
            $('.Like').click(function() {
                $.ajax({
                    url: "post.php?p_id=<?= $post_id ?>",
                    type: 'post',
                    data: {
                        'liked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                });
            });
            //unlike
            $('.unLike').click(function() {
                $.ajax({
                    url: "post.php?p_id=<?= $post_id ?>",
                    type: 'post',
                    data: {
                        'unliked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                });
            });
        });
    </script>




    ;