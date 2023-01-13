<?php

# INDEX 
# 1) MySQL
# 2) Install mysql en Docker
# 3) Herramientas Gestoras de BBDD
# 4) PDO



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) MySQL

# MySQL es un sistema de gestión de bases de datos relacional desarrollado

#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Install mysql en Docker

# En el archivo docker-compose.yml añadimos lo siguiente:
# Esta en esta ubicacion apartir de la seccion db:
# C:\wamp64\www\php_Docs\2-Intermediate\TipsOOP\EstructuraProyectoDocker\docker\docker-compose.yml

# Usamos la version de imagen image: mysql:8.0 del docker hub

# en volumes usamos /storage/mysql:/var/lib/mysql
# es por si se destruye el contenedor que no elimine las bases de datos que hay alli

# Luego la pasword del root que es root y los puertos que usa

# una vez añadido todo esto hacemos un rebuild de la imagen del docker para que construya otra vez la composicion y lo instala todo
# COMANDO: docker-compose up -d --build

# podemos hacer un COMANDO: docker ps para ver lo que contiene el docker instalado

# Podemos conectarnos al my sql de la siguiente forma:
# IMAGEN: C:\wamp64\www\php_Docs\2-Intermediate\ConectarMysqlDesdeDockerExe.PNG
#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) Herramientas Gestoras de BBDD

# 1 mysql Workbench
# 2 phpmyadmin
# 3 via comandos mysql desde ssh etc

#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) PDO
