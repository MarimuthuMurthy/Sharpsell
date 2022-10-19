<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-headers,Content-Type,Authorization,Access-Control-Allow-Methods,X-Requested-With');
 

require_once "config.php";
$data = json_decode(file_get_contents("php://input"),true);

$studentId = $data['sId'];
$studentName = $data['sname'];
$studentDept = $data['sdept'];
$studentyear = $data['syear'];
$sql = "insert into student values ('{$studentId}','{$studentName}','{$studentDept}','{$studentyear}')";
if(mysqli_query($conn , $sql))
{
    echo json_encode(array("message"=>"Student record inserted . ","status"=>true));

}
else{
    echo json_encode(array("message"=>"Student record not inserted . ","status"=>false));
}
?>