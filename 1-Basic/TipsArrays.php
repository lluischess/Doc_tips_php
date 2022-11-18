<?php

# INDEX 
# 1) Arrays 
# 1.1) Como obtener la logitut de la array
# 1.2) Como iterar
# 1.3) Casting arrays
# 2) Arrays Multidimensionales
# 3) Funciones para Arrays
# 4) Iterar arrays sencillas
# 5) Iterar arrays asociativos
# 6) Separar array en diferentes arrays dentro de la misma array
# 7) Array_combine()
# 8) array_filter()
# 9) Reindexar array_values
# 10) Podemos ver los Keys de un array con array_keys()
# 11) Array_map ejecuta una funcion a los valores de un array o dos
# 12) array_merge() es para unificar arrays
# 13) Array_reduce para obtener un unico valor con callable
# 14) Array_search() and in_array()
# 15) Array_diff encontrar la diferencia entre arrays
# 16) Ordenar arrays asort() and ksort()
# 17) array distruction 

#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Arrays

$pelicula = "spiderman";
# Definir un array 2 formas:
$peliculas = array('batman',$pelicula,'batman2');
$cantantes = ['Justin','selena','lady gaga'];
$arrayvacia = [];

#Array asociativo
$personas = array(
  'nombre' => 'luis',
  'apellido' => 'casamajor',
  'edad'  => '27'
);
# Tener en cuenta que si 2 definiciones(key) son iguales la key se quedara en 1 y el ultimo valor del array
# Ejemplo
$array1 = [0 => '0', 1 => '1', '1' => '2'];
print_r($array1);
# Output
// Array
// (
//     [0] => 0
//     [1] => 2
// )

# Tener en cuenta que de los arrays asociativos si las definiciones(key) que el array hace casting de las keys y si todas las keys dan 1 pues aparece el ejemplo siguiente
# porque combierte la key en entero y el true en int es 1 tl '1' es 1 y el float es 1
# Ejemplo
$array2 = [true => 'a', 1 => 'b', '1' => 'c', 1.8 => 'd'];
print_r($array2);
# Output
// Array
// (
//     [1] => d
// )

# otra cosa a tener en cuenta esque pueden haber keys con null 
$array3 = [null => 'hola'];
print_r($array3);
# Output
// Array
// (
//     [] => hola
// )

# Otra cosa importantissima es que el array automaticamente define las keys si no tienen key y puede pasar lo siguiente:
$array4 = ['a', 'b', 40 => 'c', 'd', 'e'];
print_r($array4);
// Array
// (
//     [0] => a
//     [1] => b
//     [40] => c
//     [41] => d
//     [42] => e
// )

#array completa
var_dump($peliculas);
var_dump($cantantes);

# sacar valores de un array
# Punto importante: si accedemos a una key que no existe dara error
var_dump($peliculas[1]);
echo $peliculas[0];
# Podemos comprobar que existe la key y es null
var_dump(isset($peliculas[3])); // False
# Otra manera es la siguiente funcion Parametro1 = key Paremetro2 = array
var_dump(array_key_exists('email', $personas));
# La diferencia entre las 2 es que si existe la key y tiene null el isset sera false y la array_key_exists sera true

# Print array usando var_dump o print_r
var_dump($peliculas);
print_r($peliculas); // printa un array normal
echo print_r($personas, true); // Cuando el return parámetro es true, esta función devolverá una cadena . De lo contrario, el valor devuelto es true booleano.

# Para mejorar la legivilidad de la array en web
echo '<pre>';
print_r($peliculas);
echo '</pre>';

# Añadir elementos a la Array 2 maneras siempre al final de la array
$peliculas[] = 'pokemon';
array_push($peliculas,'digimon');
var_dump($peliculas);
#Se puede hacer un push a un array asociativo mediante nueva key
$personas['email'] = 'joseluis@gmail.com';
echo print_r($personas, true);

#Eliminar el ultimo registro
array_pop($peliculas);
var_dump($peliculas);

#Eliminar el primer registro, Cuidado que la fuuncion hace re-index vualve a numerarlos
# El re-index solo afecta a los numericos
array_shift($peliculas);
var_dump($peliculas);

#Eliminar el indice que quieras, si no le especificamos la key o index eliminara la variable completa
# cuidado que los indices se mantienen
unset($peliculas[2]);
# Eliminar multiples indices
unset($peliculas[1], $peliculas[2]);
var_dump($peliculas);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 1.1) Como obtener la logitut de la array

# Devuelve el numero de elementos de la array
echo count($peliculas); 

#----------------------------------------------------------------------------------------------------------------------------------------------
# 1.2) Como iterar
# Recorrer un array sencilla 2 maneras:
for ($i=0; $i < count($peliculas); $i++) { 
  echo "<li>" . $peliculas[$i] . "</li>";
}

foreach ($cantantes as $cantante) {
  echo "<li>" . $cantante . "</li>";
}

foreach ($personas as $persona) {
  echo "<li>" . $persona . "</li>";
}

#----------------------------------------------------------------------------------------------------------------------------------------------
# 1.3) Casting arrays

$x = 5;
$z = true;
$y = 1.2;

var_dump((array) $x);
var_dump((array) $y);
var_dump((array) $z);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Arrays Multidimensionales

$contactos = array(
    array(
      'nombre' => 'luis',
      'email' => 'casamajor@email.com',
    ),
    array(
      'nombre' => 'loco',
      'email' => 'casamajor@email.com',
    ),
    array(
      'nombre' => 'luis',
      'email' => 'casamajor@email.com',
    )
  );
  
  var_dump($contactos);
  
  # imprimir un json de una array multidimensional
  echo json_encode($contactos);
  # acceder a un contacto de un array multidemensional
  echo $contactos[1]['nombre'];
  
  # Recorrer un array multidimensional:
  foreach ($contactos as $key => $contacto){ 
    echo "<br>" . $contacto['nombre'];
    echo "<br>" . $contacto['email'];
  
  }

  for ($lineas = 0; $lineas < count($contactos); $lineas++ ){
    echo "<p><b>Row $lineas</b></p>";
    echo "<ul>";
    foreach ($contactos[$lineas] as $key => $value){
        echo "<li>".$key.":   ".$value."</li>";
    }
    echo "</ul>";
  }


  $espanya = ['€' => 'desc_ES'];
  $paises = [
    'espanya' => $espanya, 
    'usa' => "dollar", 
    'brasil' => "R$", 
    'canada' => "C$", 
    'colombia' => "COP", 
    'hongkong' => "HK$", 
    'hungria' => "HUF", 
    'rusia' => "R$", 
    'singapur' => "S$", 
    'sudafrica' => "ZAR", 
    'mexico' => "MXN", 
    'argentina' => "ARS"];

  foreach ($paises as $nombre => $valor) {
    if (is_array($valor)){
      foreach ($valor as $moneda => $desc) {
          print "el pais es $nombre, la moneda $moneda y descr $desc.<br />\n";
      }
    }else {
      echo $nombre ." ". $valor. '<br>\n';
    }
 }
  
#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Funciones para Arrays
$cantantes = ['Justin','selena','lady gaga'];
$num = [4,3,2,1];

# Orden alfabetico A - Z
asort($cantantes);
var_dump($cantantes);

# Orden alfabetico inverso Z - A
arsort($cantantes);
var_dump($cantantes);

# Orden numerico 1 - max
sort($num);
var_dump($num);

# Sacr un elemento aleatorio de un array
echo array_rand($cantantes);

# Revertir el Array dar la vuelta
var_dump(array_reverse($peliculas));

# Buscar dentro de un array
echo array_search('selena',$cantantes);

# Longitut de un array
echo count($num);


#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) Iterar arrays sencillas

$frutas = array('Pera','Melocoton','Fresas','Manzanas');
$length = count($frutas);

for ($x = 0; $x < $length; $x++){
    echo $frutas[$x];
    echo '<br>';
}

foreach( $frutas as $key ){
  echo $key."\n";
}


#----------------------------------------------------------------------------------------------------------------------------------------------
# 5) Iterar arrays asociativos

$array = array(
  "1" => "PHP code tester",
  "emojis" => "😀 😃 😄 😁 😆",
  5,
  5 => 53456,
  "Random number" => rand(100,200),
  "PHP version" => phpversion()
);

# \t=>\t de tabulador a tabulador
# $key es el indice
# $value es el valor
foreach ($array as $key => $value){
  echo $key . "\t=>\t" . $value . "\n";
}



#----------------------------------------------------------------------------------------------------------------------------------------------
# 6) Separar array en diferentes arrays dentro de la misma array
# Con array_chunk

$items = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];

# primer argumento es la array
# segundo argumento los items que deseas por array
# si quieres mantener las keys de indices
$items_separados = array_chunk($items, 2, true);

print_r($items_separados);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 7) Array_combine()

# lo que hace es que le pasamos 2 arrays el primer array son los indices del array combinado
# y el segundo array los valores, tienen que coincidir en el numero de incides y valores si no petara

$array1 =['a', 'b', 'c'];
$array2 = [1,2,3];

print_r(array_combine($array1,$array2));

#----------------------------------------------------------------------------------------------------------------------------------------------
# 8) array_filter()

# por ejemplo podemos filtrar los divisibles entre 2
# devuelve true or false y los resultados

# Primero le pasamos la array donde buscaremos
# el segundo es una funcion callable
# En este ejemplo esta filtrando el $elemento como el valor de cada elemento
$array = ['a' => 1,'b' => 2,'c' => 3, 'd' => 4];
$result = array_filter($array, fn($elemento)=> $elemento % 2 == 0);
print_r($result);

# Pero tambien podemos filtrar por KEY usando lo sigueinte:
$array = [1,2,3,4,5,6,7,8,9];
$result = array_filter($array, fn($elemento)=> $elemento % 2 == 0,ARRAY_FILTER_USE_KEY);
print_r($result);

# O los dos Valor y KEY
$array = [1,2,3,4,5,6,7,8,9];
$result = array_filter($array, fn($elemento, $key)=> $elemento % 2 == 0,ARRAY_FILTER_USE_BOTH);
print_r($result);
#----------------------------------------------------------------------------------------------------------------------------------------------
# 9) Reindexar array_values

#Reindexamos el ejemplo anterior
#vualve a contar desde 0 los indices KEY
print_r(array_values($result));

#----------------------------------------------------------------------------------------------------------------------------------------------
# 10) Podemos ver los Keys de un array con array_keys()

# lo que hace es devolverte una array con todos los keys como valores del array que querias
$array = ['a' => 1,'b' => 2,'c' => 3, 'd' => 4];
print_r(array_keys($array)); // tiene un segundo parametro para filtrar por el valor
# Tener en cuenta que en el segundo parametro si buscamos por valores de mas de 2 numeros no funciona
#----------------------------------------------------------------------------------------------------------------------------------------------
# 11) Array_map ejecuta una funcion a los valores de un array o dos

$array1 = ['a' => 1,'b' => 2,'c' => 3, 'd' => 4];
$array2 = ['a' => 1,'b' => 2,'c' => 3, 'd' => 4];

$array_result = array_map(fn($num1, $num2)=> $num1 + $num2,$array1,$array2);
# Nota important
# si solo pasamos 1 array y es asociativo las Keys se mantendran
# pero si pasamos 2 arrays se perderan y se reindexara
print_r($array_result);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 12) array_merge() es para unificar arrays
$array1 = [1,2,3];
$array2 = [1,2,3];
$array3 = [1,2,3];

print_r(array_merge($array1,$array2,$array3));

# En caso de ser asociativos cuidado que no se repitan las KEYS ya que se quedaran con el ultimo valor de la ultima KEY

$array1 = ['a' => 1,'b' => 2,'c' => 3, 'd' => 4];
$array2 = ['a' => 1,'r' => 2,'c' => 3, 'd' => 4];
print_r(array_merge($array1,$array2));

#----------------------------------------------------------------------------------------------------------------------------------------------
# 13) Array_reduce para obtener un unico valor con callable
function suma($carry, $item)
{
    $carry += $item;
    return $carry;
}

$a = array(1, 2, 3, 4, 5);
var_dump(array_reduce($a, "suma")); // int(15)
// sumaria todos los valores
#----------------------------------------------------------------------------------------------------------------------------------------------
# 14) Array_search() and in_array()

# Sirve para obtener la KEY del valor que le pasas
$array = ['a','b','c','d','e','f','g','ha'];

$key = array_search('b',$array);

echo $key; // el indice del valor de b

# Para verificar que la hemos encontrado siempre triple comparación ===
if($key === false){
  echo "letra no encontrada";
}

# o hacerlo con in_array()

if (!in_array('l',$array)){
  echo "\nletra no encontrada 2";
}
#----------------------------------------------------------------------------------------------------------------------------------------------
# 15) Array_diff encontrar la diferencia entre arrays
$array1 = ['a' => 1,'b' => 2,'o' => 3, 'd' => 4];
$array2 = ['a' => 1,'b' => 8,'o' => 3, 'm' => 4];
$array3 = ['a' => 1,'b' => 7,'o' => 3, 'n' => 6];

# busca si en la primera array hay valores distintos en otras arrays
print_r(array_diff($array1,$array2,$array3)); // el 
//[b] => 2

# Si queremos mirar con un array asociativo seria lo siguiente:
print_r(array_diff_assoc($array1,$array2,$array3));
// estas serian los indices que no estan en otras arrays
// [b] => 2
// [d] => 4

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16) Ordenar arrays asort() and ksort()
$array1 = ['a' => 1,'b' => 8,'o' => 3, 'm' => 4];
# Ordena los valores de menor a mayor
print_r($array1);

asort($array1);

print_r($array1);

# tambien podemos ordenar por key

ksort($array1);

print_r($array1);


#----------------------------------------------------------------------------------------------------------------------------------------------
# 17) array distruction 

# El siguiente ejemplo es una manera de destruir un array asignando valores a variables

$array = [1,2,3,4];

[$a,$b,$c,$d] = $array;

echo $a . ' ' . $b . ' ' . $c . ' '. $d;

# Tambien podemos hacerlo asignando keys
$array = [1,2,3,4];

[1 => $a, 0 => $b,2 => $c,3 => $d] = $array;

echo $a . ' ' . $b . ' ' . $c . ' '. $d;
