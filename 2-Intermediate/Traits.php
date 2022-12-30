<?php

# INDEX 
# 1) Traits Example and explication
# 2) 
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Traits Example and explication

# Tenemos por un lado la class Padre que se encarga de hacer cafe
class CoffeeMaker
{
    public function makeCoffee()
    {
        echo static::class . ' is making coffee' . PHP_EOL;
    }

}

# Tenemos una class hijo que hace latte
class LatteMaker extends CoffeeMaker
{
    use LatteTrait;

    # TRAITS 2) dentro de las clases podemos redefinir y editar el metodo del trait ya que la que manda es la clase
    public function makeLatte()
    {
        echo static::class . ' is making latte well' . PHP_EOL;
    }
    
}

# Tenemos una class hijo que hace Cappuccino
class CappuccinoMaker extends CoffeeMaker
{
    use CappuccinoTrait{
        CappuccinoTrait::makeCappuccino as public; // podemos cambiar la visibilidad de los metodos del trait en la class
    }
}

# Y por ultimo tenemos all in one que lo hace todo
# Aqui el problema es que la cafetera all in one lo hace todo pero php no soporta extender de 2 clases a la vez LatteMaker y CappuccinoMaker.
# Entonces se podria resolver creando interfaces y implementandolas pero tambien estariamos duplicando mucho codigo
# La SOLUCION seria crear traits se la siguiente manera:
class AllInOneMaker extends CoffeeMaker
{
    use LatteTrait;
    # TRAITS 3) Aqui tenemos 2 traits y en los 2 aparece el mismo metodo makeLatte, en ese caso podemos decirle que use por eljemplo el del trait en vez del otro
    use CappuccinoTrait{
        CappuccinoTrait::makeLatte insteadof LatteTrait;
        CappuccinoTrait::makeCappuccino as public;
    }

    
}

#TRAITS:

# 1) No se pueden instanciar como objeto los traits hay que usarlos dentro de las clases
# 4) se pueden user abstrac metodos en los trais para que lo implementen las clases
# 5) se pueden usar propietis tambien


trait LatteTrait
{
    public function makeLatte()
    {
        echo static::class . ' is making latte' . PHP_EOL;
    }
}

trait CappuccinoTrait
{
    private function makeCappuccino()
    {
        echo static::class . ' is making Cappuccino' . PHP_EOL;
    }

    public function makeLatte() # En caso de repetirse un metodo mirar 3)
    {
        echo static::class . ' is making latte from cappuccino' . PHP_EOL;
    }
}


# Testing:

$coffeemaker = new CoffeeMaker();
$coffeemaker->makeCoffee();

$latteMaker = new LatteMaker();
$latteMaker->makeCoffee();
$latteMaker->makeLatte();

$cappuccinoMaker = new CappuccinoMaker();
$cappuccinoMaker->makeCoffee();
$cappuccinoMaker->makeCappuccino();

$allInOneMaker = new AllInOneMaker();
$allInOneMaker->makeCoffee();
$allInOneMaker->makeLatte();
$allInOneMaker->makeCappuccino();