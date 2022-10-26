


<?php

use LDAP\Connection;

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


?> 
