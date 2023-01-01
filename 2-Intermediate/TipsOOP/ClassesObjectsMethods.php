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
# 5.7) Constantes de Clases
# 5.8) Static Properties & Methods
# 5.9) Singelton class con constructor privado
# 5.10) Magic Methods
# 6) Anonymous Classes
# 7) Object Comparation



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

# En caso de estar usando Camion en la misma clase camion pero es de otra ruta podemos renombrar la classe que usaremos con otro nombre para que no de error
use tipsOop\tests\Camion as TestCamion;

var_dump(new TestCamion(2));

# Importar varios a la vez

//use tipsOop\tests\{Camion, coche};

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.7) Constantes de Clases

class Status
{
    # Asi se declaran las constantes de clase, siempre añadir la visibilidad
    public const STATUS_PAID = 'paid';
    public const STATUS_PENDING = 'pending';
    public const STATUS_DECLINED = 'declined';

    # Podemos crear una array constant con todos los Estados
    public const ALL_STATUSES = [
        self::STATUS_DECLINED => 'Paid',
        self::STATUS_PENDING => 'Pending',
        self::STATUS_DECLINED => 'Declined',
    ];
}

class PaymentProfile2 {

    public const STATUS_PAID = 'paid';
    private const STATUS_PENDING = 'pending';

    public function __construct()
    {
        // Aqui le estamos diciendo que sette el estado a pending al instanciar el objeto
        $this->setStatus(Status::STATUS_PENDING);
        #Podemos acceder a la constante privada de dos maneras asi:
        var_dump(PaymentProfile2::STATUS_PENDING);
        var_dump(self::STATUS_PENDING);

    }

    public function setStatus(string $status): self // que devuelva self inplica que esta devolviendo un objeto ya que hace referencia a su propia clase es como self=PaymentProfile2
    {
        // Podriamos revisar si el estado existe:
        if (!isset(Status::ALL_STATUSES[$status])){
            throw new \InvalidArgumentException('Invalid status');
        }
        // Esta propiedad sera igual al estado seteado
        $this->status = $status;
        return $this;
    }
}



// echo PaymentProfile2::class; // Esto imprime la ruta entera de la clase

# para acceder a una constante de clase se hace asi:
# Solo si son publicas
// echo PaymentProfile2::STATUS_PAID; // no hace falta instanciar la clase para acceder a ella

# aunque tambien funciona instanciando la clase
$payment = new PaymentProfile2();
echo $payment::STATUS_PAID;
echo "\n";

# Utilizamos constantes para asi no pasar un atributo equivocado que de bugs
$payment->setStatus(Status::STATUS_PAID);
var_dump($payment);
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.8) Static Properties & Methods

class PaymentProfile3 {

    # Static puede ir antes o despues del acceso public
    public static int $count = 0;

    public function __construct()
    {
        var_dump(self::$count++);
    }

    public static function getCount(): int
    {
        // dentro de un metodo statico no podemos usar el $this hay que usar el self
        return self::$count;
    }
}

# Podemos acceder a metodos y atributos staticos igual que como accedemos a las constantes de una clase
echo PaymentProfile3::$count;
# si son staticos pertenecen a la clase no a la instancia
# no estan asociadas por el objeto instanciado, sino que pertenecen a la clase
# si llamamos a una instancia del objeto no empezara desde 0 como otros atributos
# se ira guardado parecido a una constante
$pay = new PaymentProfile3();
$pay2 = new PaymentProfile3();
$pay3 = new PaymentProfile3(); // 2

# Con los metodos staticos pasa igual
echo "\n" . PaymentProfile3::getCount();


#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.9) Singelton class con constructor privado

# Es una clase que crea una instancia de la Base de datos de manera seguro

Class DB 
{
    public static ?DB $instancia = null;

    private function __construct(array $config)
    {
        echo 'Instancia creada';
    }

    public static function getInstance(array $config): DB 
    {
        if (self::$instancia == null){
            self::$instancia = new DB($config);
        }

        return self::$instancia;
    }
}

# Aunque creamos 3 instancias solo se imprimira 1 vez el constructor
# Si el constructor fuera publico se imprimiria 3 veces
$db = DB::getInstance([]);
$db = DB::getInstance([]);
$db = DB::getInstance([]);
#----------------------------------------------------------------------------------------------------------------------------------------------
# 5.10) Magic Methods

# __get() and __set()

class Invoice
{
    private float $amout;
    public function __get(string $name) //se utiliza para consultar datos a partir de propiedades inaccesibles (protegidas o privadas) o inexistentes.
    {
        # podemos hacer que devuelva la propiedad si es private por ejemplo:
        var_dump($name);
        if (property_exists($this, $name)){
            return $this->$name;
        }

        return null;
    }

    public function __set(string $name,$value):void // se ejecuta al escribir datos sobre propiedades inaccesibles (protegidas o privadas) o inexistentes.
    {
        var_dump($name,$value);
    }

    public function __isset(string $name): bool // se lanza al llamar a isset() o a empty() sobre propiedades inaccesibles (protegidas o privadas) o inexistentes.
    {
        echo "¿Está definido '$name'?\n";
        return isset($this->data[$name]);
    }

    public function __unset(string $name): void // se invoca cuando se usa unset() sobre propiedades inaccesibles (protegidas o privadas) o inexistentes.
    {
        echo "Eliminando '$name'\n";
        unset($this->data[$name]);
    }

    public function __call($name, $arguments) // es lanzado al invocar un método inaccesible en un contexto de objeto.
    {
        // Nota: el valor $name es sensible a mayúsculas.
        echo "Llamando al método de objeto '$name' "
             . implode(', ', $arguments). "\n";
    }

    public static function __callStatic($name, $arguments) // es lanzado al invocar un método inaccesible en un contexto estático.
    {
        // Nota: el valor $name es sensible a mayúsculas.
        echo "Llamando al método estático '$name' "
             . implode(', ', $arguments). "\n";
    }
}

$invoice = new Invoice();

# Como tenemos definido el metodo magico __get al acceder a una propiedad no existente se ejecutara ese metodo
echo $invoice->amount; // error undefined propierty 

$invoice->amount = 10; // al setter una propiedad no existente se ejecutara el metodo magico __set

// Declarar una clase simple
class TestClass
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }
    # El método __toString() permite a una clase decidir cómo comportarse cuando se le trata como un string. Por ejemplo, lo que echo $obj; mostraría. 
    # Este método debe devolver un string, si no se emitirá un nivel de error fatal E_RECOVERABLE_ERROR.
    public function __toString()
    {
        return $this->foo;
    }
}

$class = new TestClass('Hola Mundo');
echo $class;

class CallableClass
{
    public function __invoke($x) // es llamado cuando un script intenta llamar a un objeto como si fuera una función.
    {
        var_dump($x);
    }
}
$obj = new CallableClass;
$obj(5);
var_dump(is_callable($obj));


#----------------------------------------------------------------------------------------------------------------------------------------------
# 6) Anonymous Classes

# Declaración:
# Se suelen usar mas para el testing

$obj = new class(1,2,3){
    # Anonymous class puede usar trait, herencia y implement interfaces
    public function __construct(int $x, int $y, int $z)
    {
        
    }
};

var_dump($obj);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 7) Object Comparation

class Testinvoise
{
    public function __construct(public float $amount, public string $description)
    {
        
    }
}

$invoice = new Testinvoise(33,'test');
$invoice2 = new Testinvoise(333,'test');

# Mejor comparar objetos con doble igual == porque mira si las propiedades son iguales de valor
var_dump($invoice == $invoice2);
var_dump($invoice === $invoice2); // como son dos objetos distintos dara false ya que cada uno esta en una memoria distinta