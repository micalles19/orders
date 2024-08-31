<?php
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$class = $id> 0 ? "":" disabled";
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
<div class="pagetitle">
    <h1><?php echo  $nombre ?> Producto</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Productos</a></li>
            <li class="breadcrumb-item active"><?php echo  $nombre ?> Producto</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" id="hdnId" value="<?php echo $id?>">
            <div class="card">
                <div class="card-body" style="padding-top: 1.5%" >
                    <ul class="nav nav-tabs d-flex align-items-center justify-content-between" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="homeT-tab" data-bs-toggle="tab" data-bs-target="#homeT"
                                    type="button" role="tab" aria-controls="homeT" aria-selected="true">Datos Producto
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">Configuración de Precios
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo $class ?>" id="sucursales-tab" data-bs-toggle="tab" data-bs-target="#sucursales"
                                    type="button" role="tab" aria-controls="sucursales" aria-selected="false"  >Asignar a Sucursales
                            </button>
                        </li>
                        <li class="nav-item ms-auto" role="presentation">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="producto.validarCampos()"><span id="spnNombreGuardar"> Siguiente</span></button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="homeT" role="tabpanel" aria-labelledby="homeT-tab">
                            <form class="row g-3" style="padding-top: 1%">
                                <div class="row">
                                    <div class="col-md-3" style="padding-top: 2.5%">
                                        <div class="image-container" id="imageContainer" >
                                            <!-- Las imágenes temporales se mostrarán aquí -->
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6" style="padding: 0.5%">
                                                <label for="txtCodigo" class="form-label">Código Producto</label>
                                                <input type="text" class="form-control" id="txtCodigo" placeholder="0000000000000">
                                                <div class="invalid-feedback">Por favor ingrese un código</div>
                                            </div>
                                            <div class="col-md-6" style="padding: 0.5%">
                                                <label for="txtImagen" class="form-label">Seleccione imagen</label>
                                                <input type="file" class="form-control" id="txtImagen" accept="image/*" onchange="addImage()">
                                                <div class="invalid-feedback">Por favor seleccione una imagen</div>
                                            </div>
                                            <div class="col-md-12" style="padding: 0.5%">
                                                <label for="txtNombre" class="form-label">Nombre Producto</label>
                                                <input type="text" class="form-control validarTab1" id="txtNombre" placeholder="Producto xyz">
                                                <div class="invalid-feedback">Por favor ingrese un nombre</div>
                                            </div>
                                            <div class="col-md-12" style="padding: 0.5%">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="cboProveedor" class="form-label">Proveedor</label>
                                                        <select id="cboProveedor" class="form-select validarTab1">
                                                            <option value="" selected disabled>Seleccione...</option>
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione una Catálogo</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="cboMarca" class="form-label">Marca</label>
                                                        <select id="cboMarca" class="form-select validarTab1">
                                                            <option value="" selected disabled>Seleccione...</option>
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione una Catálogo</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"  >
                                        <div class="row" style="padding-top: 1%">
                                            <div class="col-md-4">
                                                <label for="cboCatalogo" class="form-label">Catálogo</label>
                                                <select id="cboCatalogo" class="form-select validarTab1">
                                                    <option value="" selected disabled>Seleccione...</option>
                                                </select>
                                                <div class="invalid-feedback">Seleccione una Catálogo</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="cboCategoria" class="form-label">Categoria</label>
                                                <select id="cboCategoria" class="form-select validarTab1">
                                                    <option value="" selected disabled>Seleccione...</option>
                                                </select>
                                                <div class="invalid-feedback">Seleccione una Categoria</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="cboSubCategoria" class="form-label">Sub Categoria</label>
                                                <select id="cboSubCategoria" class="form-select validarTab1">
                                                    <option value="" selected disabled>Seleccione...</option>
                                                </select>
                                                <div class="invalid-feedback">Seleccione una Categoria</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row" style="padding-top: 1%">
                                            <div class="col-md-6">
                                                <label for="txtNombres" class="form-label">Descripción de Producto</label>
                                                <textarea type="text" class="form-control validarTab1" id="txtDescripcionProducto" rows="3"></textarea>
                                                <div class="invalid-feedback">Por favor ingrese un nombre</div>
                                            </div>  <div class="col-md-6">
                                                <label for="txtNombres" class="form-label">Especificaciones Técnicas de Producto</label>
                                                <textarea type="text" class="form-control validarTab1" id="txtEspecificacionesProducto" rows="3"></textarea>
                                                <div class="invalid-feedback">Por favor ingrese un nombre</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form class="row g-3" style="padding-top: 1%">
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <label for="rbExento" class="form-label">Exento</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rbExento"
                                                       id="rbExentoSi" value="S"
                                                       onchange="producto.validarExento(this.value)">
                                                <label class="form-check-label" for="rbExentoSi">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rbExento"
                                                       id="rbExentoNo" value="N"
                                                       onchange="producto.validarExento(this.value)" checked >
                                                <label class="form-check-label" for="rbExentoNo" >No</label>
                                            </div>
                                            <div class="invalid-feedback">Seleccione una opción</div>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="rbExento" class="form-label">¿Precio Fijo?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rbPrecioFijo" id="rbPrecioFijoSi" value="S"
                                                       onchange="producto.validarPrecioFijo(this.value)" checked >
                                                <label class="form-check-label" for="rbPrecioFijoSi">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rbPrecioFijo" id="rbPrecioFijoNo" value="N"
                                                       onchange="producto.validarPrecioFijo(this.value)" disabled >
                                                <label class="form-check-label" for="rbPrecioFijoNo">No</label>
                                            </div>

                                            <div class="invalid-feedback">Seleccione una opción</div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="txtPrecioCompraSinIVA" class="form-label">Precio Compra U S/IVA</label>
                                            <input type="text" class="form-control validarTab2" id="txtPrecioCompraSinIVA" placeholder="Ingrese el precio sin IVA"
                                                   maxlength="16" oninput="validar.esNumeroDecimal(event,'txtPrecioCompraSinIVA')"
                                                   onkeyup="producto.calcularIVAProducto(this.value)" >
                                            <div class="invalid-feedback">Por favor ingrese un código</div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="txtIvaCompra" class="form-label">IVA Producto</label>
                                            <input type="text" class="form-control " id="txtIvaCompra" placeholder="0" disabled>
                                            <div class="invalid-feedback">Por favor ingrese un código</div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="txtPrecioCompraConIVA" class="form-label">Precio Unit C/IVA</label>
                                            <input type="text" class="form-control" id="txtPrecioCompraConIVA" placeholder="0" disabled>
                                            <div class="invalid-feedback">Por favor ingrese un código</div>
                                        </div>

                                    </div>
                                    <div class="row" style="padding-top: 1.5%">
                                        <div class="col-md-3">
                                            <label for="txtPrecioVentaSinIVA" class="form-label"> Precio Venta S/IVA</label>
                                            <input type="text" class="form-control validarTab2" id="txtPrecioVentaSinIVA" placeholder="Ingrese el precio venta"
                                                   maxlength="16" oninput="validar.esNumeroDecimal(event,'txtPrecioVentaSinIVA')"
                                                   onkeyup="producto.calcularIVAProductoVenta(this.value)">
                                            <div class="invalid-feedback">Por favor ingrese un código</div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="txtIVAVenta" class="form-label">IVA Calculado</label>
                                            <input type="text" class="form-control " id="txtIVAVenta" placeholder="0" disabled>
                                            <div class="invalid-feedback">Por favor ingrese un código</div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="txtPrecioVentaConIVA" class="form-label">Precio Con IVA Incluido</label>
                                            <input type="text" class="form-control " id="txtPrecioVentaConIVA" placeholder="0" disabled>
                                            <div class="invalid-feedback">Por favor ingrese un código</div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="txtPrecioFinal" class="form-label">Precio Final al Consumidor</label>
                                            <input type="text" class="form-control " id="txtPrecioFinal" placeholder="0" disabled>
                                            <div class="invalid-feedback"></div>
                                        </div>

                                    </div>
                                    <div class="row" style="padding-top: 1%">
                                        <div class="col-md-2" align="center">
                                            <label for="rbExento" class="form-label">¿Aplicar Descuento?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rbDescuento" id="rbDescuentoSi" value="S"
                                                       onchange="producto.validarDescuento(this.value)" >
                                                <label class="form-check-label" for="rbDescuentoSi">Sí</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rbDescuento" id="rbDescuentoNo" value="N"
                                                       onchange="producto.validarDescuento(this.value)"  >
                                                <label class="form-check-label" for="rbDescuentoNo">No</label>
                                            </div>

                                            <div class="invalid-feedback">Seleccione una opción</div>
                                        </div>
                                        <div class="col-md-2" >
                                            <label for="txtPorcentajeDescuento" class="form-label">Porcentaje Descuento</label>
                                            <input type="text" class="form-control" id="txtPorcentajeDescuento" placeholder="0"
                                                   oninput="validar.esNumeroDecimal(event,'txtPorcentajeDescuento')"
                                                   onkeyup="producto.calcularDescuento(this.value)" disabled>
                                            <div class="invalid-feedback">Ingrese un Porcentaje</div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="txtValorDescuento" class="form-label">(-) Descuento</label>
                                            <input type="text" class="form-control" id="txtValorDescuento" placeholder="0" disabled>
                                            <div class="invalid-feedback">Por favor ingrese un código</div>
                                        </div>
                                    </div>

<!--                                        DATOS PARA PRECIOS VARIOS-->
                                        <div id="divPreciosVarios" style="display: none">
                                        <hr>
                                            <div class="row">
                                                <div class="col-md-2"></div>
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
                                                <div class="col-md-2"></div>
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
                        <div class="tab-pane fade" id="sucursales" role="tabpanel" aria-labelledby="sucursales-tab">
                            <form class="row g-3" style="padding-top: 1%">
                                <div class="col-md-12">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/producto.js"></script>

