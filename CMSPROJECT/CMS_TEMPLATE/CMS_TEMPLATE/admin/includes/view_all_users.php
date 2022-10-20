<table class="table table-bordered table-hover">
    <thead>
        <th>Full name</th>
        <th>Password</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Image</th>
        <th>Make Admin</th>
        <th>Make subscriber</th>
        <th>delete</th>
        <th>Edit</th>
    </thead>
    <tbody>
        <?php
        $All_Users_query = "select * from users";
        $execute_all_users_query = mysqli_query($connection, $All_Users_query);
        while ($each_user = mysqli_fetch_assoc($execute_all_users_query)) {
            $user_id = $each_user['user_id'];
            $user_name = $each_user['user_name'];
            $user_password = $each_user['user_password'];
            $user_firstname = $each_user['user_firstname'];
            $user_lastname = $each_user['user_lastname'];
            $user_email = $each_user['user_email'];
            $user_role = $each_user['user_role'];
            $user_image = $each_user['user_image'];
        ?>
            <tr>
                <td><?= $user_name ?></td>
                <td><?= $user_password ?></td>
                <td><?= $user_firstname ?></td>
                <td><?= $user_lastname ?></td>
                <td><?= $user_email ?></td>
                <td><?= $user_role ?></td>
                <td><img width="100" height="100" src="../images/<?= $user_image ?>" alt="<?= $user_name ?>"></td>
                <td><a href='users.php?change_to_admin=<?= $user_id ?>'>Admin</a></td>
                <td><a href='users.php?change_to_subscriber=<?= $user_id ?>'>Subscriber</a></td>
                <td><a href="users.php?delete=<?= $user_id ?>">Delete</a></td>
                <td><a href="users.php?source=edit_post&user_id=<?= $user_id ?>">Edit</a></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>

<?php


if (isset($_GET['change_to_admin'])) {
    $change_to_admin_id = $_GET['change_to_admin'];
    $change_to_admin_query = "update users set user_role ='Admin' where user_id = '{$change_to_admin_id}'";
    mysqli_query($connection, $change_to_admin_query) or die("connection failed" . mysqli_error($connection));
    header("Location: users.php");
}


if (isset($_GET['change_to_subscriber'])) {
    $change_to_subscriber_id = $_GET['change_to_subscriber'];
    $change_to_subscriber_query = "update users set user_role ='Subscriber' where user_id = '{$change_to_subscriber_id}'";
    mysqli_query($connection, $change_to_subscriber_query) or die("connection failed" . mysqli_error($connection));
    header("Location: users.php");
}







if (isset($_GET['delete'])) {
    $delete_user_id = $_GET['delete'];
    $delete_user_query = "delete from users where user_id = '$delete_user_id'";
    $execute_user_details = mysqli_query($connection, $delete_user_query) or die("connection failed");
    header("Location: users.php");
}
?>