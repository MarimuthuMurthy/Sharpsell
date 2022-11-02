<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include_once "admin/functions1.php" ?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST['registration_submit'])) {
    $register_username = trim($_POST['username']);
    $register_email    = trim($_POST['email']);
    $register_password = trim($_POST['password']);
    $error = [
        'username' => '',
        'email' => '',
        'password' => ''
    ];
    if (strlen($register_username) < 4) {
        $error['username'] = 'username needs to be longer';
    }
    if (strlen($register_username) == '') {
        $error['username'] = 'username cannot be empty';
    }
    if (username_exists($register_username)) {
        $error['username'] = 'username already exists , pick another one';
    }
    if ($register_email == '') {
        $error['email'] = 'email cannot be empty';
    }
    if (email_exists($register_email)) {
        $error['email'] = 'email already exists ,<a href="index.php">please login</a>';
    }
    if ($register_password == '') {
        $error['password'] = 'password cannt be empty';
    }
    if (strlen($register_password) < 8) {
        $error['password'] = 'password needs to be longer';
    }
    foreach ($error as $key => $value) {
        if (empty($value)) {
            unset($error[$key]);
        }
    }
    if (empty($error)) {
        registration_process($register_username, $register_email, $register_password);
        login_user($register_username , $register_password);
    }
} else {
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
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($register_username) ? $register_username : '' ?>">
                                <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>

                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($register_email) ? $register_email : '' ?>">
                                <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                            </div>

                            <input type="submit" name="registration_submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>