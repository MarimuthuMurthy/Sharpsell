<?php
namespace Interface1;
class DeptCollectionService
{
    public function collectDept(DeptCollector $collector)
    {
        $owedAmount = mt_rand(100,1000);
        $collectedAmount = $collector->collect($owedAmount);
        echo 'Collected $ '.$collectedAmount;
    }
}
?>