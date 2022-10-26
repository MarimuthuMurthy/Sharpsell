<?php include "../admin/includes/admin_header.php" ?>
<?php include_once "functions1.php" ?>

<?php
if(isset($_SESSION['username']))
{
    $session_user_name = $_SESSION['username'];
    $query_session = "select * from users where user_name = '{$session_user_name}'";
    $select_user_profile_execute= mysqli_query($connection , $query_session) or die("connection failed".mysqli_error($connection));
    while($user_data = mysqli_fetch_array($select_user_profile_execute))
    {
        $session_user_id = $user_data['user_id'];
        $session_user_name = $user_data['user_name'];
        $session_user_first_name = $user_data['user_firstname'];
        $session_user_last_name = $user_data['user_lastname'];
        $session_user_password = $user_data['user_password'];
        $session_email = $user_data['user_email'];
        $session_image = $user_data['user_image'];
        $session_role = $user_data['user_role'];
    }
}


?>
<?php
if(isset($_POST['update_profile']))
{

    $new_profile_user_name = $_POST['username'];
    $new_profile_user_firstname =  $_POST['firstname'];
    $new_profile_user_lastname = $_POST['lastname'];
    $new_profile_user_email = $_POST['email'];
    $new_profile_user_role = $_POST['role'];
    $new_profile_add_user_query  = "update  users set ";
    $new_profile_add_user_query .= "user_name = '{$new_profile_user_name}' , user_firstname = '{$new_profile_user_firstname}',user_lastname = '{$new_profile_user_lastname}', user_email='{$new_profile_user_email}' , user_role='{$new_profile_user_role}' ";
    $new_profile_add_user_query .= "where user_name = '{$session_user_name}'";
    $new_profile_add_user_execution = mysqli_query($connection, $new_profile_add_user_query) or die("connection failed" . mysqli_error($connection));
    header("Location: profile.php");
}
?>





<div id="wrapper">



    <?php #redirect to admin/functions.php
    ?>
    <?php insert_categories() ?>


    <!-- Navigation -->
    <?php include "../admin/includes/admin_navigation.php" ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- heading -->
                    <h1 class="page-header">
                        Welcome to admin

                        <small><?= $_SESSION['username'] ?></small>
                    </h1>





                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Username</label>
                        <input value="<?= $session_user_name ?>" type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input value="<?= $session_user_first_name ?>" type="text" class="form-control" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">LastName</label>
                        <input value="<?= $session_user_last_name ?>" type="text" class="form-control" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input value="<?= $session_user_password ?>" type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?= $session_email ?>" type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="role">Role </label>
                        <select name="role">
                            <option value=<?= $session_role ?>><?= $session_role ?></option>
                            <option value="admin">admin</option>
                            <option value="subscriber">Subscriber</option>t
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="update_profile" value="update profile">
                    </div>
                </form>




                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "../admin/includes/admin_footer.php" ?>