<?php

class Notificacion extends Conectar
{
    // Propiedad para almacenar la conexión
    private $conectar;

    // Constructor de la clase iniciando la conexión
    public function __construct()
    {
        $this->conectar = parent::conexion();
        parent::set_names();
    }



    /**
     * Fecha actual
     */
    public function fecha_hora_actual()
    {
        return new DateTime(); // Fecha y hora actual
    }



    /**
     * Obtener usuario
     */
    public function get_user($id_usuario)
    {
        $sql = "SELECT * FROM ".CONTROLADOR_TABLA."_usuario WHERE id_usuario = ?";
        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $id_usuario);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }



    /**
     * Función para mostrar los datos
     */
    public function get_notificacion($id_usuario, $id_rol)
    {
        $resultado = $this->get_user($id_usuario);

        if ($resultado !== false) {

            $fechaCreacion_usuario = $resultado["fechaCreacion_usuario"];

            $sql = "SELECT * FROM ".CONTROLADOR_TABLA."_notificacion AS N
                WHERE COALESCE(N.grupo_notificacion, ?) = ?
                AND COALESCE(N.id_usuario_destino, ?) = ?
                AND COALESCE(N.id_usuario_exclusion, !?) != ?
                AND NOT EXISTS (
                    SELECT 1 
                    FROM ".CONTROLADOR_TABLA."_archivo_notificacion AS AN
                    WHERE AN.id_notificacion = N.id_notificacion
                        AND AN.id_usuario = ?
                )
                AND N.fechaCreacion_notificacion >= STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')
            ORDER BY N.fechaCreacion_notificacion DESC";

            $sql = $this->conectar->prepare($sql);
            $sql->bindValue(1, $id_rol);
            $sql->bindValue(2, $id_rol);
            $sql->bindValue(3, $id_usuario);
            $sql->bindValue(4, $id_usuario);
            $sql->bindValue(5, $id_usuario);
            $sql->bindValue(6, $id_usuario);
            $sql->bindValue(7, $id_usuario);
            $sql->bindValue(8, $fechaCreacion_usuario);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        } else {
            return array();
        }
    }




    /**
     * Obtener el número total por usuario
     */
    public function get_total_notificaciones($id_usuario, $id_rol)
    {
        $resultado = $this->get_user($id_usuario);

        if ($resultado !== false) {

            $fechaCreacion_usuario = $resultado["fechaCreacion_usuario"];

            $sql = "SELECT COUNT(*) as total FROM ".CONTROLADOR_TABLA."_notificacion AS N
                WHERE COALESCE(N.grupo_notificacion, ?) = ?
                    AND COALESCE(N.id_usuario_destino, ?) = ?
                    AND COALESCE(N.id_usuario_exclusion, !?) != ?
                    AND NOT EXISTS (
                        SELECT 1 
                        FROM ".CONTROLADOR_TABLA."_archivo_notificacion AS AN
                        WHERE AN.id_notificacion = N.id_notificacion
                            AND AN.id_usuario = ?
                    )
                    AND N.fechaCreacion_notificacion >= STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')";

            $sql = $this->conectar->prepare($sql);
            $sql->bindValue(1, $id_rol);
            $sql->bindValue(2, $id_rol);
            $sql->bindValue(3, $id_usuario);
            $sql->bindValue(4, $id_usuario);
            $sql->bindValue(5, $id_usuario);
            $sql->bindValue(6, $id_usuario);
            $sql->bindValue(7, $id_usuario);
            $sql->bindValue(8, $fechaCreacion_usuario);
            $sql->execute();
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);

            return $resultado['total'];

        } else {
            return array();
        }
    }



    /**
     * Archivar por ID
     */
    public function archive_notificacion($id_notificacion, $id_usuario)
    {
        $sql = "INSERT INTO ".CONTROLADOR_TABLA."_archivo_notificacion (id_notificacion, id_usuario, fecha_archivoNotificacion) 
                values (?, ?, NOW())";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $id_notificacion);
        $sql->bindValue(2, $id_usuario);
        if ($sql->execute()) {
            return [
                "status" => "success",
                "message" => "Se archivo la notificación correctamente."
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No se pudo archivar la notificación. Inténtalo de nuevo."
            ];
        }
    }




    /**
     * Eliminar notificaciones (Mensual - uno a uno)
     */
    public function delete_notifications()
    {
        $fechaActual = $this->fecha_hora_actual();
        $fechaLimite = $fechaActual->sub(new DateInterval('P1M'))->format('Y-m-d H:i:s'); //Resta 1 mes

        $sql_notificacion = "DELETE FROM ".CONTROLADOR_TABLA."_notificacion 
                             WHERE fechaCreacion_notificacion < ?";

        $sql_notificacion = $this->conectar->prepare($sql_notificacion);
        $sql_notificacion->bindValue(1, $fechaLimite);
        $sql_notificacion->execute();

        $sql_notificacion_archivo = "DELETE FROM ".CONTROLADOR_TABLA."_archivo_notificacion 
                                     WHERE fecha_archivoNotificacion < ?";
                                     
        $sql_notificacion_archivo = $this->conectar->prepare($sql_notificacion_archivo);
        $sql_notificacion_archivo->bindValue(1, $fechaLimite);
        $sql_notificacion_archivo->execute();
    }



    // Variables por defecto
    private $icono;
    private $btn_nombre;
    private $btn_funcion;

    /**
     * Funcion general para notificaciones
     */
    public function add_notification($id_usuario, $id_rol, $titulo, $mensaje, $id_usuario_destino, $id_usuario_exclusion)
    {
        $sql = "INSERT INTO ".CONTROLADOR_TABLA."_notificacion (icon_notificacion, titulo_notificacion, mensaje_notificacion, 
                                            btnNombre_notificacion, btnFuncion_notificacion, grupo_notificacion, 
                                            id_usuario, id_usuario_destino, id_usuario_exclusion, fechaCreacion_notificacion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $this->icono);
        $sql->bindValue(2, $titulo);
        $sql->bindValue(3, $mensaje);
        $sql->bindValue(4, $this->btn_nombre);
        $sql->bindValue(5, $this->btn_funcion);
        $sql->bindValue(6, $id_rol);
        $sql->bindValue(7, $id_usuario);
        $sql->bindValue(8, $id_usuario_destino);
        $sql->bindValue(9, $id_usuario_exclusion);
        $sql->execute();
    }



    /**
     * Descargar
     */
    public function download_notification()
    {
        $this->icono = 'download';
        $this->btn_nombre = 'Aceptar';
        $this->btn_funcion = 'archivar';
    }

    /**
     * Cargar
     */
    public function up_notification()
    {
        $this->icono = 'up';
        $this->btn_nombre = 'Ir';
        $this->btn_funcion = 'up';
    }

    /**
     * Exito
     */
    public function success_notification()
    {
        $this->icono = 'success';
        $this->btn_nombre = 'Aceptar';
        $this->btn_funcion = 'archivar';
    }

    /**
     * Edit
     */
    public function edit_notification()
    {
        $this->icono = 'edit';
        $this->btn_nombre = 'Aceptar';
        $this->btn_funcion = 'archivar';
    }

    /**
     * AddUser
     */
    public function addUser_notification()
    {
        $this->icono = 'adduser';
        $this->btn_nombre = 'Aceptar';
        $this->btn_funcion = 'archivar';
    }

    /**
     * Password
     */
    public function password_notification()
    {
        $this->icono = 'password';
        $this->btn_nombre = 'Cambiar';
        $this->btn_funcion = 'redireccion';
    }

    /**
     * Error
     */
    public function error_notification()
    {
        $this->icono = 'error';
        $this->btn_nombre = 'Aceptar';
        $this->btn_funcion = 'archivar';
    }

    /**
     * Advertencia
     */
    public function warning_notification()
    {
        $this->icono = 'warning';
        $this->btn_nombre = 'Ver';
        $this->btn_funcion = 'warning';
    }

    /**
     * Mensaje
     */
    public function message_notification()
    {
        $this->icono = 'message';
        $this->btn_nombre = 'Ver';
        $this->btn_funcion = 'email';
    }

    /**
     * Tiempo
     */
    public function time_notification()
    {
        $this->icono = 'clock';
        $this->btn_nombre = 'Ir';
        $this->btn_funcion = 'clock';
    }



    /**
     * Notificacion descarga documento
     */
    public function notificacionDescarga_documento($filtro, $id_usuario, $id_rol, $nombre_documento, $estado_documento, $extencion_archivo)
    {
        if ($extencion_archivo != '') {
            $titulo = 'Descarga' . ' - ' . $nombre_documento . ($filtro !== '' ? '_' . $filtro : '') . '_' . $estado_documento . $extencion_archivo;
            $mensaje = 'Se descargo el documento correctamente.';
            $id_usuario_destino = $id_usuario;
            $id_usuario_exclusion = null;

            $this->download_notification();
            $this->add_notification($id_usuario, $id_rol, $titulo, $mensaje, $id_usuario_destino, $id_usuario_exclusion);
        }
    }



    /**
     * Notificacion para cuando se agrega un nuevo usuario a los demas usuarios menos al que genera la acción
     */
    public function notificacion_add_user($id_usuario, $id_rol, $id_usuario_nuevo)
    {
        $resultado = $this->get_user($id_usuario);
        $resultado2 = $this->get_user($id_usuario_nuevo);

        if ($resultado) {
            $nombre_usuario = $resultado['nombre_usuario'];
            $apellidoPaterno_usuario = $resultado['apellidoPaterno_usuario'];

            $dni_usuario_nuevo = $resultado2['dni_usuario'];

            $titulo = $nombre_usuario . ' ' . $apellidoPaterno_usuario . ' agregó un usuario';
            $mensaje = 'Identificación del nuevo usuario: ' . $dni_usuario_nuevo;
            $id_usuario_destino = null;
            $id_usuario_exclusion = $id_usuario;

            $this->addUser_notification();
            $this->add_notification($id_usuario, $id_rol, $titulo, $mensaje, $id_usuario_destino, $id_usuario_exclusion);
        }

        if ($resultado2) {
            $id_usuario = null;

            // Notificacion de bienvenida
            $nombre_usuario_nuevo = $resultado2['nombre_usuario'];
            $apellidoPaterno_usuario_nuevo = $resultado2['apellidoPaterno_usuario'];

            $titulo = 'Bienvenid@ ' . $nombre_usuario_nuevo . ' ' . $apellidoPaterno_usuario_nuevo;
            $mensaje = 'Ahora agradecemos tu suscripción!.';
            $id_usuario_destino = $id_usuario_nuevo;
            $id_usuario_exclusion = null;

            $this->success_notification();
            $this->add_notification($id_usuario, $id_rol, $titulo, $mensaje, $id_usuario_destino, $id_usuario_exclusion);

            // Notificacion de cambio de clave
            $titulo = 'Cambiar contraseña';
            $mensaje = 'Te recomendamos que cambies tu contraseña';
            $this->password_notification();
            $this->add_notification($id_usuario, $id_rol, $titulo, $mensaje, $id_usuario_destino, $id_usuario_exclusion);
        }
    }



    /**
     * Notificacion para cuando se elimine un usuario
     */
    public function notificacion_delete_user($id_usuario, $id_rol, $id_usuario_nuevo)
    {
        $resultado = $this->get_user($id_usuario);
        $resultado2 = $this->get_user($id_usuario_nuevo);

        if ($resultado && $resultado2) {
            $nombre_usuario = $resultado['nombre_usuario'];
            $apellidoPaterno_usuario = $resultado['apellidoPaterno_usuario'];

            $dni_usuario_nuevo = $resultado2['dni_usuario'];

            $titulo = $nombre_usuario . ' ' . $apellidoPaterno_usuario . ' eliminó un usuario';
            $mensaje = 'Identificación del nuevo usuario: ' . $dni_usuario_nuevo;
            $id_usuario_destino = null;
            $id_usuario_exclusion = $id_usuario;

            $this->error_notification();
            $this->add_notification($id_usuario, $id_rol, $titulo, $mensaje, $id_usuario_destino, $id_usuario_exclusion);
        }
    }
}