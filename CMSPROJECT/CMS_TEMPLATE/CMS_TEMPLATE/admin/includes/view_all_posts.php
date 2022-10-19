<table class="table table-bordered table-hover">
    <th>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </th>
    <tbody>
        <?php
        $query = "select * from posts";
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
        ?>
            <tr>
                <td><?= $row['post_id'] ?></td>
                <td><?= $row['post_author'] ?></td>
                <td><?= $row['post_title'] ?></td>



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
                <td><?= $row['post_comment_count'] ?></td>
                <td><?= $row['post_date'] ?></td>
                <td><a href="posts.php?delete=<?= $post_id ?>">delete</a></td>
                <td><a href="posts.php?source=edit_post&edit_id=<?= $post_id ?>">edit</a></td>
            </tr>

        <?php } ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $del_id = $_GET['delete'];
    $query = "delete from posts where post_id = '{$del_id}'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: posts.php");
}
?>