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
# 6) Fechas
# 7) Funciones Matematicas
# 8) Mas funciones Predefinidas
# 9) Include y require
# 10) Redireccionar Pagina web
# 11) Cifrar contraseña
# 12) Guardar string sin espacios
# 13) Recortar String caracteres
# 14) Concatenación de cadenas, comillas simples(') vs comillas dobles(")
# 15) Definicion de tus programas
# 16) Visivilidad Public Private y protected
# 17) La Creación de las Bases de datos deben ser con esta nomenclatura
# 18) Añadir esto en los forms para subir imagenes al servidor
# 19) Otra Manera de utilizar comillas dobles en php para una query
# 20) Comparaciónes
# 21) Operador @ en variables y funciones





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
# 6) Fechas

# Formato de fecha:
echo date('d-m-y') . "<br>";
echo date("d M, Y, g:i a"). "<br>";
echo date("Y-m-d H:i:s"). "<br>"; 
echo date('H:i:s'). "<br>";

# Time en integer
echo time();
 

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

include '<EjerciciosBasicos>/Ejercicio1.php'; // lo incluye siempre y las veces que quieras
include_once '<EjerciciosBasicos>/Ejercicio1.php'; // solo puede incluirse una vez
require '<EjerciciosBasicos>/Ejercicio1.php'; // es necesario para continuar

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
# 16) Visivilidad Public Private y protected

#- A los miembros de clase declarados como 'public' se puede acceder desde donde sea.
#- A los miembros declarados como 'protected', solo desde la misma clase, mediante clases heredadas o desde la clase padre.
#- A los miembros declarados como 'private' únicamente se puede acceder desde la clase que los definió.

class MyClass
{
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';

    function printHello()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

$obj = new MyClass();
echo $obj->public;    // Funciona bien
echo $obj->protected; // Error Fatal
echo $obj->private;   // Error Fatal
$obj->printHello();   // Muestra Public, Protected y Private

class MyClass2 extends MyClass
{
    // Se pueden redeclarar las propiedades pública y protegida, pero no la privada
    public $public = 'Public2';
    protected $protected = 'Protected2';

    function printHello()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

$obj2 = new MyClass2();
echo $obj2->public;    // Funciona bien
echo $obj2->protected; // Error Fatal
echo $obj2->private;   // Undefined
$obj2->printHello();   // Muestra Public2, Protected2, Undefined


#----------------------------------------------------------------------------------------------------------------------------------------------
# 17) La Creación de las Bases de datos deben ser con esta nomenclatura

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
# 18) Añadir esto en los forms para subir imagenes al servidor

# enctype="multipart/form-data">
# <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
#----------------------------------------------------------------------------------------------------------------------------------------------
# 19) Otra Manera de utilizar comillas dobles en php para una query
$query = <<<SQL
    SELECT *
    FROM `table`
    WHERE `column` = true;
    SQL;

#----------------------------------------------------------------------------------------------------------------------------------------------
# 20) Comparaciónes


'1' == 1; // true son iguales

'1' === 1; // false porque compara el tipo de dato con los tres iguales




#----------------------------------------------------------------------------------------------------------------------------------------------
# 21) Operador @ en variables y funciones

# El operador @ se puede añadir delante de una funciona para que esta en el momento de se utilizada no muestre los ERRORES ni WARNINGS que pueda causar PHP
# En Caso de PHP 8 o superior los ERRORES FATAL no son ignorados
#Ejemplo
@opendir('files/jpg');
$file = @file_get_contents('none/existing/path');


#----------------------------------------------------------------------------------------------------------------------------------------------

?>