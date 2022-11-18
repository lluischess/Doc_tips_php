<?php

# INDEX 
# 1) php.ini & configuration
# 2) error_reporting, error_log, display_errors
# 3) max_execution_time - memory_limit - file_uploats - upload_max_filesize
# 4) 



#----------------------------------------------------------------------------------------------------------------------------------------------
# 1) php.ini & configuration

# podemos usar ini_get() para obtener el estado del valor que esta configurado en el php.ini con la siguiente lista de 
#https://www.php.net/manual/en/ini.list.php
#https://www.php.net/manual/en/ini.core.php
//echo ini_get('');
# tambien podemos settear las onfiguraciónes con ini_set() pero luego hay que reiniciar apache
//echo ini_set('s',1);
#----------------------------------------------------------------------------------------------------------------------------------------------
# 2) error_reporting, error_log, display_errors

// ; Default Value: E_ALL
// ; Development Value: E_ALL
// ; Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT
# por ejemplo podriamos quitar los warnings
//ini_set('error_reporting', E_ALL & ~E_WARNING);

// ; Default Value: On
// ; Development Value: On
// ; Production Value: Off
// ; http://php.net/display-errors
// display_errors = On

// ; Log errors to specified file. PHP's default behavior is to leave this value
// ; empty.
// ; http://php.net/error-log
// ; Example:
// error_log ="c:/wamp64/logs/php_error.log"

#----------------------------------------------------------------------------------------------------------------------------------------------
# 3) max_execution_time - memory_limit - file_uploats - upload_max_filesize

# max_execution_time es para que los scripts php tengan un limite de tiempo de ejecución

# memory_limit es la maxima cantidad de memoria que un script puede consumir

# file_uploats es para activar la carga de archivos en php 

# upload_max_filesize el maximo de peso de un archivo cargado

#----------------------------------------------------------------------------------------------------------------------------------------------

#----------------------------------------------------------------------------------------------------------------------------------------------