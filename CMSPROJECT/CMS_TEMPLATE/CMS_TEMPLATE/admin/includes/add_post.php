<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-Y');
    move_uploaded_file($post_image_temp, "../images/$post_image");
    $query = "insert into posts(post_category_id , post_title , post_author,post_date,post_image,post_content,post_tags ,post_status) values ";
    $query .= "('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
    mysqli_query($connection, $query) or die("Query failed");
    $the_post_id = mysqli_insert_id($connection);
    echo "<h1 class ='bg-success' <span style='color : aqua ; text-align: center;'>POST CREATED</span></h1>";
    echo "<p class = 'bg=success'><a href='../post.php?p_id={$the_post_id}'>View post  </a> or <a href='posts.php'>Edit more posts</a></p>"; 
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>


    <div class="form-group">
        <select name="post_category" id="">
        <?php
            $query = "select * from categories";
            $result = mysqli_query($connection , $query);
            if($result=="")
            {
                die("query failed ".mysqli_error($connection));
            }
            else{
                while($row= mysqli_fetch_assoc($result))
                {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }
            }
        ?>
        </select>
    </div>



    <div class="form-group">
        <label for="author">author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <div>
            <select name="post_status" id="">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="post_image">Post image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish status">
    </div>

</form>