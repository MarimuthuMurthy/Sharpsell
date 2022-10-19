<?php



// require_once '../App/practice1/Transaction1.php';
// require_once '../App/practice1/CustomerProfile.php';
// require_once '../App/practice2/Transaction1.php';

// spl_autoload_register(function($class)
// {
//     $path = __DIR__.'/../'.$class.'.php';
//     $path = str_replace("\\",'/',$path);
//     echo $path."<br>";
//     require $path;
// }
// );




require '../App/Vehicle.php';
require '../App/Car.php';
require_once '../App/practice2/Transaction1.php';
require_once '../App/practice2/Enum.php';

// use App\practice2\Transaction1;
// use App\practice2\Enum;

// use App\practice1\Transaction1 as practice1Transaction;
// use App\practice2\Transaction1 as practice2Transaction;
// use App\practice1\CustomerProfile; 

// var_dump(new practice1Transaction());
// var_dump(new practice2Transaction());
// var_dump(new CustomerProfile());

$suzuki = new Vehicle(10,20);
$bmw = new Vehicle(20,40);
echo "Suzuki milage is ".$suzuki->getMilege()."<br>";
$suzuki->setMilege(40);
echo "Suzuki milage is ".$suzuki->getMilege()."<br>";
echo "BMW milage is ".$bmw->getMilege()."<br>";
$x = new Car(10,20);  


#constants in class can be access by Class name (no requirement of object)
// echo Transaction1::STATUS_PAID."<br>";


#by object
$transaction1 = new Transaction1(123);
// echo $transaction1::STATUS_PAID."<br>";

echo Transaction1::class."<br>";

$transaction1->setStatus(Enum::DECLINED);

echo $transaction1::$count."<br>";

var_dump(Transaction1::$count);

#to access private variables

$reflectionProperty = new ReflectionProperty(Transaction1::class , 'amount');
$reflectionProperty->setAccessible(true);
var_dump($reflectionProperty->getValue($transaction1));




?>