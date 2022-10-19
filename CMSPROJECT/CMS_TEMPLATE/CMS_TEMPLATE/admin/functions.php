


<?php
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
