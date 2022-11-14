<?php

# INDEX 
# 1) Function con paramaetros opcionales
# 2) La mejor Practica con funciones es el return
# 3) Funciones guardadas en variables
# 4) type jggling en function
# 5) Información de parametros y retornos
# 5.1) Parametros de funcion explicados
# 6) Se puede llamar una funcion dentro de otra
# 7) si tenemos : void en una funcion puede ser que retorne null
# 8) Podemos indicar que puede devolver la funcion


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
# 5) Información de parametros y retornos
# como informarnos de lo que devuelve una funcion y que tipos de parametros tiene
class Offer
{
public string $offerNumber;
//public Money $totalPrice;
}

# El primer metodo es describir-lo en el docblock anterior para informarte de que debuelve la funcion
/**
* @param \App\Offer $offer
* @param bool $sendMail
*
* @return \App\Offer
*/
function createOffer(Offer $offer, $sendMail)
{
  // ...
}

# Esto podria transformarse en lo recomendado como es lo siguiente:
# Es recomendado a partir de PHP 8

  // function createOffer(Offer $offer, bool $sendMail): Offer // = RETURN de la class
  // {

  // }



#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.1) Parametros de funcion explicados

# Si no especificamos el tipo de dato de los parametros sera pordefecto mixed: acepta todo tipo de datos
# es recomendable intentar definir los tipos de datos de los parametros para controlar mas el return
# (int $x, int $y)

# Podemos asignar un valor pordefeto a un parametro en caso de no darle valor al llamarlo
# el parametro opcional debe estar siempre al final de todo
# (int $x, int $y = 10)

function test(int $x, int $y = 10): int{
    return $x*$y;
}

echo test(6,2);

# Podemos crear un parametro con multiples numeros dentro de un array que se van guardado todos los parametros dentro de ese array
# en caso de añadir otros parametros deberian ir antes de este (int $x, int y, int ...$nums)
#ejemplo
function test2(...$nums): int{
  $sum = 0;

  foreach($nums as $num){
    $sum += $num;
  }
  return $sum;
  # Podriamos omitir toda la iteración que suma por array_sum($nums)
}
echo test2(6,2,2,2,2,2);

# tambien es posible pasar un array con los 3 puntos pero en el puesto del parametro
# Ejemplo:
$array = [1,2,3,4,5,6,7,8];
echo test2(...$array);




#----------------------------------------------------------------------------------------------------------------------------------------------
# 6) Se puede llamar una funcion dentro de otra
# Pero no es para nada recomendable esto

# Podemos llamar a foo y luego a bar pero ordenadamente primero foo y luego la que esta dentro 
# porque si llamamos directamente a bar no funcionara
foo();
bar();
function foo(){
  echo 'foo';
  function bar(){
    echo 'bar';
  }
}


#----------------------------------------------------------------------------------------------------------------------------------------------
# 7) si tenemos : void en una funcion puede ser que retorne null
# ya que acepta que retorne un null
function foo2(): void{
  echo 'foo';
}

// pero no funcionara si en el return le asignamos un null FATAL ERROR
#----------------------------------------------------------------------------------------------------------------------------------------------
# 8) Podemos indicar que puede devolver la funcion

function foo3(): ?int // podemos añadir int string etc 
{// pero tambien poner el ? que quiere decir que aceptaria un null como respuesta

  return null;
}

# tambien podemos indicar multiples salidas de la funcion ejemplo
//function foo4(): string|int{ // PHP 8

//  return 'foo';
//}

# o mas facil poner el mixed que acepta multiples tipos de datos
function foo5(): mixed // PHP 7.4 y 8
{
  return 'foo';
}
