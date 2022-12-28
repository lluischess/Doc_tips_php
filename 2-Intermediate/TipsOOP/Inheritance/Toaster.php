<?php

namespace App;

# Si añadimos la palabra final delante de la class estaremos indicando que ninguna clase puede heredar de esta misma
//final class Toaster
class Toaster
{
    # Lo mejor es encapsular con protected las propiedades del padre e hijo con herencia asi evitamos que nos toquen las propiedades

    protected array $rebanadas;
    protected int $size;

    public function __construct()
    {
        # Inicializamos al instanciar objeto
        $this->rebanadas = [];
        $this->size = 2;
    }

    public function addRebanada(string $rebanada): void
    {
        # Si la instancia del objeto es de la clase hijo el $this-> se referira a la clase hija pero como tiene acceso a propiedades y metodos del padre se ejecutaran correctamente
        # pero es eso que hay que tener en cuenta que el $this sera el objeto de la clase que se llama en la instancia
        if(count($this->rebanadas) < $this->size){
            $this->rebanadas[] = $rebanada;
        }
    }
    # Si un metodo tiene la palabra final es que no se puede sobrescribir el metodo en una class hijo
    //final public function toast()
    public function toast()
    {
        foreach($this->rebanadas as $i => $rebanada){
            echo ($i + 1) . ': Toasting '. $rebanada . PHP_EOL;
        }
    }
}