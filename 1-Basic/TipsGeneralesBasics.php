<?php

# INDEX 
# 1) Variable definida o esta vacio? isset() empty()
# 2) PHP abreviado para formularios HTML
# 2.1) No es necesario ; cuando cierras php
# 2.2) Se puede ejecutar php en terminal
# 2.3) echo vs print
# 2.4) Sintaxis echo
# 2.5) Variable por referencia
# 3) Imprimir valores con var_dump() y print_r()
# 4) Saltos de linea o tabulador en un String
# 5) Variables locales, globales y Constantes, Constantes predefinidas
# 5.1) Variable de variables
# 5.2) Tipos de datos
# 5.3) Type casting
# 5.4) Boolean
# 5.5) Integer
# 5.6) Floats
# 5.7) Strings
# 5.8) Strings Heredoc and Nowdoc
# 5.9) Null
# 5.10) Variables Scopes
# 6) Fechas
# 7) Funciones Matematicas
# 8) Mas funciones Predefinidas
# 9) Include y require
# 9.1) ob_start() and ob_get_clean()
# 10) Redireccionar Pagina web
# 11) Cifrar contraseña
# 12) Guardar string sin espacios
# 13) Recortar String caracteres
# 14) Concatenación de cadenas, comillas simples(') vs comillas dobles(")
# 15) Definicion de tus programas
# 16) Arithmetic Operators (+ - * / % **)
# 16.1) Assignment Operators (= += -= *= /= %= **=)
# 16.2) String Operators (. .=)
# 16.3) Comparison Operators (== === != <> !=== < > <= >= <=> ?? ?:)
# 16.4) Error control operator (@)
# 16.6) Logical Operators (&& || ! and or xor)
# 16.7) Bitwise Operators (& | ^ ~ << >>)
# 16.8) Array Operators (+ == === !== <> !===)
# 16.9) Execution Operators (``)
# 16.10) Type Operators (instanceof)
# 16.11) Nullsafe Operators PHP8 (?)
# 17) Operators Precedence & Associativity
# 18) La Creación de las Bases de datos deben ser con esta nomenclatura
# 19) Añadir esto en los forms para subir imagenes al servidor
# 20) Comparaciónes
# 21) Control Structures (Condicionales) (if / else / elseif / else if)
# 22) declare(strict_types=1)
# 23) Handling errors manejo de errores
# 24) Trabajar con directorios
# 25) Limpiar cache de estado clearstatcache()





#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Es nulo o esta vacio? isset() empty()

# isset determina si una variable esta definida
# empty determina si una variable esta vacia

# Ejemplo 1  
# Si existe el $_POST['action'] entonces guardara el valor en la variable $action
$action = isset($_POST['action']) ? $_POST['action'] : 'action no existe';
# Esto es lo mismo
$action = $_POST['action'] ?? 'action no existe';

# Ejemplo 2 
# Si la variable $_POST['action'] no esta vacia guardara el valor de POST en la variable $action 
$campo = !empty($_POST['action']) ?  $_POST['action'] : 'action vacia';

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) PHP abreviado para formularios HTML

# Ejemplo 1 
# Podemos imprimir en un HTML la variable $saludos de la siguiente manera:
$saludos = "Hola soy una variable PHP";
?>  
<h1><?php $saludos ?></h1>
<h1><?=$saludos?></h1>  
<?php

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2.1) No es necesario ; cuando cierras php
# Si nos fijamos la linia no finaliza con ; y funciona.
?>

<?php echo 'Hola'  ?>

<?php
#----------------------------------------------------------------------------------------------------------------------------------------------
# 2.2) Se puede ejecutar php en terminal
# Vas a la terminal y te diriges a la carpeta donde tenemos el fichero php
# una vez alli codeamos esto: php archivo.php 
# En VScode con la extension 

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2.3) echo vs print
# Recompiendo echo que es mas rapido que print

# echo admite esto:
echo 'hello', ' ', 'World';
# Output: hello World

echo('hola');
# Output: hola

print('hola');
# Output: hola

# El print devolvera 1 al reves no se puede
echo print 'hola dq';
# Output: hola dq1
#----------------------------------------------------------------------------------------------------------------------------------------------
# 2.4) Sintaxis echo

# comillas '' es lo mas rapido
# pero si necesitamos usar apostrofe o algo "''" meter dentro de comillas dobles
# o antes de la comilla usar \
echo 'Hello World';
echo 'hello\'s World';
echo "hello's World";

# Printar variables
$v = 'adios';
#Solo con comillas dobles
echo "hola $v";
echo "hola {$v}";

#Solo com comillas simples
echo 'hola' . $v;
#----------------------------------------------------------------------------------------------------------------------------------------------
# 2.5) Variable por referencia

# Sin referencia
$x = 1;
$y = $x;
$x = 2;
echo $y;
#output: 2

# con referencia
$x = 1;
$y = &$x; # coje el ultimo valor de x
$x = 2;
echo $y;
#output: 1
#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Imprimir valores con var_dump() y print_r()

# var_dump() Esta función muestra información sobre una o más expresiones incluyendo su tipo y valor. 
# Las matrices y los objetos son explorados recursivamente con valores sangrados para mostrar su estructura.

# print_r() Muestra información sobre una variable en una forma que es legible por humanos.

# Ejemplo 1 
$variable = "Hola";
var_dump($variable);

# Ejemplo 2
$a = array ('a' => 'manzana', 'b' => 'banana', 'c' => array ('x', 'y', 'z'));
print_r($a);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) Saltos de linea o tabulador en un String
# Ejemplo:
$text = "Soy un texto y \n HOla \t Salto de tabulador";

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5) Variables locales, globales y Constantes, Constantes predefinidas

# Variable local
$frase = "<h1>Hola soy Luis</h1>";
echo $frase;

function hola(){ 
  # Para usar la variable de fuera se usa global
  # Se pueden ver un listado de Variables locales en un array asociativo aqui:
  echo $GLOBALS['frase'];
  global $frase; 
    return $frase;
 }
 hola();

 # Definir una constante:
 # Hay que intentar definir las constantes en mayusculas con guion bajo
 define('NOMBRE_APP','LuisApp');
 echo NOMBRE_APP;

 # Definir una constante de otra manera:
 const IP_APP = '172.0.0.1';
 echo IP_APP;

 # La diferencia entre las 2 es que la define puede ir dentro de bucle y la otra siempre al principio.
 if (true){
    define('NOMBRE_APP','LuisApp');
 }

 # Podemos preguntar si la constante esta definida con la function defined
 defined('NOMBRE_APP'); 
 # output: 1/true esta definida

 # Constantes predefinidas
 echo PHP_OS.'<br>'; // sistema operativo
 echo PHP_VERSION.'<br>'; // version php
 echo PHP_EXTENSION_DIR.'<br>'; // Extensiones de php instaladas
 echo __FILE__; // la ruta y el nombre del archivo

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.1) Variable de variables

$foo = 'var';

# el $$ significa que coje la definicion de la variable y la cambia por el nombre de la variable
$$foo = 'var';
# igual a = $var = 'var'


#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.2) Tipos de datos

# 4 Scalar Types
    # bool ->  true / false
    $boleano = true;
    # int -> 1, 2, 3, 4, -5, 0 (sin decimales)
    $entero = 2;
    # float -> 2.3 - -32.22 - 0.002 
    $decimal = 0.33;
    # string ->  'Hola', "Hola"
    $cadena = "Hola";

    echo $boleano . '<br>';
    echo $entero . '<br>';
    echo $decimal . '<br>';
    echo $cadena . '<br>';
    echo gettype($boleano);

# 4 Compound Types
    # array
    $array1 = [1,2,3.2,-0.1,'A',true];
    # object
    # callable
    # iterable

    print_r($array1);

# 2 Special Types
    # resource
    # null


#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.3) Type casting
# Podemos forzar la conversion de una variable añadiendo entre parentesis el tipos de dato

$x = (int) '3';
#output = 3 int
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.4) Boolean
$bool = -0.0; // = a False

# Que se considera falso en otros tipos de datos:
# integers 0, -0 = false
# float 0.0, -0.0 = false
# string '' = false
# string '0' = false
# array [] = false
# null = false

# i Verdadero:
# integers el 1 como boleano pero el reso de numeros seran true por condicion
# si hay valores en float string y array seran true

if($bool){
    echo 'es true';
}else{
    echo 'es false';
}

# si se intenta imprimir un boleano con echo los 2 resultados siguienes significarian lo mismo:
echo $bool;
echo (string) $bool;


# para saber si es boleano o no
$bool = false;
var_dump(is_bool($bool));

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.5) Integer
# integers son todos los numeros positivos y negativos sin decimales 1, -2, 3, 42242

# tambien es compatible con numeros hexadecimales
 $x = 0x2A; // = 42
 $y = 055; // Octalnumbers
 $d = 0b11; //numero binareos
 $max = PHP_INT_MAX; // es el valor maximo de un int
 echo $x . $y . $d;

 # casting int los dos son lo mismo
 $x = (int) 5;
 $x = (integer) 5;
var_dump(is_int($x));

# Para leer un entero mejor puedes añadir un guion bajo ya que no lo gestionara _
$integ = 200_000_000;
var_dump($integ);
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.6) Floats

$x = 1.3;
$y = 13.3e-3; // float hexadecimales
$z = 130_000.3; // fload y separado para ser mas legibles

echo PHP_FLOAT_MAX; // el valor maximo del float

$x = floor((0.1 + 0.7) * 10); //output = 7,  para redondear para abajo el valor final 
$x = ceil((0.1 + 0.7) * 10); //output = 8,  para redondear para arriba el valor final 

# con esto hay que tener en cuenta que el echo de comparar bien numeros decimales es dificil y hay que entender-lo muy bien

echo NAN; // Se podria dejar si alguna operación no puediese ser computada por alguna cosa especial
echo INF; // es el valor que puede dar si calcula algo superor a PHP_FLOAT_MAX

# Casting float
$int = (float) 9;
# O tambien se puede usar la siguiente función:
var_dump(floatval($int));
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.7) Strings

# Diferencias entre comillas simples y dobles

# en comillas simples no se pueden añadir variables
$firstname = 'Will';
# en comillas dobles puedes agregar variables
$lastname = "$firstname Smith";
# para mejorar la lectura de la variable agregamos {}
$lastname = "{$firstname} Smith";
# en comillas simples seria de la siguiente forma
$lastname2 = $firstname . ' Smith';

echo $lastname2;

# podemos acceder a culquier letra de la cadena mediante una array
# por ejemplo la i
echo "\n".$lastname2[1];
# y para acceder desde el final de la cadena lo hacemos con negativos
echo "\n".$lastname2[-1];
# tambien podemos modificar las letras de la cadena accediendo a su valor
$lastname2[-1] = 'R';
echo $lastname2;
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.8) Strings Heredoc and Nowdoc

# Heredoc Yes Variables:
# se puede ejecutar html
$x = 1;
$y = 2;
$text = <<<TEXT
Line $x
Line $y
Line 3
<p> <strong>H</strong>ello </p>
TEXT;

echo nl2br($text); // Genera lineas e imprime con \n por linea

# Nowdoc Not variables:
# funciona igual pero sin variabes
$text = <<<'TEXT'
Line $x
Line $y
Line 3
TEXT;

echo nl2br($text);
# Otro Ejemplo
$query = <<<SQL
    SELECT *
    FROM `table`
    WHERE `column` = true;
    SQL;
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.9) Null

# null constante
$x = null;
# comprobamos que es null
var_dump(is_null($x));

# los === iguales pueden ser una alternativa igual que la funcion isnull
var_dump($x === null);

# si una variable no a sido definida o es unset es null
unset($x); // destruimos la variable
var_dump($x === null); // output = null errir de no definida

# Casting
# si pasamos un valor null a otro valor el valor sera 0 o estara vacio
$x = null;
var_dump((int) $x); // output 0


#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.10) Variables Scopes(Alcance de las variables)

# Si una variable esta dentro de una funcion solo tendra alcance dentro de la funcion
function fi(){
    $variable_solo_para_la_funcion = 10;
}

# Si una variable esta fuera de la funcion solo tendre accesso en ese archivo de la funcion o si inclumos el archivo en otro archivo
$variable_para_el_archivo = 10;

# Tenemos luego las variables GLOBALES
$GLOBALS[$variable_para_el_archivo];

#Static variables
static $variable2 = null;

class Foo {
    static $my_var = 'Foo';
}

$x = new Foo();

echo $x::$my_var;  // works fine
echo $x->my_var;   // doesn't work - Notice: Undefined property: Foo::$my_var

#----------------------------------------------------------------------------------------------------------------------------------------------
# 6) Fechas Dates

# Formato de fecha:
echo date('d-m-y') . "<br>";
echo date("d M, Y, g:i a"). "<br>";
echo date("Y-m-d H:i:s"). "<br>"; 
echo date('H:i:s'). "<br>";

# Time en integer
echo time();

# Podemos modificar la fecha via el segundo parametro de date
echo date('d/m/y H:i:a', time() + 5 * 24 * 60 * 60); // en este ejemplo añadimos 5 dias 24 horas 60 minutos y 60 s a la fecha actual

# Para poder trabajar con las horas de zona time zones se usa la siguiente funcion
# Primero podemos ver en que timezone estamos:
echo date_default_timezone_get();
# luego seteamos la que queremos usar
date_default_timezone_set('UTC');
echo date('d/m/y H:i:a', time() + 5 * 24 * 60 * 60); // ahora nos lo enseña en otra zona de tiempo

# Podemos obtener una fecha en hexadecimal por parametros que nos convenga y luego formatearla a fecha 
# Ejemplo :
echo mktime(8,0,0,11,10,2022); 
$fecha = mktime(8,0,0,11,10,2022); 
echo "\n$fecha";
// ahora formateamos la fecha a lo que nos convenga
echo date('d-m-y H:i:s a', $fecha);

#tambien podemos usar strtotime
echo strtotime('2022-01-18 07:00:00');// de un estring to hexa
// podemos formatearlo
echo date('d/m/y H:i:a',strtotime('2022-01-18 07:00:00'));
$data = date('d/m/y H:i:a',strtotime('2022-01-18 07:00:00'));
#Para obtener mas valores de una fecha podemos usar date_parse para transformar la fecha en un array con mas parametros
print_r(date_parse($data));

#----------------------------------------------------------------------------------------------------------------------------------------------
# 7) Funciones Matematicas

# Reiz cuadrada de un numero
echo "Raiz cuadrada de 10 es: ". sqrt(10); 

# Numero aleatorio Random
echo rand(). "<br>";
echo rand(3,10);

# Numero Pi 
echo pi();

# Redondear numero a 2 decimales
echo "Redondear ".round(7.5812312,2);


#----------------------------------------------------------------------------------------------------------------------------------------------
# 8) Mas funciones Predefinidas

#gettype() devuelve el tipo de variable que es
$tabla = [];
echo gettype($tabla);

# comprobar tipos de datos
echo is_array($tabla);
echo is_float($tabla);
echo is_bool($tabla);

# trim() Limpiar espacios en blanco de un string al inicio y al final
$texto = "  hola   ";
var_dump(trim($texto));

# Eliminar variable o indices de array
unset($tabla);

# Contador de caracteres de un string
$testolargo = "sdfasfasdfasdf";
echo strlen($testolargo);

# Encontrar la posicion caracter o palabra
$frase = "la vida es Bella";
echo strpos($frase, "vida");

# Remplazar palabras de un String
echo str_replace("vida","puta",$frase);
echo $frase;

# Upercase convertir a Mayusculas y minusculas
echo strtoupper($frase);
echo strtolower($frase);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 9) Include y require

# Siempre es recomendable dividir bastante el codigo en varios archivos ordenadamente y logicamente

include '<EjerciciosBasicos>/Ejercicio1.php'; // lo incluye siempre y las veces que quieras
include_once '<EjerciciosBasicos>/Ejercicio1.php'; // solo puede incluirse una vez

# La gran diferencia entre include y require es que si el require no encuentra el archivo el codigo dara fatal error
require '<EjerciciosBasicos>/Ejercicio1.php'; // es necesario para continuar
require_once '1-Basic/php.ini.php'; // Solo se requiere 1 sola vez

#----------------------------------------------------------------------------------------------------------------------------------------------
# 9.1) ob_start() and ob_get_clean()

# Se usan para almacenar en el bufer la salida de codigo

ob_start();
include 'php.ini.php';
$ini = ob_get_clean();

echo $ini; // imprimimos el codigo del archivo en el momento que imprimimos con echo en el momento desado

#----------------------------------------------------------------------------------------------------------------------------------------------
# 10) Redireccionar Pagina web

header('Location:ver_cookies.php');
header("Location:" . $domain . 'userController/registro');

#----------------------------------------------------------------------------------------------------------------------------------------------
# 11) Cifrar contraseña

 #   password_hash(Password,Encriptación,pasadas de encriptado)
 $password_segura = password_hash($pass, PASSWORD_BCRYPT, ['cost'=>4]);

 # Descifrar contraseña y comparar la password
 #   password original / pasword encriptada(hash) TRUE o FALSE
 password_verify($pass,$password_segura);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 12) Guardar string sin espacios

trim($email);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 13) Recortar String caracteres

substr($entrada['fDesc'],0,200);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 14) Concatenación de cadenas, comillas simples(') vs comillas dobles(")

# Cuando trabajes con cadenas, evita siempre el uso de comillas dobles. 
# La razón es que PHP analiza el contenido de las comillas dobles en búsqueda de variables que deban ser interpretadas, resultando en un tiempo de ejecución mayor.


#----------------------------------------------------------------------------------------------------------------------------------------------
# 15) Definicion de tus programas

# Los nombres de las clases en MixedCase. Ejemplo: ElNombreDeMiClase
# Los nombres de los métodos en camelCase. Ejempo: nombreDelMetodo()
# Las constantes siempre en ALL_CAPS. Ejemplo: COLOR_DEFINIDO_PARA_MI
# Las variables, propiedades y parámetros en giones bajos. Ejemplo $mi_palabra_secreta


#----------------------------------------------------------------------------------------------------------------------------------------------
# 16) Arithmetic Operators (+ - * / % **)
$z = 4;
$x = 2;

var_dump($z + $x);
var_dump($z - $x);
var_dump($z / $x); // ERROR si divides por 0
var_dump($z % $x); // RESTO del resultado
var_dump($z ** $x); // $z elevado a la $x 4 elevado a 2 es 4x4 = 16

// tener en cuenta que aveces el resultado puede ser casteado automaticamente por php en float o int


#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.1) Assignment Operators (= += -= *= /= %= **=)
$x = 5;

// Esto es igual a :
$x = $x * 3;
$x *= 3;

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.2) String Operators (. .=)
$x = "hello";

$x = $x . "World";
// simplificado
$x .= "World";

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.3) Comparison Operators (== === != <> !=== < > <= >= <=> ?? ?:)
// == comprueba que el resultado sea igual
// <> es lo mismo que !==
// === comprueba que el resualtado sea igual y el tipo de dato de la variable tambien

// Ejemplo ternaria ?:

$x = 'Hello World';
$existe = strpos($x, 'H');

$resultado = $existe === false ? 'No existe la Letra H' : 'Si existe la Letra H';

// Ejemplo ?? se usa normalmente para los nulos

$x = null;
$y = $x ?? 'Hello'; // si no existe la x 'hello'

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.4) Error control operator (@)
# El operador @ se puede añadir delante de una funciona para que esta en el momento de se utilizada no muestre los ERRORES ni WARNINGS que pueda causar PHP
# En Caso de PHP 8 o superior los ERRORES FATAL no son ignorados

# No es muy recomendable usar este operador

#Ejemplo
@opendir('files/jpg');
$file = @file_get_contents('none/existing/path');

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.5) Increment/Decrement Operators (++ --)
$x = 1;

// Hay que tener en cuenta que si printamos la operacion -- o ++ no veremos el resultado pero si printamos el resultado si
echo $x++; // output = 1
echo $x; // output = 2

$x = 1;
echo ++$x; // podemos hacer el calculo antes, en este caso si se vera el resultado
$x--; // lo resta


# en los String podemos incrementar con ++ de la a-z abecedario
$x = 'a';
$x++;
echo $x;

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.6) Logical Operators (&& || ! and or xor)
$x = true;
$y = false;
$result = $x && $y; // && = i las 2 se cumplen
var_dump($result);

$x = true;
$y = false;
$result = $x || $y; // || = o una de las 2 se cumple
var_dump($result);

# ! negacion
$x = true;
$y = true;
$result = (!$x && $y); // ! evalua lo contrario
var_dump($result);

# xor
$x = true;
$y = true;
var_dump($x xor $y); // mientras 1 sea verdadera bien pero si lo son las 2 false

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.7) Bitwise Operators (& | ^ ~ << >>)

# & calcula el resultado binareo
# | es el binareo al reves

$x = 6;
$y = 3;

// 6 = 110 binareo
//      &
// 3 = 011 binareo
//    ----
//     010 = 2
var_dump($x & $y);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.8) Array Operators (+ == === !== <> !===)

$x = ['a', 'b', 'c'];
$y = ['d', 'e', 'f', 'g'];

$z = $x + $y; // union, se fusionaran los indices solamente, es decir como x y y tiene indices 0 1 y 2 no se fusionaran y sera solo la array x
var_dump($z);

# == revisa si las keys y los valores son identicos
# === revisa si tienen keys, valores y tipo de valores identicos
# !== revisa lo contrario de ==
# <> es lo mismo que !==
# !=== revisa lo contrario de ===

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.9) Execution Operators (``)

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.10) Type Operators (instanceof)

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16.11) Nullsafe Operators PHP8 (?)

#----------------------------------------------------------------------------------------------------------------------------------------------
# 17) Operators Precedence & Associativity (Preferencia)

#Ejemplo en que la Multiplicación tiene preferencia ante la suma
$x = $a + $b * $c;
# tabla de preferencia: https://www.php.net/manual/es/language.operators.precedence.php

#----------------------------------------------------------------------------------------------------------------------------------------------
# 18) La Creación de las Bases de datos deben ser con esta nomenclatura

# 1 Siempre en Ingles

# 2 Los Nombres de las tablas en minusculas y en plural:
# categories
# products

# 3 Los campos de las tablas siempre en singular con (_sufijo)
# id_category
# name_category
# date_created_category

# 4 Si tenemos claves foraneas relacionadas con otras tablas deben añadirse asi: id_(nombre de la tabla relacionada)_(Nombre de la tabla actual)
# Por ejemplo de la tabla PRODUCTOS:
# id_category_product
# id_store_product
#----------------------------------------------------------------------------------------------------------------------------------------------
# 19) Añadir esto en los forms para subir imagenes al servidor

# enctype="multipart/form-data">
# <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
#----------------------------------------------------------------------------------------------------------------------------------------------
# 20) Comparaciónes


'1' == 1; // true son iguales

'1' === 1; // false porque compara el tipo de dato con los tres iguales

#----------------------------------------------------------------------------------------------------------------------------------------------
# 21) Control Structures (Condicionales) (if / else / elseif / else if)

# funciona tambien sin corchetes pero no es para nada recomendable
# En el caso del elseif se puede usar tambien else if separado, pero cuando lo usas en html funciona mejor el elseif junto
$condition = 1;
if ($condition == 2){ // true 
    // do
    echo "2";
}elseif($condition == 3){
    echo "3";
}else{
    echo "otro";
}

# Se puede adaptar a html de la siguiente forma para dejarlo mas limpio

if($condition == 2): ?>
    <strong>2</strong>
<?php elseif ($condition == 3): ?>
    <strong>3</strong>
<?php else: ?>
    <strong>otro</strong>
<?php endif ?>

<?php
#----------------------------------------------------------------------------------------------------------------------------------------------
# 22) declare(strict_types=1)

# tendria que estar definido al principio del codigo
//declare(strict_types=1); // esto sirve para hacer que los tipos de datos sean totalmente estrictos y dara error en este ejemplo
// este declare solo aplicara al archivo en si, si en otro archivo no esta declarado no le afectara
function sum(int $x, int $y){
    return $x + $y;
}

echo sum('4',10);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 23) Handling errors manejo de errores

error_reporting(0); // no mostrara ningun error
error_reporting(E_ALL); // Mostrara todos los errores

# Lista de control de errores:
# https://www.php.net/manual/en/errorfunc.constants.php
# https://www.php.net/manual/en/function.set-error-handler.php

# Para generar mensajes de errores tenemos esta funcion:
# Con esta funcion manual solo podemos llamar a estos handling errors: E_USER_ERROR E_USER_WARNING  E_USER_NOTICE E_USER_DEPRECATED 
trigger_error('error de ejemplo', E_USER_WARNING);
echo 1;

# Para crear un control de errores necesitamos una function Ejemplo:

function ErrorHandler(int $type, string $msn, ?string $file = null, ?int $line =null){
    echo $type. ': ' .$msn.' in '. $file. ' on line '. $line;
    exit;
}
echo $k;
# despues de crear la funcion la tenemos que settear como paso de control del erro_hendler
# es importante saber que esto remplazara el error_reporting actual por defecto que exista en ese momento
set_error_handler('ErrorHandler', E_ALL);

# en caso de volver a recuperar el handler tenemos esta function
//restore_error_handler();

echo $k;

#----------------------------------------------------------------------------------------------------------------------------------------------
# 24) Trabajar con directorios y ficheros
# Existe un sitema de directorios y como tener controlado todo esto en php

# scandir()
# Escanea el directorio donde estamos y almacena los ficheros nombres de ficheros en una array
$dir = scandir(__DIR__);

# Podemos revisar que es un fichero o un directorio
var_dump($dir);
var_dump(is_file($dir[4]));
var_dump(is_dir($dir[1]));

#Crear directorios con mkdir o eliminar con rmdir
mkdir('carpeta_nueva/dentro_nueva_carpeta',0777, true); // segundo parametro permisos y el tercero por si creamos directorios dentro de directorios
rmdir('carpeta_nueva/dentro_nueva_carpeta'); 

# Mirar si existe el fichero y da el tamaño del fichero
if(file_exists('foo.txt')){
    echo filesize('foo.txt');

    # En caso de existir vamos a meterle contenido al archivo
    file_put_contents('foo.txt','hello world'); // sobrescrive el archivo
    file_put_contents('foo.txt','hello world', FILE_APPEND); // podemos incluir un tercer parametro en este caso para añadir nueva información en vez de sobrescrivirla

    # Ahora vamos a trabajar con el archivo y vamos abrirlo
    # En caso de no encontrar el archivo fopen devuelve un false 
    # en caso de devolver el archivo devuelve un recurso que es un tipo de dato
    # Para que no de error se le añade el @ pero es recomendable usar el file_existes
    $file = @fopen('foo.txt', 'r'); // podemos abrir archivo con segundo parametro que son los permisos para leer escribir o para los 2

    # Assignamos a $line la linea del archivo  hasta que sea false
    while(($line = fgets($file)) !== false){ // fgets devuelve string o false
        echo $line . "\n";// imprimimos la linea
    }
    # tambien existe un get linea de csv fgetcsv()

    # Podemos obtener el contendio de esta manera tambien:
    $content = file_get_contents('foo.txt');
    echo $content;

    # finalmente siempre cerrar el archivo en el que se este trabajando
    fclose($file);



}else{
    echo 'el archivo no existe';
}

#Para eliminar ficheros podemos usar lo siguiente:
unlink('foo.txt');

# Podemos copiar el contenido de un fichero a otro fichero:
# Si no existe el segundo archivo lo creara con el contenido de foo
# Si existe con otro contenido lo sobrescribira con el de foo
copy('foo.txt','bar.txt');

#Para renombrar archivos podemos usar lo siguente con carpetas tambien funciona
rename('foo.txt','foo2.txt');

# Obtener información del archivo
var_dump(pathinfo('foo.txt'));

#----------------------------------------------------------------------------------------------------------------------------------------------
# 25) Limpiar cache de estado clearstatcache()
# Limpia la caché de estado de un archivo va bien al trabajar con archivos
clearstatcache();

?>