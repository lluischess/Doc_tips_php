<?php

namespace App;

class ToasterPro extends Toaster # Extiende de una clase padre
{
    # al heredar de Toaster podemos usar todas las propiedades publicas y protected
    protected int $size; # es la misma propierty que el padre pero en el hijo se redefine distinto
    # Si la propiedad $size fuera privada en el padre no podriamos editarla y segiria teniando el valor que le da la clase padre
    # pero si podriamos acceder a ella para imprimir etc

    # Tampoco podriamos decrementar el acceso de public a private o protected de la propiedad $size ya que public esta antes de esas y no tendria permisos la clase hija
    # pero si por ejemplo la propiedad $size del padre es protected si podriamos modificarla a public
    # esto tambien se aplica a metodos y static metodos y propertis

    public function __construct() # Aqui estamos sobrescribiendo el metodo constructor ya que el padre tiene otro
    {
        # Hay que tener en cuenta que si rescribimos un metodo del padre en el hijo, ya no intentara ejecurar el metodo del padre y en el del hijo no tenemos la array rebanadas inicializada,
        # por lo tanto dara error.
        # Para solucionar esto podemos llamar directamente al constructor del padre pero siempre al principio:
        parent::__construct();
        $this->size = 4;
    }

    # En caso de que quisieramos sobrescribir otro metodo del padre siempre tiene que tener los mismos parametros del metodo y el mismo valor de return que el padre
    # pero solo aplica a los metodos propios no al constructor que si podriamos poner otros parametros distintos a los del padre

    public function toastBagel()# Un metodo solo del hijo aunque el hijo puede usar los otros metodos publicos del padre y protected
    {
        foreach ($this->rebanadas as $i => $rebanada){
            echo ($i + 1). ': Toasting ' . $rebanada . ' with bagels options';
        }
    }

}