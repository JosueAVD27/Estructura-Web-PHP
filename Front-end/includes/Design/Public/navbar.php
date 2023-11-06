<nav id="nav">
    <div class="toggle-sidebar">
        <i class='bx bx-menu'></i>
    </div>
    
    <form action="#">
        <div class="form-group"></div>
    </form>

    <input type="hidden" id="user_id_x" value="<?= $_SESSION["id_usuario"] ?>">
    <input type="hidden" id="rol_id_x" value="<?= $_SESSION["id_rol"] ?>">
    <input type="hidden" id="time_session_x" value="<?= TIME_SESSION ?>">
    <input type="hidden" id="route_page_x" value="<?= RUTA ?>">

    <div class="contenedor_notificacion">
        <button type="button" id="toggleBtn">
            <i class='bx bx-bell icon' id="icono_notificacion"></i>
            <span class="notificacion" id="numero_notificaciones">0</span>
        </button>

        <div id="notificationsContainer" style="display: none;">
            <?php require_once 'includes/Design/notifications.php'; ?>
        </div>
    </div>

    <div class="contenedor_user">
        <span class="name_user">
            <?php
            $nombreCompleto = $_SESSION["nombre_usuario"];
            $nombres = explode(" ", $nombreCompleto);
            echo $nombres[0] . " " . $_SESSION["apellidoPaterno_usuario"];
            ?>
        </span>

        <div class="profile">
            <?php
            if (isset($_SESSION['foto_usuario']) && !empty($_SESSION['foto_usuario'])) {
                echo '<img src="data:image/png;base64,' . base64_encode($_SESSION['foto_usuario']) . '"/>';
            } else {
                echo '<img src="' . RUTA . 'assets/img/default/Default-User.svg" alt="">';
            }
            ?>
            <ul class="profile-link">
                <?php if ($_SESSION['dni_usuario'] != 'Ninguno') { ?>
                    <li>
                        <a href="<?= RUTA . $Profile ?>"><i class='bx bxs-user icon'></i> Perfil</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="<?= RUTA . $Logout ?>"><i class='bx bx-log-out'></i> Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Boton para volver hacia arriba -->
    <button id="btn_top"><i class='bx bxs-chevrons-up'></i></button>

</nav>

<!-- Funcionalidad general -->
<script src="<?= RUTA ?>assets/js/utils/components/notifications/controller.js"></script>
<script src="<?= RUTA ?>assets/js/utils/components/timer/digital_clock.js"></script>