<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1><?php echo  $nombre ?>  Catálogos de Bancos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Planilla</a></li>
            <li class="breadcrumb-item"><a href="#">Catálogos</a></li>
            <li class="breadcrumb-item"><a href="#">Administrar AFP</a></li>
            <li class="breadcrumb-item active"><?php echo  $nombre ?> Catálogos de AFP</li>
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

                                <div class="col-md-3">
                                    <label for="txtNombre" class="form-label">Nombre AFP </label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtNombre" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txrPorcentajePatronal" class="form-label">Porcentaje Patronal </label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txrPorcentajePatronal" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtPorcentajeTrabajador" class="form-label">Porcentaje Trabajador </label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtPorcentajeTrabajador" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtTechoMaximo" class="form-label">Techo</label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtTechoMaximo" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-12" style="margin-top:12px;">
                                    <label for="txtDescripcion" class="form-label">Descripción </label>
                                    <input class="form-control" type="text" value=""
                                           id="txtDescripcion" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card-footer" align="center">
                    <button type="button" onclick="catalogo_afp.validar('validar');" class="btn btn-outline-dark">Guardar</button>
                    <button type="button" onclick="generales.atras('planilla','adm_catalogo_afp')" class="btn btn-outline-danger">Cancelar</button>
                </div>
            </div>

        </div> <!-- end col -->
    </div>


</div>

<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/catalogo_afp.js?version=2"></script>


