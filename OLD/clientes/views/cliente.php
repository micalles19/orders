<?php
$idCliente = isset($_GET["idCliente"]) && $_GET["idCliente"] != null ? base64_decode($_GET["idCliente"]) : 0;
$nombre = $idCliente != 0 ? "Editar" : "Registrar";
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: 38px!important; /* ajusta la altura según tus necesidades */
        line-height: 38px!important; /* asegúrate de que el texto esté centrado verticalmente */
        padding-top:3px !important;
    }

</style>

<div class="pagetitle">
    <h1><?php echo  $nombre ?> Cliente</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Clientes</a></li>
            <li class="breadcrumb-item active"><?php echo  $nombre ?> Cliente</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="section dashboard">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body " style="margin-top: 1%;">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="datosGenerales-tab" data-bs-toggle="tab"
                                    data-bs-target="#datosGenerales" type="button" role="tab"
                                    aria-controls="datosGenerales" aria-selected="true">Datos Generales
                            </button>
                            <button class="nav-link" id="verOrdenesRealizadas-tab" data-bs-toggle="tab"
                                    data-bs-target="#verOrdenesRealizadas" type="button" role="tab"
                                    aria-controls="verOrdenesRealizadas" aria-selected="false">Compras
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent" style="padding-top: 20px!important;">
                        <div class="tab-pane fade show active" id="datosGenerales" role="tabpanel"
                             aria-labelledby="datosGenerales-tab">

                            <form name="frmCliente">
                                <div class="row" style="padding-bottom: 15px;">
                                    <input type="hidden" id="hdnId" value="<?php echo $idCliente ?>">

                                    <div class="col-md-4">
                                        <label for="txtNombreCliente" class="form-label">Nombre Cliente </label>
                                        <input class="form-control" type="text" value=""
                                               id="txtNombreCliente" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cboTipoDocumento" class="form-label">Tipo Documento</label>
                                        <select class="form-select" id="cboTipoDocumento" onchange="clientes.changeTipoDoc(this)">
                                            <option value="0" disabled selected>Seleccione ...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="txtNumeroDocumento" class="form-label">Numero Documento (<span id="spnTipoDocumento"></span>) </label>
                                        <input class="form-control" type="text" value="" id="txtNumeroDocumento" required>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 20px;">
                                    <div class="col-md-4">
                                        <label for="txtIVA" class="form-label">IVA</label>
                                        <input class="form-control" type="text" value="" id="txtIVA" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cboActividadEconomica" class="form-label">Actividad Económica</label>
                                        <select class="form-select cboSelect2" id="cboActividadEconomica">
                                            <option value="0" disabled selected>Seleccione ...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="txtEmail" class="form-label">Correo Electrónico</label>
                                        <input class="form-control" type="email" value="" id="txtEmail">
                                    </div>
                                </div>


                                <div class="row" style="padding-bottom: 20px;">

                                    <div class="col-md-4">
                                        <label for="txtTelefono" class="form-label">Número Contacto</label>
                                        <input class="form-control" type="text" value=""
                                               id="txtTelefono">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cboDepartamento" class="form-label">Departamento</label>
                                        <select class="form-select" id="cboDepartamento"
                                                onchange="clientes.obtenerMunicipios(this.value)">
                                            <option value="0" disabled selected>Seleccione ...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cboMunicipio" class="form-label">Municipio</label>
                                        <select class="form-select" id="cboMunicipio"
                                                onchange="">
                                            <option value="0" disabled selected>Seleccione ...</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row" style="padding-bottom: 20px;">
                                    <div class="col-md-12">
                                        <label for="txtDireccion" class="form-label">Complemento Dirección</label>
                                        <textarea class="form-control" id="txtDireccion" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                            <button type="button" onclick="clientes.validar();" class="btn btn-success">Guardar</button> &nbsp;
                                        <button type="button" class="btn btn-danger">Cancelar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="sucursales" role="tabpanel" aria-labelledby="sucursales-tab">
                        </div>
                        <div class="tab-pane fade" id="verOrdenesRealizadas" role="tabpanel" onchange="clientes.ajustarTabla()"
                             aria-labelledby="verOrdenesRealizadas-tab">

                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <div class="page-title-left">
                                    </div>
                                </div>
                                <table id="tblAdmCatalogosCliente" class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <div class="card-footer" align="center">

                </div>
            </div>

        </div> <!-- end col -->
    </div>


</div>

<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/clientes.js?vesion=5"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        $(".cboSelect2").select2({
        });
    });
</script>





