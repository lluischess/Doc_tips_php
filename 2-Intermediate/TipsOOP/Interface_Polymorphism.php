<?php

# INDEX 
# 1) Que es una interfaz ?
# 2) Polimorfismo
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Que es una interfaz ?

// Las interfaces de objetos permiten crear código con el cual especificar qué métodos deben ser implementados por una clase, sin tener que definir cómo estos métodos son manipulados.

// Las interfaces se definen de la misma manera que una clase, aunque reemplazando la palabra reservada class por la palabra reservada interface y sin que ninguno de sus métodos tenga su contenido definido.

// Todos los métodos declarados en una interfaz deben ser públicos, ya que ésta es la naturaleza de una interfaz.

// Para implementar una interfaz, se utiliza el operador implements. Todos los métodos en una interfaz deben ser implementados dentro de la clase; el no cumplir con esta regla resultará en un error fatal. Las clases pueden implementar más de una interfaz si se deseara, separándolas cada una por una coma.

#Ejemplo:

namespace App;

# Una interfaz puede extender de otros padres de interfaz con ,
interface DebtCollector //extends OtraInterfaz, otratambien
{
    # En una interfaz no podemos declarar propiedades pero si constantes, pero luego en las clases que la implementan no son editables
    public const CONSTANT = 1; // en PHP 8.1 se pueden editar las constantes
    # Añadimos los metodos que debe tener sin implementarlos
    //public function __construct();
    public function collect(float $owedAmount): float;

}


# Aqui tenemos una class que implementara la interfaz, es decir el paquete de metodos que tendre que implementar
# Si la clase que implementa la interfaz no tiene los metodos que requiere dicha interfaz dara fatal error

# Podemos implementar multiples interfaces mediente ,
class CollectionAgency implements DebtCollector//, otraInterfaz
{
    // public function __construct()
    // {

    // }

    # todos los metodos tienen que ser publicos de una interfaz
    public function collect(float $owedAmount): float
    {
        $guaranteed = $owedAmount * 0.5;
        return mt_rand($guaranteed,$owedAmount);
    }
}

$collector = new CollectionAgency();
echo $collector->collect(100). PHP_EOL; // PHP_EOL es un intro


# 2) Polimorfismo

# Un objeto se considera polimorfo si puede implementar multiples formas de el, es decir si puede instanciar distintas clases desde el.

# polimorfismo se refiere a la propiedad por la que es posible enviar mensajes sintácticamente iguales a objetos de tipos distintos. El único requisito que deben cumplir los objetos que se utilizan de manera polimórfica es saber responder al mensaje que se les envía.

# Implementamos polimorfismo en el ejemplo de arriba siguiendolo aqui

# Creamos otra clase para crear un servicio de debit collect
class DebtCollectionService
{
    public function collectDebt(DebtCollector $collector)
    {
        # (Terminar lo de abajo antes de leer esto:)
        # Aqui miramos si viene de esta instancia de objeto
        var_dump($collector instanceof CollectionRocky);
        #(/)
        $owedAmount = mt_rand(100,1000);
        $collectedAmount = $collector->collect($owedAmount);

        echo 'Collected $'. $collectedAmount. ' out of $'. $owedAmount .PHP_EOL;
    }
}

$service = new DebtCollectionService();

echo $service->collectDebt( new CollectionAgency()). PHP_EOL;

# Todo esto funciona perfectamente pero si tubieramos en vez de un collectorAgency tubieramos tambien un CollectorRocky que pasaria? como usariamos los dos como podriamos instanciar uno u otro?
# Utilizando Polimorfismo
# Creamos el Ejemoplo con el nueco collectorRocky

class CollectionRocky implements DebtCollector
{
    public function collect(float $owedAmount): float
    {
        return $owedAmount * 0.65;
    }
}

# Claro entonces intentariamos cambier el collector por el de Rocky pero no funcionara porque el servicio(DebtCollectionService) solo acepta collectDebt(CollectionAgency $collector)
# La solucion seria que en el DebtCollectionService usemos la interfaz aqui: 
# public function collectDebt(DebtCollector $collector)
 $service2 = new DebtCollectionService();
 echo $service->collectDebt( new CollectionRocky()). PHP_EOL;