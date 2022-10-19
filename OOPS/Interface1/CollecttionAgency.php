<?php
namespace Interface1;
class CollectionAgency implements DeptCollector
{
    public function collect(float $owedAmount): float
    {
        $guarenteed_amount = $owedAmount*0.5;
        return mt_rand($guarenteed_amount , $owedAmount);
    }
}
?>