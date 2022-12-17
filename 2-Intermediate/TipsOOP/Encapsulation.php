<?php

# INDEX 
# 1) Que es encapsulation(encapsulación) ?
# 2) 
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Que es encapsulation ?

// Se refiere a la capacidad de agrupar y condensar distintos elementos en un entorno con límites bien definidos. 
// ¿Cómo lo relaciono a la POO? De manera automática, primero generalizamos —abstracción— y luego establecemos los límites —encapsulación. 
// Sí, la encapsulación está ligada a la abstracción.

# En este Ejemplo si el tributo amount es public podriamos modificar el valor del atributo desde fuera llamando a la instancia $transaction->amount = 140 y podrimos modificar el valor como queramos.
# Esto significa que no tendria mucha seguridad esto lo podemos arreglar con el siguiente ejemplo Encapsulando el atributo y los metodos

# Una de las mejores practicas en la encapsulación son los Getters y los Setters

class Transaction 
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function process()
    {
        echo 'Prossecing $' . $this->amount . ' transaction';
        # Si tubieramos dentro de este metodo otros metodos:
        # Lo suyo seria que fueran privados perque sino los podrian llamar por separado fuera de la clase
        $this->genereteFactura();

        $this->sendEmail();

    }
    # Private o Protected 
    private function genereteFactura()
    {

    }

    private function sendEmail()
    {

    }

    # Si el atributo es privado podremos modificarlo desde fuera usando un set function y obtenerlo con un get function
    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }
}


$transaction = new Transaction(5.5);
echo $transaction->getAmount();
$transaction->setAmount(4.1);
$transaction->process();