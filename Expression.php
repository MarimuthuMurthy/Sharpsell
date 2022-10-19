
<?php 

$x = 5 ; 
$y = $x;
echo $x === $y;



#               OPERATORS

# Arithmetic operators
$x = 10; 
$y = 20;
var_dump($x+$y);
var_dump($x-$y);
var_dump($x*$y);
var_dump($x/ $y);



#string operators

$firstName = "marimuthu";
$lastName =  "murthy";
echo $firstName.$lastName;
$firstName .=$lastName;
echo $firstName;



#comparison operators

$x = 2;
$y = 5;
var_dump($x == $y);
var_dump($x === $y);

#   ?? operator - if x is null then y assigned to hello else y asigned to x .

$x = null;
$y = $x ?? "hello";

# error control operators

# denoted by "@"

# Increment / Decrement operators 
$x = 10;
var_dump($x--);
var_dump(--$x);



$a = 0;
for($a = 0 ; $a < 10 ; $a++):
    echo "{$a}";
endfor;

while($a<0):
    echo $a;
endwhile;



$paymentStatus = true;
switch($paymentStatus):
    case 1:
        echo "yes paid";
        break;
endswitch;




?>

