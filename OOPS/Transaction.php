<?php
declare(strict_types=1);
class transaction
{
    private float $amount ;
    private string $desription;

    public function getAmount():float
    {
        return $this->amount;
    }

    public function setAmount(float $amt)
    {
        $this->amount = $amt;
    }

    public function getDescription():string
    {
        return $this->desription;
    }

    public function setDescription(float $desc)
    {
        $this->desription = $desc;
    }

    public function __construct(private float $amt, private string $desp)
    {
        $this->amount = $amt;
        $this->desription = $desp;
    }

    public function addTax(float $rate) : Transaction
    {
        $this->amount +=$this->amount*$rate/100;
        return $this;
    }
    
    public  function apply_discount(float $rate) : Transaction
    {
        $this->amount -=$this->amount*$rate/100;
        return $this;
    }

    public function __destruct()
    {
        echo "Destruct ".$this->desription."<br>";
    }
}

?>