<?php
namespace Interface1;
class Rocky implements DeptCollector
{
    function collect(float $owedAmount): float {
        return $owedAmount*0.65;
	}
}
?>