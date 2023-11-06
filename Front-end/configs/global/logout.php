<?php
// Cierra la sesión
if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] != null) {

    // verifica a qué login va a redireccionar
    if ($_SESSION['id_rol'] == $G_rol_user) {
        $redireccion = $login_user;
    } else if ($_SESSION['id_rol'] == $G_rol_admin) {
        $redireccion = $login_admin;
    }

    // Destruye la sesión y regenera el ID de la sesión
    session_regenerate_id(true);
    session_destroy();

    // Elimina la cookie de fecha de finalización del temporizador de la sesión
    setcookie('timerEndDate', '', time() - 3600);

    // Cierra la sesión de manera efectiva
    session_write_close();

    header("Location:" . Conectar::ruta() . $redireccion);

    exit;
}