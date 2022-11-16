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
# 9) is_callable
# 10) Anonymus functions
# 11) (array_map) y callable data type and callback functions
# 12) Arrow Functions en php 7.4 para arriba



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
function foo5($num): mixed // Solo en php 8
{
  return $num;
}

# Lista de declaraciónes:

// Nombre de la Clase/Interfaz |	El valor debe ser una instancia de la clase o de la interfaz.	 
// self |	El valor debe ser una instanceof de la misma clase que aquella en la que se utiliza la declaración de tipo. Solamente se puede usar en clases.	 
// parent |	El valor debe ser una instanceof del padre de la clase en la que se usa la declaración de tipo. Solo se puede usar en clases.	 
// array |	El valor debe ser un array.	 
// callable |	El valor debe ser un callable válido. No puede ser usado como una declaración de tipo de propiedad de clase.	 
// bool |	El valor debe ser un valor booleano.	 
// float |	El valor debe ser un número de coma flotante.	 
// int |	El valor debe ser un número entero.	 
// string |	El valor debe ser un string.	 
// iterable |	El valor debe ser un array o una instanceof de la clase Traversable.	PHP 7.1.0
// object |	El valor debe ser un objeto.	PHP 7.2.0
// mixed	| El valor puede ser cualquier valor.	PHP 8.0.0

#----------------------------------------------------------------------------------------------------------------------------------------------
# 9) is_callable

# si tienes una variable con el nombre de una funcion y la utilizas para hacer una llamada php la detecta como funcion.
#podemos usar la function is_calleble para averiguar si esa funcion existe

$funcion_name = 'foo5';

if (is_callable($funcion_name)){
  echo $funcion_name(3);
}else{
  echo 'Not callable';
}
# funciona muy bien para verificar siempre si esa función esta al alcance de ser llamada o no existe
var_dump(is_callable(foo5(3)));
#----------------------------------------------------------------------------------------------------------------------------------------------
# 10) Anonymus functions

# Son funciones sin nombre que para que funcionen correctamente tienen que terminar con ; 
# ejemplo: f{};
# Para poder llamar a esta funcion tenemos que asignar la funcion a una variable
# Las funciones anonimas tienen una funcionalidad unica que permite a la funcion poder acceder a variables externas usando use
#ejemplo:
$x = 1;
$num = function ($num ) use($x) // Solo en php 7.4 y 8 para arriba
{
  echo $x . "\n"; // ya no da error e incluso se puede usar el valor de la x externo a la funcion
  return $num;
};

echo $num(5);
#----------------------------------------------------------------------------------------------------------------------------------------------
# 11) (array_map) y callable data type and callback functions

# a Callable data type es un tipo de dato que es una function callable que estas pasando una funcion que se puede llamar
# Existen varias maneras de pasar una callback function como argumento
# existe array_map que es una funcion que se encarga de usar una callable que es una function ejecutable la cual puede recorrer el array que le pasamos
$array = [1,2,3,4];

$array_result = array_map(function($element){
  echo $element;
  return $element * 2; # element es cada valor que esta dentro del $array
}, $array);

print_r($array_result);

#El ejemplo de arriba tambien se puede externalizar de la siguiente manera:

$x = function($element){
  return $element *2;
};

$array_result = array_map($x,$array);
print_r($array_result);

#Ultimo ejemplo es usar una funcion nombrada

function multi($element){
  return $element *2;
};

$array_result = array_map('multi',$array);
print_r($array_result);

# Ejemplo usando callable data type en una funccion de parametro

function multi2($element){
  return $element *2;
};

$sum = function (callable $callback, int ...$numeros): int{
  return $callback(array_sum($numeros));
};

echo $sum('multi2',1,2,3,4); // 2 + 4 + 6 + 8 = 20

# La diferencia entre Callable function y Closure function es que las funciones clousure solo pueden ser anonimas
#----------------------------------------------------------------------------------------------------------------------------------------------
# 12) Arrow Functions en php 7.4 para arriba

# Es una versión limpia de una funcion anonimo
#Ejemplo la funcion arrow es fn
$array = [1,2,3,4];

$array_result = array_map(fn($element) => $element * 2, $array);

print_r($array_result);







#----------------------------------------------------------------------------------------------------------------------------------------------
