// Variable tiempo de sesion
var G_time_session = $('#time_session_x').val();
var G_route_page = $('#route_page_x').val();

var one_second = 1000,
    one_minute = one_second * 60,
    one_hour = one_minute * 60,
    face = document.getElementById('lazy'),
    tiempo = G_time_session; //Tiempo de la sesion en minutos

var requestAnimationFrame =
    window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    window.msRequestAnimationFrame ||
    function (callback) {
        window.setTimeout(callback, 1000 / 60);
    };

// Verificar si la cookie existe
var storedEndDate = getCookie('timerEndDate');
var endDate;

if (storedEndDate) {
    endDate = new Date(parseInt(storedEndDate));
} else {
    // Si no hay cookie almacenada, iniciar con 30 minutos
    endDate = new Date(new Date().getTime() + tiempo * one_minute);
    document.cookie = 'timerEndDate=' + endDate.getTime() + '; expires=' + new Date(Date.now() + tiempo * 60 * 1000).toUTCString();
}

tick();

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
}

function tick() {
    var now = new Date(),
        remainingTime = endDate - now;

    if (remainingTime <= 5 * one_minute) {
        // Mostrar la notificación del temporizador cuando falten 5 minutos
        $('#sesion_timer_notificacion').show();

    } else {
        // Ocultar la notificación del temporizador en otros casos
        $('#sesion_timer_notificacion').hide();
    }

    if (remainingTime <= 0) {
        // El temporizador ha alcanzado su fin
        face.innerText = '00:00:00';

        // Redirigir a la página de cierre de sesión
        window.location.href = G_route_page + 'logout';

    } else {
        var parts = [];
        parts[0] = '' + Math.floor(remainingTime / one_hour);
        parts[1] = '' + Math.floor((remainingTime % one_hour) / one_minute);
        parts[2] = '' + Math.floor(((remainingTime % one_hour) % one_minute) / one_second);

        parts[0] = parts[0].padStart(2, '0');
        parts[1] = parts[1].padStart(2, '0');
        parts[2] = parts[2].padStart(2, '0');

        face.innerText = parts.join(':');
        requestAnimationFrame(tick);
    }
}

// Manejar el evento de restablecimiento del temporizador
function extender_sesion() {
    // Restablecer la fecha de finalización en 30 minutos
    endDate = new Date(new Date().getTime() + tiempo * one_minute);

    // Actualizar la fecha de finalización en la cookie
    document.cookie = 'timerEndDate=' + endDate.getTime() + '; expires=' + new Date(Date.now() + tiempo * 60 * 1000).toUTCString();
    tick();
};