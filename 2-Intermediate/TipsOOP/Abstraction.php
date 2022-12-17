<?php

# INDEX 
# 1) Que es Abstraction ?
# 2) 
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Que es Abstraction ?

// Las clases abstractas en PHP son clases que no se pueden instanciar y se definen con la palabra reservada abstract, 
// la clase abstracta implementa métodos parcialmente con el objetivo que las clases que lo heredan terminen de implementar la funcionalidad.
// la abstracción va un poco de la mano de la encapsulación
// los metodos publicos y atributos publicos rompen la abstracción
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
        $this->genereteFactura();
        $this->sendEmail();

    }

    private function genereteFactura()
    {

    }

    private function sendEmail()
    {

    }

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
$transaction->process();