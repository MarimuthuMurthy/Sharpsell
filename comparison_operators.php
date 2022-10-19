<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php


$things = ["1 . EQUAL"=>"==","2 . IDENTICAL"=>"===" ,"3 . COMPARE"=>"> < >=  <= <>" ,"4 . NOT EQUAL"=>"!=","5 .NOT IDENTICAL"=>"!=="];

echo "<h2>COMPARISON OPERATORS</h2>"; 
echo '<pre>';
print_r($things);
echo '</pre>';



#           LOGICAL OPERATORS 


#           AND         &&
#           OR          ||
#           NOT         !


if(4 === 4.0)
{
    echo "it is true"."<br>";
}
else{
    echo "it is not true"."<br>";
}




#               SWITCH STATEMENTS
#           *************************
$a  = 20;
switch($a)
{
    case 20 :
        echo "i found"."<br>";
        break;
    default :
        echo "not found"."<br>";
        break;
}



#               WHILE LOOP
#           *******************

$end = true;
$i =1;
while( $end)
{
    if($i==10)
    {
        $end = false;
    }
    echo "<h2>{$i} time</h2>";
    $i++;

}


#               FOR LOOP
#               *********

for( $a = 1 ; $a <= 10 ; $a++ )
{
    echo "{$a}"."<br>";
}


#               FOR EACH LOOP
#              ***************

$numbers = ["Andal" , "Daddy" , "Mummy" , "ram" , "murthy"];
foreach($numbers as $number)
{
    echo "{$number}"."<br>";
}





?>
















</body>
</html>