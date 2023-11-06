<?php
// Configurar la zona horaria a Bogotá
date_default_timezone_set('America/Bogota');

// Inicializando la sesion del usuario
SESSION_START();

// Función personalizada para manejar errores
function customErrorHandler($errno, $errstr, $errfile, $errline)
{
    // Loguear el error
    error_log("PHP Error: [$errno] $errstr in $errfile on line $errline");
}

// Configuración del manejador de errores personalizado
set_error_handler("customErrorHandler");
// Iniciamos Clase Conectar
class Conectar
{
    protected $dbh;

    // Funcion Protegida de la cadena de Conexion
    protected function Conexion()
    {
        try {
            $server = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'estructura';

            $conectar = $this->dbh = new PDO("mysql:host=$server;dbname=$database", $username, $password);

            return $conectar;

        } catch (Exception $e) {
            // En Caso hubiera un error en la cadena de conexion
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    // Para impedir que tengamos problemas con las ñ o tildes
    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    // Ruta principal del proyecto
    public static function ruta()
    {
        return 'http://localhost/Estructura_PHP/';
    }
}

// Ruta principal del proyecto
define('RUTA', 'http://localhost/Estructura_PHP/');

// Controlador de la tablade la base de datos
define('CONTROLADOR_TABLA', 'st');

// Definir el tiempo de la sesión
define('TIME_SESSION', 30);