<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <style>
        table{
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th, table tr td {
            padding: 4px;
            border: 1px #eee solid;
        }

        tfoot tr th, tfoot tr td {
            font-size: 17px;
        }
        tfoot tr th {
            text-align: right;
        }

    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Check</th>
            <th>Description</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($transactions)): ?>
            <?php foreach ($transactions as $transaction):?>
                <tr>
                    <td><?=$transaction['data'] ?? ''?></td>
                    <td><?=$transaction['checkNumber'] ?? ''?></td>
                    <td><?=$transaction['description'] ?? '' ?></td>
                    <?php if ($transaction['amount'] < 0): ?>
                        <td style="color:red"><?=formatDollarAmount($transaction['amount'] ?? 0)?></td>
                    <?php else: ?>
                        <td style="color:green"><?=formatDollarAmount($transaction['amount'] ?? 0)?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total Income:</th>
            <td><?=formatDollarAmount($totals['totalIncom'] ?? 0) ?></td>
        </tr>
        <tr>
            <th colspan="3">Total Expense:</th>
            <td><?=formatDollarAmount($totals['totalExpense'] ?? 0) ?></td>
        </tr>
        <tr>
            <th colspan="3">Net Total:</th>
            <td><?=formatDollarAmount($totals['totalNet'] ?? 0 )?></td>
        </tr>
    </tfoot>
</table>
    
</body>
</html>