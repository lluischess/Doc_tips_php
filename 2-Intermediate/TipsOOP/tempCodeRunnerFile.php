<?php
Class DB 
{
    public static ?DB $instancia = null;

    private function __construct(public array $config)
    {
        echo 'Instancia creada';
    }

    public static function getInstance(array $config): DB 
    {
        if (self::$instancia == null){
            self::$instancia = new DB($config);
        }

        return self::$instancia;
    }
}

$db = DB::getInstance([]);
$db = DB::getInstance([]);
$db = DB::getInstance([]);