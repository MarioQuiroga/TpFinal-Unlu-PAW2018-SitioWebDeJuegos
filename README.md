# Guia de instalación

Este sitio de juegos, se desarrolló como trabajo final para la materia Programación en ambiente web, de la lic. en Sistemas de Información, de la Universidad Nacional de Luján (Arg).
A continuación, se describen las dependencias necesarias para el proyecto en su máquina local.

## PHP
Descargue la ultima versión disponible de php, ingresando en el siguiente enlace: http://php.net/downloads.php

## Composer
Descargue el gestor de paquetes Composer, ingresando en el siguiente enlace: https://getcomposer.org/download/

## Clonar y configurar el repositorio de este proyecto
Luego de descargar este proyecto, en la carpeta raiz del proyecto buscar el archivo .env.example. Con este archivo, cree un nuevo archivo, en la misma carpeta, llamado ".env". Luego, en el archivo .env, busque y complete las siguientes lineas.
    * APP_KEY= Solicitar a los desarrolladores.  
    * DB_CONNECTION= Iniciales de su Sistema gestor de Base de Datos. Ejemplos: pgsql, mysql.
    * DB_HOST=127.0.0.1
    * DB_PORT= Puerto donde escucha el Sistema gestor de Base de Datos.
    * DB_DATABASE= Nombre de la base de datos en su máquina local.
    * DB_USERNAME= Usuario de su Sistema gestor de Base de Datos.
    * DB_PASSWORD= Contraseña de su Sistema gestor de Base de Datos.

## Levantar el servicio
Para levantar el servidor en su máquina local, abra una terminal, y ejecute los siguientes comandos.

* Instalar las dependencias del proyecto através de composer:
``` 
composer install
```
* Migrar la base de datos a su máquina local
``` 
php artisan migrate --seed   
```
* Levantar el servidor provisto por Laravel.
``` 
php artisan serve 
```
