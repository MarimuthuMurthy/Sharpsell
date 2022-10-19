<?php

class SingleTon
{
    public static ?SingleTon $instance = null;
    private function __construct(public array $config)
    {
        echo "one object onky created";
    }
    public static function getInstance(array $config)
    {
        if(self :: $instance === null)
        {
            self::$instance =  new SingleTon($config);
        }
        return self::$instance;
    }

}




?>