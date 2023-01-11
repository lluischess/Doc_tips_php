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
# 8) Docblock
# 9) Clone objects
# 10) serialize and unserialize
# 11) OOP Error Handling
# 12) DateTime();
# 13) SuperGlobal $_SERVER
# 14) SuperGlobals $_POST and $_GET and $_REQUEST
# 15) SuperGlobals $_SESSIONS and $_COOKIES
# 16) PHP file upload $_FILES
# 17) HTTP Headers 



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

#----------------------------------------------------------------------------------------------------------------------------------------------
# 8) Docblock

# se utilizan para documentar clases y funciones


/**
 * @property-read Customer $customer
 * @property-write float $y
 * 
 */
class Testinvoise2
{

    /** @var Customer */
    private $customer;

    /**
     * Some description
     * 
     * @param Customer $customer
     * @param float|int $amount
     * @param Customer[] $arr
     * 
     * @throws \RuntimeException // es para la excepciones
     * 
     * @return bool
     */
    public function process($customer, $amount, array $arr)
    {
        return true;
    }
}

#----------------------------------------------------------------------------------------------------------------------------------------------
# 9) Clone objects

$invoice = new Testinvoise2();

# Asi se puede crear una copia del objeto, con el mismo valor de las propiedades de la primera invice
$invoice3 = clone $invoice;

var_dump($invoice, $invoice3, $invoice === $invoice3);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 10) serialize and unserialize

# Basicamente es una manera de desarmar un valor y volverlo a construir
#tiene muchos usos lo des-arma y lo deja como una cadena string

#Ejemplo: 
$arr = [1,2,3];

echo serialize($arr);

$SerializeArr = serialize($arr);

var_dump(unserialize($SerializeArr));

# __serialize es un metodo magico de classe y tambien __unserialize

#----------------------------------------------------------------------------------------------------------------------------------------------
# 11) OOP Error Handling

class Customer1
{
    public function __construct( array $billingInfo = [])
    {
        
    }

    public function getBillingInfo()
    {
        return $this->billingInfo;
    }
}

class Invoice1
{

    public function __construct( Customer1 $customer)
    {
        
    }

    public function process(float $amount): void
    {
        if ($amount <= 0){
            throw new \Exception('Invalid invoice amount'); // Exception manual
            throw new \InvalidArgumentException('Invalid amount'); // Exception manual
        }
        echo 'Processing $'. $amount . ' invoice -';

        sleep(1);

        echo 'OK'. PHP_EOL;
    }
}

class MissingbillingExeption extends \Exception
{
    protected $message = 'Missing ammout o 0';
}

$invoice = new Invoice1(new Customer1());

# Otra manera de captar errores es con try catch
# podemos ver el mensaje de error el archivo de donde viene y la linea
try{
    $invoice->process(-32);
}catch(\Exception $e){ // Esto lo que hace es pillar la exeption que devuelve desde la function y puedes añadir documentación extra o que haga un codigo diferente
    echo $e->getMessage(). ' ' . $e->getFile(). ': ' . $e->getLine();
}finally{
    echo  'Se ejecuta con el error o sin el error';
}
# con throw podemos manejar errores manualmente 


#----------------------------------------------------------------------------------------------------------------------------------------------
# 12) DateTime(); esto solo funciona en PHP 8 o superior

# Esta clase de php ya biene definida por el propio php podemos pasar 2 propiedades a su constructor la datetime con string que accepta bastantes cosas
# Luego le podemos pasar el datetimeZone
$dateTime = new DateTime('tomorrow', new DateTimeZone('UTC'));
# Aqui esta el listado de Zonas que se pueden usar https://www.php.net/manual/en/timezones.php
$dateTime1 = new DateTime('10/10/2022 7:00');
//$dateTime1 = new DateTime('10/10/2022 7:00', new DateTimeZone('Europe/Andorra'));
var_dump($dateTime);
var_dump($dateTime1);

# Compareciónes de Datetime:
var_dump($dateTime < $dateTime1);
var_dump($dateTime > $dateTime1);
var_dump($dateTime == $dateTime1);
var_dump($dateTime <> $dateTime1);

# Podemos hacer una comparación avanzada con diff
# devuelve un objeto con todas las diferencias de dias años horas etc
var_dump($dateTime->diff($dateTime1));
# Para visualizar mejor acemos el format
echo $dateTime->diff($dateTime1)->format('%Y years, %m months, %d days, %H, %i, %s'). PHP_EOL;

# Podemos formatear la fecha con la nomenclatura de formato de fecha
echo $dateTime->format('m/d/Y g:i A') . PHP_EOL;


#Podemos ajustar la Hora real del tiempo de cada zona seteandola
$dateTime1->setTimezone(new DateTimeZone('Europe/Andorra'));
var_dump($dateTime1);

#Podemos obtener el nombre de la timezone usando el getName
echo $dateTime->getTimezone()->getName();

#Podemos cambiar el valor de la fecha seteandola
# Y tambien la Hora
$dateTime->setDate(2023,1,1)->setTime(4,00,00);
var_dump($dateTime);


#Por defecto cuando guardamos fecha lo guarda en sistema Americano que el mes y el dia estan al reves
# la mejor solucion es utilizar la funcion de la clase formatocon fecha:

#Ejemplo: le estamos pasando la fecha Europea y dara fatal error porque el dia 15 lo coge como mes 15 que no existe
$date = '15/05/2022 3:30';

#solución1:
$datetime3 = new DateTime(str_replace('/','.',$date));
var_dump($datetime3);
# Solución2:
$datetime3 = DateTime::createFromFormat('d/m/Y',$date);
var_dump($datetime3);


# Tambien podemos añadir un interval de tiempo al datatime:
$date = '03/01/2023 9:15AM';
$datetime = new DateTime(str_replace('/','.',$date));
var_dump($datetime);
$interval = new DateInterval('P3M2D'); // 3meses y 2 dias

$datetime->add($interval);

var_dump($datetime);

#----------------------------------------------------------------------------------------------------------------------------------------------
# 13) SuperGlobal $_SERVER

# Esta super global contiene información del servidor y del entorno de ejecución
echo '<pre>';
print_r($_SERVER);
echo '<pre>';

# Con esta super global podemos hacer y trbajar con rutas del entorno (routing)
#Ejemplo de rutas muy cutre

class Router
{
    private array $routes;

    public function register(string $route, callable $action): self // este metodo de devolvera a si mismo
    {
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve(string $requestUri)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$route] ?? null;

        if (!$action){
            throw new Exception('No existe ninguna action 404 not fount');
        }

        return call_user_func($action);// llama a un tipo de datos callable
    }
}

class Home
{
    public function index(): String
    {
        return 'Home';
    }
}

class Invoice3
{
    public function index(): String
    {
        return 'Invoice';
    }
}

$router = new Router();
# Lo suyo seria hacerlo con Controladores pero seria por metodos y class Ejemplo
$router->register('/', [Home::class, 'index'])
        ->register('/invoice', [Invoice3::class, 'index']);

$router->register('/', function(){
    echo '/invoices';
});

# Estariamos printando la ruta que le hemos pasado al registro
# Si fueramos a /Home estariamos en Home y en caso de /invoices en invoices y en caso de una inventada daria el error 404
echo $router->resolve($_SERVER['REQUEST_URI']); // invaices 

#----------------------------------------------------------------------------------------------------------------------------------------------
# 14) SuperGlobals $_POST and $_GET and $_REQUEST

# Estas Super globals se utilizan para las request de aplicaciónes y formularrios web o mobiles

# Cuando visitamos una url en la web siempre pasa información en el $_GET
# Estos parametros guardados en el GET se suelen ver en la URL
# Si tenemos que pasar un nombre de la WEB o un ID no importante usamos GET
var_dump($_GET);
# SE accede medianta array []

# Luego tenemos el $_POST request que es lo mismo que el get pero sin que se pueda ver en la URL es mas seguro
# Por ejemplo al acceder con un user name utilizaremos POST
# SE accede medianta array []
var_dump($_POST);

# Luego tenemos $_REQUEST que es otra super global esta contiene todo lo del get, post y las cookies
var_dump($_REQUEST);
# Tener en cuenta que si usamos request y hay una variable duplicada en get y post solo se vera la del post en el request

#----------------------------------------------------------------------------------------------------------------------------------------------
# 15) SuperGlobals $_SESSIONS and $_COOKIES

#la Global sessiones es destruida automaticamente cuando el navegador se cierra
# en cambio las cookis pueden mantenerse hasta caducarse en cierto tiempo o hasta que se destruyan

# Iniciar session:
session_start(); // se suele poner al principio del archivo
# Esto creara una cookie de session PHPSESSID
var_dump($_SESSION);
# Podemos eliminar la session con el unset
unset($_SESSION['count']);

# Para setear y crear una cookie usamos esto:
setcookie(
    'NombreCookie',
    'ValorCookie',
    time() + 10, // Tiempo de vida de la cookie hasta que desaparezca
    '/', // path de la ruta
    '', // Dominio
    false, // Seguridad
    false 
); // La cookie se suele setear antes de imprimir cualquier cosa


# Para eliminar la cooki tenemos que pasar la cookie en negativo
setcookie(
    'NombreCookie',
    'ValorCookie',
    time() - 10, // Tiempo en negativo
    '/', // path de la ruta
    '', // Dominio
    false, // Seguridad
    false 
); 

#----------------------------------------------------------------------------------------------------------------------------------------------
# 16) PHP file upload $_FILES

# Antes de todo tenemos que dejar claro que en un form para subir archivos al servidor etc hay que añadir el atributo enctype="multipart/form-data"
?>
<form action="/upload" method="post" enctype="multipart/form-data">
    <input type="file" name="recipe"/>
    <button type="submit">Upload</button>

</form>

<?php
# Con esta super global podriamoss mirar alguna informacion importante del archivo en si
var_dump($_FILES);

# Podemos mover el archivo de carpeta usando esta funcion
move_uploaded_file($_FILES['recipe']['tmp_name'], __DIR__.'../TipsOOP/'.$_FILES['recipe']['name']); 

# O podemos guardar como array usando el mismo name en el form para guardarlo todo en el $_FILES
# C:\wamp64\www\php_Docs\2-Intermediate\TipsOOP\FILES añadir multiples archivos en array.PNG

#----------------------------------------------------------------------------------------------------------------------------------------------
# 17) HTTP Headers 

# Siempre que se visite una Web, se envie un formulario o realizar cualquier accion que accione una request
# automaticamente el cliente are una http request al servidor y el servicor devolvera una response al cliente

# 2 Imagenes Importantes:
#C:\wamp64\www\php_Docs\2-Intermediate\TipsOOP\httpRequest_Response.PNG
#C:\wamp64\www\php_Docs\2-Intermediate\TipsOOP\Response StatusCodes.PNG

# Se pueden cambiar los headers de esta manera:
header('HTTP/1.1 404 Not Found');

# Existe una manera mejor de modificar los estados de response code
http_response_code(404);
# Los headers tienen que ser enviados antes que cualquier output

# Con el header tambien podemos redirigir:
header('Location: /'); //homepage
# Con esto de los headers estamos aplicando cosas que se aran al cargar la pagina web aplicara esos headers
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename"myfile.pdf"');

