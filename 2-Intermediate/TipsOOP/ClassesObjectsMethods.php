<?php

# INDEX 
# 1) Clase predefinida para hacer pruebas stdClass()
# 2) Visibilidad en Metodos Public, Private y Protected
# 2.1) Mas ejemplos de visivilidad
# 3) Añadir tipos a las variables de clases
# 4) Tratar variables de clases antes de nada
# 5) Clases & objects
# 5.1) Metodo chaining llamar a todas las funciones instanciando de golpe
# 5.2) Destruir instancia
# 5.3) Casting para objetos
# 5.4) Constructores propiedades promocionadas sintaxis mas limpia php 8
# 5.5) Nullsafe operator ? llamando a clases php 8
# 5.6) Namespace



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
# 5) Clases & objects

# Una clase es una definición de algun cosa, una clase puede instanciarse como un objeto multiples veces.
# Un objeto es la instancia de una clase la cual por su definición de clase se genera un objeto individual.
# Ejemplo de clase

class Transaction
{
    // Propiedades de una clase
    # todas las propiedades sin valor asignado estaran como NULL
    # En caso de una propiedad private solo se podria acceder dentro de la clase

    #Nota Importante: Si la propiedad tiene asignada un tipo de dato y no tiene valor asignado devolvera un error y no un null,
    # la mejor manera de resolver eso es que siempre devuelva un valor, ya que al añadir tipo es una variable uninicializada si no tiene valor
    # para resolver esto se puede añadir un valor directamente en la propiedad o en el constructor o en el setter
    private float $amount;
    public string $description;

    # El constructor es un metodo especial el cual es llamado siempre que se instancie una clase
    # El constructor puede alvergar argumentos e iniciarlos
    # Es super recomendable añadir los accesos de permisos a los metodos ya que sino php siempre los dejara por defecto en public
    # El constructor siempre suele ser public
    public function __construct(float $amount, string $description)
    {
        # Para acceder a las propiedades de la misma clase utilizamos el $this
        $this->amount = $amount; // Aqui le estamos diciendo que este amount de la class es igual al valor del argumento del constructor que sera asignado al instanciar la clases
        $this->description = $description;
    }

    // Este metodo magico se ejecuta cuando no hay mas referencias a la clase o cuando se destruye la instancia
    public function __destruct()
    {
        echo 'Destruir ' . $this->description . "\n";
    }

    public function addtax(float $rate): Transaction
    {
        $this->amount += $this->amount * $rate/100;
        var_dump($this->amount);
        return $this; // devolvemos el objeto
    }

    public function adddiscount(float $discount): Transaction // devuelve un objeto
    {
        $this->amount -= $this->amount * $discount/100;
        var_dump($this->amount);
        return $this;
    }

    // Para poder acceder desde fuera a una propiedad private se suelen usar los Getters
    public function getAmount(): float
    {
        return $this->amount;
    }


}

# Ejemplo de Objeto instanciado
$transaccion = new Transaction(100,"gol");
var_dump($transaccion);
// objeto: Transaction


# Acceder a una propiedad del objeto
//echo $transaccion->amount; // error al ser propiedad privada en caso de public podriamos
$transaccion->addtax(8);
$transaccion->adddiscount(5);
echo $transaccion->getAmount();

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.1) Metodo chaining llamar a todas las funciones instanciando de golpe
# Podemos hacer que las funciones de la clase devuelvan un return y ajustarlo todo en el siguiente ejempolo
# haciendo que se vayan ejecutando todos los metodos segidamente
$amount2 = (new Transaction(100,"T2"))
            ->addtax(8)
            ->adddiscount(5)
            ->getAmount();

var_dump($amount2);
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.2) Destruir instancia
unset($transaccion);
//var_dump($transaccion); no funcionara
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.3) Casting para objetos

# Convertimos de Array a objeto

$arr = [1,2,3];

$obj = (object) $arr; // esto se convertira en objeto stdclass

var_dump($obj->{1}); // entrara en el indice 1 = 2

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.4) Constructores propiedades promocionadas sintaxis mas limpia php 8

class Transaction2 {
    # Esto te ahorra poner las propiedades antes y llamarlas con el this para añadirles el valor
    // public function __construct(private float $amount, private string $description)
    // {
    //     // Se puede acceder a las propiedades asi:
    //     echo $this->amount;
    //     echo $description;
        
    // }
}

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.5) Nullsafe operator ? llamando a clases php 8

# Si tenemos llamadas a una clase para consegir las propiedades podemos añadir un nullsafe operator

class PaymentProfile {
    # Tenemos un id random
    public int $id;

    public function __construct()
    {
        $this->id = rand();
    }
}

class Customer {
    # tenemos una propiedad de clase PaymentProfile que es un null por defecto
    public ?PaymentProfile $paymantProfile = null;
}

class Transactions3 {
    private float $amount;
    public ?Customer $customer = null;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}

#Multi llamada de instancia de objeto
# Instanciando todas las clases para que funcione la llamada al id seria de la siguiente manera:
$transaction8 = new Transactions3(3);
$transaction8->customer = new Customer();
$transaction8->customer->paymantProfile = new PaymentProfile();
echo $transaction8->customer->paymantProfile->id;

#PERO si nos faltara una instancia de objeto para que no petara en php 8 podemos llamar al ? que es un nullsafe operator
# ASI:
//echo $transaction8->customer?->paymantProfile?->id;

# O:
echo $transaction8->customer->paymantProfile->id ?? 'foo';

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.6) Namespace


# Si tuviéramos 2 clases iguales en distintas rutas, causaria error fatal
# Por ello existen los namespace
require_once './2-Intermediate/TipsOOP/otrositio/camion.php';
require_once './2-Intermediate/TipsOOP/tests/camion.php';

# El namespace se declara al principio de todo, para ver el ejemplo ir a la clase camion en tests

# Para poder acceder a la clase con namespace tenemos que hacer lo siguiente:
var_dump(new tipsOop\tests\Camion(2));

# Otro ejemplo para acceder:
# podemos usar el use

use tipsOop\tests\Camion;

var_dump(new Camion(2));

#----------------------------------------------------------------------------------------------------------------------------------------------
