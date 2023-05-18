<?php

# INDEX 
# 1) Que es Docker?
# 2) Como instalar
# 3) Comandos de Docker
# 4) DOCKERFILE
# 5) Agrupar por redes los contenedores
# 6) Docker compose



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Que es Docker?

# Es un es una herramienta de contenedores que contiene paquetes con nuestras aplicaciones y sus dependencias.

# Cuando se crea una imagen contiene el contenedor y sus paquetes.

# Una maquina hace de servidor que es el hardware y el kernel(SO) la parte de la imagen de doker que podemos instalar en ese servidor se llama CLiente.
# Se pueden instalar varios clientes sin que interfieran entre ellos.

# Ejemplo

# Podemos tener 3 clientes con estas caracteristicas:
# Cliente 1: Windows | php 8.0 MySQL 8 Configurations
# Cliente 2: Windows | php 7.0 MySQL 8 Configurations
# CLiente 3: Windows | php 7.4 Mysql 8 Configurations

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Como instalar
# Esto significa que los desplieges se vuelven mucho mas faciles. Ya que son Portables.

# 1- Primero hay que instalar Docker Deskctop Para gestionar nuestros contenedores e imagenes

# 2- Tenemos Docker hub que es como un github pero de contenedores e imagenes, los cuales podemos usar.

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Comandos de Docker
# Comandos de Docker Utiles:
# - docker images : Te Printa un listado de Imagenes que tienes en el sistema
# Ejemplo:
// REPOSITORY   TAG       IMAGE ID       CREATED      SIZE
// node         20        acd15857ce39   7 days ago   1GB
// node         latest    acd15857ce39   7 days ago   1GB
// node         18        acb969b80f38   7 days ago   996MB

# - docker pull [imagen]:[Versión opcional] : Ejemplo docker pull node, se descarga la imagen con el contenedor y sus paquetes.
# - docker image rm [nombre imagen repository] : elimina la imagen
# - docker create [nombre de la imagen] : docker create mongo, se creara el contenedor de esa imagen
#   Esto nos creara un identificador que lo guardaremos en este caso: 6b23d475af6f06afde36b1c450bd02fcaa3126c41274c4e529fb17444b308d39
# - docker start [id del contenedor] : ejemplo docker start 6b23d475af6f06afde36b1c450bd02fcaa3126c41274c4e529fb17444b308d39 con esto tendremos el contenedor ejecutado


# - docker ps es para visualizar una tabla con los contenedores que se estan ejecutando en el pcServer y no hace falta pasar siempre la id larga(6b23d475af6f06afde36b1c450bd02fcaa3126c41274c4e529fb17444b308d39) podemos pasar la corta
// CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS         PORTS       NAMES
// 6b23d475af6f   mongo     "docker-entrypoint.s…"   9 minutes ago   Up 2 minutes   27017/tcp   xenodochial_lovelace

# - docker stop [id] : podemos parar la ejecucion del conteiner usando el id 6b23d475af6f

# - docker ps -a : para visualizar todos los contenedores ejecutados o parados del pcServer
// CONTAINER ID   IMAGE     COMMAND                  CREATED          STATUS                     PORTS     NAMES
// 6b23d475af6f   mongo     "docker-entrypoint.s…"   14 minutes ago   Exited (0) 2 minutes ago             xenodochial_lovelace

# - docker rm [Nombre del contenedor] : Podemos eliminar el contenedor creado usando este comando Ej docker rm xenodochial_lovelace

# - docker create --name [nombre] [repositorio] : Le damos un nuevo nombre al contenedor

# - docker create -p[puerto PcServer de nuestra maquina]:[puerto de la imagen creada] --name [nombre de la imagen]         : mapping de un puerto de nuestra maquina a un contenedor, ya que aunque marque que tiene un puerto en nuestro pcServer no esta abierto
// CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS         PORTS       NAMES
// 6b23d475af6f   mongo     "docker-entrypoint.s…"   9 minutes ago   Up 2 minutes   0.0.0.0:27017->27017/tcp   xenodochial_lovelace

# - docker create -p[puerto PcServer de nuestra maquina] --name [nombre imagen] : si lo dejamos asi lo que ara docker es asignar un puerto automatico de la maquina para que apunte a esta imagen

# - docker logs [nombre de la imagen] : veremos los logs de la imagen 

# - docker logs --follow [nombre imagen] : esto es para ver en directo como van apareciendo logs a la escucha (para salir control+c)

# - docker run [imagen]:[version] : Esto es un todo en uno DESCARGA/CREA/INICIA
# - docker run -d [imagen]:[version] : Esto es un todo en uno DESCARGA/CREA/INICIA pero sin iniciar logs
#--------------------------------------------------
# Poder ejecutar un codigo de un contenedor en la maquina
# Crear un ejemplo de Docker de una mini app en mongo:
# Como asignar una imagen de Docker a un proyecto y configurarla:
# Este ejemplo es el de HolaMundo con js y la imagen de MongoDB

# Primero nos descargamos la imagen con pull
# Ejemplo : le decimos que el puerto 27017 del pcServer apunte al 27017 de la imagen de mongo, le ponemos un nombre al contenedor creado y le pasamos las variables de entorno para configurar la BBDD.
# docker create -p27017:27017 --name monguito -e MONGO_INITDB_ROOT_USERNAME=nico -e MONGO_INITDB_ROOT_PASSWORD=password mongo
# despues lo iniciamos con start y apareceria esto con docker ps
// CONTAINER ID   IMAGE     COMMAND                  CREATED              STATUS          PORTS                      NAMES
// c94473486dfd   mongo     "docker-entrypoint.s…"   About a minute ago   Up 10 seconds   0.0.0.0:27017->27017/tcp   monguito


#--------------------------------------------------
# 4) DOCKERFILE

# DOCKERFILE : es el archivo obligatorio para añadir nuestra app dentro de un contenedor

# es un archivo para autogenerar los contenedores dentro de un proyecto:
# Hay que especificar lo siguiente:

# Esto es para indicar en que se basa la Imagen en este caso node, y despues de los : el tag de la imagen a la que hace referencia
// FROM node:18

# Ahora tendriamos que crear una carpeta donde se guarde nuestra imagen
# Esta carpeta no es de nuestra maquina fisica, es del contenedor de linux
# En esa carpeta app es donde guardaremos todo el proyecto
// RUN mkdir -p /home/app

# Pero para que funcione el codigo de run que es el sistema linux hay que decirle de donde copiara los archivos del proyecto.
# En nuestro caso los copiara de una carpeta de nuestro sistema fisico situada en
// COPY . /home/app

# esto esta indicando que el contenedor estara escuchando el puerto en este caso 3000
// EXPOSE 3000

# esto ejecutara un comando cuando nuestro contenedor se inicie, aqui lo que ara sera ejecutar nuestro archivo index.js
// CMD ["node", "/home/app/index.js"]

# Estando en la ruta de Dockerfile
# COMANDO para crear una imagen de un contenedor a partir de un archivo DOCKERFILE : docker build -t [nombre]:[tag lo que queramos] [Ruta por ejemplo: . es donde te encuentras]
# podemos hacer un ls para encontrar el dockerfile


#--------------------------------------------------
# 5) Agrupar por redes los contenedores
# Como conectar contenedores entre ellos mismos y no con el host PCserver que ya lo hemos hecho.

# Para agrupar contenedores hay que agruparlos en una red interna en la que añadiremos los contenedores que queremos y con esto todos los contenedores se veran entre si.
# Tambien podemos tener multiples redes de contenedores
# COMANDO para ver las redes de Docker: docker network ls

# COMANDO para crear una red : docker network create [nombre de red]
# COMANDO para eliminar una red : docker network rm [nombre de red]

# Para asignar un contenedor a nuestra red se hace en el momento de create EJEMPLO : 
# docker create -p27017:27017 --name monguito --network [mired] [variables de entorno] [Nombre imagen]
# docker create -p3000:3000 --name [nombre] --network [mired] [variables de entorno] [nombre]:[tag]
# Como estaran dentro de la misma red se podran ver entre ellos

#--------------------------------------------------
# 6) Docker compose

# Es un archivo el cual tiene que estar junto con Dockerfile y se llama docker-compose.yml 
# esta guardado como archivo yaml que es un lenguaje de configuraciones.


# Primero especificamos la sintaxis de la versión de DockerCompose
//version: "3.8"

# Luego especificamos el services: el servicio
//services:

# y es obligatorio tabular 

# Por ultimo especificamos el nombre de los contenedores y todo lo que tendran
# EJEMPLO COMPLETO:

// version: "3.9"

// services:
//   App_lluis:
//     build: .
//     ports:
//       - "3000:3000"
//     links:
//       - bbdd_lluis

//   bbdd_lluis:
//     image: mongo
//     ports:
//       - "27017:27017"
//     environment:
//       - MONGO_INITDB_ROOT_USERNAME=nico
//       - MONGO_INITDB_ROOT_PASSWORD=passwod


# Una vez teniendo el docker-compose montado, hay que saber usarlo con los siguientes comandos:
# docker compose up : Se encarga de contruir todo los contenedores y ejecutarlos todo en uno

