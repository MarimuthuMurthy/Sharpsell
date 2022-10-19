<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-headers,Content-Type,Authorization,Access-Control-Allow-Methods,X-Requested-With');
require_once "config.php";
$data = json_decode(file_get_contents("php://input"),true);
$studentId = $data['sId'];
$sql = "DELETE from student where id = '{$studentId}'";
if(mysqli_query($conn , $sql))
{
    echo json_encode(array("message"=>"given id deleted","status"=>true));
}
else
{
    echo json_encode(array("message"=>"given id deleted","status"=>false));
}

?>