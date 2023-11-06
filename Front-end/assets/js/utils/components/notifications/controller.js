var id_usuario = $('#user_id_x').val();
var id_rol = $('#rol_id_x').val();
var autoUpdate = true;
var tiempo_actualizacion_notificacion = 1500;

/**
 * Cargar datos
 */
function cargarDatos_notificacion() {

    var relPath = definirNivel();
    var total_notificaciones = $('#numero_notificaciones');
    var contenedorNotificaciones = $('#container_notifications_load');
    var notificacionSesion = $('#sesion_timer_notificacion');

    function obtenerNotificaciones() {
        $.post(relPath + "controllers/Utils/components/notifications.php?st=mostrar_notificaciones", { id_usuario: id_usuario, id_rol: id_rol }, function (data) {
            var resultado = JSON.parse(data);
            contenedorNotificaciones.empty();

            var displayStyle = notificacionSesion.css('display');

            // Verifica el estilo y toma acción en consecuencia
            if (displayStyle === 'none') {
                var incremento = 0;
            } else {
                var incremento = 1;
            }

            // Agregar la notificación del temporizador al principio
            contenedorNotificaciones.append(notificacionSesion);

            // Agregar las demás notificaciones
            contenedorNotificaciones.append(resultado.output);

            // Agrega el total de notificaciones
            total_notificaciones.text(parseInt(resultado.total_notificaciones, 10) + incremento);

            if (parseInt(resultado.total_notificaciones, 10) + incremento == 0) {
                contenedorNotificaciones.append('<li class="no_notifications">No hay notificaciones</li>');
            }
        });
    }

    obtenerNotificaciones();  // Cargar datos al principio

    // Configurar sondeo cada 1.5 segundos (ajusta el intervalo según tus necesidades)
    var updateInterval = setInterval(function () {
        if (autoUpdate) {
            obtenerNotificaciones();
        }
    }, tiempo_actualizacion_notificacion);

    // Desactivar temporalmente la actualización después de hacer clic en un botón o al entrar/salir del área de notificación
    $(document).on('click mouseenter mouseleave', '.notification_btn, .notification_box', function () {
        autoUpdate = false;
        setTimeout(function () {
            autoUpdate = true;
        }, tiempo_actualizacion_notificacion);  // Reactivar la actualización después de 1.5 segundos
    });

    // Detener actualizacion
    // clearInterval(updateInterval);
}



/**
 * Ejecuta cuando carga la pagina
 */
$(document).ready(function () {
    cargarDatos_notificacion();
});



/**
 * Archivar
 * @param {*} id_notificacion 
 * @param {*} id_usuario 
 */
function archivar(id_notificacion) {
    autoUpdate = false;  // Desactivar la actualización automática temporalmente

    var relPath = definirNivel();
    $.post(relPath + "controllers/Utils/components/notifications.php?st=archivar", { id_notificacion: id_notificacion, id_usuario: id_usuario }, function (data) {
        data = JSON.parse(data);
        if (data.status === "success") {
            cargarDatos_notificacion();
        }
        autoUpdate = true;  // Reactivar la actualización automática después de realizar la acción
    });
}



/**
 * Direccionar
 * @param {*} $id_notificacion 
 */
function redireccion($id_notificacion) {
    var relPath = definirNivel();
    window.location.href = relPath + ruta_perfil;
}