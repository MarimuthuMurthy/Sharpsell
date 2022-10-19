<?php

$currenttime = time();
echo $currenttime."<br />";

echo date('m/d/Y g:ia')."<br>";

echo date_default_timezone_get()."<br>";

echo date('d/m/Y g:ia' , strtotime("second saturday of october"));


?>