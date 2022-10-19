<?php
$connetion = mysqli_connect('localhost','root','','loginapp');
if($connetion)
{
    $query = "select * from users";
    $result = mysqli_query($connetion , $query);
}
else{
    die("sorry ! connection not established");
}
?>
<?php include "includes/header.php" ?>
    <?php
    while($row = mysqli_fetch_assoc($result))
    {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    }
    ?>
<?php include "includes/footer.php" ?>