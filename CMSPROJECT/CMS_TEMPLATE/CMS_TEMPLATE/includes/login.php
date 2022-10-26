<?php include "db.php" ?>
<?php session_start() ?>


<?php
if (isset($_POST['login'])) {
    $login_username = $_POST['username'];
    $login_password = $_POST['password'];
    $login_username = mysqli_real_escape_string($connection, $login_username);
    $login_password = mysqli_real_escape_string($connection, $login_password);
    $login_check_query_from_users_table = "select * from users where user_name = '{$login_username}'";
    $login_check_query_from_users_table_execute = mysqli_query($connection, $login_check_query_from_users_table) or die("query failed" . mysqli_error($connection));
    while ($login_user = mysqli_fetch_assoc($login_check_query_from_users_table_execute)) {
        $login_check_user_id = $login_user['user_id'];
        $login_check_username = $login_user['user_name'];
        $login_check_password = $login_user['user_password'];
        $login_check_user_firstname = $login_user['user_firstname'];
        $login_check_user_lastname  = $login_user['user_lastname'];
        $login_check_user_role = $login_user['user_role'];
    }
    $login_password = crypt($login_password , $login_check_password);
    if ($login_username === $login_check_username && $login_password === $login_check_password) {
        $_SESSION['username'] = $login_check_username;
        $_SESSION['firstname'] = $login_check_user_firstname;
        $_SESSION['lastname'] = $login_check_user_lastname;
        $_SESSION['role'] = $login_check_user_role;
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}
?>