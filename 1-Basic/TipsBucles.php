<?php

# INDEX 
# 1) while
# 2) do-while
# 3) for
# 4) foreach


#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) while

$i = 0;

while($i <= 10){
    echo $i++;
}

# Se puede romper el loop con break a distintos niveles tanto sea 1 while como 2
# Ejemplo
while(true){
    while($i <= 20){
        break; // este break solo saldria del bucle interno
        break 2; // esto saldria de los 2 bucles
    }
    echo $i++;
}

# Sintaxis HTML

while($i <= 10):
    echo $i++;
endwhile;

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) do-while
# el do-while es lo mismo que el while pero antes de la condición ejecutara el codigo
$a = 0;
do {
    echo $a++ . "\n";
} while ($a <= 10);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) for

# La condición for se separa en 3 partas 
# 1- la primera evaluación solo se ejecuta 1 vez $i = 0
# 2- la segunda es la condición de entrada que se evalua en cada iteración
# 3- la tercera es evaluada al final de cada iteración

for ($i = 0; $i < 5; ++$i) {
    if ($i == 2){
        continue; // hace que pase a la siguiente iteracion saltandose el codigo que hay a continuación
    }
    print "$i\n";
}

# Sintaxis HTML

for ($i = 0; $i < 5; ++$i):
    echo $i;
endfor;

# se pueden añadir mas codigo separado por comas
# si añadimos a la condición $i > 5 mas cosas la condición se va a leer de izquierda a derecha
for ($i = 0; print $i, $i < 5; print $i, ++$i){ // solo funciona el print el echo no
# print $i, $i < 5 se imprimira el 5 porque la condición de menor esta en la derecha
}

# Ejemplo de trabajar con array en for

$array = ['a','b','c','d'];
for ($i = 0, $lenght = count($array); $i < $lenght; $i++){
    echo $i;
    echo $array[$i] . "\n";
}

#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) foreach
# Only for arrays and objects
$programlanguages = ['php','js','python','java'];

foreach($programlanguages as $key => $lengueges){
    echo $key ."-" . $lengueges . "\n";
}

# es curioso que la variable del loop foreach $lenguages no es destruida despues del loop y se queda con el valor de la ultima iteración
echo $lengueges;
# asi que esta bien destruir la variable para que luego no moleste con unset
unset($lenguages);
echo $lenguages;

# tips para recorrer arrays asociativos con foreach

$user = [
    'name' => 'locol',
    'email' => 'locol@gmail.com',
    'skills' => ['php', 'graphql', 'react'],
];

foreach($user as $key => $value){
    //echo $key . ": ". $value . "\n"; // cuando llege a skills dara un error de conversión ya que es un array
    # Solución 1:
    //echo $key . ": ". json_encode($value) . "\n";
    # Solución 2:
    # Revisar que es un array si usas implode
    if (is_array($value)){
        $value = implode(',', $value);
    }
    echo $key . ": ". $value . "\n";
}

#Otra forma mas limpia de imprimir asociativos

$user = [
    'name' => 'locol',
    'email' => 'locol@gmail.com',
    'skills' => ['php', 'graphql', 'react'],
];

foreach($user as $key => $value){

    echo $key . ": ";

    if (is_array($value)){
        foreach($value as $skills){
            echo $skills . " - ";
        }
    }else{
        echo $value;
    }
    echo "\n";
}

#----------------------------------------------------------------------------------------------------------------------------------------------
