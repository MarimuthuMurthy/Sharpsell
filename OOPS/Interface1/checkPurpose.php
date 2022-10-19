<?php
class concreete
{
    public function concreteDisplay()
    {
        echo "iam concrete class display";
    }
}



interface first
{
    public function display();
}

class second implements first
{
    public function display()
    {
        echo "iam second concrete class display method";
    }
}

$sec = new second();
$sec->display();

?>