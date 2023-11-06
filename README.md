# Estructura-Web-PHP
Estructura de pagina web con manejo de sesiones, CRUD, notificaciones, temporizador de sesión, manejo de usuarios

## Características

- Manejo de sesiones de usuario
- Operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en la base de datos MySQL
- Uso de tecnologías web como PHP, JS, jQuery, AJAX, SCSS
- Sistema de notificaciones
- Temporizador de sesión para gestionar el tiempo de inactividad del usuario
- Manejo de usuarios y roles

## Requisitos del Sistema

- PHP 7.x
- Servidor web (por ejemplo, Apache)
- MySQL
- Xampp (Recomandado)

## Instalación

1. Clona el repositorio: `git clone https://github.com/JosueAVD27/Estructura-Web-PHP.git`
2. Configura la base de datos en `Front-end/configs/connections/connection.php`
3. Importa el esquema de la base de datos desde `Database/DDL.sql` y `Database/DML.sql` 
4. Inicia el servidor web y abre la plataforma en tu navegador.

## Estructura del Proyecto

- `Database`: Esquema de la base de datos
- `/assets/scss/`: Archivos SCSS
- `/assets/css/`: Estilos CSS resultantes
- `/assets/js/`: Archivos JavaScript y jQuery
- `/configs/`: Configuraciones del sistema, incluyendo la conexión a la base de datos y gestion de rutas
- `/includes`: Componententes, diseños generales de lapagina y modals
- `/controllers`: Controladores de gestion por parte del servidor
- `/models`: Consultas directas a la base de datos
- `/index.php`: Lógica de la aplicación
- `/.htaccess`: Archivo de configuración
- `/update_scss.bat`: Codigo de ejecucción solo de los scss necesarios (Actualizacion masiva)
- `/index.php`: Lógica de la aplicación


## Uso

Se tiene 2 logins unno para administrador y otro para usuario, donde en el de administrador se debe agregar un correo y una contraseña, el usuario tendra su propio login donde pogra ingresar por medio de su identificaión sin necesidad de contraseña y en el caso de no tener una cuenta podra registrarse ubicando sus datos, tambien existe un boton para ingresar como invitado. Una ves logueado el usuario dependiendo de su rol tendra diferentes vistas en el caso de administrador tendra una vista mas avanzada donde podra ver todos los usuarios que existen, modificarlos, eliminarlos y asignar mas administradores. Todos los usuarios a excepcion del invitado podra editar su perfil agregando una foto que desee o cambiar algunos datos que tenga permitido. Esta solo es una estructura para una plataforma por lo que no se tiene mas contenido adicional.

## Licencia

Este proyecto está bajo la Licencia BSD 3-Clause. Ver el archivo LICENSE.md para más detalles.

## Contacto

- Autor: Josue Velasquez
- Email: josue27.velasquez9@gmail.com
- Sitio Web: https://armandovelasquez.com