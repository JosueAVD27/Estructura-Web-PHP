// Obtener la url actual
urlActual = window.location.href;

// Rutas de paginas utilizadas
var ruta_registro_usuario = "admin/usuarios";
var ruta_perfil = "perfil";
var ruta_login = "";

/*
* Obtener datos sin importar el nivel
*/
function definirNivel() {
    var parts = urlActual.split('/'); // Dividir la URL en partes
    var nivel = parts.length - 5; // Calcular el nivel actual 5 para mi local 3 para produccion
    // Verificar si la última parte contiene un punto (como una extensión de archivo)
    if (parts[parts.length - 1].includes('.')) {
        nivel--;
    }
    return '../'.repeat(nivel); // Construir la ruta relativa
}