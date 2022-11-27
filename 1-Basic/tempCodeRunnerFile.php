<?php
$dir = scandir(__DIR__);

# Podemos revisar que es un fichero
var_dump($dir);
var_dump(is_file($dir[4]));
var_dump(is_dir($dir[1]));