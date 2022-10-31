<?php
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
}
$query = "select * from posts where post_id = '{$edit_id}'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
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
    $post_user = $_POST['post_user'];
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
    $query .= "post_user= '{$post_user}', ";
    $query .= "post_content='{$post_content}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags='{$post_tags}' ";
    $query .= "where post_id = '{$edit_id}'";
    mysqli_query($connection, $query) or die(mysqli_error($connection).mysqli_error($connection));
    echo "<h1 class ='bg-success' <span style='color : aqua ; text-align: center;'>POST UPDATED</span></h1>";
    echo "<p class = 'bg=success'><a href='../post.php?p_id={$post_id}'>View post  </a> or <a href='posts.php'>Edit more posts</a></p>"; 
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
                if($cat_id == $post_category_id)
                {
                    echo "<option selected  value=$cat_id> $cat_title</option>";
                }
                else{
                    echo "<option value= $cat_id> $cat_title</option>";
                }
            ?>
                <!-- <option value=<?//= $cat_id?>><?//= $cat_title ?></option>; -->
            <?php } ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_user">User</label>
        <select name="post_user" id="">
        <option value=<?= $post_user?>><?= $post_user ?></option>;
            <?php
            $query = "select * from users";
            $select_users = mysqli_query($connection, $query) or die("connection failed ".mysqli_error($connection));
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
            ?>
                <option value=<?= $user_name?>><?= $user_name ?></option>;
            <?php } ?>

        </select>
    </div>

    <!-- <div class="form-group">
        <label for="author">author</label>
        <input value="<?//= $post_author ?>" type="text" class="form-control" name="post_author">
    </div> -->
    <div class="form-group">
        <label for="post_status">Post status</label>
        <div>
            <select name="post_status" id="">
                <option value="<?= $post_status ?>"><?= $post_status ?></option>
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
            </select>
        </div>
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
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?= $post_content ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edited_post" value="Publish status">
    </div>

</form>