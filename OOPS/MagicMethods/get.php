<?php

namespace MagicMethods;

class Invoice
{
    private float $amount=0;
    public string $desciption ; 
    public int $value;
    public function __construct($amount)
    {
        $this->amount = $amount;
    }
    public function __get(string $name)
    {
        if(property_exists($this , $name))
        {
            return $this->$name;
        }
        else{
            return null; 
        }
    }


    public function __set(string $name , int $value)
    {
        if(property_exists($this , $name))
        {
            $this->$name = $value;
        }
    }
    #isset function .
    public function __ISSET(string $name)
    {
        return array_key_exists($name , $this->data);
    }

    #unset function
    public function __unset(string $name)
    {
        unset($this->amount);
    }


    public function process(float $name  , string $description)
    {
        var_dump('process');
    }
    # __call method
    public function __call(string $name , array $arguments)
    {
        if(method_exists($this , $name))
        {
            call_user_func_array([$this , $name] , $arguments);
        }
    }
    public function __toString():string
    {
        return '1';
    }


    #   invoke method :
    #   *************
    #                   the method is invoked by object name 
    #                   eg:
    #                       objectName();

    public function __invoke()
    {
        echo "method invoked";
    }
    # __debugInfo magical method
    public function __debugInfo()
    {
        return [
            'amount' => $this->amount,
            'description' => $this->desciption,
            'value'=>$this->value,
        ];
    }

}



?>