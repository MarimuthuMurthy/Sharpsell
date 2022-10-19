<?php
// namespace App\practice2;
require '../App/practice2/Enum.php';
class Transaction1{
    public static  int $count =0 ;
    public string $status ;
    private int $amount ;
    public function __construct(int $amount)
    {
        echo Enum::PENDING."<br>";
        self::$count++;
        $this->amount = $amount;
    }

    public function setStatus(string $status ){
        if(! isset(Enum::ALL_STATUS[$status]))
        {
            throw new \InvalidArgumentException();
        }
        else{
            $this->status = $status;
        }
    }
    
}



?>