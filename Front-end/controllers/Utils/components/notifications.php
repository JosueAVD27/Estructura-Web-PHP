<?php
// Obtener conexion
require_once '../../../configs/connections/connection.php';
// Obtener el modelo
require_once '../../../models/Utils/components/Notifications.php';
$notificacion = new Notificacion();

// Solicitud de controlador
switch ($_GET[CONTROLADOR_TABLA]) {

    // Mostrar la informacion
    case "mostrar_notificaciones":
        $id_usuario = $_POST['id_usuario'];
        $id_rol = $_POST['id_rol'];
        $datos = $notificacion->get_notificacion($id_usuario, $id_rol);

        $output = '';
        foreach ($datos as $row) {

            $fechaActual = $notificacion->fecha_hora_actual();

            $fechaCreacion = $row["fechaCreacion_notificacion"];
            $fechaCreacion = new DateTime($fechaCreacion); // Convertir la fecha de creación a objeto DateTime

            $interval = $fechaActual->diff($fechaCreacion); // Calcular la diferencia entre las fechas

            // Generar el mensaje basado en la diferencia
            if ($interval->y > 0) {
                $mensaje = "hace " . $interval->y . " año" . ($interval->y > 1 ? "s" : "");
            } elseif ($interval->m > 0) {
                $mensaje = "hace " . $interval->m . " mes" . ($interval->m > 1 ? "es" : "");
            } elseif ($interval->d > 0) {
                $mensaje = "hace " . $interval->d . " día" . ($interval->d > 1 ? "s" : "");
            } elseif ($interval->h > 0) {
                $mensaje = "hace " . $interval->h . " hora" . ($interval->h > 1 ? "s" : "");
            } elseif ($interval->i > 0) {
                $mensaje = "hace " . $interval->i . " minuto" . ($interval->i > 1 ? "s" : "");
            } else {
                $mensaje = "hace un momento";
            }

            $output .= '
            <li class="notification_box">
                <div class="notification_content">
                    <div class="notification_icon">
                        <svg class="notification_icon-svg" role="img" aria-label="message" width="32px" height="32px">
                            <use xlink:href="#' . $row["icon_notificacion"] . '"></use>
                        </svg>
                    </div>
                    <div class="notification_text">
                        <div class="notification_text-title">' . $row["titulo_notificacion"] . '</div>
                        <div class="notification_text-subtitle">' . $row["mensaje_notificacion"] . '</div>
                        <div class="notification_text_time">' . $mensaje . '</div>
                    </div>
                </div>

                <div class="notification_btns">';

            if ($row["btnNombre_notificacion"] != "Aceptar") {
                $output .= '
                <button class="notification_btn" type="button" data-dismiss="note-29563d99" onClick="archivar(' . $row["id_notificacion"] . ');" id="' . $row["id_notificacion"] . '">
                    <span class="notification_btn-text">Cerrar</span>
                </button>';
            }

            $output .= '
                    <button class="notification_btn" type="button" data-dismiss="note-29563d99" onClick="' . $row["btnFuncion_notificacion"] . '(' . $row["id_notificacion"] . ');" id="' . $row["id_notificacion"] . '">
                        <span class="notification_btn-text">' . $row["btnNombre_notificacion"] . '</span>
                    </button>
                </div>
            </li>';
        }

        $total_notificaciones = $notificacion->get_total_notificaciones($id_usuario, $id_rol);

        echo json_encode(
            array(
                'output' => $output,
                'total_notificaciones' => $total_notificaciones,
            )
        );
        break;



    // Archivar por ID
    case "archivar":
        $id_notificacion = $_POST['id_notificacion'];
        $id_usuario = $_POST['id_usuario'];

        $datos = $notificacion->archive_notificacion($id_notificacion, $id_usuario);
        echo json_encode($datos);
        break;
}