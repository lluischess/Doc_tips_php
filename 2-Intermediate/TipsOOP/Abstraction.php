<?php

# INDEX 
# 1) Que es Abstraction ?
# 2) Ejemplo de clase Abstracta
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Que es Abstraction ?

// Las clases abstractas en PHP son clases que no se pueden instanciar y se definen con la palabra reservada abstract, 
# Solo pueden ser extendidas por otra clase
// la clase abstracta implementa métodos parcialmente con el objetivo que las clases que lo heredan terminen de implementar la funcionalidad.
// la abstracción va un poco de la mano de la encapsulación
// los metodos publicos y atributos publicos rompen la abstracción

# UTILIZAMOS las clases abstractas o metodos cuendo queremos que los hijos class implementen eso por ellos y no por la base del padre

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
#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Ejemplo de clase Abstracta
echo phpversion(); // solo funciona en php 8

# Los metodos abstractos no pueden ser privados ya que no tendrian acceso los hijos


# como sabemos que ni el field class ni el boolean van a hacer nada podemos usarlas como clases abstractas y que se ocupen sus propios hijos
abstract class Field
{
    public function __construct( protected string $name) // PHP 8 : protected string $name
    {
        
    }

    abstract public function render(): string; //asi este metodo lo aran los hijos y es obligado
}

class Text extends Field
{
    public render(): string // si estamos sobrescribiendo un metodo abstracto podemos añadir parametros pero declarados x = 1 ejemplo
    {
        return <<<HTML 
        <input type="text" name="{$this->name}" />
        HTML;
    }
}

abstract class Boolean extends Field
{
   
}

class Checkbox extends Boolean
{
    public render(): string 
    {
        return <<<HTML 
        <input type="checkbox" name="{$this->name}" />
        HTML;
    }
}

class Radio extends Boolean
{
    public render(): string 
    {
        return <<<HTML 
        <input type="radio" name="{$this->name}" />
        HTML;
    }
}


$fields = [
    //new Field('baseField'), // como es una clase abstracta no podra instanciarse
    new Text('textField'),
    //new Boolean('booleanField'), // clase abstracta
    new Checkbox('checkboxField'),
    new Radio('radioField'),
];

foreach($fields as $field){
    echo $field->render() . '<br>';
}