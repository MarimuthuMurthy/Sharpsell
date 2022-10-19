
<?php

class inher1
{
    public int $length ;
    public int $breadth; 
    public function __construct(int $len , int $bre)
    {
        echo "this is parent"."<br>";
        $this->length = $len;
        $this->breadth = $bre;
    }
    public function area()
    {
        return $this->length*$this->breadth;
    }
}
class inherit2 extends inher1
{
    public int $height=0;
    public function __construct(int $height)
    {
        parent::__construct(10,28);
        echo "this is child"."<br>";
        $this->$height = $height;
    }
    public function volume()
    {
        return $this->area()*$this->height;
    }
}

$ts = new inherit2(10);
echo $ts->volume()."<br>";



?>