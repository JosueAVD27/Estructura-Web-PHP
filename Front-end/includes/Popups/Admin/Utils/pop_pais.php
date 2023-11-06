<div id="overlay" class="overlay"></div>
<div id="pop_pais" class="modal">
    <div class="content">
        <h2 id="pop_title_pais" class="pop_title"></h2>
        <hr>
        <form method="post" id="pais_form">
            <div id="pais_form_contenedor" class="form_contenedor">
                <input type="hidden" name="id_pais" id="id_pais" />
                <input type="hidden" name="fechaDesactivacion_pais" id="fechaDesactivacion_pais" />

                <div>
                    <label for="nombre_pais">Nombre <span class="requerido">*</span></label>
                    <input class="input" type="text" id="nombre_pais" name="nombre_pais"
                        placeholder="Ingrese el nombre">
                </div>

                <div>
                    <label for="abreviatura_pais">Abreviatura <span class="requerido">*</span></label>
                    <input class="input" type="text" id="abreviatura_pais" name="abreviatura_pais"
                        placeholder="Ingrese la abreviatura" style="text-transform: uppercase;">
                </div>

                <div>
                    <label for="prefijo_pais">Prefijo <span class="requerido">*</span></label>
                    <input class="input" type="text" id="prefijo_pais" name="prefijo_pais"
                        placeholder="Ingrese el prefijo">
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="button2 efects2__button2 btn_enviar"><i class="fa fa-check"></i>
                    Guardar</button>

                <button type="reset" id="btnCerrarModal_pais" class="button2 efects2__button2 btn_cancelar"><i
                        class="fa fa-close"></i>
                    Cancelar</button>

            </div>
        </form>
    </div>
</div>