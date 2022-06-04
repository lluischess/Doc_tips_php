<?php

# INDEX 
# 1) Typed Properties(Variables con tipos de dato unicos)
# 2) Arrow Functions
# 3) Null Operator
# 4) Spread operator



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Typed Properties(Variables con tipos de dato unicos)

# Se le puede añadir el tipo de variable que es, es de tipo coche y ya no se podra modificar el tipo de variable
# Solo están disponibles en clases y requieren un modificador de acceso: public, protectedo private; ovar
# Todos los tipos están permitidos, excepto voidycallable

# private Coche $coche;

# ? delante para decir que puede ser null
# private ?Coche $coche;

class Foo
{
    # Variable publica que es un int
    public int $a;

    # Variable publica que es un string pero puede ser null
    public ?string $b = 'foo';

    # La variable $prop es de tipo Foo objeto y privada
    private Foo $prop;

    # La variable $static es protegida y statica y un string
    protected static string $static = 'default';
}

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Arrow Functions

# Las funciones de flecha fueron introducidas en PHP 7.4 como una sintaxis más concisa para las funciones anónimas.

# Ejemplo 1
$y = 1;

$fn1 = fn($x) => $x + $y;
// equivalent to using $y by value:
$fn2 = function ($x) use ($y) {
    return $x + $y;
};

var_export($fn1(3));

# Ejemplo 2
class coche {

}

function arrowfunctions() {

    $coches = [
        new coche('rojo'),
        new coche('verde'),
        new coche('marron')
    ];

    $colorafiltrar = 'rojo';

    # Antes
    $cochesRojos = array_filter($coches, function (coche $coche) use($colorafiltrar): bool{
        return $coche->color == $colorafiltrar;
    });

    # 7.4 solo se puede usar una expresión
    $cochesRojos = array_filter($coches, fn(coche $coche): bool => $coche->color == $colorafiltrar);

   // $this->assertCount(2,$cochesRojos);
}


#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Null Operator

$request = [
    'nombre' => 'alejandro',
    'edad' => 33,
    'cat' => null
];


# Antes
# Si existe la categoria sera igual a la categoria pero si no sera 'categoria por defecto'
$request['cat'] = $request['cat'] ? $request['cat'] : 'categoria por defecto';

# Esto es lo mismo que lo de arriba
$request['cat'] = $request['cat'] ?? 'categoria por defecto';

# 7.4 Esto es lo mismo que lo de arriba
$request['cat'] ??='categoria por defecto';


#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) Spread operator

$frutas = ['peras'];
$mas = ['platanos','manzanas'];

# Antes Furión de dos Arrays
$todas = array_merge($frutas,$mas);

# 7.4 Fusion de 2 arrays
$todas = [...$frutas,...$mas];

# RESULTADO:
/*
Array
(
    [0] => peras
    [1] => platanos
    [2] => manzanas
)
*/

#----------------------------------------------------------------------------------------------------------------------------------------------
