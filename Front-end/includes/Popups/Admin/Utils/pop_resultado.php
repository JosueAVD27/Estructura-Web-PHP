<div id="overlay" class="overlay"></div>
<div id="pop_resultado" class="modal">
    <div class="content">
        <h2 id="pop_title_resultado" class="pop_title"></h2>
        <hr>
        <form method="post" id="resultado_form">
            <div id="resultado_form_contenedor" class="form_contenedor">
                <div class="contenedor_inputs">
                    <input type="hidden" name="id_resultado" id="id_resultado" />
                    <input type="hidden" name="id_tarjeta" id="id_tarjeta" value="" />
                    <input type="hidden" name="fechaDesactivacion_resultado" id="fechaDesactivacion_resultado" />

                    <div>
                        <label for="fechaInicio_resultado">Fecha inicio <span class="requerido">*</span></label>
                        <input class="input" type="date" id="fechaInicio_resultado" name="fechaInicio_resultado">
                    </div>

                    <div>
                        <label for="hora_resultado">Programar Hora <span class="requerido">*</span></label>
                        <input class="input" type="time" id="hora_resultado" name="hora_resultado">
                    </div>

                    <div>
                        <label for="id_animal">Animal <span class="requerido">*</span></label>
                        <select class="input" name="id_animal" id="id_animal" data-placeholder="Seleccione"></select>
                    </div>

                    <div>
                        <label for="id_tipoSorteo">Tipo sorteo <span class="requerido">*</span></label>
                        <select class="input" name="id_tipoSorteo" id="id_tipoSorteo"
                            data-placeholder="Seleccione"></select>
                    </div>
                </div>

                <div class="contenedor_preview">
                    <h1 class="titulo_previa">Previsualización</h1>

                    <img class="preview_tarjeta" id="img_tarjeta" src="" alt="Preview">

                    <div class="contenedor_interno_preview">
                        <div class="head_img">
                            <img id="preview_animal" src="" alt="seleccione un animal">
                        </div>
                    </div>

                    <div class="nombre_sorteo_preview">
                        <h1 id="preview_nombre">-</h1>
                    </div>

                    <div class="numero_sorteo_preview">
                        <h1 id="numero_preview">000</h1>
                    </div>

                    <div>
                        <h1 id="preview_dia">Seleccione una fecha</h1>
                    </div>

                    <div>
                        <h1 id="preview_hora">--:--</h1>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="button2 efects2__button2 btn_enviar"><i class="fa fa-check"></i>
                    Guardar</button>

                <button type="reset" id="btnCerrarModal_resultado" class="button2 efects2__button2 btn_cancelar"><i
                        class="fa fa-close"></i>
                    Cancelar</button>
            </div>
        </form>
    </div>
</div>