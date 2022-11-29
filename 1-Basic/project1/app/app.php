<?php

declare(strict_types=1);


// Guarda la ruta de los archivos de la carpeta FILES_PATH en un array
function getTransactionFiles(string $path): array
{

    $files = [];

    foreach (scandir($path) as $file) {

        if (is_dir($file)) {
            continue;
        }

        $files[] = $path . $file;
    }

    return $files;
}

// Guarda en una array las lineas del archivo que pasamos en $filename
function getTransactions(string $filename, ?callable $transactionpharse = null): array
{
    $transactions = [];

    if (file_exists($filename)) {
        $datos = fopen($filename, 'r');

        //Para no leer la primera linea que seran los titulos de la table:
        fgetcsv($datos);

        if ($datos !== false) {
            while (($line = fgetcsv($datos, 1000, ',')) !== false) {
                if(!is_null($transactionpharse)){
                    $transactions[] = $transactionpharse($line);
                }else{
                    $transactions[] = $line;
                }
            }
        }
    } else {
        trigger_error('File: ' . $filename . ' does not esist', E_USER_ERROR);
    }

    return $transactions;
}

// Formatear transacciones a los formatos correctos

function pharseTransaction(array $transactionRow): array
{
    // Destruimos el array $transactionRow
    [$data, $checkNumber, $description, $amount] = $transactionRow;

    // Eliminamos $ y ,
    $amount = (float) str_replace(['$', ','], '', $amount);

    // Formateamos fecha
    $data = (string) date('d M, Y',strtotime($data));


    // añadimos los valores formateados al nuevo array
    return [
        'data'          => $data,
        'checkNumber'   => $checkNumber,
        'description'   => $description,
        'amount'        => $amount,
    ];
}

function getTotalsResult(array $transactions): array 
{
    $totals = [
        'totalIncom'  => 0,
        'totalExpense'=> 0,
        'totalNet'    => 0,
    ];

    foreach($transactions as $transaction){
        $totals['totalNet'] += $transaction['amount'];

        if($transaction['amount'] >= 0){
            $totals['totalIncom'] += $transaction['amount'];
        }else{
            $totals['totalExpense'] += $transaction['amount'];
        }
    }


    return $totals;
}
