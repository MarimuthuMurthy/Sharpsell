<?php
include "delete_model.php";
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
                    $post_user = $each_post['post_user'];
                    $post_category_id = $each_post['post_category_id'];
                    $post_status = $each_post['post_status'];
                    $post_image = $each_post['post_image'];
                    $post_tags = $each_post['post_tags'];
                    $post_content = $each_post['post_content'];
                    $post_date = date('d-m-Y');

                    if (empty($post_tags)) {
                        $post_tags = "general";
                    }

                    $query = "insert into posts(post_category_id , post_title , post_author,post_user,post_date,post_image,post_content,post_tags ,post_status) values ";
                    $query .= "('{$post_category_id}','{$post_title}','{$post_author}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                    mysqli_query($connection, $query) or die("Query failed" . mysqli_error($connection));
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
                <th>users</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>View post</th>
                <th>Comments</th>
                <th>Visit comments</th>
                <th>Date</th>
                <th>View count</th>
                <th>set view count to 0</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // $query = "select * from posts order by post_id DESC";
            $query = "select posts.post_id , posts.post_author ,posts.post_user,posts.post_title,posts.post_category_id,posts.post_status,posts.post_image , posts.post_tags , posts.post_comment_count , posts.post_date , posts.post_view_count ,";
            $query .= "categories.cat_id , categories.cat_title ";
            $query .= "from posts left join categories on posts.post_category_id = categories.cat_id  order by posts.post_id DESC";
            $result = mysqli_query($connection, $query) or die("Query failed");

            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_view_count'];
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
            ?>
                <tr>
                    <td><input class='checkBoxes' type="checkbox" name='checkBoxArray[]' value='<?= $post_id ?>'></td>
                    <td><?= $row['post_id'] ?></td>

                    <?php
                    if (!empty($post_author)) {
                        echo "<td>$post_author</td>";
                    } else if (!empty($post_user)) {
                        echo "<td>$post_user</td>";
                    }
                    ?>









                    <td><a href='../post.php?p_id=<?= $post_id ?>'><?= $row['post_title'] ?></a></td>
                    <td><?= $cat_title ?></td>

                    <td><?= $row['post_status'] ?></td>
                    <td> <img width='100' height='50' src=../images/<?= $row['post_image'] ?>></td>
                    <td><?= $row['post_tags'] ?></td>
                    <td><a class="btn btn-primary" href='../post.php?p_id=<?= $post_id ?>'>view post</a></td>
                    <?php
                    $count_comments_query = "select * from comments where comment_post_id=$post_id";
                    $execute_count_comments = mysqli_query($connection, $count_comments_query) or die("connection failed 1 " . mysqli_error($connection));
                    $post_comment_count = mysqli_num_rows($execute_count_comments);
                    ?>
                    <td><?= $post_comment_count ?></td>
                    <td><a class="btn btn-success" href="post_comments.php?post_id=<?= $row['post_id'] ?>">visit</a></td>
                    <td><?= $row['post_date'] ?></td>
                    <td><?= $post_views_count ?></td>
                    <td><a class="btn btn-success" href="posts.php?zero_count=<?= $post_id ?>">set 0</a></td>
                    <!-- <td><a rel="<? //=$post_id
                                        ?>" href="javascript:void(0)" class="delete_link">delete</a></td> -->

                    <form method="post">
                        <input type="hidden" name="post_id" value="<?= $post_id ?>">
                        <td><input type="submit" class="btn btn-danger" name="delete1" value="delete"></td>
                    </form>
                    <!-- <td><a onclick="javascript: return confirm('are you sure you want to delete ');" href="posts.php?delete=<? //$post_id 
                                                                                                                                    ?>">delete</a></td> -->
                    <td><a class="btn btn-info" href="posts.php?source=edit_post&edit_id=<?= $post_id ?>">edit</a></td>
                </tr>

            <?php } ?>

        </tbody>
    </table>
</form>
<?php
if (isset($_POST['delete1'])) {
    $del_id = $_POST['post_id'];
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

<!-- <script>
    $(document).ready(function(){
        $(".delete_link").on('click',function(){
            var id = $(this).attr("rel");
            var delete_url ="posts.php?delete="+ id +" ";
            $(".modal_delete_link").attr("href",delete_url);
            $("#myModal").modal('show');
        });
    });
</script> -->