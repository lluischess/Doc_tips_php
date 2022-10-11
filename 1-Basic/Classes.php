<?php

# INDEX 
# 1) Añadir tipos a las variables de clases
# 2) Tratar propiedades de objetos antes de nada
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Añadir tipos a las variables de clases

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
# 2) Tratar propiedades de objetos antes de nada
$money = new Money();
# OJO!! Si la variable tipada int no tuviera valor el var_dump daria error ya que las varibles tipadas si no se les da valor son nulls
# Esta bien saber que antes de crear un objeto si tiene propiedades que no tienen valor tratar esos nulls antes de nada.
var_dump($money->amount);

#----------------------------------------------------------------------------------------------------------------------------------------------
