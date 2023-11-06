<?php
class Globals extends Conectar
{    
    // Propiedad para almacenar la conexión
    protected $conectar;

    // Variables globales
    protected $G_rol_user;
    protected $G_rol_admin;
    protected $G_estado_activo;
    protected $G_estado_inactivo;


    // Constructor de la clase iniciando la conexión
    public function __construct()
    {
        // Variables globales
        include '../../configs/global/vars.php';

        $this->G_rol_user = $G_rol_user;
        $this->G_rol_admin = $G_rol_admin;
        $this->G_estado_activo = $G_estado_activo;
        $this->G_estado_inactivo = $G_estado_inactivo;

        // Conexion a la base de datos
        $this->conectar = parent::conexion();
        parent::set_names();
    }
}

