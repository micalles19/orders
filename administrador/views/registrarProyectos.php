<?php
$idProyecto = isset($_GET["idProyecto"]) && $_GET["idProyecto"] != null ? $_GET["idProyecto"] : 0;
$nombre = $idProyecto != 0 ? "Editar" : "Registrar";
?>

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css"/>
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Administrar Proyectos</a>
                                </li>
                                <li class="breadcrumb-item active"><?php echo $nombre ?> Proyecto</li>
                            </ol>
                        </div>

                        <div class="page-title-right">
                            <a href="?page=verProyectos" class="btn btn-info btn-sm">Ver Proyectos
                            </a>
                        </div>

                    </div>

                </div>
                <div class="card-body ">
                    <div class="container">
                        <form name="frmProyecto">
                            <div class="row" style="padding-bottom: 15px;">
                                <input type="hidden" id="txtIdProyecto" value="<?php echo $idProyecto ?>">

                                <div class="col-lg-4 ">
                                    <label for="cboClientes" class="form-label ">Clientes</label>
                                    <select class="form-select" id="cboClientes">
                                        <option value="0" selected disabled>Seleccione un cliente</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtNombreProyecto" class="form-label">Nombre proyecto
                                        <span>*</span></label>
                                    <input class="form-control" type="text" value=""
                                           id="txtNombreProyecto" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtInvoice" class="form-label">Invoice</label>
                                    <input class="form-control" type="email" value=""
                                           id="txtInvoice">
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">

                                <div class="col-lg-4 ">
                                    <label for="cboEstadoPago" class="form-label ">Estado del pago</label>
                                    <select class="form-select" id="cboEstadoPago">
                                        <option value="0" selected disabled>Seleccione un Estado</option>
                                    </select>

                                </div>

                                <div class="col-md-4">
                                    <label for="txtPrecioProyecto" class="form-label">Precio $</label>
                                    <input class="form-control" type="number" value=""
                                           id="txtPrecioProyecto" step=".01" placeholder="98.99" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtFechaEjecucion" class="form-label">Fecha Ejecución</label>
                                    <input type="date" class="form-control" id="txtFechaEjecucion">
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-12">
                                    <label for="txtDireccion" class="form-label">Dirección del proyecto</label>
                                    <input class="form-control" type="text" value="" id="txtDireccion" row="2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="txtDescripcion" class="form-label">Detalles / Descripcion</label>
                                    <textarea class="form-control" id="txtDescripcion" rows="3">

                                    </textarea>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card-footer" align="center">
                    <?php
                    if ($idProyecto == 0) {
                        ?>
                        <button type="button" onclick="proyectos.guardar();" class="btn btn-info">Guardar</button>
                    <?php } else {
                        ?>
                        <button type="button" onclick="proyectos.actualizar();" class="btn btn-info">Actualizar</button>
                    <?php } ?>

                    <button type="button" class="btn btn-danger">Cancelar</button>

                </div>
            </div>

        </div> <!-- end col -->
    </div>


</div>

<?php
include "./views/footer.php"; ?>
<!-- pace js -->
<script src="assets/libs/pace-js/pace.min.js"></script>

<script src="js/proyectos.js?vesion=4"></script>


