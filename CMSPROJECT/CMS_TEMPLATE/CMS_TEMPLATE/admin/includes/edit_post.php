<?php
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
}
$query = "select * from posts where post_id = '{$edit_id}'";
$result = mysqli_query($connection, $query);
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
    $post_content = $row['post_content'];
}
if (isset($_POST['edited_post'])) {
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $check =move_uploaded_file($post_image_temp, "../images/$post_image") ;
    if (empty($post_image)) {
        $image_query = "select * from posts where post_id = '{$edit_id}'";
        $select_image = mysqli_query($connection, $image_query);
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query =  "update posts  set ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_title = '{$post_title}' ,";
    $query .= "post_author= '{$post_author}', ";
    $query .= "post_content='{$post_content}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags='{$post_tags}' ";
    $query .= "where post_id = '{$edit_id}'";
    mysqli_query($connection, $query) or die(mysqli_error($connection));
    
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?= $post_title ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <select name="post_category" id="">
            <?php
            $query = "select * from categories ";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
            ?>
                <option value=<?= $cat_id?>><?= $cat_title ?></option>;
            <?php } ?>

        </select>
    </div>
    <div class="form-group">
        <label for="author">author</label>
        <input value="<?= $post_author ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post status</label>
        <input value="<?= $post_status ?>" type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?= $post_image ?>" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?= $post_tags  ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?= $post_content ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edited_post" value="Publish status">
    </div>

</form>