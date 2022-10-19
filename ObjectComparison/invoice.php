<?php

namespace ObjectComparison;
class invoice1
{
    public int $value1 ; 
    public string $description;
    public function __construct(int $value1 , string $desc)
    {
        $this->value1 = $value1;
        $this->description = $desc;
    }
}


?>