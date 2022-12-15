<?php

# INDEX 
# 1) What is composer?
# 2) Install composer 2 ways
# 3) Donde obtener paquetes para instalar desde el composer
# 4) composer.json
# 5) composer.lock
# 6) Se puede utilizar el autoloading de Composer



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) What is composer?

# Es una herramienta de manejo de dependencias y paquetes, te permite gestionar librerias paquetes y otras dependencias mediante comandos
#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Install composer 2 ways

# 1- Descargar desde la web oficial:
# https://getcomposer.org/

# 2- Si estamos usando docker podemos ir al docker

# - cd docker/ 
# Alli instalar el composer
# codigo: docker-compose up -d  --build

# luego podemos ir al utilizar el bash desde el contenedor
# codigo: docker exec -it (Proyecto) bash
#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Donde obtener paquetes para instalar desde el composer

# Tenemos esta web oficial : packagist.org
#para descargar los packetes que necesitemos o en las documentaciones de la libreria que necesitemos
# Codigo para instalar con composer el paquete de ramsy/uuid: 
# - composer require ramsy/uuid 

#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) Composer.json

# normalmente es un archivo que esta en la raiz del proyecto.
# Es un archivo que se la configuración de todas las dependencias del proyecto y otras configuraciónes

# Este archivo se genera de 2 maneras con composer init o instalando un paquete el cual si no existe el archivo lo genera con el paquete que acabas de instalar

# Cuando se generan los archivos de configuración o instalamos una dependencia con composer tendremos una carpeta "vendor" donde se encontraran todas las dependencias del proyecto

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5) composer.lock

# Este archivo se encarga de prefijar y bloquer tus dependencias en el estado que se deje en el mismo archivo
# es decir si tenemos un packete con versión "4.1" que se quede en esa misma versión y no se actualice

# cuando generas por primera vez el composer.lock se generara con las versiónes actuales de las dependencias existentes en el composer.json
#----------------------------------------------------------------------------------------------------------------------------------------------
# 6) Se puede utilizar el autoloading de Composer

# Composer tiene un autoload.php en la raiz del vendor, se puede usar pero mejor usarla solo en desarrollo ya que al ser muy dinamica es un poco pesada 

#se trata de autoload_psr4.php 
# En ese archivo en el return hay que añadir esto la raiz de tu app donde tienes el codigo: array( 'App\\' => array($baseDir . '/app'),)

# Despues hay que añadir el autoload en el composer.json: "autoload": {
#                                                              "psr-4": {
#                                                                   "App\\": "app/"
#                                                                   }
#                                                                 }


# Luego simplemente en el index.php del proyecto:

// require __DIR__. '/../vendor/autoload.php';
# Usando el paquete de uuid
// $id = new \Ramsey\Uuid\UuidFactory();
// echo $id->uuid4();