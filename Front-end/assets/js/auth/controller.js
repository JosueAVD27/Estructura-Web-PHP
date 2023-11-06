// Funcion init
function init() {

    // Login Admin
    $("#login_admin_form").on("submit", function (e) {
        ingreso_admin(e);
    });

    // Login usuario
    $("#login_form").on("submit", function (e) {
        ingreso_usuario(e);
    });

    // Login invitado
    $("button[name='ingresar_como_invitado']").on("click", function (e) {
        e.preventDefault();
        ingresarComoInvitado();
    });

    // Registro
    $("#usuario_form").on("submit", function (e) {
        nuevo_registro(e);
    });
}



/**
 * Login Administrador
 * @param {*} e 
 */
function ingreso_admin(e) {
    e.preventDefault();

    var formData = new FormData($("#login_admin_form")[0]);
    $.ajax({
        url: "controllers/Utils/user.php?st=login_admin",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.status === "success") {
                window.location.href = 'admin';
            } else if (data.status === "error") {
                alert_validar(data.title, data.message);
            } else {
                alert_validar(data.title, data.message);
            }
        },
        error: function () {
            alert_ajax();
        }
    });
}



/**
 * Login Usuario
 * @param {*} e 
 */
function ingreso_usuario(e) {
    e.preventDefault();

    var formData1 = new FormData($("#login_form")[0]);
    $.ajax({
        url: "controllers/Utils/user.php?st=login_usuario",
        type: "POST",
        data: formData1,
        contentType: false,
        processData: false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.status === "success") {
                window.location.href = '';
            } else if (data.status === "error") {
                alert_validar(data.title, data.message);
            } else {
                alert_validar(data.title, data.message);
            }
        },
        error: function () {
            alert_ajax();
        }
    });
}



/**
 * Login Invitado
 */
function ingresarComoInvitado() {
    // Establecer los valores de usuario y contraseña por defecto
    $("#dni_usuariol1").val("Ninguno");  // Aquí establece el DNI o usuario por defecto

    // Enviar el formulario manualmente
    $("#login_form").submit();
}



// Función para nuevo usuario
function nuevo_registro(e) {
    e.preventDefault();

    // Verificar si se está insertando un nuevo usuario o actualizando uno existente
    var cedula = $('#dni_usuario').val();
    var correo = $('#correo_usuario').val();


    // Validar campos antes de enviar el formulario
    if (!validarCampos()) {
        return; // No enviar el formulario si no cumplen las validaciones
    }

    // Realizar la validación de la cédula para ver si ya existen en la base de datos
    validarCedula(cedula, function (resultado) {
        if (resultado === 'existe') {
            // Si la cédula ya existe, mostrar un mensaje de error
            Swal.fire({
                title: 'Ya registrado!',
                text: 'La cédula ya está registrada.',
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            });
        } else {

            // Realizar la validación del correo para ver si ya existe en la base de datos
            validarCorreo(correo, function (resultado) {
                if (resultado === 'existe') {
                    // Si el correo ya existe, mostrar un mensaje de error
                    Swal.fire({
                        title: 'Ya registrado!',
                        text: 'El correo ya está registrado.',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar'
                    });
                } else {

                    // Si la cédula y el correo no existen, continuar con el envío del formulario
                    enviarFormulario();
                }
            });
        }
    });
}



// Función para enviar el formulario
function enviarFormulario() {
    var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "controllers/Utils/user.php?st=nuevo_actualizar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data === 'Error al insertar en la base de datos') {
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un error al guardar los cambios.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Registró Correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(function () {
                    // Recargar la página después de que el usuario haga clic en "Aceptar" en el cuadro de diálogo
                    location.reload();
                });
            }
        },
        error: function () {
            Swal.fire({
                title: 'Error!',
                text: 'Hubo un error en la solicitud AJAX.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}



init();