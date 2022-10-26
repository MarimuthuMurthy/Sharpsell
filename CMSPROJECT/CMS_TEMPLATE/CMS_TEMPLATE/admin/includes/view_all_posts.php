<?php

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $post_value_Id) {
        $bulk_options = $_POST['BulkOptions'];
        switch ($bulk_options) {
            case 'published':
                $publish_query = "update posts set post_status = '{$bulk_options}' where post_id = {$post_value_Id}";
                mysqli_query($connection, $publish_query) or die("connection failed" . mysqli_error($connection));
                break;
            case 'draft':
                $draft_query = "update posts set post_status = '{$bulk_options}' where post_id = {$post_value_Id}";
                mysqli_query($connection, $draft_query) or die("connection failed" . mysqli_error($connection));
                break;
            case 'delete':
                $delete_query = "delete from posts where post_id = '{$post_value_Id}'";
                mysqli_query($connection, $delete_query) or die("connection failed" . mysqli_error($connection));
                break;
            case  'clone':
                $query = "select * from posts where post_id = '{$post_value_Id}'";
                $select_post_query = mysqli_query($connection, $query) or die("Connection failed" . mysqli_error($connection));
                while ($each_post = mysqli_fetch_assoc($select_post_query)) {
                    $post_title = $each_post['post_title'];
                    $post_author = $each_post['post_author'];
                    $post_category_id = $each_post['post_category_id'];
                    $post_status = $each_post['post_status'];
                    $post_image = $each_post['post_image'];
                    $post_tags = $each_post['post_tags'];
                    $post_content = $each_post['post_content'];
                    $post_date = date('d-m-Y');
                    $query = "insert into posts(post_category_id , post_title , post_author,post_date,post_image,post_content,post_tags ,post_status) values ";
                    $query .= "('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                    mysqli_query($connection, $query) or die("Query failed".mysqli_error($connection));
                }
                break;
        }
    }
}

?>













<form action="" method="post">



    <table class="table table-bordered table-hover">


        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="BulkOptions" id="">
                <option value="">Select option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit_posts" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View count</th>
                <th>set view count to 0</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "select * from posts order by post_id DESC";
            $result = mysqli_query($connection, $query) or die("Query failed");

            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_view_count'];
            ?>
                <tr>
                    <td><input class='checkBoxes' type="checkbox" name='checkBoxArray[]' value='<?= $post_id ?>'></td>
                    <td><?= $row['post_id'] ?></td>
                    <td><?= $row['post_author'] ?></td>
                    <td><a href='../post.php?p_id=<?= $post_id ?>'><?= $row['post_title'] ?></a></td>




                    <?php
                    $query1 = "select * from categories where cat_id = {$post_category_id}";
                    $result1  = mysqli_query($connection, $query1);
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $cat_id = $row1['cat_id'];
                        $cat_title = $row1['cat_title'];
                    }
                    ?>
                    <td><?= $cat_title ?></td>












                    <td><?= $row['post_status'] ?></td>
                    <td> <img width='100' height='50' src=../images/<?= $row['post_image'] ?>></td>
                    <td><?= $row['post_tags'] ?></td>
                    <td><?= $post_comment_count ?></td>











                    <td><?= $row['post_date'] ?></td>
                    <td><?= $post_views_count?></td>
                    <td><a class="btn btn-primary" href="posts.php?zero_count=<?= $post_id?>">set 0</a></td>
                    <td><a onclick="javascript: return confirm('are you sure you want to delete ');" href="posts.php?delete=<?= $post_id ?>">delete</a></td>
                    <td><a href="posts.php?source=edit_post&edit_id=<?= $post_id ?>">edit</a></td>
                </tr>

            <?php } ?>

        </tbody>
    </table>
</form>
<?php
if (isset($_GET['delete'])) {
    $del_id = $_GET['delete'];
    $query = "delete from posts where post_id = '{$del_id}'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: posts.php");
}

if (isset($_GET['zero_count'])) {
    $zero_count_id = $_GET['zero_count'];
    $query = "update posts set post_view_count = 0 where post_id = '{$zero_count_id}'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: posts.php");
}

?>