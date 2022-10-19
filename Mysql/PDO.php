<?php


$serverName = "localhost";
$username= "root";
$password = "";
$dbname = "loginapp";
try
{
$connectionPDO = new PDO("mysql:host=$serverName;dbname=$dbname",$username ,$password);
$connectionPDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}




?>