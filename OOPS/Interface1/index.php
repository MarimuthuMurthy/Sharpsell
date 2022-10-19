<?php

require_once '../Interface1/DeptCollector.php';
require_once '../Interface1/CollecttionAgency.php';
require_once '../Interface1/DeptCollectionService.php';

use Interface1\DeptCollector as dc;
use Interface1\CollectionAgency as ca;
use Interface1\DeptCollectionService as DCS;

$service = new DCS();
echo $service->collectDept(new ca()).PHP_EOL;






?>