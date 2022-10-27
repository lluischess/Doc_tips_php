<?php

# INDEX 
# 1) Añadir tipos a las variables de clases
# 2) Tratar propiedades de objetos antes de nada
# 3) Visivilidad Public Private y protected
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Añadir tipos a las variables de clases

# A partir de PHP 7.4 para arriba se puede añadir a las variables el tipo de dato
class Money
{
    public int $amount = 2;
}

class Offer
{
    public string $offerNumber; //antes de la variable y despues de la seguridad
    public Money $totalPrice;
}

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Tratar propiedades de objetos antes de nada
$money = new Money();
# OJO!! Si la variable tipada int no tuviera valor el var_dump daria error ya que las varibles tipadas si no se les da valor son nulls
# Esta bien saber que antes de crear un objeto si tiene propiedades que no tienen valor tratar esos nulls antes de nada.
var_dump($money->amount);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Visivilidad Public Private y protected

#- A los miembros de clase declarados como 'public' se puede acceder desde donde sea.
#- A los miembros declarados como 'protected', solo desde la misma clase, mediante clases heredadas o desde la clase padre.
#- A los miembros declarados como 'private' únicamente se puede acceder desde la clase que los definió.

class MyClass
{
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';

    function printHello()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

$obj = new MyClass();
echo $obj->public;    // Funciona bien
echo $obj->protected; // Error Fatal
echo $obj->private;   // Error Fatal
$obj->printHello();   // Muestra Public, Protected y Private

class MyClass2 extends MyClass
{
    // Se pueden redeclarar las propiedades pública y protegida, pero no la privada
    public $public = 'Public2';
    protected $protected = 'Protected2';

    function printHello()
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

$obj2 = new MyClass2();
echo $obj2->public;    // Funciona bien
echo $obj2->protected; // Error Fatal
echo $obj2->private;   // Undefined
$obj2->printHello();   // Muestra Public2, Protected2, Undefined


#----------------------------------------------------------------------------------------------------------------------------------------------