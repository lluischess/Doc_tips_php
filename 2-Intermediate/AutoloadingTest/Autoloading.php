<?php

// require_once '../TipsOOP/tests/camion.php';
// require_once '../TipsOOP/tests/coche.php';

// PHP tiene una function para el autoload
# El primer parametro es un calleble que es nuestra funcion que se ejecuta en ese momento

# El autoload por defecto usara la clase instanciada, si no tenemos ninguna no se ejecutara
spl_autoload_register(function($class){
    // Añadimos el path correcto para requerir la clase
     $class = __DIR__ . '/../' .lcfirst(str_replace('\\', '/', $class)) . '.php';
     require $class;
     var_dump($class);
 });
 
 // El prarametro prepend se usa para que se ejecute primero este autoload
 spl_autoload_register(function($class){
     var_dump('Autoloader 2');
 }, prepend:true);
 
 use tipsOop\tests\Camion;
 use tipsOop\tests\coche;
 
 $testcoche = new coche(4); // clase instanciada
 
 //var_dump($testcoche);