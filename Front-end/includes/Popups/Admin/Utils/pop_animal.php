<div id="overlay" class="overlay"></div>
<div id="pop_animal" class="modal">
    <div class="content">
        <h2 id="pop_title_animal" class="pop_title"></h2>
        <hr>
        <form method="post" id="animal_form" enctype="multipart/form-data">
            <div id="animal_form_contenedor" class="form_contenedor">
                <input type="hidden" name="id_animal" id="id_animal" />

                <div>
                    <label for="numero_animal">Número <span class="requerido">*</span></label>
                    <input class="input" type="text" id="numero_animal" name="numero_animal"
                        placeholder="Ingrese un número">
                </div>

                <div>
                    <label for="nombre_animal">Nombre <span class="requerido">*</span></label>
                    <input class="input" type="text" id="nombre_animal" name="nombre_animal"
                        placeholder="Ingrese un nombre">
                </div>

                <div class="contenedor_foto">
                    <label for="file_upload">Subir imagen <span class="requerido">*</span></label>
                    <div class="file-input-wrapper">
                        <input class="input" type="file" id="file_upload">
                        <label for="file_upload"></label>
                        <div class="image-preview">
                            <img src="<?= RUTA ?>assets/img/default/upload.png" alt="Preview" id="preview-image">
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="button2 efects2__button2 btn_enviar"><i class="fa fa-check"></i>
                    Guardar</button>

                <button type="reset" id="btnCerrarModal_animal" class="button2 efects2__button2 btn_cancelar"><i
                        class="fa fa-close"></i>
                    Cancelar</button>
            </div>
        </form>
    </div>
</div>