<?php
$idCliente = isset($_GET["idUsuario"]) && $_GET["idUsuario"] != null ? $_GET["idUsuario"] : 0;
$nombre = $idCliente != 0 ? "Editar" : "Registrar";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Administrar Usuarios</a></li>
                                <li class="breadcrumb-item active"><?php echo $nombre ?> Usuario</li>
                            </ol>
                        </div>

                        <div class="page-title-right">
                            <a href="?page=administrarUsuarios" class="btn btn-info btn-sm">Ver Usuarios
                            </a>
                        </div>

                    </div>

                </div>
                <div class="card-body ">
                    <div class="container">
                        <form name="frmCliente">
                            <div class="row" style="padding-bottom: 15px;">
                                <input type="hidden" id="txtIdUsuario" value="<?php echo $idCliente ?>">


                                <div class="col-md-4">
                                    <label for="txtNombre" class="form-label">Nombres <span>*</span></label>
                                    <input class="form-control" type="text" value=""
                                           id="txtNombre" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtEmail" class="form-label">Email</label>
                                    <input class="form-control" type="email" value=""
                                           id="txtEmail" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtClave" class="form-label">Clave</label>
                                    <input class="form-control" type="password" value=""
                                           id="txtClave">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card-footer" align="center">
                    <?php
                    if ($idCliente == 0) {
                        ?>
                        <button type="button" onclick="usuarios.validarGuardadoUsuario();" class="btn btn-info">Guardar</button>
                    <?php } else {
                        ?>
                        <button type="button" onclick="usuarios.validarActualizacionUsuario();" class="btn btn-info">Actualizar</button>
                    <?php } ?>

                    <button type="button" class="btn btn-danger">Cancelar</button>

                </div>
            </div>

        </div> <!-- end col -->
    </div>


</div>

<?php
include "./views/footer.php"; ?>
<script src="js/usuarios.js?vesion=1"></script>

