<?php
$idProveedor= isset($_GET["iProveedor"]) && $_GET["iProveedor"] != null ? $_GET["iProveedor"] : 0;
$nombre = $idProveedor != 0 ? "Editar" : "Registrar";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Administrar Proveedor</a>
                                </li>
                                <li class="breadcrumb-item active"><?php echo $nombre ?> Provedor</li>
                            </ol>
                        </div>

                        <div class="page-title-right">
                            <a href="?page=verClientes" class="btn btn-info btn-sm">Ver Clientes
                            </a>
                        </div>

                    </div>

                </div>
                <div class="card-body ">
                    <div class="container">
                        <form name="frmCliente">
                            <div class="row" style="padding-bottom: 15px;">
                                <input type="hidden" id="txtProveedor" value="<?php echo $idProveedor ?>">

                                <div class="col-md-4">
                                    <label for="txtNombre" class="form-label">Nombres <span>*</span></label>
                                    <input class="form-control" type="text" value=""
                                           id="txtNombre" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="cboTipoCliente" class="form-label">Tipo Cliente <span>*</span></label>
                                  <select class="form-select" id="cboTipoCliente">
                                      <option value="0" selected disabled>Seleccione</option>
                                      <option value="1">Natural</option>
                                      <option value="2">Juridico</option>
                                  </select>
                                </div>
                                <!--                                <div class="col-md-4">-->

                                <input class="form-control" type="hidden" value=""
                                       id="txtApellidos" required>
                                <!--                                </div>-->
                                <div class="col-md-4">
                                    <label for="txtEmail" class="form-label">email</label>
                                    <input class="form-control" type="email" value=""
                                           id="txtEmail">
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 35px;">
                                <div class="col-md-4">
                                    <label for="txtNumeroContacto" class="form-label">Numero contacto</label>
                                    <input class="form-control" type="text" value=""
                                           id="txtNumeroContacto">
                                </div>
                                <div class="col-md-8">
                                    <label for="example-search-input" class="form-label">Direccion</label>
                                    <input class="form-control" type="text" value="" id="txtDireccion">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="card-footer" align="center">
                    <?php
                    if ($idProveedor == 0) {
                        ?>
                        <button type="button" onclick="proveedores.guardar();" class="btn btn-info">Guardar</button>
                    <?php } else {
                        ?>
                        <button type="button" onclick="proveedores.actualizar();" class="btn btn-info">Actualizar</button>
                    <?php } ?>

                    <button type="button" class="btn btn-danger">Cancelar</button>

                </div>
            </div>

        </div> <!-- end col -->
    </div>


</div>

<?php
include "./views/footer.php"; ?>
<script src="js/proveedores.js?version=3"></script>

