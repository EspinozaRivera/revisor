#Validador
Servicio para la validacion de documentos mediante usuarios validadores.

***

##Requisitos
~~~
Composer 2.5.*
Laravel Framework 8.*
php 7.*
Apache 2.4.*
MySQL 7.*
~~~

***

##Instalacion
Es necesario tener el ***.env*** confirgurado antes de comensar con la instalacion
eso incluye la configuracion de la **BD** y el **MAIL**.
Ejecutar los siguienes comandos desde la carpeta raiz del proyecto
1. composer install
2. php artisan jwt:secret
3. php artisan migrate:fresh --seed

***

##Ejecutar servidor
Se ejecuta el siguiente comando dentro de la carpeta raíz del proyecto
~~~
php artisan serve
~~~

***
##Referencias
* [Repositorio del proyecto](https://github.com/EspinozaRivera/revisor)
* [Curso de Laravel](https://youtube.com/playlist?list=PLZ2ovOgdI-kWWS9aq8mfUDkJRfYib-SvF)
* [Sptie](https://spatie.be/docs/laravel-permission/v4/introduction)
* [JWT](https://jwt-auth.readthedocs.io/en/develop/)

###Credenciales
correosvalidatoruas@gmail.com
Laravel777@

***

#Endpoints

##Login

>Tipo: **POST** 
>http://localhost:8000/api/auth/login

>Requiere Bearer token: **sí**

Body:
~~~
{
    "email":"usuario@dominio.com",
    "password":"password"
}
~~~

***

##Logout

>Tipo: **POST** 
>http://localhost:8000/admin/logout

>Requiere Bearer token: **sí**

***

##Me

Obtiene informacion del usuario

>Tipo: **POST** 
>http://localhost:8000/api/admin/me

>Requiere Bearer token: **sí**

***

##Usuarios

###Listado de usuarios

Obtiene el listado de usuarios
>Tipo: **GET** 
>http://localhost:8000/api/admin/usuarios

>Requiere Bearer token: **sí**

***

###Usuario

Obtiene informacion de 1 usuario en especifio indicando el **ID** dentro de la URL

>Tipo: **GET** 
>http://localhost:8000/api/admin/usuarios/1

>Requiere Bearer token: **sí**

