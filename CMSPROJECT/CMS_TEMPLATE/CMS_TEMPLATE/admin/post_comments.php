<?php include "../admin/includes/admin_header.php" ?>
<?php include_once "functions1.php" ?>
<?php ob_start() ?>



<div id="wrapper">




    <?php #redirect to admin/functions.php
    ?>
    <?php insert_categories() ?>


    <!-- Navigation -->
    <?php include "../admin/includes/admin_navigation.php" ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- heading -->
                    <h1 class="page-header">
                        Welcome to post comments section
                        <small>Author</small>
                    </h1>
<?php

if(isset($_POST['checkBoxArray1']))
{
    foreach($_POST['checkBoxArray1'] as $commentId)
    {
        $bulk = $_POST['bulk_options1'];
        switch($_POST['bulk_options1'])
        {
            case 'approved':
                $approve_query = "update comments set comment_status = 'approved' where comment_id = '{$commentId}'";
                mysqli_query($connection , $approve_query) or die("connection failed ".mysqli_error($connection));
                break;
            case 'unapproved':
                $unapprove_query = "update comments set comment_status = 'unapproved' where comment_id = '{$commentId}'";
                mysqli_query($connection , $unapprove_query) or die("connection failed ".mysqli_error($connection));
                break;
            case 'delete':
                $delete_query = "delete from comments where comment_id = '{$commentId}'";
                mysqli_query($connection , $delete_query) or die("connection failed ".mysqli_error($connection));
                break;
        }
    }
}

?>

<form action="" method='post'>
               
               <table class="table table-bordered table-hover">
               
               <div id="bulkOptionContainer" class="col-xs-4">

        <select class="form-control" name="bulk_options1" id="">
        <option value="">Select Options</option>
        <option value="approved">Approve</option>
        <option value="unapproved">Unapprove</option>
        <option value="delete">Delete</option>
        </select>

        </div> 

<div class="col-xs-4">

<input type="submit" name="submitComments" class="btn btn-success" value="Apply">

 </div>

<table class="table table-bordered table-hover">
    <th>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>UnApprove</th>
            <th>Delete</th>
        </tr>
    </th>
    <tbody>
        
        <?php
        $query = "select * from comments where comment_post_id = " . mysqli_real_escape_string($connection,$_GET['post_id']). " ";
        $result = mysqli_query($connection, $query) or die("Query failed");

        while ($row = mysqli_fetch_assoc($result)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
        ?>
        <tr>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray1[]' value='<?=$comment_id?>'></td>
            <td><?=$comment_id?></td>
            <td><?=$comment_author?></td>

            <td><?=$comment_content?></td>
            <td><?=$comment_email?></td>
            <td><?=$comment_status?></td>
            <?php
            $query_res = "select * from posts where post_id = $comment_post_id";
            $result1 = mysqli_query($connection, $query_res) or die("faileds");
            while ($row = mysqli_fetch_assoc($result1)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
            }
            ?>
            <td><a href='../post.php?p_id=<?=$post_id?>'><?=$post_title?></a></td>

            <td><?=$comment_date?></td>
            <td><a href='comments.php?approve=<?=$comment_id?>&post_id=<?=$_GET['post_id']?>'>Approve</a></td>
            <td><a href='comments.php?unapprove=<?=$comment_id?>&post_id=<?=$_GET['post_id']?>'>UnApprove</a></td>
            <td><a href='post_comments.php?delete=<?=$comment_id?>&post_id=<?=$_GET['post_id']?>' >delete</a></td>
        
        <?php } ?>
        </tr>
    </tbody>
</table>
    </form>
<?php


#*************************for approval **************************#
if (isset($_GET['approve'])) {
    $approve_id = $_GET['approve'];
    $query = "update comments set  comment_status = 'approved' where comment_id = '$approve_id'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: post_comments.php?post_id={$_GET['post_id']}");
}


#************************for unapproval**************************#
if (isset($_GET['unapprove'])) {
    $unapprove_id = $_GET['unapprove'];
    $query = "update comments set  comment_status = 'unapproved' where comment_id = '$unapprove_id'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: post_comments.php?post_id={$_GET['post_id']}");
}

#***********************for comment deletion*********************#
if (isset($_GET['delete'])) {
    $del_id = $_GET['delete'];
    $query = "delete from comments where comment_id = '{$comment_id}'";
    mysqli_query($connection, $query) or die("connection failed");
    header("Location: post_comments.php?post_id={$_GET['post_id']}");
}
?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "../admin/includes/admin_footer.php" ?>