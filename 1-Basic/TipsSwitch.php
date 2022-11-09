<?php

# INDEX 
# 1) What is switch
# 2) Switch + foreach
# 3) Diferencia entre Switch y if else
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) What is switch
# Es similar a las condiciones if else pero para multiples condiciones

$paymentStatus = 'declined';

switch ($paymentStatus){
    case 'paid':
        echo 'paid';
        break;
    case 'declined':
    case 'rejected': // en caso de declined o rejected entrara en este caso
        echo 'declined';
        break;
    case 'pending':
        echo 'pending';
        break;
    
    default: // no es obligatorio
        echo 'Error Status';
}

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Switch + foreach

$paymentStatus = ['paid','declined','e'];

# Este switch se recorrera 3 veces y dara 3 estados, pero si en el break indicamos 2 salimos tambien del bucle
foreach ($paymentStatus as $status){
    switch ($status){
        case 'paid':
            echo 'paid';
            continue 2; // para que siga con el switch y el foreach un 2
        case 'declined':
        case 'rejected': // en caso de declined o rejected entrara en este caso
            echo 'declined';
            break 2; // Salimos del Swich y del foreach
        case 'pending':
            echo 'pending';
            break;
        
        default: // no es obligatorio
            echo 'Error Status';
    }
}

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Diferencia entre Switch y if else

# la principal diferencia es que el Switch ejecuta la condición una sola vez y el if elseif por cada condicion