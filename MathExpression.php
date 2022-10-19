<?php

declare(strict_types=1);


#       switch is loose (==) conversion .

  
#       match is strict(===) conversion .










$paymentstatus = 1;

#we can assign variables to match


// $status1 = match($paymentstatus)
// {
//     1 => print("paid"),
//     2 => print( "payment decline"),
//     3 => print( "pending payment"),
// };

// echo $status; 

// #     output is 1

// $status = match($paymentstatus)
// {
//     1 =>  "paid",
//     2 =>  "payment decline",
//     3 =>  "pending payment",
//     default => "not found",
// };

// echo $status; 

#    output is paid


#            return statement


function sum($a , $b) : int
{
    return $a+$b;
}


#           declare statement


#   declare - ticks



function onTick()
{
    echo "tick"."<br>";
}

register_tick_function('onTick');

declare(ticks =2);

$x = 1;
$y=1;
while($x<=10):
    echo $x++."<br>";
endwhile;






?>