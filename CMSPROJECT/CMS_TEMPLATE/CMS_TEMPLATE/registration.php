<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<?php
if (isset($_POST['registration_submit'])) {
    $register_username = $_POST['username'];
    $register_email    = $_POST['email'];
    $register_password = $_POST['password'];
    if(!empty($register_username) && !empty($register_email) && !empty($register_password))
    {
    $register_username = mysqli_real_escape_string($connection, $register_username);
    $register_email    = mysqli_real_escape_string($connection, $register_email);
    $register_password = mysqli_real_escape_string($connection, $register_password);

    
    $query = "select randSalt from users";
    $select_randsalt_query = mysqli_query($connection, $query);
    if (!$select_randsalt_query) {
        die("query failed " . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $register_password = crypt($register_password , $salt);
    $query = "insert into users (user_name , user_email , user_password , user_role) values ('{$register_username}','{$register_email}','{$register_password}','subscriber')";
    mysqli_query($connection , $query) or die("connection failed".mysqli_error($connection));
    $message = "Your registration has been submitted";
    }
    else{
        $message = "Registration failed . Fields cannot be empty";
    }
}
else{
    $message = "";
}
?>










<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">


    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class = "text-center"><?= $message?></h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="registration_submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>