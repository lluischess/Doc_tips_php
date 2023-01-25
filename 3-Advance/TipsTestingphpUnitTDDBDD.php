<?php

# INDEX 
# 1) Tipos de testing
# 2) Que es TDD y BDD
# 3) PHPUnit Framework
# 4) PHPUnit Framework configure



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Tipos de testing

# El testing es esencial ya que nos asegura que nuestro programa no se rompera, hacer un test manual cuando hay una funcionalidad o alguna cosa que arreglar esta bien, pero cuando se implementan muchas cosas,
# es mejor estar preparados y pasar un testeo completo de todo que es lo que estudiaremos aqui:

# Existen muchos tipos de testings, aqui nombrare algunos pero no los miraremos todos:
# Tipos: Accessibility Testing, Acceptance Testing, End to end Testing, Functional Testing, Integration Testing, Load Testing, Unit Testing, Stress Testing, Regression Testing, Smoke Testing y muchos mas

# Aqui Estudiaremos Unit Testing y Integration Testing

# Unit Testion: tests small piece of code(Singel function) y no se connecta a ninguna base de datos ni te resuelve ninguna dependencies solo usa mocks/fakes cuando lo necesita.
# Integration Testing: Se asegura de que ciertas funcionalidades o modulos funcionen segun lo esperado, cuando se ponen dependencias en la integration testing pueden ser resueltas y puede conectarse a la base de datos si lo necesita.

# Normalmente se usan los dos tipos al mismo tiempo porque individualmente puede que no falle pero cuando se une a un grupo de funcionalidad puede dar errores.
#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Que es TDD y BDD

# En los dos las pruebas se escriven primero y luego el codigo
# Prefiero primero creaar el codigo y despues los test ya que cuando creas los test antes puede que en una aplicación del mundo real haya muchos cambios y eso dificulte el Trabajo con TDD


# TDD: Test Driven Development
# En TDD 

# BDD: Behavior Driven Development
# En BDD los test se escriben antes que realizar el codigo

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) PHPUnit Framework

# Es un frameword orientado a testing 
# Enlace de descarga: https://phpunit.de/

# lo Instalaremos con composer via comando: composer require --dev phpunit/phpunit ^9.5

# Todas las pruebas estaran en el directorio sigiente con la estructura del framework
# C:\wamp64\www\php_Docs\3-Advance\PHPUnit

# Para empezar a utilizarlo tendremos que ir a este archivo mediante consola y nos dara todos los comandos que tenemos a nuestro alcance:
# ./vendor/bin/phpunit

# si no queremos ir añadiendo toda la ruta para ir ejecutando los codigos podemos crear un alias

#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) PHPUnit Framework configure

# First of all we have to configure the test creating the configurationfile:
# si no esta crealo en la ruta del proyecto
# C:\wamp64\www\php_Docs\3-Advance\PHPUnit\phpunit.xml

# En nuestro caso e quitado bootstrap porque no lo usamos
