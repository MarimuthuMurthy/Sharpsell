<?php
if(isset($_POST['create_user']))
{
$user_name = $_POST['username'];
$user_firstname = $_POST['firstname'];
$user_lastname = $_POST['lastname'];
$user_password = $_POST['password'];
$new_hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
$user_image = $_FILES['image']['name'];
$user_temp_image = $_FILES['image']['tmp_name'];
$user_email = $_POST['email'];
$user_role = $_POST['role'];
move_uploaded_file($user_temp_image, "../images/$user_image");
$add_user_query  = "insert into users";
$add_user_query .="(user_name , user_firstname,user_lastname, user_email, user_password , user_image, user_role)";
$add_user_query .="values ('{$user_name}','{$user_firstname}','{$user_lastname}','{$user_email}','{$new_hashed_password}','{$user_image}','{$user_role}')";
$add_user_execution = mysqli_query($connection , $add_user_query) ;
echo mysqli_error($connection);
echo "<h2 span style='color:violet;'>User created .</h2>";
}
?>





<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname">
    </div>
    <div class="form-group">
        <label for="lastname">LastName</label>
        <input type="text" class="form-control" name="lastname">
    </div>
    
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" >
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="role">Role </label>
        <select name="role">
            <option value="admin">admin</option>
            <option value="subscriber">Subscriber</option>t
        </select>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add user">
    </div>
</form>