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
    echo $a++;
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

#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) foreach

#----------------------------------------------------------------------------------------------------------------------------------------------
