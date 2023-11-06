/**
 * Validaciones
 */

// Función para validar campos antes de enviar el formulario
function validarCampos() {
    var nombreUsuario = $('#nombre_usuario').val();
    var apellidoPaterno = $('#apellidoPaterno_usuario').val();
    var apellidoMaterno = $('#apellidoMaterno_usuario').val();
    var dni = $('#dni_usuario').val();
    var password = $('#password_usuario').val();
    var correo = $('#correo_usuario').val();
    var telefono = $('#telefono_usuario').val();
    var idRol = $('#id_rol').val();
    var id_pais = $('#id_rol').val();
    var idPais = $('#id_pais option:selected').data('prefijo-codigo-pais');

    // Verificar si algún campo está vacío
    if (
        nombreUsuario === '' ||
        apellidoPaterno === '' ||
        apellidoMaterno === '' ||
        dni === '' ||
        password === '' ||
        correo === '' ||
        telefono === '' ||
        idRol === '' ||
        id_pais == ''
    ) {
        alert_vacios()
        return false; // Evita enviar el formulario si hay campos vacíos


        // Validacion para nombre
    } else if (!validarNombreCampo(nombreUsuario)) {
        var title = "Nombre inválido!";
        var message = "El nombre debe contener solo letras sin espacios.";
        alert_validar(title, message);
        return false; // Evita enviar el formulario

        // Validacion para apellido paterno
    } else if (!validarApellidoPaternoCampo(apellidoPaterno)) {
        var title = "Apellido Paterno inválido!";
        var message = "El apellido debe contener solo letras sin espacios.";
        alert_validar(title, message);
        return false; // Evita enviar el formulario

        // Validacion para apellido materno
    } else if (!validarApellidoMaternoCampo(apellidoMaterno)) {
        var title = "Apellido Materno inválido!";
        var message = "El apellido debe contener solo letras sin espacios.";
        alert_validar(title, message);
        return false; // Evita enviar el formulario

        // Validacion para correo electronico
    } else if (!validarCorreoElectronico(correo)) {
        var title = "Correo Electrónico inválido!";
        var message = "El correo no es válido.";
        alert_validar(title, message);
        return false; // Evita enviar el formulario

        // Validacion para identificacion 
    } else if (!validarNumeroCedula(idPais, dni)) {

        return false; // Evita enviar el formulario


        // Validacion para telefono
    } else if (!validarNumeroCelular(idPais, telefono)) {

        return false; // Evita enviar el formulario

    }
    return true; // Todos los campos están completos, puede enviar el formulario
}



/**
 * Validacion para nombre
 * @param {*} nombre 
 * @returns 
 */
function validarNombreCampo(nombre) {
    // Expresión regular que permite máximo dos palabras y solo letras
    var regex = /^[A-Za-z]+\s?[A-Za-z]*$/;

    // Verificar si el nombre cumple con la expresión regular y no contiene números
    return regex.test(nombre) && !/\d/.test(nombre);
}



/**
 * Validacion para apellido paterno
 * @param {*} apellido 
 * @returns 
 */
function validarApellidoPaternoCampo(apellido) {
    // Expresión regular que permite una sola palabra y solo letras
    var regex = /^[A-Za-z]+$/;

    // Verificar si el nombre cumple con la expresión regular y no contiene números
    return regex.test(apellido) && !/\d/.test(apellido);
}



/**
 * Validacion para apellido paterno
 * @param {*} apellido 
 * @returns 
 */
function validarApellidoMaternoCampo(apellido) {
    // Expresión regular que permite una sola palabra y solo letras
    var regex = /^[A-Za-z]+$/;

    // Verificar si el nombre cumple con la expresión regular y no contiene números
    return regex.test(apellido) && !/\d/.test(apellido);
}



