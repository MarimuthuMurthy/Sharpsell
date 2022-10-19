<?php

#   Static properties and methods :
#   *******************************
#               |
#               v
#           Early binding
#               |
#               v
#          Compile time



#       Late static binding:
#   *******************************
#               |
#               v
#           Late binding
#               |
#               v
#            run time

namespace OOPS;

class classA
{
    protected string $name = 'A';
    public function getName() : string
    {
        var_dump(get_class($this));
        return $this->name;
    }
}
class classB extends classA
{
    protected string $name = "B"; 
}


$clA = new classA();
$clB = new classB();
echo $clA->getName();
echo $clB->getName();



###for static purpose



class classC
{
    protected static string $value1 = 'C';
    public static function display()
    {
        return static::$value1;
    }
}
class classD extends classC{
    protected static string $value1 = 'D';
}
$clC = new classC();
$cld = new classD();
echo $clC::display().PHP_EOL;
echo $cld::display().PHP_EOL;



?>