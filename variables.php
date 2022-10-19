<?php

#    global scope 
$x = 5;
$y = 10;
$z = 20;

#php stores global variables in globals array


include('anotherfile.php');

echo $x;



$arr = ["15892" => "murthy" , "13027"=>"jana"];

if(is_array($arr))
{
foreach($GLOBALS as $key => $value)
{
    if(is_array($value))
    {
        foreach($value as $val)
        {
            echo $val."<br>";
        }
    }
    else
    {
        echo $value."<br>";
    }
}
}

#           STATIC VARIABLES

function getValue()
{
    static $value = null;
    if($value === null)
    {
        $value = getExpensiveValue();
    }
    return $value;
}

function getExpensiveValue()
{
    echo "processing"."<br>";
    sleep(2);
    return 10;
}

echo getValue();
echo getValue();

?>