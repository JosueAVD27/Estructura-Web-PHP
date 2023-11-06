// Función para ocultar el mensaje de cookies y establecer una cookie de aceptación
function aceptarCookies() {
    document.getElementById('cookie-message').style.display = 'none';
    // Lógica adicional (puede incluir establecer una cookie de aceptación utilizando JavaScript o PHP).
    document.cookie = "cookies_aceptadas=true; expires=" + new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
}

// Función para rechazar cookies y eliminar la cookie de aceptación si existe
function rechazarCookies() {
    document.getElementById('cookie-message').style.display = 'none';
    document.cookie = "cookies_aceptadas=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

// Lógica para mostrar el mensaje de cookies si la cookie de aceptación no está presente.
document.addEventListener('DOMContentLoaded', function () {
    var cookieAceptadas = document.cookie.indexOf('cookies_aceptadas=true') !== -1;
    if (!cookieAceptadas) {
        document.getElementById('cookie-message').style.display = 'grid';
    }
});