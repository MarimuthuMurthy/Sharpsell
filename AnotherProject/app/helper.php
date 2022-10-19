<?php

declare(strict_types=1);
function formatDollarAmount(float $amount)
{
    $isNegitive = $amount<0;
    return ($isNegitive?'-' : '').'$'.number_format(abs($amount),2);
}



?>