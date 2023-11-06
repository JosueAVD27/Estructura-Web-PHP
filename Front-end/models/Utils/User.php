<?php
// Modelo de notificaciones
require_once '../../models/Utils/components/Notifications.php';
// Variables globales
require_once '../../models/Utils/components/global.php';

class Usuario extends Globals
{
    /**
     * Funcion para login Administrador
     */
    public function login_admin($correo, $pass)
    {
        if (empty($correo) || empty($pass)) {
            // En caso esten vacios correo y contraseña
            return [
                "status" => "error",
                "title" => "Hay campos vacios",
                "message" => "Porfavor, llene todos los campos."
            ];

        } else {
            $sql = "SELECT U.*, R.nombre_rol FROM " . CONTROLADOR_TABLA . "_usuario AS U
                    INNER JOIN " . CONTROLADOR_TABLA . "_rol AS R ON R.id_rol = U.id_rol
                    WHERE correo_usuario = ? AND U.id_estado = ? AND R.id_rol = ?";

            $stmt = $this->conectar->prepare($sql);
            $stmt->bindValue(1, $correo);
            $stmt->bindValue(2, $this->G_estado_activo);
            $stmt->bindValue(3, $this->G_rol_admin);
            $stmt->execute();
            if ($resultado = $stmt->fetch()) {

                // Contraseña verificada con éxito
                if ($resultado && password_verify($pass, $resultado["password_usuario"])) {
                    $_SESSION["id_usuario"] = $resultado["id_usuario"];
                    $_SESSION["nombre_usuario"] = $resultado["nombre_usuario"];
                    $_SESSION["apellidoPaterno_usuario"] = $resultado["apellidoPaterno_usuario"];
                    $_SESSION["dni_usuario"] = $resultado["dni_usuario"];
                    $_SESSION["correo_usuario"] = $resultado["correo_usuario"];
                    $_SESSION["sexo_usuario"] = $resultado["sexo_usuario"];
                    $_SESSION["foto_usuario"] = $resultado["foto_usuario"];
                    $_SESSION["id_rol"] = $resultado["id_rol"];

                    $_SESSION['nombre_rol'] = $resultado["nombre_rol"];

                    return [
                        "status" => "success",
                        "message" => "Dirigir a administrador."
                    ];
                }

                return [
                    "status" => "error",
                    "title" => "Datos invalidos",
                    "message" => "El correo o la contraseña son incorrectos."
                ];

            } else {
                // En caso no coincidan el usuario o la contraseña
                return [
                    "status" => "error1",
                    "title" => "Datos invalidos",
                    "message" => "El correo o la contraseña son incorrectos."
                ];
            }
        }
    }



    /**
     * Funcion para login de estudiantes
     */
    public function login_user($dni_usuario)
    {
        if ($dni_usuario) {

            $sql = "SELECT U.*, R.nombre_rol 
                    FROM " . CONTROLADOR_TABLA . "_usuario AS U
                    INNER JOIN " . CONTROLADOR_TABLA . "_rol AS R ON R.id_rol = U.id_rol
                    WHERE U.dni_usuario = ? and U.id_estado = ? and U.id_rol = ?";

            $stmt = $this->conectar->prepare($sql);
            $stmt->bindValue(1, $dni_usuario);
            $stmt->bindValue(2, $this->G_estado_activo);
            $stmt->bindValue(3, $this->G_rol_user);
            $stmt->execute();
            if ($resultado = $stmt->fetch()) {
                if (is_array($resultado) and count($resultado) !== 0) {

                    $_SESSION["id_usuario"] = $resultado["id_usuario"];
                    $_SESSION["nombre_usuario"] = $resultado["nombre_usuario"];
                    $_SESSION["apellidoPaterno_usuario"] = $resultado["apellidoPaterno_usuario"];
                    $_SESSION["dni_usuario"] = $resultado["dni_usuario"];
                    $_SESSION["correo_usuario"] = $resultado["correo_usuario"];
                    $_SESSION["sexo_usuario"] = $resultado["sexo_usuario"];
                    $_SESSION["foto_usuario"] = $resultado["foto_usuario"];
                    $_SESSION["id_rol"] = $resultado["id_rol"];

                    $_SESSION['nombre_rol'] = $resultado["nombre_rol"];

                    return [
                        "status" => "success",
                        "message" => "Dirigir a inicio."
                    ];
                }
            } else {

                // En caso no coincidan el usuario o la contraseña
                return [
                    "status" => "error1",
                    "title" => "Datos incorrectos",
                    "message" => "Ingresa correctamente tu identificación, si no tienes cuenta regístrate."
                ];
            }

        } else {
            return [
                "status" => "error",
                "title" => "Hay campos vacios",
                "message" => "Porfavor, llene todos los campos."
            ];
        }
    }



    /**
     * Función para mostrar los datos por id
     */
    public function get_usuario_id($id_usuario)
    {
        $sql = "SELECT * FROM " . CONTROLADOR_TABLA . "_usuario 
                WHERE id_usuario = ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $id_usuario);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }



    /**
     * Funcion para actualizar los datos del perfil
     */
    public function update_perfil(
        $id_usuario,
        $nombre_usuario,
        $apellidoPaterno_usuario,
        $apellidoMaterno_usuario,
        $id_pais,
        $dni_usuario,
        $telefono_usuario,
        $sexo_usuario,
        $foto_usuario
    ) {
        $sql = "UPDATE " . CONTROLADOR_TABLA . "_usuario 
                SET
                    nombre_usuario = ?,
                    apellidoPaterno_usuario = ?,
                    apellidoMaterno_usuario = ?,
                    id_pais = ?,
                    dni_usuario = ?,
                    telefono_usuario = ?,
                    sexo_usuario = ?,
                    foto_usuario = ?
                WHERE 
                    id_usuario = ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $nombre_usuario);
        $sql->bindValue(2, $apellidoPaterno_usuario);
        $sql->bindValue(3, $apellidoMaterno_usuario);
        $sql->bindValue(4, $id_pais);
        $sql->bindValue(5, $dni_usuario);
        $sql->bindValue(6, $telefono_usuario);
        $sql->bindValue(7, $sexo_usuario);
        $sql->bindValue(8, $foto_usuario);
        $sql->bindValue(9, $id_usuario);
        if ($sql->execute()) {
            return [
                "status" => "success",
                "message" => "Se actualizó correctamente. Los cambios estarán visibles después de iniciar sesión nuevamente."
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No se pudo actualizar el usuario. Inténtalo de nuevo."
            ];
        }
    }



    /**
     * Insertar un nuevo registro
     */
    public function insert_usuario(
        $nombre_usuario,
        $apellidoPaterno_usuario,
        $apellidoMaterno_usuario,
        $correo_usuario,
        $telefono_usuario,
        $dni_usuario,
        $password_usuario,
        $id_pais,
        $fechaDesactivacion_usuario,
        $id_rol,

        $id_usuario_accion,
        $id_rol_accion
    ) {
        // Cifrar la contraseña utilizando password_hash
        if ($password_usuario === "default") {
            $passwd = $dni_usuario;
        } else {
            $passwd = $password_usuario;
        }
        $password_cifrada = password_hash($passwd, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO " . CONTROLADOR_TABLA . "_usuario (nombre_usuario, apellidoPaterno_usuario, apellidoMaterno_usuario, 
                                            correo_usuario, password_usuario, sexo_usuario, telefono_usuario, dni_usuario, 
                                            id_pais, fechaCreacion_usuario, fechaDesactivacion_usuario, id_rol, id_estado) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?);";

            $sql = $this->conectar->prepare($sql);
            $sql->bindValue(1, $nombre_usuario);
            $sql->bindValue(2, $apellidoPaterno_usuario);
            $sql->bindValue(3, $apellidoMaterno_usuario);
            $sql->bindValue(4, $correo_usuario);
            $sql->bindValue(5, $password_cifrada);
            $sql->bindValue(6, '');
            $sql->bindValue(7, $telefono_usuario);
            $sql->bindValue(8, $dni_usuario);
            $sql->bindValue(9, $id_pais);
            $sql->bindValue(10, $fechaDesactivacion_usuario);
            $sql->bindValue(11, $id_rol);
            $sql->bindValue(12, 1);
            $sql->execute();

            // Notificacion
            $id_usuario = $this->conectar->lastInsertId();
            if ($id_rol_accion == '') {
                $id_rol_accion = $id_rol;
            }

            $notificacion = new Notificacion();
            $notificacion->notificacion_add_user($id_usuario_accion, $id_rol_accion, $id_usuario);

            return [
                "status" => "success",
                "message" => "Se registró correctamente el usuario."
            ];

        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "No se pudo regiatrar el usuario. Inténtalo de nuevo."
            ];
        }
    }



    /**
     * Actualizar el registro
     */
    public function update_usuario(
        $id_usuario,
        $nombre_usuario,
        $apellidoPaterno_usuario,
        $apellidoMaterno_usuario,
        $correo_usuario,
        $sexo_usuario,
        $telefono_usuario,
        $dni_usuario,
        $id_pais,
        $id_rol
    ) {
        $sql = "UPDATE " . CONTROLADOR_TABLA . "_usuario
                SET
                    nombre_usuario = ?,
                    apellidoPaterno_usuario = ?,
                    apellidoMaterno_usuario = ?,
                    correo_usuario = ?,
                    sexo_usuario = ?,
                    telefono_usuario = ?,
                    dni_usuario = ?,
                    id_pais = ?,
                    id_rol = ?
                WHERE
                    id_usuario = ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $nombre_usuario);
        $sql->bindValue(2, $apellidoPaterno_usuario);
        $sql->bindValue(3, $apellidoMaterno_usuario);
        $sql->bindValue(4, $correo_usuario);
        $sql->bindValue(5, $sexo_usuario);
        $sql->bindValue(6, $telefono_usuario);
        $sql->bindValue(7, $dni_usuario);
        $sql->bindValue(8, $id_pais);
        $sql->bindValue(9, $id_rol);
        $sql->bindValue(10, $id_usuario);

        if ($sql->execute()) {
            return [
                "status" => "success",
                "message" => "Se actualizó correctamente el usuario."
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No se pudo actualizar el usuario. Inténtalo de nuevo."
            ];
        }
    }



    /**
     * Funcion para actualizar la contraseña
     */
    public function update_contrasenia(
        $id_usuario,
        $password_usuario
    ) {
        $sql = "UPDATE " . CONTROLADOR_TABLA . "_usuario 
                SET
                    password_usuario = ?
                WHERE 
                    id_usuario = ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $password_usuario);
        $sql->bindValue(2, $id_usuario);
        if ($sql->execute()) {
            return [
                "status" => "success",
                "message" => "Se actualizó la contraseña correctamente."
            ];
        } else {
            return [
                "status" => "error",
                "title" => "Contraseña incorrecta",
                "message" => "No se pudo actualizar la contraseña. Inténtalo de nuevo."
            ];
        }
    }



    /**
     * Obtener lista de todos los registros
     */
    public function get_usuarios_activo($offset, $limit, $filtro)
    {
        $id_estado = $this->G_estado_activo;
        return $this->get_resultados($offset, $limit, $filtro, $id_estado);
    }

    public function get_usuarios_inactivo($offset, $limit, $filtro)
    {
        $id_estado = $this->G_estado_inactivo;
        return $this->get_resultados($offset, $limit, $filtro, $id_estado);
    }

    public function get_resultados($offset, $limit, $filtro, $id_estado)
    {
        $sql = "SELECT * FROM " . CONTROLADOR_TABLA . "_usuario AS U
                INNER JOIN " . CONTROLADOR_TABLA . "_rol AS R ON U.id_rol = R.id_rol      
                INNER JOIN " . CONTROLADOR_TABLA . "_pais AS P ON U.id_pais = P.id_pais  
                WHERE U.id_estado = ?";

        if ($filtro != '') {
            $sql .= " AND (U.nombre_usuario LIKE ? OR U.apellidoPaterno_usuario LIKE ? OR U.dni_usuario LIKE ? OR U.telefono_usuario LIKE ?
                      OR U.correo_usuario LIKE ? OR P.nombre_pais LIKE ? OR P.abreviatura_pais LIKE ? OR R.nombre_rol LIKE ?)";
        }
        $sql .= " ORDER BY U.id_usuario DESC LIMIT ?, ?";

        $sql = $this->conectar->prepare($sql);

        $params = array($id_estado);

        if ($filtro != '') {
            $filtro = '%' . $filtro . '%';
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $offset;
            $params[] = $limit;
        } else {
            $params[] = $offset;
            $params[] = $limit;
        }

        foreach ($params as $key => $value) {
            $sql->bindValue($key + 1, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $sql->execute();

        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }



    /**
     * Conteo y filtrado
     */
    public function get_total_usuarios_activo($filtro)
    {
        $id_estado = $this->G_estado_activo;
        return $this->get_total_usuarios($filtro, $id_estado);
    }

    public function get_total_usuarios_inactivo($filtro)
    {
        $id_estado = $this->G_estado_inactivo;
        return $this->get_total_usuarios($filtro, $id_estado);
    }

    public function get_total_usuarios($filtro, $id_estado)
    {
        $sql = "SELECT COUNT(*) as total FROM " . CONTROLADOR_TABLA . "_usuario AS U
                INNER JOIN " . CONTROLADOR_TABLA . "_rol AS R ON U.id_rol = R.id_rol      
                INNER JOIN " . CONTROLADOR_TABLA . "_pais AS P ON U.id_pais = P.id_pais  
                WHERE U.id_estado = ?";

        if ($filtro != '') {
            $sql .= " AND (U.nombre_usuario LIKE ? OR U.apellidoPaterno_usuario LIKE ? OR U.dni_usuario LIKE ? OR U.telefono_usuario LIKE ?
                      OR U.correo_usuario LIKE ? OR P.nombre_pais LIKE ? OR P.abreviatura_pais LIKE ? OR R.nombre_rol LIKE ?)";
        }

        $sql = $this->conectar->prepare($sql);

        $params = array($id_estado);

        if ($filtro != '') {
            $filtro = '%' . $filtro . '%';
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
            $params[] = $filtro;
        }

        foreach ($params as $key => $value) {
            $sql->bindValue($key + 1, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        return $resultado['total'];
    }



    /**
     * Elimina por ID
     */
    public function delete_usuario($id_usuario, $id_usuario_accion, $id_rol_accion)
    {
        try {
            $this->conectar->beginTransaction(); // Iniciar la transacción

            // Notificacion
            $notificacion = new Notificacion();
            $notificacion->notificacion_delete_user($id_usuario_accion, $id_rol_accion, $id_usuario);

            $sql = "DELETE FROM " . CONTROLADOR_TABLA . "_usuario 
                    WHERE id_usuario = ?";

            $sql = $this->conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();

            // Confirmar la transacción
            $this->conectar->commit();

            return [
                "status" => "success",
                "message" => "Se eliminó el usuario correctamente."
            ];

        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "No se pudo eliminar el usuario. Inténtalo de nuevo."
            ];
        }
    }


    /**
     * Desactivar por ID
     */
    public function desactivar_usuario($id_usuario)
    {
        $sql = "UPDATE " . CONTROLADOR_TABLA . "_usuario 
                    SET 
                        id_estado = ?, 
                        fechaDesactivacion_usuario = NOW() 
                    WHERE 
                        id_usuario = ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $this->G_estado_inactivo);
        $sql->bindValue(2, $id_usuario);
        if ($sql->execute()) {
            return [
                "status" => "success",
                "message" => "Se desactivó el usuario correctamente."
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No se pudo desactivar el usuario. Inténtalo de nuevo."
            ];
        }
    }



    /**
     * Activar por ID
     */
    public function activar_usuario($id_usuario)
    {
        $sql = "UPDATE " . CONTROLADOR_TABLA . "_usuario 
                SET 
                    id_estado = ?, 
                    fechaDesactivacion_usuario = ? 
                WHERE 
                    id_usuario = ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, $this->G_estado_activo);
        $sql->bindValue(2, "");
        $sql->bindValue(3, $id_usuario);
        if ($sql->execute()) {
            return [
                "status" => "success",
                "message" => "Se activó el usuario correctamente."
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No se pudo activar el usuario. Inténtalo de nuevo."
            ];
        }
    }



    /**
     * Eliminar Foto por id
     */
    public function delete_photo($id_usuario)
    {
        $sql = "UPDATE " . CONTROLADOR_TABLA . "_usuario 
                SET 
                    foto_usuario = ? 
                WHERE 
                    id_usuario = ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, null);
        $sql->bindValue(2, $id_usuario);
        if ($sql->execute()) {
            return [
                "status" => "success",
                "message" => "Se eliminó la foto correctamente."
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No se pudo eliminar la foto. Inténtalo de nuevo."
            ];
        }
    }



    /**
     * Obtener los países de la base de datos
     */
    public function get_Paises()
    {
        $sql = "SELECT * FROM " . CONTROLADOR_TABLA . "_pais 
                WHERE id_pais <> ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, 1);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }



    /**
     * Obtener los países activos de la base de datos
     */
    public function get_Paises_activos()
    {
        $sql = "SELECT * FROM " . CONTROLADOR_TABLA . "_pais 
                WHERE id_pais <> ? AND id_estado = ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, 1);
        $sql->bindValue(2, $this->G_estado_activo);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }



    /**
     * Obtener los roles de la base de datos
     */
    public function get_Roles()
    {
        $sql = "SELECT * FROM " . CONTROLADOR_TABLA . "_rol 
                WHERE id_rol <> ?";

        $sql = $this->conectar->prepare($sql);
        $sql->bindValue(1, 0);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }



    /**
     * Verificar si una cédula ya existe en la base de datos
     */
    public function verificar_Cedula($cedula)
    {
        $sql = "SELECT COUNT(*) AS count 
                FROM " . CONTROLADOR_TABLA . "_usuario AS U
                WHERE U.dni_usuario = ?";

        $stmt = $this->conectar->prepare($sql);
        $stmt->bindValue(1, $cedula);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            return [
                "status" => "existe",
                "message" => "La cédula ya está registrada."
            ];
        } else {
            return [
                "status" => "no existe",
                "message" => "despejado"
            ];
        }
    }



    /**
     * Verificar si un correo ya existe en la base de datos
     */
    public function verificar_Correo($correo)
    {
        $sql = "SELECT COUNT(*) AS count 
                FROM " . CONTROLADOR_TABLA . "_usuario AS U
                WHERE U.correo_usuario = ?";

        $stmt = $this->conectar->prepare($sql);
        $stmt->bindValue(1, $correo);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            return [
                "status" => "existe",
                "message" => "El correo ya está registrado."
            ];
        } else {
            return [
                "status" => "no existe",
                "message" => "despejado"
            ];
        }
    }



    /**
     * Copiar en portapapeles
     */
    public function copy_portapapeles_activo($filtro, $id_usuario_accion, $id_rol_accion, $nombre_documento, $estado_documento, $extencion_archivo)
    {
        $estado = $this->G_estado_activo;
        return $this->copy_portapapeles($filtro, $estado, $id_usuario_accion, $id_rol_accion, $nombre_documento, $estado_documento, $extencion_archivo);
    }

    public function copy_portapapeles_inactivo($filtro, $id_usuario_accion, $id_rol_accion, $nombre_documento, $estado_documento, $extencion_archivo)
    {
        $estado = $this->G_estado_inactivo;
        return $this->copy_portapapeles($filtro, $estado, $id_usuario_accion, $id_rol_accion, $nombre_documento, $estado_documento, $extencion_archivo);
    }

    public function copy_portapapeles($filtro, $estado, $id_usuario_accion, $id_rol_accion, $nombre_documento, $estado_documento, $extencion_archivo)
    {
        $sql = "SELECT U.id_usuario, U.nombre_usuario, U.apellidoPaterno_usuario, U.apellidoMaterno_usuario, 
                       U.dni_usuario, U.telefono_usuario, U.correo_usuario, U.sexo_usuario, P.nombre_pais, 
                       P.abreviatura_pais, R.nombre_rol, U.fechaCreacion_usuario, U.fechaDesactivacion_usuario 
                FROM " . CONTROLADOR_TABLA . "_usuario AS U
                INNER JOIN " . CONTROLADOR_TABLA . "_rol AS R ON U.id_rol = R.id_rol      
                INNER JOIN " . CONTROLADOR_TABLA . "_pais AS P ON U.id_pais = P.id_pais 
                WHERE U.id_estado = :estado";

        // Agrega condiciones al SQL si hay un filtro
        if ($filtro != '') {
            $sql .= " AND (U.nombre_usuario LIKE :filtro OR U.apellidoPaterno_usuario LIKE :filtro OR U.dni_usuario LIKE :filtro OR U.telefono_usuario LIKE :filtro
                      OR U.correo_usuario LIKE :filtro OR P.nombre_pais LIKE :filtro OR P.abreviatura_pais LIKE :filtro OR R.nombre_rol LIKE :filtro)";
        }

        // Prepara la consulta
        $sql = $this->conectar->prepare($sql);

        // Enlaza parámetros
        $sql->bindParam(':estado', $estado, PDO::PARAM_INT);

        // Enlaza parámetros si hay un filtro
        if (!empty($filtro)) {
            $filtro_contenido = '%' . $filtro . '%';
            $sql->bindParam(':filtro', $filtro_contenido, PDO::PARAM_STR);
        }

        // Ejecuta la consulta
        $sql->execute();

        // Notificacion
        $notificacion = new Notificacion();
        $notificacion->notificacionDescarga_documento($filtro, $id_usuario_accion, $id_rol_accion, $nombre_documento, $estado_documento, $extencion_archivo);

        // Obtiene los resultados
        return $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}