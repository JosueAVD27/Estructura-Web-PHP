<?php
// Ruta del modelo de notificaciones
require_once 'models/Utils/components/Notifications.php';

//Instancias
$notificacion = new Notificacion();

/**
 * Eliminar notificaciones a las 00:00:00
 */
if (date('H') === '00' && date('i') === '12' && date('s') === '12') {
    $notificacion->delete_notifications();
}