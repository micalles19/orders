<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1><?php echo  $nombre ?>  Cuentas de Bancos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Formularios </a></li>
            <li class="breadcrumb-item"><a href="#">Catálogos</a></li>
            <li class="breadcrumb-item"><a href="#">Administrar Cuentas de banco</a></li>
            <li class="breadcrumb-item active"><?php echo  $nombre ?> Cuentas de Bancos</li>
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
                                    <label for="cboEmpresa" class="form-label">Empresa</label>
                                  <select class="form-select validar" id="cboEmpresa">
                                      <option value="">Seleccione</option>
                                  </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cboBancos" class="form-label">Nombre del banco</label>
                                  <select class="form-select validar" id="cboBancos">
                                      <option value="">Seleccione</option>
                                  </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-6">
                                    <label for="txtNumeroCuenta" class="form-label">Número de Cuenta </label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtNumeroCuenta" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cboTipoCuenta" class="form-label">Tipo de cuenta</label>
                                    <select class="form-select validar" id="cboTipoCuenta">
                                        <option value="">Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer" align="center">
                    <button type="button" onclick="cuentas_banco.validar('validar');" class="btn btn-outline-dark">Guardar</button>
                    <button type="button" onclick="generales.atras('formularios','adm_cuentas_banco')" class="btn btn-outline-danger">Cancelar</button>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>

<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/cuentas_banco.js?version=2"></script>


