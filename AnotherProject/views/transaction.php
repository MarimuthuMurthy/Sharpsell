<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if(! empty($transactions)) : ?>
                <?php foreach($transactions as $transaction):?>
                    <tr>
                        <td><?= $transaction['date']?></td>
                        <td><?= $transaction['checkNumber']?></td>
                        <td><?= $transaction['description']?></td>
                        <td>
                            <?php if($transaction['amount']<0):?>
                            <span style="color: red;">
                                <?= $transaction['amount']?>
                            </span>
                            <?php elseif($transaction['amount']>0):?>
                            <span style="color: green;">
                                <?= $transaction['amount']?>
                            </span>
                            <?php else:?>
                                <?= $transaction['amount']?>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan = "3">total income : </th>
                <td><?= formatDollarAmount($totals['totalIncome'] ?? 0) ?></td>
            </tr>
            <tr>
                <th colspan = "3">total Expense : </th>
                <td><?=formatDollarAmount($totals['totalExpense'] ?? 0) ?></td>
            </tr>
            <tr>
                <th colspan = "3">Net Total : </th>
                <td><?=formatDollarAmount($totals['nettotal'] ?? 0) ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>