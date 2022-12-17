<?php
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