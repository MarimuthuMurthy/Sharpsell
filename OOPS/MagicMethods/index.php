<?php

require_once '../MagicMethods/get.php';
use MagicMethods\Invoice as invoice;

$invoice = new invoice(20);
echo $invoice->amount.PHP_EOL;
$invoice->process(1,2,3);


?>