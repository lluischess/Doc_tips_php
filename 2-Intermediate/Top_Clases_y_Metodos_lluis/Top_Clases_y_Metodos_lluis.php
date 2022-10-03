<?php

# INDEX 
# 1) Clase predefinida para hacer pruebas stdClass()
# 2) Visibilidad en Metodos Public, Private y Protected
# 3) 
# 4) 



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
