<?php


class Vehicle
{
    private int $speed ; 
    private int $milage;

    public function getSpeed():int
    {
        return $this->speed;
    }
    public function getMilege():int
    {
        return $this->milage;
    }
    public function setSpeed(int $speed)
    {
        $this->speed = $speed;
    }
    public function setMilege(int $milege)
    {
        $this->milage = $milege;
    }
    public function __construct(int $speed , int $milege)
    {
        $this->speed = $speed;
        $this->milage = $milege;
    }
    function MoveWheels()
    {
        echo "Wheels move";
    }
}

// if(class_exists("Car"))
// {
//     echo "yes it exists";
// }
// else{
//     echo "No Car not exists";
// }

?>