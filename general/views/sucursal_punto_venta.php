<?php
$idSucursal = isset($_GET["idSucursal"]) ? base64_decode($_GET["idSucursal"]) : 0;
$idPuntoVenta = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $idPuntoVenta != 0 ? "Editar" : "Registrar";
?>

    <div class="pagetitle">
        <h1>Sucursales Punto de Venta</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?page=home">Empresa</a></li>
                <li class="breadcrumb-item"><a href="?page=home">Sucursales</a></li>
                <li class="breadcrumb-item active"><?php echo $nombre ?> Punto de Venta</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <style>
        .password-container {
            position: relative;
            margin-bottom: 20px;
        }

        .toggle-password {
            position: absolute;
            top: 70%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" id="hdnId" value="<?php echo $idPuntoVenta ?>">
                <input type="hidden" id="hdnIdSucursal" value="<?php echo $idSucursal ?>">
                <div class="card">

                    <div class="card-body">
                        <!-- Multi Columns Form -->
                        <form class="row">
                                <div class="row" style="">
                                    <div class="col-md-4" style="padding-bottom: 1.5%; padding-top: 1.5%">
                                        <strong class="d-block">Nombre de la Empresa:</strong>
                                        <span id="spnNombreEmpresa"></span>
                                    </div>
                                    <div class="col-md-4" style="padding-bottom: 1.5%;  padding-top: 1.5%">
                                        <strong class="d-block">Sucursal:</strong>
                                        <span id="spnSucursal"></span>
                                    </div>
                                    <div class="col-md-4" style="padding-bottom: 1.5%; padding-top: 1.5%">
                                        <strong class="d-block">NIT:</strong>
                                        <span id="spnNit"></span>
                                    </div>
                                    <div class="col-md-4" style="padding-bottom: 1.5%;">
                                        <strong class="d-block">Dirección:</strong>
                                        <span id="spnDireccion"></span>
                                    </div>
                                    <div class="col-md-4" style="padding-bottom: 1.5%">
                                        <strong class="d-block">Teléfono:</strong>
                                        <span id="spnTelefono"></span>
                                    </div>
                                    <div class="col-md-4" style="padding-bottom: 1.5%">
                                        <strong class="d-block">Correo Electrónico:</strong>
                                        <span id="spnCorreo"> </span>
                                    </div>
                                </div>
                        </form><!-- End Multi Columns Form -->
                        <div class="row">
                            <div class="col-md-4">
                                <label for="txtUbicación" class="form-label">Ubicación</label>
                                <input type="text" class="form-control validar" id="txtUbicación" placeholder="Ej. Caja Tienda">
                                <div class="invalid-feedback">Por favor ingrese la ubicación</div>
                            </div>
                            <div class="col-md-4">
                                <label for="txtNumeroCaja" class="form-label">Número de Caja Interno</label>
                                <input type="text" class="form-control validar" id="txtNumeroCaja" placeholder="1">
                                <div class="invalid-feedback">Ingrese un usuario</div>
                            </div>
                            <div class="col-md-4">
                                <label for="txtnumeroPost" class="form-label">Número de Punto Venta</label>
                                <input type="text" class="form-control validar" id="txtnumeroPost" placeholder="Autorizado por hacienda">
                                <div class="invalid-feedback">Numero POS</div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="button" onclick="usuario.validarCampos()" class="btn btn-success">Guardar
                            </button>
                            <button type="button" onclick="generales.atras('general','adm_usuarios')"
                                    class="btn btn-secondary">Cancelar
                            </button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php include './general/views/footer.php'; ?>
<script src="general/js/sucursal_punto_venta.js"></script>
