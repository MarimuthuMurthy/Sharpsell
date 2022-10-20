<table class="table table-bordered table-hover">
    <th>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to</th>
            <th>Date </th>
            <th>Approve</th>
            <th>UnApprove</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </th>
    <tbody>
        <?php
        $query = "select * from comments";
        $result = mysqli_query($connection, $query) or die("Query failed");

        while ($row = mysqli_fetch_assoc($result)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td> $comment_author </td>";
            echo "<td> $comment_content </td>";
            echo "<td> $comment_email </td>";
            echo "<td> $comment_status </td>";

            $query_res = "select * from posts where post_id = $comment_post_id";
            $result1 = mysqli_query($connection, $query_res) or die("faileds");
            while ($row = mysqli_fetch_assoc($result1)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
            }
            echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove= $comment_id'>UnApprove</a></td>";
            echo '<td><a href="posts.php?source=edit_post&edit_id=">edit</a></td>';
            echo "<td><a href='comments.php?delete= $comment_id' >delete</a></td>";

            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<?php


#*************************for approval **************************#
if (isset($_GET['approve'])) {
    $approve_id = $_GET['approve'];
    $query = "update comments set  comment_status = 'approved' where comment_id = '$approve_id'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: comments.php");
}


#************************for unapproval**************************#
if (isset($_GET['unapprove'])) {
    $unapprove_id = $_GET['unapprove'];
    $query = "update comments set  comment_status = 'unapproved' where comment_id = '$unapprove_id'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: comments.php");
}

#***********************for comment deletion*********************#
if (isset($_GET['delete'])) {
    $del_id = $_GET['delete'];
    $query = "delete from comments where comment_id = '{$comment_id}'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: comments.php");
}
?>