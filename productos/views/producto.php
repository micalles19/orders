<?php
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
?>
<style>
    .image-container {
        width: 200px; /* Ancho fijo para la imagen */
        height: 200px; /* Alto fijo para la imagen */
        border: 1px solid #ddd;
        margin-top: 15px!important;
        padding: 5px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-size: cover;
        background-position: center;
    }
    .image-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
</style>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" id="hdnId" value="<?php echo $id?>">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $nombre ?> Producto</h5>
                    <hr style="margin-top: -15px!important; margin-bottom: 18px!important;">
                    <!-- Multi Columns Form -->
                    <form class="row g-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="image-container" id="imageContainer">
                                    <!-- Las imágenes temporales se mostrarán aquí -->
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6" style="padding: 0.5%">
                                        <label for="txtCodigo" class="form-label">Código Producto</label>
                                        <input type="text" class="form-control validar" id="txtCodigo" placeholder="0000000000000">
                                        <div class="invalid-feedback">Por favor ingrese un código</div>
                                    </div>
                                    <div class="col-md-6" style="padding: 0.5%">
                                        <label for="txtImagen" class="form-label">Seleccione imagen</label>
                                        <input type="file" class="form-control" id="txtImagen" accept="image/*" onchange="addImage()">
                                        <div class="invalid-feedback">Por favor seleccione una imagen</div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0.5%">
                                        <label for="txtNombres" class="form-label">Nombre Producto</label>
                                        <input type="text" class="form-control validar" id="txtNombres" placeholder="Producto xyz">
                                        <div class="invalid-feedback">Por favor ingrese un nombre</div>
                                    </div>

                                    <div class="col-md-6" style="padding: 0.5%">
                                        <label for="cboLinea" class="form-label">Linea</label>
                                        <select id="cboLinea" class="form-select validar">
                                            <option value="" selected disabled>Seleccione...</option>
                                        </select>
                                        <div class="invalid-feedback">Seleccione una Linea</div>
                                    </div>
                                    <div class="col-md-6" style="padding: 0.5%">
                                        <label for="cboLineaSub" class="form-label">Sub Linea</label>
                                        <select id="cboLineaSub" class="form-select validar">
                                            <option value="" selected disabled>Seleccione...</option>
                                        </select>
                                        <div class="invalid-feedback">Seleccione una Sub Linea</div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div>
                                        <span style="margin-bottom: -5px!important;">Configuración de precios</span>
                                        <hr style="margin-top: -1px!important;">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="rbExento" class="form-label">Exento</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbExento" id="rbExentoSi" value="si">
                                            <label class="form-check-label" for="rbExentoSi">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbExento" id="rbExentoNo" value="no">
                                            <label class="form-check-label" for="rbExentoNo">No</label>
                                        </div>
                                        <div class="invalid-feedback">Seleccione una opción</div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <label for="rbEscalaCantidad" class="form-label">Escala en cantidad</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbEscalaCantidad" id="rbEscalaCantidadSi" value="S" onchange="producto.validarEscalaCantidad(this.value)">
                                            <label class="form-check-label" for="rbEscalaCantidadSi">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbEscalaCantidad" id="rbEscalaCantidadNo" value="N" onchange="producto.validarEscalaCantidad(this.value)">
                                            <label class="form-check-label" for="rbEscalaCantidadNo">No</label>
                                        </div>
                                        <div class="invalid-feedback">Seleccione una opción</div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <label for="rbPrecioUnico" class="form-label">Escala en Precio</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbEscalaPrecio" id="rbEscalaPrecioSi" value="S" onchange="producto.validarEscalaPrecio(this.value)">
                                            <label class="form-check-label" for="rbEscalaPrecioSi">Sí</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbEscalaPrecio" id="rbEscalaPrecioNo" value="N" onchange="producto.validarEscalaPrecio(this.value)">
                                            <label class="form-check-label" for="rbEscalaPrecioNo">No</label>
                                        </div>
                                        <div class="invalid-feedback">Seleccione una opción</div>
                                    </div>

                                    <div class="col-md-12" style="padding-top: 1%">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-0" style="padding-top: 2%">Escala por cantidades</p>
                                                                <button type="button" id="btnAgregarEscalaCantidad" class="btn btn-outline-dark btn-sm" style="margin-top: 2%"
                                                                onclick="producto.mdlAgregarEscalaCantidad()">Nueva Escala</button>
                                                            </div>
                                                            <hr>
                                                            <table class="table table-striped" id="tblEscalaCantidad">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">Desde</th>
                                                                    <th scope="col">Hasta</th>
                                                                    <th scope="col">Precio</th>
                                                                    <th scope="col">% Comisión</th>
                                                                    <th scope="col">Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
<!--                                                            MODAL ESCALA POR CANTIDADES-->
                                                            <div class="modal fade" id="mdlEscalaCantidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Configurar Escala por cantidades</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <input type="hidden" class="limpiarMdl" id="hdnIdCantidad" value="0">
                                                                                    <label for="txtDesdeCantidad" class="form-label">Cantidad Desde</label>
                                                                                    <input type="text" class="form-control validarCantidad limpiarMdl" id="txtDesdeCantidad"
                                                                                           oninput="validar.esNumeroDecimal(event,'txtDesdeCantidad')" maxlength="11">
                                                                                    <div class="invalid-feedback">Ingrese una cantidad</div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="txtHastaCantidad" class="form-label">Cantidad Hasta</label>
                                                                                    <input type="text" class="form-control validarCantidad limpiarMdl" id="txtHastaCantidad"
                                                                                           oninput="validar.esNumeroDecimal(event,'txtHastaCantidad')" maxlength="11">
                                                                                    <div class="invalid-feedback">Ingrese una cantidad</div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="txtPrecioCantidad" class="form-label">Precio</label>
                                                                                    <input type="text" class="form-control validarCantidad limpiarMdl" id="txtPrecioCantidad"
                                                                                           oninput="validar.esNumeroDecimal(event,'txtPrecioCantidad')" maxlength="11">
                                                                                    <div class="invalid-feedback">Ingrese un precio</div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="txtComisionCantidad" class="form-label">% Comision</label>
                                                                                    <input type="text" class="form-control limpiarMdl" id="txtComisionCantidad"
                                                                                           oninput="validar.esNumeroDecimal(event,'txtComisionCantidad')" maxlength="11">
                                                                                    <div class="invalid-feedback">Ingrese una comison</div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                            <button type="button" class="btn btn-primary" onclick="producto.agregarEscalaCantidad()">Guardar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-0" style="padding-top: 2%">Escala de Precios</p>
                                                                <button type="button" id="btnAgregarEscalaPrecios" class="btn btn-outline-dark btn-sm" style="margin-top: 2%"
                                                                onclick="producto.mdlAgregarEscalaPrecio()">Nueva Escala</button>
                                                            </div>
                                                            <hr>
                                                            <table class="table table-striped" id="tblEscalaPrecios">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">Precio</th>
                                                                    <th scope="col">% Comisión</th>
                                                                    <th scope="col">Acciones</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
<!--                                                            MODAL ESCALA POR CANTIDADES-->
                                                            <div class="modal fade" id="mdlEscalaPrecio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Configurar Escala por Precios</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <input type="hidden" id="hdnIdPrecio" value="0">
                                                                                <div class="col-md-6">
                                                                                    <label for="txtPrecioCantidad" class="form-label">Precio</label>
                                                                                    <input type="text" class="form-control validarPrecio limpiarMdl" id="txtPrecio"
                                                                                           oninput="validar.esNumeroDecimal(event,'txtPrecio')" maxlength="11">
                                                                                    <div class="invalid-feedback">Ingrese un precio</div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="txtComisionCantidad" class="form-label">% Comision</label>
                                                                                    <input type="text" class="form-control limpiarMdl" id="txtComisionPrecio"
                                                                                           oninput="validar.esNumeroDecimal(event,'txtComisionPrecio')" maxlength="11">
                                                                                    <div class="invalid-feedback">Ingrese una comison</div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                            <button type="button" class="btn btn-primary" onclick="producto.agregarEscalaPrecio()">Guardar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-footer">
                    <div class="text-center">

                            <button type="button" onclick="producto.validarCampos()" class="btn btn-success">Guardar</button>
                        <button type="button" onclick="generales.atras('productos','productos_adminsitrar')" class="btn btn-secondary">Cancelar</button>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/producto.js"></script>

