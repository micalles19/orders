<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1><?php echo  $nombre ?>  montos de Aprobación</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Formularios </a></li>
            <li class="breadcrumb-item"><a href="#">Catálogos</a></li>
            <li class="breadcrumb-item"><a href="#">Administrar Montos Aprobación</a></li>
            <li class="breadcrumb-item active"><?php echo  $nombre ?> montos de Aprobación</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card" style="padding-top: 2%;">
                <div class="card-body ">
                    <div class="container">
                        <form name="frmCliente">
                            <div class="row" style="padding-bottom: 15px;">
                                <input type="hidden" id="hdnId" value="<?php echo $id ?>">
                                <div class="col-md-6">
                                    <label for="cboCuenta" class="form-label">Cuenta asignar</label>
                                    <select class="form-select validar" id="cboCuenta">
                                        <option value="">Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cboUsuario" class="form-label">Usuario Autorizado</label>
                                    <select class="form-select validar" id="cboUsuario">
                                        <option value="">Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>

                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-4">
                                    <label for="txtMontoDesde" class="form-label">Monto Desde </label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtMontoDesde" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtMontoHasta" class="form-label">Monto Hasta </label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtMontoHasta" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="cboEstado" class="form-label">Estado Autorización</label>
                                    <select class="form-select validar" id="cboEstado">
                                        <option value="" selected disabled>Seleccione</option>
                                        <option value="A">Activo</option>
                                        <option value="I">Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer" align="center">
                    <button type="button" onclick="conf_montos_aprobacion.validar('validar');" class="btn btn-outline-dark">Guardar</button>
                    <button type="button" onclick="generales.atras('formularios','adm_conf_montos_aprobacion')" class="btn btn-outline-danger">Cancelar</button>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>

<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/conf_montos_aprobacion.js?version=2"></script>


