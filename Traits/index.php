<?php


require_once "../Traits/coffeMaker.php";
require_once "../Traits/latteMaker.php";
require_once "../Traits/CappuccinoMaker.php";
require_once "../Traits/AllInOneMaker.php";

$coffeeMaker = new \Traits\coffeMaker();
$coffeeMaker->makeCoffee();

$lattemaker = new \Traits\LatteMaker();
$lattemaker->makeCoffee();
$lattemaker->makeLattee();

$cappucinoMaker = new \Traits\CappuccinoMaker();
$cappucinoMaker->makeCoffee();
$cappucinoMaker->makeCappuccino();


$AllInOne = new \Traits\AllInOneMaker();
$AllInOne->makeCoffee();
$AllInOne->makeCappuccino();
$AllInOne->makeLattee();

?>