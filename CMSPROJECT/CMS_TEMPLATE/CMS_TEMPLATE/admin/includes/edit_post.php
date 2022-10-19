<!-- <?php
        // if (isset($_POST['create_post'])) {
        //     $post_title = $_POST['title'];
        //     $post_author = $_POST['author'];
        //     $post_category_id = $_POST['post_category_id'];
        //     $post_status = $_POST['post_status'];

        //     $post_image = $_FILES['image']['name'];
        //     $post_image_temp = $_FILES['image']['tmp_name'];

        //     $post_tags = $_POST['post_tags'];
        //     $post_content = $_POST['post_content'];
        //     $post_date = date('d-m-Y');
        //     $post_comment_count = 4;
        //     move_uploaded_file($post_image_temp, "../images/$post_image");
        //     $query = "insert into posts(post_category_id , post_title , post_author,post_date,post_image,post_content,post_tags ,post_comment_count,post_status) values ";
        //     $query .= "('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}')";
        //     mysqli_query($connection, $query) or die("Query failed");

        // }

        ?> -->

<?php
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
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
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?= $post_id ?>" type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Post category id</label>
        <input value="<?= $post_category_id ?>" type="text" class="form-control" name="post_category_id">
    </div>
    <div class="form-group">
        <label for="author">author</label>
        <input value="<?= $post_author ?>" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post status</label>
        <input value="<?= $post_status ?>" type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post image</label>
        <input value="<?= $post_image ?>" type="file" name="image">
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


<?php
if (isset($_POST['edited_post'])) {
    echo $_POST['edited_post'];
    $post_author = $_POST['author'];
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $query = "update posts  set post_category_id = '{$post_category_id}', post_title = '{$post_title}' , post_author'={$post_author}',post_content='{$post_content}',post_tags='{$post_tags}' where post_id = '{$edit_id}'" ;
    mysqli_query($connection , $query) or die("query failed");
}

?>