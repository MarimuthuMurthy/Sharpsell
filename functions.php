<?php

function sum(int...$numbers):float
{

    return array_sum($numbers);
}
$x = "sum";
if(is_callable($x))
{
echo $x(1,2,2)."<br>";
}
else{
    echo "not callable"."<br>";
}



#           ANONYMOUS FUNCTION

$num = 10;
$sum = function (int ...$numbers) use ($num) :int{
    #use keyword used to access global variables
    echo $num."<br>";
    return array_sum($numbers);
};
echo $sum(1,2,3,4)."<br>";


#callables

$mul = function(callable $callback , ...$integers):int{

    $m = 1;
    foreach ($integers as $numb)
    {
        $m*=$numb;
    }
    return $m;
};
echo $mul(function($element)
{
    return $element*2;
},1,2,34,4);
 

#       arrow functions

$array = [1,2,3,4];
$array2 =  array_map(fn($number)=>$number*$number , $array);
echo '<pre>';
print_r($array2);
echo '</pre>';



?>