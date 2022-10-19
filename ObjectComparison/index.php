<?php

require_once '../ObjectComparison/invoice.php';
require_once '../ObjectComparison/invoice2.php';

use ObjectComparison\invoice1;
use ObjectComparison\invoice2;

$invoice1 = new ObjectComparison\invoice1(15892 , "Murthy");
$invoice2 = new ObjectComparison\invoice2(7329 , "Ram");


#   compares only values (LOOSE COUPLING) .
echo 'invoice1 == invoice2 '.PHP_EOL;
var_dump($invoice1 == $invoice2);


echo "<br>";


#   strict coupling .
echo 'invoice1 === invoice2'.PHP_EOL;
var_dump($invoice1 === $invoice2);



?>