<?php require_once 'includes/Components/icons_svg.php'; ?>

<ul class="contenedor_notificaciones" id="container_notifications_load">

    <!-- Notificacion para el timer de la sesion -->
    <li class="notification_box" id="sesion_timer_notificacion" style="display: none;">
        <div class="notification_content">
            <div class="notification_icon">
                <svg class="notification_icon-svg" role="img" aria-label="message" width="32px" height="32px">
                    <use xlink:href="#clock"></use>
                </svg>
            </div>
            <div class="notification_text">
                <div class="notification_text-title" id="lazy">00:00:00</div>
                <div class="notification_text-subtitle">Tu sesión esta a punto de terminar</div>
            </div>
        </div>
        <div class="notification_btns">
            <button class="notification_btn" onclick="extender_sesion()" type="button" data-dismiss="note-29563d99">
                <span class="notification_btn-text">Extender</span>
            </button>
        </div>
    </li>

    <!-- Aqui se agregan las notificaciones de la base de datos por el controller.js -->

</ul>