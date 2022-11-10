<?php

# INDEX 
# 1) Comprovar nulos nulsafeoperator
# 2) Obtener el full name class
# 3) obtener null de dos formas
# 4) Lanzar excepciones nuevas
# 5) Match expresions es como un Switch
# 6) classes y propiedades
# 7) Excepciones mejoradas
# 8) Comparaciones mejoradas



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Comprovar nulos nulsafeoperator

$firstcategori = null;

# Antes
if (null !== $course) {
    if (null !== $course->categorias()){
        if (null !== $course->categorias()->first()){
            $firstcategori = $course->categorias()->first()->name();
        }
    }
}

# 8.0
# $firstcategori = $course?->categorias()?->first()?->name();

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Obtener el full name class
# PHP 5.5
var_dump(Course::class);

# PHP 8.0 podemos añadir una variable que asigne la clase
$className = $course::class;


#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) obtener null de dos formas
# Algo o null ?$dato

#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) Lanzar excepciones nuevas

# Antes

if (null !== $user){
    echo $user;
}else {
    throw new Exception();
}

# 8.0 no hace falta asignar una variable a la excepcion

# echo $user ?? throw new Exception();

try {
    // Something goes wrong
    } catch (Exception) {
    // Just continue
    }

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5) Match expresions es como un Switch
$errorCode = 504;

// $errorMessage = match ($errorCode){
//     404 => 'user not found',
//     407 => 'User not verified',
//     default => 'Internal server error',
// };

var_dump($errorMessage);

#Otro Ejemplo

$paymentStatus = 1;

match($paymentStatus){
    1 > 2 => print 'Paid',
    2 => print 'Declined',
    3,4 => print 'Pending', // este sirve tanto para 3 y para 4
    default => 'Error', // en match es mejor poner default ya que si no existe el valor dara error
};


#----------------------------------------------------------------------------------------------------------------------------------------------
# 6) classes y propiedades

# Antes

class Persona {
    public $nom;
    public $email;
    public $edad;

    public function __construct(
        $nom,
        $email,
        $edad
    )
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->edad = $edad;
    }
}


# 8.0

// class Persona2 {

//     public function __construct()
//     {
//         $nom,
//         $email,
//         $edad

//     }{}
// }
#----------------------------------------------------------------------------------------------------------------------------------------------
# 7) Excepciones mejoradas

// Invalid before PHP 8
#$name = $input['name'] ?? throw new NameNotFound();
// Valid as of PHP 8
$name = $input['name'] ?? throw new NameNotFound();

$error = fn (string $class) => throw new $class();

#----------------------------------------------------------------------------------------------------------------------------------------------
# 8) Comparaciones mejoradas


'foo' == 1; // true PHP 7.4 e inferior
'foo' == 1; // false PHP 8 superior asi que mejora el comportamiento de las comparaciones

#----------------------------------------------------------------------------------------------------------------------------------------------

