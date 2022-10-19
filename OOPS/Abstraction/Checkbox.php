<?php


namespace Abstraction;
class CheckBox extends Field
{
    public function render():string
    {
        return "<input type = 'checkbox' name = {$this->name}/>";
    }
}


?>