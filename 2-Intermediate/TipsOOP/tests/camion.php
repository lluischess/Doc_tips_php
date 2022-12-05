<?php

# Normalmente definimos los namespace identificandolos por su ruta
namespace tipsOop\tests;

use DateTime;

class Camion {
    public float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
        # IMPORTANTE: si quisiermos instanciar otra clase dentro de esta claso con namespace propio, tendriamos que añadir la barra \ para que busque en el namespace global 
        # O usando el use arriba
        var_dump(new \DateTime());

        #Otra cosa importante en las funciones, es que si ya existe una funcion en el namespace que se parece a una generica puedes llamar ala generica con la barra
        var_dump(\explode(',','hello,world'));
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}