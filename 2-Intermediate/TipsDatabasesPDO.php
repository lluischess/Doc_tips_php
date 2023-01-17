<?php

# INDEX 
# 1) MySQL
# 2) Install mysql en Docker
# 3) Herramientas Gestoras de BBDD
# 4) BBDD y PHP
# 5) Enable PDO with mySQL
# 6) PDO connection and Uses
# 7) Injection SQL




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
# 4) BBDD y PHP

# Existen 2 maneras de trabajar con bbdd en php una es l MySQLi y la otra es la PDO
# Imagen con Esquema: C:\wamp64\www\php_Docs\2-Intermediate\BBDD y PHP.PNG

#----------------------------------------------------------------------------------------------------------------------------------------------
# 5) Enable PDO with mySQL

# Para comprobar si podemos usar PDO en PHP tenemos que verificar que el Driver este Activo
# Si miramos phpinfo() y buscamos PDO si aparece es que ya lo tenemos activo
phpinfo();
# si el output nos sale solo con sqlite tendremos que habilitar el driver mysql | deveria salir asi con el driver instalado: PDO drivers => mysql, sqlite
# simplemente en el PHP hay que descomentar esta linea: extension=pdo_mysql y resetear el server
# o si usamos docker este comando: docker-php-ext-install pdo pdo_mysql

#----------------------------------------------------------------------------------------------------------------------------------------------
# 6) PDO connection and Uses

# En este caso crearemos una clase para crear objetos de la base de datos con PDO


# Lo usaremos en la HomeController ej

class HomeController
{
    public function index(): View
    {
        // Si usamos un Docker y tenemos un contenedor con un nombre por ejemplo db, sustitumos el host=db
        # IMPORTANTE: si hay un problema de credenciales el mensaeje de error mostrara contraseña etc, para evitar eso hay que hacer u ntry catch y modificar el mensaje del error
        try{
            $db = new PDO('mysql:host=localhost;dbname=store_db','root','', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH // podemos configurar un sistema de fetch para todos los fetch es opcional a gustos
            ]); // ESTA class PDO ya existe // tiene otro parametra para pasar una lista de opciones 
        } catch(\PDOException $error){
            throw new \PDOException($error->getMessage(),$error->getCode()); // Aqui solo printamos el mensaje y el code asi evitamos el $error->errorInfo que da mucha mas información
        }
        //var_dump($db);

        
        // Podemos realizar una query de la sigiente manera:
        # EJEMPLO 1
        $query = 'SELECT * FROM products'; // sentencia SQL

        $data_query = $db->query($query); // Guarda el resultado de la query ejecutada
        
        var_dump($data_query->fetchAll(PDO::FETCH_OBJ));// devuelve un array por rows de la consulta, el fetchall tiene parametros para poder devolverlo como un array de objetos

        # EJEMPLO 2 iteramos la select
        foreach($db->query($query) as $product)
        {
            echo '<per>';
            var_dump($product);
            echo '</per>';
        }
        #----------------------------------------------------------------------------------------------------------------------------------------------
        # 7) Injection SQL

        # Si queresmos trabajar con querys es todo correcto pero hay una cosa IMPORTANTE
        # Si trabajamos con contraseñas o usuarios la function query es vulnerable a injection SQL

        # EJEMPLO

        # Imaginate que tenemos lo siguiente:
        $email = $_GET['email']; // lo cogemos del get que proporciona el usuario o post
        $query2 = 'SELECT * FROM users WHERE email = "'. $email .'"';

        # La dirección seria algo asi: www.tuweb.com/?email=admin@admin.com

        # El atacante por GET podria añadir esto en la URL:
        # www.tuweb.com/?email=admin@admin.com"+OR+1=1+--+ 
        # con eso esta completando el Get que añadimos a la query y va hacer que le devuelva todos los usuarios
        echo $query2;

        foreach($db->query($query2) as $user)
        {
            echo '<per>';
            var_dump($user);
            echo '</per>';
        }

        # SOLUCION AL SQL Injection:
        # Lo mejor es realizar un Placholder con variables en la sentencia de esta manera:
        # EJEMPLO 1:
        $query3 = 'SELECT * FROM users WHERE email = ?'; // el ? se sustituira por la variable que le añadamos en el execute
        $prepare = $db->prepare($query3);// para retornar el objeto y poder ejecutar la sentencia con el execute
        $prepare->execute([$email]);
        // Luego lo recorremos
        foreach($prepare->fetchAll() as $user)
        {
            echo '<per>';
            var_dump($user);
            echo '</per>';
        }

        # EJEMPLO 2 con INSERT:

        $email = 'admin@admin.com';
        $name = 'admin';
        $rol = 'admin';
        $createdAt = date('Y-m-d :H:m:i', strtotime('07/11/2021 9:00PM'));

        $query = 'INSERT INTO users(email, name_u, rol, createdAt)
                                VALUES (?,?,?,?)';
        $prepare = $db->prepare($query);// para retornar el objeto y poder ejecutar la sentencia con el execute
        $prepare->execute([$email, $name, $rol, $createdAt]); // asi insertariamos el usuario
        
        # Otro Ejemplo
        // obtenemos el id del ultimo isertado:
        $id = (int) $db->lastInsertId();
        // Obtenemos el ID del usuario que queremos del ultimo
        $user = $db->query('SELECT * FROM users WHERE id=' . $id)->fetch();
        // Luego lo printamos
        var_dump($user);
         

         # Con los dos ejemplos anteriores lo resolveriamos la Injection pero tambien es muy lioso si tenemos muchos valores o si los desordenamos
         # EJEMPLO 2 modificado a mejor:
        $query = 'INSERT INTO users(email, name_u, rol, createdAt)
                  VALUES (:email,:name,:rol,:date)';
        $prepare = $db->prepare($query);// para retornar el objeto y poder ejecutar la sentencia con el execute
        $prepare->execute([
            'email' => $email,
            'name' => $name,
            'rol' => $rol,
            'date' => $createdAt]); // No hace falta que esten por orden de los parametros el rol puede ir primero o donde sea igual que los otros

        return View::home('index');
    }
}

class View 
{
    static public function home($view)
    {
        return $view;
    }
}

#----------------------------------------------------------------------------------------------------------------------------------------------


#----------------------------------------------------------------------------------------------------------------------------------------------


#----------------------------------------------------------------------------------------------------------------------------------------------


#----------------------------------------------------------------------------------------------------------------------------------------------


#----------------------------------------------------------------------------------------------------------------------------------------------
