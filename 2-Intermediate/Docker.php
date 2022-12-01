<?php

# INDEX 
# 1) Que es Docker?
# 2) 
# 3) 
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Que es Docker?

# Es un es una herramienta para contenedores, se instala en cada servidor y desde el puedes habilitar o deshabilitar los contenedores adecuados para ese servidor
# Ejemplo

# Podemos tener 3 clientes con estas caracteristicas de servidor:
# Cliente 1: Nginx php 8.0 MySQL 8 Redis 6.2 curl
# Cliente 2: Apache php 7.4 MySQL 5.6 Configurations
# CLiente 3: Apache php 7.3 Mysql 5.6 Configurations

# Pues con docker lo que podemos hacer es crear containers para cada uno de estos web servers, entonces al desplegar el programa al cliente habilitariamos el contenedor indicado

# Una Imagen de Docker contiene los Containers
# Estas Imagenes deben estar instaladas en Producción y en Local o pruebas asi podremos crear los contenedores segun el web server donde estamos

