<?php

if (isset($_GET['user_id'])) {
    $present_user_id = $_GET['user_id'];
    $present_user_id_data_query = "select * from users where user_id = '{$present_user_id}'";
    $present_user_data_execute = mysqli_query($connection, $present_user_id_data_query);
    while ($present_user = mysqli_fetch_assoc($present_user_data_execute)) {
        $present_user_name = $present_user['user_name'];
        $present_user_firstname = $present_user['user_firstname'];
        $present_user_lastname = $present_user['user_lastname'];
        $present_user_password = $present_user['user_password'];
        $present_user_image = $present_user['user_image'];
        $present_user_email = $present_user['user_email'];
        $user_role = $present_user['user_role'];
    }


    if (isset($_POST['edit_user'])) {
        $new_user_name = $_POST['username'];
        $new_user_firstname = $_POST['firstname'];
        $new_user_lastname = $_POST['lastname'];
        $new_user_password = $_POST['password'];
        $new_user_image = $_FILES['image']['name'];
        $new_user_temp_image = $_FILES['image']['tmp_name'];
        $new_user_email = $_POST['email'];
        $user_role = $_POST['role'];
        move_uploaded_file($new_user_temp_image, "../images/$new_user_image");
        if (!empty($new_user_password)) {
            $hashed_password = password_hash($present_user_password , PASSWORD_BCRYPT , array('cost' => 10));
            $new_add_user_query  = "update  users set ";
            $new_add_user_query .= "user_name = '{$new_user_name}' , user_firstname = '{$new_user_firstname}',user_lastname='{$new_user_lastname}', user_email='{$new_user_email}' ,user_password = '{$hashed_password}', user_image='{$new_user_image}', user_role='{$user_role}' ";
            $new_add_user_query .= "where user_id = '{$present_user_id}'";
            $new_add_user_execution = mysqli_query($connection, $new_add_user_query) or die("connection failed" . mysqli_error($connection));
            echo "<p class = 'bg-success'>updated successfully</p>";
        }
        else{
            $new_add_user_query  = "update  users set ";
            $new_add_user_query .= "user_name = '{$new_user_name}' , user_firstname = '{$new_user_firstname}',user_lastname='{$new_user_lastname}', user_email='{$new_user_email}' , user_image='{$new_user_image}', user_role='{$user_role}' ";
            $new_add_user_query .= "where user_id = '{$present_user_id}'";
            $new_add_user_execution = mysqli_query($connection, $new_add_user_query) or die("connection failed" . mysqli_error($connection));
            echo "<p class = 'bg-success'>updated successfully</p>";
        }
        header("Location: users.php");
    }

}else{
    header("Location: index.php");
}
?>







<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input value="<?= $present_user_name ?>" type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input value="<?= $present_user_firstname ?>" type="text" class="form-control" name="firstname">
    </div>
    <div class="form-group">
        <label for="lastname">LastName</label>
        <input value="<?= $present_user_lastname ?>" type="text" class="form-control" name="lastname">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input value="" type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" value="<?= $present_user_image ?>" name="image">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input value="<?= $present_user_email ?>" type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="role">Role </label>
        <select name="role">
            <option value=<?= $user_role ?>><?= $user_role ?></option>
            <?php
            if ($user_role == 'subscriber') {
                echo "<option value='admin'>admin</option>";
            } else {
                echo ' <option value="subscriber">Subscriber</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit user">
    </div>
</form>