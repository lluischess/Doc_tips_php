<?php

# INDEX 
# 1) Arrays y como iterar
# 2) Arrays Multidimensionales
# 3) Funciones para Arrays
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Arrays y como iterar

$pelicula = "spiderman";

# Definir un array 2 formas:
$peliculas = array('batman',$pelicula,'batman2');
$cantantes = ['Justin','selena','lady gaga'];

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
