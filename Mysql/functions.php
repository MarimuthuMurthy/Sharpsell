<?php include "db.php";?>
<?php include "PDO.php";

function showAllData()
{
    global $connection;
    $query = "select * from users";
    $result = mysqli_query($connection , $query);
    if(!$result)
    {
        die("QUERY FAILED"); 
    }
    while($row = mysqli_fetch_assoc($result))
    {
        $id = $row['id'];
        echo "<option value='$id'>$id</option>";
    }
}

function userData()
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    global $connection;
    $username = mysqli_real_escape_string($connection , $username);
    $password = mysqli_real_escape_string($connection , $password);
    return [
        'username' => $username,
        'password'=>$password,
    ];
}

function passwordCheck()
{
    global $connection;
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT  * from users where username = '$userName' and password ='$password'";
    $result = mysqli_query($connection , $query);
    if($result->fetch_assoc()>0)
    {
        return true;
    }
    else{
        return false;
    }
}

function checkData()
{
    global $connection;
    $user_Data = userData();
    $query = "SELECT * FROM users";
    $result = mysqli_query($connection , $query);
    while($row = mysqli_fetch_assoc($result))
    {
        if($row['username'] === $user_Data['username'])
        {
            return true;
        }
    }
    return false;
}

function createTable()
{
    $user_Data = userData();

    
    #password encrpytion
    $hash_format = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hash_and_salt = $hash_format.$salt;
    $password = crypt($user_Data['password'] , $hash_and_salt);




    global $connection;
    $username = $user_Data['username'];
    $password = $user_Data['password'];
    $query = "INSERT INTO users(username , password) ";
    $query .="VALUES ('$username','$password')";
    $result = mysqli_query($connection , $query);
    if(!$result)
    {
        die('Query failed');
    }
    else{
        echo "<h1 span style='text-align:center ; '><span style = 'color : blue;'>Record created</span></h1>";
    }
}

function updateTable()
{
    global $connection;
    $username = $_POST['username'];
    $newPassword =  $_POST['Npassword'];
    $query = "UPDATE users SET password = '$newPassword' where username = '$username' ";
    $result = mysqli_query($connection , $query);
    if(!$result)
    {
     die("query failed");
    }
    else{
        echo "<h1 <span style = 'color : orange ;'> Data Updated  successfully</h1>";
    };
}

function deleteRecordsTable()
{
    global $connection;
    $id = $_POST["id"];
    $query  = "DELETE FROM users WHERE id  = $id ";
    $result = mysqli_query($connection , $query);
    if(!$result)
    {
        die("connection not extablished");
    }
}

function deleteRecordsUsingPdo()
{
    global $connectionPDO;
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id  = $id ";
    $connectionPDO->exec($sql);
}

?>