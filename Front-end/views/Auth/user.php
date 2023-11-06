<?php
if (isset($_SESSION["id_usuario"])) {
    header("Location:" . Conectar::ruta() . $inicio_admin);
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Estilos generales -->
        <?php require_once 'includes/Design/head.php'; ?>

        <!-- Estilos propios -->
        <link href="<?= RUTA ?>assets/css/Auth/user.css" rel="stylesheet">

        <title>Iniciar Sesión</title>
    </head>

    <body>
        <div class="container">
            <img class="marca_logo" src="assets/img/logo/LogoJosue.png" alt="Logo">
            <h1><?= $G_nombre_sito ?></h1>
        </div>

        <div class="main1" id="main1">
            <div class="switch">
                <div class="switch_circle"></div>
                <div class="switch_circle switch_circle_t"></div>
                <div class="switch_circle switch_circle_t2"></div>
                <div class="switch_circle switch_circle_t3"></div>

                <div class="button_container_register">
                    <button class="boton_registro button1" type="button" id="toggleButton1">REGÍSTRATE <i
                            class="bx bx-chevrons-right"></i></button>
                </div>

                <form class="switch_container" method="post" id="login_form">
                    <img class="logo_login" src="assets/img/logo/LogoJosue.png" alt="Logo">

                    <h3 class="title"><?= $G_nombre_sito ?></h3>
                    <p class="description">Documento de Identidad</p>
                    <input class="input form_input" type="text" id="dni_usuariol1" name="dni_usuariol1"
                        placeholder="Ingrese su número de cédula" oninput="this.value = this.value.replace(/[^0-9]/g, '')">

                    <div class="btn_contenedor_login">
                        <button type="submit" class="button efects__button">INGRESAR</button>
                        <button type="button" class="button_invitado button_forma" name="ingresar_como_invitado">Ingresar
                            como invitado</button>
                    </div>
                </form>

                <div class="contenedor_letras_login">
                    <div class="main_a letra_A"></div>
                    <div class="main_j letra_J"></div>
                    <div class="main_v letra_V"></div>
                    <div class="main_d letra_D"></div>
                </div>

            </div>
        </div>

        <div class="main2" id="main2">
            <div class="switch">
                <div class="switch_circle"></div>
                <div class="switch_circle switch_circle_t"></div>
                <div class="switch_circle switch_circle_t2"></div>
                <div class="switch_circle switch_circle_t3"></div>

                <div class="button_container_login">
                    <button class="boton_login button1" type="button" id="toggleButton2"><i class="bx bx-chevrons-left"></i>
                        INGRESAR</button>
                </div>


                <div class="switch_container">
                    <h1 class="title">Registro Usuario</h1>
                    <p class="description description_register"><?= $G_descripcion_registro ?></p>
                    <form method="post" id="usuario_form">
                        <div id="usuario_form_contenedor" class="form_contenedor">
                            <input type="hidden" name="id_usuario" id="id_usuario" />
                            <input type="hidden" name="id_rol" id="id_rol" value="1" />
                            <input type="hidden" name="sexo_usuario" id="sexo_usuario" value="" />
                            <input type="hidden" name="id_usuario_accion" id="id_usuario_accion" value="" />
                            <input type="hidden" name="id_rol_accion" id="id_rol_accion" value="" />
                            <input type="hidden" name="sexo_usuario" id="sexo_usuario" value="" />
                            <input type="hidden" name="fechaDesactivacion_usuario" id="fechaDesactivacion_usuario" />

                            <div>
                                <label for="nombre_usuario">Nombre</label>
                                <input class="input" type="text" id="nombre_usuario" name="nombre_usuario"
                                    placeholder="Ingrese su nombre">
                            </div>

                            <div>
                                <label for="apellidoPaterno_usuario">Apellido Paterno</label>
                                <input class="input" type="text" id="apellidoPaterno_usuario" name="apellidoPaterno_usuario"
                                    placeholder="Ingrese su apellido paterno">
                            </div>

                            <div>
                                <label for="apellidoMaterno_usuario">Apellido Materno</label>
                                <input class="input" type="text" id="apellidoMaterno_usuario" name="apellidoMaterno_usuario"
                                    placeholder="Ingrese su apellido materno">
                            </div>

                            <div>
                                <label for="id_pais">País</label>
                                <select class="input" name="id_pais" id="id_pais" data-placeholder="Seleccione"></select>
                            </div>

                            <div>
                                <label for="dni_usuario">Identificación</label>
                                <input class="input inactive" type="text" id="dni_usuario" name="dni_usuario"
                                    placeholder="Seleccione su país" disabled>
                            </div>

                            <div>
                                <label for="telefono_usuario">Celular</label>
                                <input class="input inactive" type="text" id="telefono_usuario" name="telefono_usuario"
                                    placeholder="Seleccione su país" disabled>
                            </div>

                            <div>
                                <label for="correo_usuario">Correo Electrónico</label>
                                <input class="input" type="text" id="correo_usuario" name="correo_usuario"
                                    placeholder="Ingrese su correo electrónico">
                            </div>

                            <div>
                                <label for="password_usuario">Contraseña</label>
                                <input class="input" type="password" id="password_usuario" name="password_usuario"
                                    placeholder="Ingrese su contraseña">
                            </div>
                        </div>

                        <div class="contenedor_btn_registro_usuario">
                            <button type="submit" class="button efects__button">
                                REGISTRARSE</button>
                        </div>

                        <div class="contenedor_letras_register">
                            <div class="main_a letra_A"></div>
                            <div class="main_j letra_J"></div>
                            <div class="main_v letra_V"></div>
                            <div class="main_d letra_D"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
    <?php
}
?>

<!-- Funcionalidad -->
<script src="<?= RUTA ?>assets/js/auth/controller.js"></script>
<script src="<?= RUTA ?>assets/js/auth/script.js"></script>
<script src="<?= RUTA ?>assets/js/utils/user/validations.js"></script>