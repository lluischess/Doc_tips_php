<?php

# INDEX 
# 1) Clase predefinida para hacer pruebas stdClass()
# 2) Visibilidad en Metodos Public, Private y Protected
# 2.1) Mas ejemplos de visivilidad
# 3) Añadir tipos a las variables de clases
# 4) Tratar variables de clases antes de nada



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Clase predefinida para hacer pruebas stdClass()

# Es una clase predefinida sin atributos ni metodos.
# Y la podemos usar cuando queremos crear un objeto genérico al que después podemos agregar propiedades.

$objeto = new stdClass();
$objeto->color = 'Rojo'; // ahora que esta definido este atributo lo podemos reutilizar para cualquier cosa

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Visibilidad en Metodos Public, Private y Protected

# Aquellos declarados sin ninguna palabra clave de visibilidad explícita serán definidos como public.

class MyClass
{
    // Declaración de un constructor public
    public function __construct() { }

    // Declaración de un método public
    public function MyPublic() { }

    // Declaración de un método protected
    protected function MyProtected() { }

    // Declaración de un método private
    private function MyPrivate() { }

    // Esto es public
    function Foo()
    {
        $this->MyPublic();
        $this->MyProtected();
        $this->MyPrivate();
    }
}

$myclass = new MyClass;
$myclass->MyPublic(); // Funciona
//$myclass->MyProtected(); // Error Fatal
//$myclass->MyPrivate(); // Error Fatal
$myclass->Foo(); // Public, Protected y Private funcionan


class MyClass2 extends MyClass
{
    // Esto es public
    function Foo2()
    {
        $this->MyPublic();
        $this->MyProtected();
        // No se puede acceder a una funcion privada de su extends MyClass
        //$this->MyPrivate(); // Error Fatal
    }
}

$myclass2 = new MyClass2;
$myclass2->MyPublic(); // Funciona
$myclass2->Foo2(); // Public y Protected funcionan, pero Private no

class Bar
{
    public function test() {
        $this->testPrivate();
        $this->testPublic();
    }

    public function testPublic() {
        echo "Bar::testPublic\n";
    }
    
    private function testPrivate() {
        echo "Bar::testPrivate\n";
    }
}

class Foo extends Bar
{
    public function testPublic() {
        echo "Foo::testPublic\n";
    }
    
    private function testPrivate() {
        echo "Foo::testPrivate\n";
    }
}

// Desde Foo puedes acceder a las publicas de la extends Bar
$myFoo = new Foo();
$myFoo->test(); // Bar::testPrivate 
                // Foo::testPublic

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2.1) Mas ejemplos de visivilidad
#- A los miembros de clase declarados como 'public' se puede acceder desde donde sea.
#- A los miembros declarados como 'protected', solo desde la misma clase, mediante clases heredadas o desde la clase padre.
#- A los miembros declarados como 'private' únicamente se puede acceder desde la clase que los definió.

class MyClass3
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

$obj = new MyClass3();
echo $obj->public;    // Funciona bien
echo $obj->protected; // Error Fatal
echo $obj->private;   // Error Fatal
$obj->printHello();   // Muestra Public, Protected y Private

class MyClass4 extends MyClass3
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

$obj2 = new MyClass4();
echo $obj2->public;    // Funciona bien
echo $obj2->protected; // Error Fatal
echo $obj2->private;   // Undefined
$obj2->printHello();   // Muestra Public2, Protected2, Undefined

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Añadir tipos a las variables de clases
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
# 4) Tratar variables de clases antes de nada
$money = new Money(); // en 3)
# Esta bien saber que antes de crear un objeto si tiene propiedades que no tienen valor tratar esos nulls antes de nada.
# en caso de que amount no tubiera valor daria error de warning null
var_dump($money->amount);

#----------------------------------------------------------------------------------------------------------------------------------------------

#----------------------------------------------------------------------------------------------------------------------------------------------

#----------------------------------------------------------------------------------------------------------------------------------------------

#----------------------------------------------------------------------------------------------------------------------------------------------
