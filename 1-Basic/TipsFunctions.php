<?php

# INDEX 
# 1) Function con paramaetros opcionales
# 2) La mejor Practica con funciones es el return
# 3) Funciones guardadas en variables
# 4) type jggling en function
# 5) 2 Informativos de Retornos de funciones



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Function con paramaetros opcionales

# El tercer parametro es opcional ya que predeterminadamente sera false
# Ejemplo:
function sumar($numero1, $numero2, $numero3 = false){ 
    if ( $numero3 == false ) { 
        $resul = "<h1>" . ($numero1 + $numero2) . "</h1>";
    }else{
        $resul = "<h1>" . ($numero1 + $numero2 + $numero3) . "</h1>";
    }
    return $resul;
}

$resultado = sumar(2, 3);
$resultado = sumar(3, 3, 4);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) La mejor Practica con funciones es el return

# Es primordial que una función retorne siempre un valor ya que es una funcionalidad
# Ejemplo:
function sumar2($numero1, $numero2, $numero3 = false){ 
    if ( $numero3 == false ) { 
          $resul = "<h1>" . ($numero1 + $numero2) . "</h1>";
      }else{
          $resul = "<h1>" . ($numero1 + $numero2 + $numero3) . "</h1>";
      }
      return $resul;
  }
  
  sumar(2, 3);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Funciones guardadas en variables
# Se puede guardar una función en una variable
function buenosdias(){ 
    return "Hola buenos dias";
  }
  
  function buenasnoches(){ 
    return "Buenas noches";
  }
  # Guardamos el nombre de la funcion en una variable y luego la llamamos con la misma variable
  $funcion_saludos = "buenasnoches";
  
  echo $funcion_saludos();
  
#----------------------------------------------------------------------------------------------------------------------------------------------
  # 4) type jggling en function

  function sum(int $x, int $y){
    return $x + $y;
  }
  # Aun pasandole un string lo intenta convertir en integer para sumarlos
  # tambien le pasamos un float y lo convierte en un int
  $sum = sum(2.5, '3');
  var_dump($sum);
  # output = 5

  # Podemos definir que los tipos sean estrictos y no los modifique
  # declare(strict_types=1); // declarar en la primera linea

  # entonces la funcion dara error de conversion de typos

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5) 2 Informativos de Retornos de funciones

# El primer metodo es describir-lo en el docblock anterior para informarte de que debuelve la funcion
/**
* @param \App\Offer $offer
* @param bool $sendMail
*
* @return \App\Offer
*/
// function createOffer(Offer $offer, $sendMail)
// {
//   // ...
// }

# Esto podria transformarse en lo recomendado como es lo siguiente:

  // function createOffer(Offer $offer, bool $sendMail): Offer
  // {

  // }



#----------------------------------------------------------------------------------------------------------------------------------------------
