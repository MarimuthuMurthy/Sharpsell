<?php session_start() ?>
<?php include "db.php" ?>
<?php include_once "admin/functions.php"?>
<?php
if (isset($_POST['login'])) {
    $login_username = $_POST['username'];
    $login_password = $_POST['password'];
    login_user($login_username , $login_password);
}
?>