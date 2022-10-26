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
