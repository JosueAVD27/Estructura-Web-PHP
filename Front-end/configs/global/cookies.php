<?php
// Verificar si la cookie de aceptación de cookies está presente
if (!isset($_COOKIE['cookies_aceptadas'])) {
    // Mostrar el mensaje de cookies solo si aún no se ha aceptado
    echo '<div id="cookie-message" class="cookie-message">
            <p>Este sitio web utiliza cookies. Al continuar utilizando este sitio, aceptas su uso.</p>
            <div class="btn_cookies">
                <button class="btn_aceptar_notificacion" onclick="aceptarCookies()">Aceptar</button>
                <button class="btn_rechazar_notificacion" onclick="rechazarCookies()">Rechazar</button>
            </div>
          </div>';
}