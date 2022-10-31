<?php include "../CMS_TEMPLATE/includes/db.php" ?>
<?php require_once "../CMS_TEMPLATE/includes/header.php" ?>
<?php require_once "../CMS_TEMPLATE/includes/navigation.php" ?>




<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">



            <?php
            $per_page = 3;
            if(isset($_GET['page']))
            {
                $page = $_GET['page'];
            }else{
                $page = '';
            }
            if($page == '' || $page==1)
            {
                $page_1 = 0;
            }else{
                $page_1 = ($page *$per_page)-$per_page;
            }

            if(isset($_SESSION['role']) && $_SESSION['role']=='admin')
            {

                $post_count = "select * from posts";
            }
            else{
                $post_count = "select * from posts where post_status = 'published'";
            }


            // $post_count = "select * from posts where post_status = 'published'";
            
            $find_count = mysqli_query($connection , $post_count)or die("connection failed ".mysqli_error($connection));
            $count = mysqli_num_rows($find_count);
            
            $count = ceil($count/5);

            if($count < 1)
            {
                echo "<h1 class = 'text-center'>NO POSTS AVAILABLE</h1>";
            }
            else{

            $query = $post_count." LIMIT {$page_1},{$per_page}";
            $select_all_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_status = $row['post_status'];
                $post_content = substr($row['post_content'], 0, 400);
                
            ?>

                <h1 class="page-header">

                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?= $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?= $post_user?>&p_id=<?= $post_id?>"><?= $post_user ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <a href="post.php?p_id=<?= $post_id ?>">
                <img width="500" height="200" class="img-responsive" src="images/<?= $post_image; ?>" alt="<?php echo $post_title ?>">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>




            <?php }}?>










        </div>

        <?php require_once "../CMS_TEMPLATE/includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>
    <ul class = "pager">
        <?php
        for($i = 1 ; $i<=$count ; $i++)
        {
            if($i == $page)
            {
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            }
            else{
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>
    </ul>
    <?php require_once "../CMS_TEMPLATE/includes/footer.php";
