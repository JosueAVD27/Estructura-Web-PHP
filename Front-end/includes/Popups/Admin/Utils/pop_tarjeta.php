<div id="overlay" class="overlay"></div>
<div id="pop_tarjeta" class="modal">
    <div class="content">
        <h2 id="pop_title_tarjeta" class="pop_title"></h2>
        <hr>
        <form method="post" id="tarjeta_form" enctype="multipart/form-data">
            <div id="tarjeta_form_contenedor" class="form_contenedor">
                <input type="hidden" name="id_tarjeta" id="id_tarjeta" />

                <div>
                    <label for="nombre_tarjeta">Nombre <span class="requerido">*</span></label>
                    <input class="input" type="text" id="nombre_tarjeta" name="nombre_tarjeta"
                        placeholder="Ingrese su nombre">
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

                <button type="reset" id="btnCerrarModal_tarjeta" class="button2 efects2__button2 btn_cancelar"><i
                        class="fa fa-close"></i>
                    Cancelar</button>
            </div>
        </form>
    </div>
</div>