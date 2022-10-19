<?php

$con = mysqli_connect("localhost","root","","test1") or die("connection failed");
$sql = "select * from student";
$result = mysqli_query($con ,$sql) or die("sql query failed");
$output = mysqli_fetch_all($result , MYSQLI_ASSOC);
$json_data = json_encode($output,JSON_PRETTY_PRINT);
$file_name = "my-".date("d-m-Y").".json";
if(file_put_contents($file_name , $json_data))
{
    echo $file_name." file created .";
}
else
{
    echo "Cant insert data in json file . ";
}

?>