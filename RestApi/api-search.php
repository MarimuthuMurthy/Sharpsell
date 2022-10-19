<?php

include "config.php";
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
$studentSearch = $data['search'];
$sql = "SELECT * from student where name like '%{$studentSearch}%'";
$result = mysqli_query($conn , $sql) or die("sql query failed");
if(mysqli_num_rows($result)>0)
{
    $output = mysqli_fetch_all($result , MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
    echo json_encode(array('message'=>'no search found .','status'=>false));

}

?>