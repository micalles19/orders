<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalle de Orden # <?php echo str_pad($id, 5, "0", STR_PAD_LEFT) ?></h4>
                    <button class="btn btn-danger" onclick="detalleOrden.descargarPDF()">Descargar PDF &nbsp; <i class="fas fa-regular fa-file-pdf"></i></button>
                </div>

                <div class="card-body ">
                    <div class="row">
                        <h5>Datos del cliente</h5>
                        <hr>
                    </div>
                    <div class="row" style="padding-bottom: 10px;">
                        <input type="hidden" id="txtId" value="<?php echo $id ?>">

                        <div class="col-md-3">
                            <label for="txtNombreCliente" class="form-label">Nombre Cliente </label>
                            <input class="form-control" type="text" value=""
                                   id="txtNombreCliente" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtNombreTienda" class="form-label">Nombre Tienda </label>
                            <input class="form-control" type="text" value=""
                                   id="txtNombreTienda" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtDui" class="form-label">DUI</label>
                            <input class="form-control" type="text" value=""
                                   id="txtDui" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtNIT" class="form-label">NIT</label>
                            <input class="form-control" type="text" value=""
                                   id="txtNIT" disabled>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 20px;">

                        <div class="col-md-3">
                            <label for="txtIVA" class="form-label">IVA</label>
                            <input class="form-control" type="text" value=""
                                   id="txtIVA" disabled>
                        </div>

                        <div class="col-md-3">
                            <label for="txtNumeroContacto" class="form-label">Número Principal</label>
                            <input class="form-control" type="text" value=""
                                   id="txtNumeroContacto" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtEmail" class="form-label">Correo Electrónico</label>
                            <input class="form-control" type="email" value=""
                                   id="txtEmail" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtDepartamento" class="form-label">Departamento</label>
                            <input type="text" class="form-control" id="txtDepartamento" disabled>
                        </div>
                    </div>

                    <div class="row" style="padding-bottom: 20px;">

                        <div class="col-md-3">
                            <label for="txtMunicipio" class="form-label">Municipio</label>
                            <input type="text" class="form-control" id="txtMunicipio" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtDistrito" class="form-label">Distrito</label>
                            <input type="text" class="form-control" id="txtDistrito" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtEstadoOrden" class="form-label">Estado de la Orden</label>
                            <input type="text" class="form-control" id="txtEstadoOrden" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtTipoFactura" class="form-label">Tipo de factura solicitada</label>
                            <input type="text" class="form-control" id="txtTipoFactura" disabled>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 20px;">
                        <div class="col-md-12">
                            <label for="txtEmail" class="form-label">Direccion de Envio</label>
                            <textarea class="form-control" id="txtDireccion" disabled></textarea>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 20px;">

                        <div class="col-md-3">
                            <label for="txtFechaRecibido" class="form-label">Fecha orden recibida</label>
                            <input type="text" class="form-control" id="txtFechaRecibido" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtFechaDespachada" class="form-label">Fecha orden despachada</label>
                            <input type="text" class="form-control" id="txtFechaDespachada" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="txtFechaCanclada" class="form-label">Fecha orden cancelada</label>
                            <input type="text" class="form-control" id="txtFechaCanclada" disabled>
                        </div>

                    </div>
                    <div class="row">
                        <h5>Datos de la orden</h5>
                        <hr>
                    </div>
                    <div class="row">
                        <table id="tblDetalleProductos" class="table table-bordered   nowrap w-100">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Unidades bulto</th>
                                <th>Precio Unidad</th>
                                <th>Precio Bulto</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                            <tfoot>
                            <tr>
                            <tr>
                                <td colspan="3" style="text-align: right; font-size: 20px;">Sub Total</td>
                                <td style="font-size: 20px;"  align="right">$<span id="spnSubTotal">0.00</span></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right; font-size: 20px;">IVA</td>
                                <td style="font-size: 20px;"  align="right">$<span id="spnIVa">0.00</span></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right; font-size: 20px;">Total</td>
                                <td style="font-size: 20px;" align="right">$<span id="spnTotal">0.00</span></td>
                            </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
                <div class="card-footer" align="center">

                    <button id="btnDespachar" type="button" onclick="detalleOrden.despacharOrden();" class="btn btn-success">Despachar Orden</button>
                    <button id="btnEntregar" style="display: none" type="button" onclick="detalleOrden.entregarOrden();" class="btn btn-info">Orden Entregada</button>
                    <button id="btnCancelar" type="button" class="btn btn-warning" onclick="detalleOrden.cancelarOrden()">Cancelar Orden</button>
                    <button id="btnEliminar" type="button"  class="btn btn-danger"  onclick="detalleOrden.eliminarOrden();">Eliminar Orden</button>

                </div>
            </div>

        </div> <!-- end col -->
    </div>


</div>

<?php
include "./views/footer.php"; ?>
<script src="js/detalleOrden.js?vesion=2"></script>