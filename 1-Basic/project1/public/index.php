<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app'. DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files'. DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views'. DIRECTORY_SEPARATOR);

// Code

require APP_PATH . 'app.php';
require APP_PATH . 'helper.php';
// Obtenemos los archivos de la carpeta "project1\transaction_files\"
$files = getTransactionFiles(FILES_PATH);

// Guardamos todos los datos de las transacciónes en un array
$transactions = [];
foreach($files as $file){
    $transactions = array_merge($transactions, getTransactions($file,'pharseTransaction'));
}
// echo '<pre>';
// print_r($transactions);
// echo '</pre>';

// Obtenemos los totales
$totals = [];
$totals = getTotalsResult($transactions);

// Imprimiremos la array en HTML
require VIEWS_PATH . 'transactions.php';

