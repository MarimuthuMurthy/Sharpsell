<?php

use LDAP\Connection;




function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}
function users_online()
{
    if (isset($_GET['onlineusers'])) {
        global $connection;
        if (!$connection) {
            session_start();
            include("../includes/db.php");
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;
            $query = "select * from users_online where session = '$session'";
            $send_query = mysqli_query($connection, $query) or die('connection failed' . mysqli_error($connection));
            $count = mysqli_num_rows($send_query);
            if ($count == null) {
                mysqli_query($connection, "insert into users_online (session , time) values ('{$session}','{$time}')") or die("connection failed1 " . mysqli_error($connection));
            } else {
                mysqli_query($connection, "update users_online set time = {$time} where session ='{$session}'") or die("connection failed2 " . mysqli_error($connection));
            }

            $users_online = mysqli_query($connection, "select * from users_online where time > {$time_out}");
            echo $count_user = mysqli_num_rows($users_online);
        }
    } //get request isset
}
users_online();

function insert_categories()
{
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if (!$_POST['cat_title'] == "" || !empty($cat_title)) {
            global $connection;
            $query = "insert into categories(cat_title) values ('{$cat_title}')";
            mysqli_query($connection, $query) or die("Query failed");
        } else {
            echo "<h2 span style='color: aqua ;' >This field cannot be empty </h2>";
        }
    }
}


function findAllCategories()
{
    global $connection;
    //FIND ALL CATEGORIES QUERY


    $query = "select * from categories";
    $all_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($all_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='Categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='Categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function record_count($table)
{
    global $connection;
    $query = "select * from " . $table;
    $execute = mysqli_query($connection, $query) or die("connection failed " . mysqli_error($connection));
    return mysqli_num_rows($execute);
}


function check_status($table, $column_name, $status)
{
    global $connection;
    $query = "select * from $table where $column_name = '$status'";
    $execute_published_post = mysqli_query($connection, $query);
    return mysqli_num_rows($execute_published_post);
}
function check_role($table, $column_name, $role)
{
    global $connection;
    $query = "select * from $table where $column_name = '$role'";
    $execute_published_post = mysqli_query($connection, $query);
    return mysqli_num_rows($execute_published_post);
}

function is_admin($username)
{
    global $connection;
    $query = "select user_role from users where user_name = '$username'";
    $result = mysqli_query($connection, $query) or die("Connection failed " . mysqli_error($connection));
    $row = mysqli_fetch_assoc($result);
    if ($row['user_role'] == 'Admin') {
        return true;
    } else {
        return false;
    }
}


function username_exists($username)
{
    global $connection;
    $query = "select user_name from users where user_name = '$username'";
    $result = mysqli_query($connection, $query) or die("connection failed1 " . mysqli_error($connection));
    if (mysqli_num_rows($result) == 1) {
        return true;
    } else {
        return false;
    }
}

function email_exists($email)
{
    global $connection;
    $query = "select user_email from users where user_email = '$email'";
    $result = mysqli_query($connection, $query) or die("connection failed1 " . mysqli_error($connection));
    if (mysqli_num_rows($result) == 1) {
        return true;
    } else {
        return false;
    }
}

function registration_process($username, $email, $password)
{
    global $connection;
    $register_username = $username;
    $register_email    = $email;
    $register_password = $password;
    if (username_exists($register_username)) {
        $message = "user name exists , try new one";
    }
    $register_username = mysqli_real_escape_string($connection, $register_username);
    $register_email    = mysqli_real_escape_string($connection, $register_email);
    $register_password = mysqli_real_escape_string($connection, $register_password);
    $register_password = password_hash($register_password, PASSWORD_BCRYPT, array('cost' => 12));
    $query = "insert into users (user_name , user_email , user_password , user_role) values ('{$register_username}','{$register_email}','{$register_password}','subscriber')";
    mysqli_query($connection, $query) or die("connection failed" . mysqli_error($connection));
}
// function login_user($login_username, $login_password)
// {
//     global $connection;
//     $login_username = trim($login_username);
//     $login_password = trim($login_password);
//     $login_username = mysqli_real_escape_string($connection, $login_username);
//     $login_password = mysqli_real_escape_string($connection, $login_password);
//     $login_check_query_from_users_table = "select * from users where user_name = '{$login_username}'";
//     $login_check_query_from_users_table_execute = mysqli_query($connection, $login_check_query_from_users_table) or die("query failed" . mysqli_error($connection));
//     while ($login_user = mysqli_fetch_assoc($login_check_query_from_users_table_execute)) {
//         $login_check_user_id = $login_user['user_id'];
//         $login_check_username = $login_user['user_name'];
//         $login_check_password = $login_user['user_password'];
//         $login_check_user_firstname = $login_user['user_firstname'];
//         $login_check_user_lastname  = $login_user['user_lastname'];
//         $login_check_user_role = $login_user['user_role'];
//         if ($login_username === $login_check_username && password_verify($login_password, $login_check_password)) {
//             $_SESSION['username'] = $login_check_username;
//             $_SESSION['firstname'] = $login_check_user_firstname;
//             $_SESSION['lastname'] = $login_check_user_lastname;
//             $_SESSION['role'] = $login_check_user_role;

//             header("Location: admin");
//         }
//          else {
//             return false;
//         }
//     }

//     return true;
// $login_password = crypt($login_password , $login_check_password);


function ifItIsMethod($method = null)
{
    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
        return true;
    }
    return false;
}

function isLoggedIn()
{
    if (isset($_SESSION['role'])) {
        return true;
    }
    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation = null)
{
    if (isLoggedIn()) {
        header("Location: $redirectLocation");
    }
}
?>


<?php
function login_user($login_username, $login_password)
{
    global $connection;
    $login_username = trim($login_username);
    $login_password = trim($login_password);
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
        if ($login_username !== $login_check_username && !password_verify($login_password, $login_check_password)) {
            return false;
        } else {
            $_SESSION['username'] = $login_check_username;
            $_SESSION['firstname'] = $login_check_user_firstname;
            $_SESSION['lastname'] = $login_check_user_lastname;
            $_SESSION['role'] = $login_check_user_role;
?>
            <script>
                window.location.href = 'admin'
            </script>
<?php
        }
    }

    return true;
}

?>