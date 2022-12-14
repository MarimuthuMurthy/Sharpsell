<?php 
    $status = session_status();
    if($status == PHP_SESSION_NONE)
    {
        session_start();
    }
?>
<?php include_once "admin/functions1.php"?>

<!-- Navigation -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                $query = "select * from categories";
                $select_all_categories_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    $category_class = '';
                    $registration_class = '';
                    $page_name = basename($_SERVER['PHP_SELF']);
                    $registration = 'registration.php';
                    if(isset($_GET['category']) && $_GET['category'] == $cat_id)
                    {
                        $category_class = 'active';
                    }
                    else if($page_name == $registration){
                        $registration_class = 'active';
                    }
                    echo "<li class='$category_class'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                }

                ?>
                <?php if(isLoggedIn()){
                    echo "<li><a href='admin'>admin</a></li>";
                    echo "<li><a href='includes/logout.php'>Logout</a></li>";
                }else{
                    $status = session_status();
                    echo "<li><a href='login.php'>login</a></li>";
                }
               ?>




                
                <li class='<?= $registration_class ?>'><a href="registration.php">Registration</a></li>
                <li><a href="contact.php">contact</a></li>
                
                <?php
                if (isset($_SESSION['role'])) {
                    if (isset($_GET['p_id'])) {
                        $post_id = $_GET['p_id'];
                        echo "<li><a href='admin/posts.php?source=edit_post&edit_id={$post_id}'>Edit post</a></li>";
                    }
                }
                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>