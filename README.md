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

## Configuración (Producción)
Hay varias configuraciones que se debe agregar en el caso de que la aplicacion pase a produccion, algunas estan debidamente comentadas en el archivo en cuestión pero se hara mencion en este apartado.
- `index.php`: Se debe asignar a la variagle de $url la variable $request_uri
- `configs/connections/connection.php`: Se debe cambiar las credenciales de la base de datos y tambien al final las rutas principales del proyecto junto con el controlador de las tablas de la base de datos y el tiempo de la sesión.
- `assets/js/structure/routes.js`: Se debe cambiar el valor especificado en la funcion definirNivel() de 5 a 3.

## Uso

Se tiene 2 logins unno para administrador y otro para usuario, donde en el de administrador se debe agregar un correo y una contraseña, el usuario tendra su propio login donde pogra ingresar por medio de su identificaión sin necesidad de contraseña y en el caso de no tener una cuenta podra registrarse ubicando sus datos, tambien existe un boton para ingresar como invitado. Una ves logueado el usuario dependiendo de su rol tendra diferentes vistas en el caso de administrador tendra una vista mas avanzada donde podra ver todos los usuarios que existen, modificarlos, eliminarlos y asignar mas administradores. Todos los usuarios a excepcion del invitado podra editar su perfil agregando una foto que desee o cambiar algunos datos que tenga permitido. Esta solo es una estructura para una plataforma por lo que no se tiene mas contenido adicional.

## Licencia

Este proyecto está bajo la licencia [Licencia BSD 3](LICENSE).

## Contacto

- Autor: Josue Velasquez
- Email: josue27.velasquez9@gmail.com
- Sitio Web: https://armandovelasquez.com
- Plataforma: http://plataforma.armandovelasquez.com
