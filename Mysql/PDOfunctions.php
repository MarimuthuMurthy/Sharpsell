<?php include "db.php";?>
<?php include "PDO.php";

// function showAllData()
// {
//     global $connection;
//     $query = "select * from users";
//     $result = mysqli_query($connection , $query);
//     if(!$result)
//     {
//         die("QUERY FAILED"); 
//     }
//     while($row = mysqli_fetch_assoc($result))
//     {
//         $id = $row['id'];
//         echo "<option value='$id'>$id</option>";
//     }
// }

function showAllData()
{
    global $connectionPDO;
    $query = "select * from users";
    $result = $connectionPDO->prepare($query);
    $result->execute();
    if(!$result)
    {
        die("QUERY FAILED"); 
    }
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $id = $row['id'];
        echo "<option value='$id'>$id</option>";
    }
}

function passwordCheck()
{
    global $connectionPDO;
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $connectionPDO->prepare("SELECT  * from users where username = '$userName' and password ='$password'");
    $stmt->execute();
    if($stmt->fetch()>0)
    {
        return true;
    }
    else{
        return false;
    }
}
function userData()
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    global $connectionPDO;
    $username = $connectionPDO->prepare( $username);
    $password = $connectionPDO->prepare($password);
    return [
        'username' => $username,
        'password'=>$password,
    ];
}



function checkData()
{
    global $connectionPDO;
    $user_Data = userData();
    $stmt = $connectionPDO->prepare("SELECT * FROM users");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
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
    $array1 = (array)$user_Data['password'];
    $password = $array1['queryString'];
    $array2 = (array)$user_Data['username'];
    $username = $array2['queryString'];
    
    #password encrpytion
    $hash_format = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hash_and_salt = $hash_format.$salt;
    $password = crypt($password , $hash_and_salt);

    global $connectionPDO;
    $sql = "INSERT INTO users(username , password) ";
    $sql .="VALUES ('$username','$password')";
    $result = $connectionPDO->exec($sql);
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
    global $connectionPDO;
    $username = $_POST['username'];
    $newPassword =  $_POST['Npassword'];
    $sql = "UPDATE users SET password = '$newPassword' where username = '$username' ";
    $result = $connectionPDO->exec($sql);
    if(!$result)
    {
     die("query failed");
    }
    else{
        echo "<h1 <span style = 'color : orange ;'> Data Updated  successfully</h1>";
    };
}

function deleteRecordsUsingPdo()
{
    global $connectionPDO;
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id  = $id ";
    $connectionPDO->exec($sql);
}

?>