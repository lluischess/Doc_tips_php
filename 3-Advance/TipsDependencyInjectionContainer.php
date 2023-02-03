<?php

# INDEX 
# 1) Explicación de como funciona un Dependency Injection y Dependency Injection Conteinar
# 2) Dependenci Injection Support
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Explicación de como funciona un Dependency Injection y Dependency Injection Conteinar
# https://php-di.org/doc/understanding-di.html


// Comprender la inyección de dependencia
// La inyección de dependencia y los contenedores de inyección de dependencia son cosas diferentes:

// la inyección de dependencia es un método para escribir mejor código
// un contenedor es una herramienta para ayudar a inyectar dependencias
// No necesita un contenedor para hacer la inyección de dependencia. Sin embargo, un contenedor puede ayudarte.

// PHP-DI se trata de esto: hacer que la inyección de dependencia sea más práctica.

// La teoría#
// Código PHP clásico#
// Así es como funcionará aproximadamente un código que no usa DI:

// La aplicación necesita Foo (por ejemplo, un controlador), entonces:
// La aplicación crea Foo
// La aplicación llama a Foo
// Foo necesita Bar (por ejemplo, un servicio), entonces:
// Foo crea Bar
// Foo llama Bar
// Bar necesita Bim (un servicio, un repositorio, …), así que:
// Bar crea Bim
// la barra hace algo
// Usando la inyección de dependencia#
// Así es como funcionará aproximadamente un código que usa DI:

// La aplicación necesita Foo, que necesita Bar, que necesita Bim, entonces:
// La aplicación crea Bim
// La aplicación crea Bar y le da Bim
// La aplicación crea Foo y le da Bar
// La aplicación llama a Foo
// Foo llama Bar
// la barra hace algo
// Este es el patrón de Inversión de Control . El control de las dependencias se invierte de uno que llama a uno que llama.

// La principal ventaja: el que está en la parte superior de la cadena de llamadas siempre eres tú . Puede controlar todas las dependencias y tener control total sobre cómo funciona su aplicación. Puedes reemplazar una dependencia por otra (una que hayas creado, por ejemplo).

// Por ejemplo, ¿qué sucede si la biblioteca X usa el registrador Y y desea que use su registrador Z? Con la inyección de dependencia, no tiene que cambiar el código de la Biblioteca X.

// usando un contenedor#
// Ahora, ¿cómo funciona un código que usa PHP-DI?

// La aplicación necesita Foo entonces:
// La aplicación obtiene Foo del contenedor, por lo que:
// Contenedor crea Bim
// Container crea Bar y le da Bim
// Container crea Foo y le da Bar
// La aplicación llama a Foo
// Foo llama Bar
// la barra hace algo
// En resumen, el contenedor elimina todo el trabajo de crear e inyectar dependencias .

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Dependenci Injection Support
