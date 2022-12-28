<?php

# INDEX 
# 1) Que es la Herencia?
# 2) EN php no existe la Multiherencia pero si podemos heredar de un hijo, puede haber descendencia
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Que es la Herencia?

# La herencia es que existe una class padre que tiene sus propiedades y sus metodos y que a la vez existe una clase hija que extiende y hereda de su padre las propiedades y los metodos de la clase padre.

# hay mas explicaciónes en Inheritance/ToasterPro.php

require_once __DIR__.'/Toaster.php';
require_once __DIR__.'/ToasterPro.php';

use App\Toaster;
use App\ToasterPro;

$tostadas = new ToasterPro();
# Obtendremos 4 tostadas ya que estamos utilizando la clase hijo que es la tostadora pro
$tostadas->addRebanada('bread');
$tostadas->addRebanada('bread');
$tostadas->addRebanada('bread');
$tostadas->addRebanada('bread');

$tostadas->toastBagel();


$toaster = new Toaster();
# Estamos haciendo 3 tostadas pero como la tostadora solo es de 2 solo imprimira 2
$toaster->addRebanada('bread');
$toaster->addRebanada('bread');
$toaster->addRebanada('bread');

$toaster->toast();


#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) EN php no existe la Multiherencia pero si podemos heredar de un hijo, puede haber descendencia

# no puede haber un hijo que extienda de 2 padres

# Si existe el MultiLevelHerencia
# Es decir si tenemos clase Padre: Tostadora
# y luego tenemos una clase Hijo: TostadoraPro extends Tostadora
# Podriamos tener una clase SubHijo: TosdadoraElite extends TostadoraPro

