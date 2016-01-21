Administrador de Cursos y Profesores UAI
===================


Esta herramienta sirve para poder generar horarios de profesores de forma dinámica y ordenada. También guarda el historial de asignaciones de cursos pasados. Permite que tanto el administrador y el coordinador de un área particular puedan 

----------


Requisitos de Sistema
-------------

Nuestra aplicación usa principalmente Laravel 5.1 y Mysql para la base de datos.

- PHP >= 5.6
- Mysql 
- Composer
- Apache

 



Instalación
-------------------

Primero hacer un pull del código en la carpeta `{DIR}` luego una vez en `{DIR}` 

1. Preparar el archivo para las variables de ambiente
	
		mv .env.example .env 
		
2. Luego generar una llave para la aplicación y colocarla en `APP_KEY` del archivo .env 
	
		php artisan key:generate
		
3. Instalar los packages que usa la aplicación

		composer install

4. Una vez configurados los parámetros dentro de la base de datos en el archivo .env migrar y sedear la base de datos:
	
		php artisan migrate --seed
		
5. Para probar que todo esté correctamente configurado	

		php artisan migrate --seed