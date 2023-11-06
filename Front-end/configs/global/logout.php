<?php
// Cierra la sesion
if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] != null) {

    // verifica a que login va a redireccionar
    if ($_SESSION['id_rol'] == $G_rol_user){
        $redireccion = $login_user;

    } else if ($_SESSION['id_rol'] == $G_rol_admin) {
        $redireccion = $login_admin;
    }

    // Elimina los datos de las variables iniciadas
    session_unset();

    // Destruye los objetos creados en la sesión
    session_destroy();

    // Elimina la cookie de fecha de finalización del temporizador de la sesion
    setcookie('timerEndDate', '', time() - 3600);

    header("Location:" . Conectar::ruta() . $redireccion);
}