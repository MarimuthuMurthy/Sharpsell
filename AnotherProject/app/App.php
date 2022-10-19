<?php

declare(strict_types=1);

function getTransaction(string $dirpath) :  array{
    $files= [];
    foreach(scandir($dirpath) as $file)
    {
        if(is_dir($file))
        {
            continue;
        }
        $files[] = $dirpath.$file;
    }
    return $files;
}

function getTransactionsFile($fileName):array{
    if(!file_exists($fileName))
    {
        trigger_error("File : ".$fileName." does not exist ." , E_USER_ERROR);
    }
    $file = fopen($fileName , 'r');

    fgetcsv($file);

    $transactions = [];

    while(($line = fgetcsv($file))!=false)
    {
        $transactions[] = extractTransaction($line);
    }

    return $transactions;
}

function extractTransaction(array $transactionRow):array
{
    [$date , $checkNumber , $description , $amount] = $transactionRow;
    $amount = (float)str_replace(['$',','] , '' , $amount);
    return[
        'date' => $date , 
        'checkNumber' => $checkNumber , 
        'description' => $description , 
        'amount' => $amount,
    ];
}

function totals(array $transactions) :  array
{
    $total = ["nettotal"=>0 , "totalIncome"=>0 , "totalExpense"=>0];
    foreach($transactions as $transaction){
        $total['nettotal']+=$transaction['amount'];
        if($transaction['amount']>=0)
        {
            $total['totalIncome']+=$transaction['amount'];
        }
        else{
            $total['totalExpense']+=$transaction['amount'];
        }
    }
    return $total;
}

?>