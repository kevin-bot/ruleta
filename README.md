## About Ruleta
- Este es un proyecto realizado con laravel version 8.23.1 y vueJs.

## Intalación en linux
- Paso 1) Clonar el proyecto
- Paso 2) Ubicarlo el la carpeta raiz de su servidor web Ej: /var/www/html/ruleta
- Paso 3)  Ejecutar composer install
- Paso 4) Crear el archivo .env 
    4.1) Ejecutar touch .env para crear el archivo .env
    4.2) Ejecutar cp .env.example .env 
- Paso 5) Configurar la base de datos mysql
    5.1) En mi caso 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ruleta
    DB_USERNAME=laravel1
    DB_PASSWORD=laravel
    Dicha configuracion depende se su servidor mysql y el usuario.
    * La base esta nombrada como ruleta.sql
    
 
- Paso 4) Ejecutar php artisan key:generate, laravel necesita una llave unica en nuestro proyecto 

    ### Todos los pasos del 3 al 5 son explicados de una mejor forma en el siguiente post 
    https://parzibyte.me/blog/2017/05/29/hacer-despues-clonar-proyecto-laravel/

-paso 5) Ejecuar servidor interno de laravel para ver nuestro projecto
    - php artisan serve
    
 Nota: si llega a tener algun problemas de permisos ver este video
    https://www.youtube.com/watch?v=m-EjyMPUhhY

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# ruleta
