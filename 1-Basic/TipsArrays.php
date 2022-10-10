<?php

# INDEX 
# 1) Arrays y como iterar
# 2) Arrays Multidimensionales
# 3) Funciones para Arrays
# 4) Iterar arrays sencillas
# 5) Iterar arrays asociativos



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Arrays y como iterar

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

#array completa
var_dump($peliculas);
var_dump($cantantes);

# sacar valores de un array
var_dump($peliculas[1]);
echo $peliculas[0];

# Añadir elementos a la Array 2 maneras
$peliculas[] = 'pokemon';
array_push($peliculas,'digimon');
var_dump($peliculas);

#Eliminar el ultimo registro
array_pop($peliculas);
var_dump($peliculas);

#Eliminar el indice que quieras
unset($peliculas[2]);
var_dump($peliculas);

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
