<?php


require_once '../Abstraction/Field.php';
require_once '../Abstraction/CheckBox.php';
require_once '../Abstraction/Text.php';
require_once '../Abstraction/Radio.php';

use Abstraction\Field as f;
use Abstraction\CheckBox as cb;
use Abstraction\Radio as r;
use Abstraction\Text as t;

$all_fields = [
    new cb('checkbox'),
    new r('radio'),
    new t('text'),
];

foreach($all_fields as $each)
{
    echo $each->render()."<br>";
}


?>