<?php

# INDEX 
# 1) Server Apache configure file
# 2) Virtual host
# 3) htaccess files
# 4) Nginx
# 5) Apache vs Nginx



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) Server Apache configure file

# Normalmente la configuración de apache esta en esta ruta:
//usr/local/apache2/conf/httpd.conf

# Log ruta
//var/log/httpd
#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) Virtual host

# En extras tenemos un archivo donde podemos configurar diferentes virtual hosts otros dominios
# Podemos hacer funcionar multiples paginas web en un solo servidor, podemos hacer funcionar multimes web en una solo maquina con multiples ips
# Todas las configuraciones en apache necesitan resetear los servicios
//usr/local/apache2/conf/extra/httpd-vhost.conf

# Configurar virtual host en local:
#examples: 
// <VirtualHost *:80>
// 	DocumentRoot "C:/xampp/htdocs/m2multi1/pub"
// 	ServerName m2multi1.magento.com
// </VirtualHost>

// <VirtualHost *:80>
// 	DocumentRoot "C:/xampp/htdocs/m2multi2/pub"
// 	ServerName m2multi2.magento.com
// </VirtualHost>

// <VirtualHost *:80>
// 	DocumentRoot "C:/xampp/htdocs/magento244/pub"
// 	ServerName magento244.magento.com
// </VirtualHost>

# Despues hay que configurar que la ip de la maquina apunte a ese server name:
#en la siguiente ruta tenemos el archivo host de la maquina:
# C:\Windows\System32\drivers\etc\hosts.file
// 127.0.0.1 localhost
// 127.0.0.1 m2multi1.magento.com
// 127.0.0.1 m2multi2.magento.com
// 127.0.0.1 magento244.magento.com
// 127.0.0.1 tecnicalbugs.com

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) htaccess files

# Es un archivo para configurar el directorio donde es colocado y los subdirectorios
# Las configuraciónes son inmediatas, no hace falta resetear apache

# Primero de tado saber que la configuración principal la main configuration esta en apache httpd.conf pero como no todos los host te dan acceso a esa configuración para tratar los permisos de carpetas
# tenemos alli el htaccess que se encarga de sobrescribir algunas configuraciones encima del main para esa carpeta en la que esta en concreto

# Si el  AllowOverride esta en None el servidor no estara aciendo peticiones para buscar el htaccess todo el rato, y si no tienes un htaccess mejor dejar esa opcion en none por rapidez

#Ejemplo Explicado con rutas limpias

#htaccess: 
# Primero añadimos la etiqueta mod_rewrite que es donde modificaremos las reglas
// <IfModule mod_rewrite.c>

# Luego aplicamos On en la regla para que realmente si se modifiquen las siguientes reglas
// RewriteEngine On 

# Las siguientes condiciones comprueban que no es en el directorio actual o en el archivo actual, no queremos que el archivo o la carpeta actual procese el js desde aqui o otras cosas
// RewriteCond %{REQUEST_FILENAME} !-d 
// RewriteCond %{REQUEST_FILENAME} !-f 

# esto lo redirige todo a ese archivo, cualquier enlace ira a imprimir el index.php
// RewriteRule ^ /index.php [L]

// </IfModule>

# todos esto tambien se puede aplicar directamente en el hostvirtual
# asi que no es siempre del todo necesario el htaccess

#----------------------------------------------------------------------------------------------------------------------------------------------
# 4) Server Nginx



#----------------------------------------------------------------------------------------------------------------------------------------------
# 5) Apache vs Nginx

# En Apache el php funciona como un modulo mas de apache por ello tiene el archivo mod_php en esta diferencia puede ser un poco mas lentas las llamadas al php module, que se podria solventar con un CDN
# En cambio en Nginx tenemos PHP_FPM este en cambio stands para php mas rapido cgi, como no procesa imagenes ni staticos es mucho mas rapido, el modelo FPM es posible tambien meterlo en apache pero en Nginx biene por defecto

