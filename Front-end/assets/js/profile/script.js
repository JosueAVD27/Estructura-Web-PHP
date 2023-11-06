// Obtener referencia al input y a la imagen
const $seleccionArchivos = document.querySelector("#file-input"),
    $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

// Establecer la imagen por defecto al cargar la página
$imagenPrevisualizacion.src = "assets/img/default/Default-User.svg";

// Escuchar cuando cambie
$seleccionArchivos.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = $seleccionArchivos.files;
    // Si no hay archivos o si se cancela la selección, mostramos la imagen por defecto
    if (!archivos || !archivos.length) {
        $imagenPrevisualizacion.src = "assets/img/default/Default-User.svg";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imagenPrevisualizacion.src = objectURL;
});
