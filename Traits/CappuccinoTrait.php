<?php
namespace Traits;
Trait CappuccinoTrait{
    public function makeCappuccino()
    {
        echo static::class.' is making cappuccino'.PHP_EOL;
    }

    public function makeLattee()
    {
        echo static::class.' is making Latte (from cappucino trait)'.PHP_EOL;
    }
}

?>