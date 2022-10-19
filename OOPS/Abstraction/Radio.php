<?php


namespace Abstraction;
class Radio extends Field
{
    public function render():string
    {
        return "<input type = 'radio' name = {$this->name}/>";
    }
}


?>