<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
$class = $id != 0 ? "" : "Disabled";
$tab = isset($_GET["tag"]) ? base64_decode($_GET["tag"]) : "homeT";
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: 38px!important; /* ajusta la altura según tus necesidades */
        line-height: 38px!important; /* asegúrate de que el texto esté centrado verticalmente */
        padding-top:3px !important;
    }

</style>
<style>
    .image-container {
        width: 350px; /* Ancho fijo para la imagen */
        height: 125px; /* Alto fijo para la imagen */
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
    <h1>Administrar Datos de Empresa <span id="spnNombreUA"></span></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">General</a></li>
            <li class="breadcrumb-item"><a href="?module=general&page=datos_empresa">Administrar Datos Empresa</a></li>
            <li class="breadcrumb-item active"><?php echo $nombre ?></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" id="hdnId" value="<?php echo $id ?>">
            <input type="hidden" id="hdnTab" value="<?php echo $tab ?>">

            <div class="card" style="padding-top: 10px;">
                <div class="card-body">
                    <!-- Default Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="homeT-tab" data-bs-toggle="tab" data-bs-target="#homeT"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Empresa
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false"  >Actividad Económica
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sucursales-tab" data-bs-toggle="tab" data-bs-target="#sucursales"
                                    type="button" role="tab" aria-controls="sucursales" aria-selected="false"  <?php  $class?> >Sucursales
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="documentosFiscales-tab" data-bs-toggle="tab" data-bs-target="#documentosFiscales"
                                    type="button" role="tab" aria-controls="documentosFiscales" aria-selected="false"  <?php  $class?> >Documentos Fiscales
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="DTES-tab" data-bs-toggle="tab" data-bs-target="#DTES"
                                    type="button" role="tab" aria-controls="DTES" aria-selected="false" >Transmisión DTE
                            </button>
                        </li>
                    </ul>
                    <!-- Multi Columns Form -->
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="homeT" role="tabpanel" aria-labelledby="homeT-tab">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="txtNombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control validar" id="txtNombre" placeholder="Ingrese el nombre">
                                    <div class="invalid-feedback">Por favor ingrese un nombre</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="txtNombreComercial" class="form-label">Nombre Comercial</label>
                                    <input type="text" class="form-control validar" id="txtNombreComercial"
                                           placeholder="Nombre Comercial">
                                    <div class="invalid-feedback">Por favor un nombre comercial</div>
                                </div>

                                <div class="col-md-4">
                                    <label for="cboTipoPersoneria" class="form-label">Tipo de Personería</label>
                                    <select id="cboTipoPersoneria" class="form-select validar">
                                        <option value="" selected disabled>Seleccione...</option>
                                    </select>
                                    <div class="invalid-feedback">Selecione Tipo de Personería</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtNIT" class="form-label">NIT</label>
                                    <input type="text" class="form-control validar" id="txtNIT">
                                    <div class="invalid-feedback">Por favor ingrese el NIT</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtIVA" class="form-label">IVA</label>
                                    <input type="text" class="form-control validar" id="txtIVA">
                                    <div class="invalid-feedback">Por favor ingrese el IVA</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtCorreo" class="form-label">Correo</label>
                                    <input type="text" class="form-control validar" id="txtCorreo">
                                    <div class="invalid-feedback">Por favor ingrese un correo</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtTelefono" class="form-label">Telefono</label>
                                    <input type="text" class="form-control validar" id="txtTelefono">
                                    <div class="invalid-feedback">Por favor ingrese un Telefono</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtLogo" class="form-label">Logo Empresa</label>
                                    <input type="file" class="form-control" id="txtLogo" accept="image/*">
                                    <div class="invalid-feedback">Por favor seleccione una imagen</div>
                                </div>
                                <div class="col-md-4">

                                    <div class="image-container" id="imageContainer" >
                                        <!-- Las imágenes temporales se mostrarán aquí -->
                                    </div>
                                </div>



                                <div class="card-footer">
                                    <div class="text-center">
                                        <button type="button" onclick="datos_empresa.validarCamposEmpresa('validar')" class="btn btn-primary">Guardar</button>

                                        <button type="button" onclick="generales.atras('general','adm_empresas')" class="btn btn-secondary">Cancelar</button>
                                    </div>
                                </div>
                            </form><!-- End Multi Columns Form -->


                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table-toolbar" style="text-align: right!important; padding-bottom: 2%!important;">
                                        <button type="button" id="agregarUsuarioBtn" onclick="datos_empresa.mostrarModalActividades()"  class="btn btn-outline-info btn-sm">Agregar Actividades</button>
                                    </div>
                                    <table class="table table-striped" id="tblActividades">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Codigo Actividad</th>
                                            <th scope="col">Nombre Actividad</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                                <!--                            MODAL PARA AGREGAR EL GASTO MENSUAL-->
                                <div class="modal fade" id="mdlAgregarActividadesEconomicas" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ingresa las actividades económicas  <span id="spnPeriodo"></span> </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row" id="mdlConsumo">
                                                    <input type="hidden" id="hdnIdActividadEco" value="0">
                                                    <div class="col-md-12 col-sm-12 col-lg-12" style="padding-top: 10px!important;">
                                                        <div class="row">
                                                                <label for="cboActividadEconomica" class="form-label">Seleccionar Actividad Económica.</label>
                                                                <select id="cboActividadEconomica" style=" width: 100%!important;" class="form-select cboSelect2 validarmdl limpiarMdlAct">
                                                                </select>
                                                                <div class="invalid-feedback">Seleccione una actividad</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary" id="btnMdlGuardar"
                                                        onclick="datos_empresa.agregarActividadEconomica()">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="sucursales" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table-toolbar" style="text-align: right!important; padding-bottom: 2%!important;">
                                        <button type="button" id="agregarUsuarioBtn" onclick="datos_empresa.mostrarModalSucursales()"  class="btn btn-outline-info btn-sm">Agregar Sucursal</button>
                                    </div>
                                    <table class="table table-striped" id="tblSucursales">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre Sucursal</th>
                                            <th scope="col">Tipo <br> Establecimiento</th>
                                            <th scope="col">Responsable</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Correo</th>
                                            <th scope="col">Departamento</th>
                                            <th scope="col">Municipio</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                                <div class="modal fade" id="mdlSucursales" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Administrar Sucursal <span id="spnPeriodo"></span> </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row" id="mdlConsumo">
                                                    <input type="hidden" id="hdnIdSucursal" value="0">
                                                    <div class="col-md-12 col-sm-12 col-lg-12" style="padding-top: 5px!important;">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="txtNombreSucursal" class="form-label">Nombre Sucursal.</label>
                                                                <input type="text" id="txtNombreSucursal" class="form-control validarMdlSucursales " >
                                                                <div class="invalid-feedback">Ingresa un Nombre de sucursal</div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-top: 5px!important; margin-top: 5px!important;">
                                                            <div class="col-md-4">
                                                                <label for="cboTipoEstablecimiento" class="form-label">Tipo Establecimiento.</label>
                                                                <select class="form-select validarMdlSucursales" id="cboTipoEstablecimiento">
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                                <div class="invalid-feedback">Selecciona un Tipo Establecimiento</div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="txtResponsable" class="form-label">Responsable Sucursal.</label>
                                                                <input type="text" id="txtResponsable" class="form-control validarMdlSucursales " >
                                                                <div class="invalid-feedback">Ingresa un Responsable</div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="txtTelefonoSucursal" class="form-label">Telefono Sucursal.</label>
                                                                <input type="text" id="txtTelefonoSucursal" class="form-control validarMdlSucursales " >
                                                                <div class="invalid-feedback">Ingresa un Telefono</div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-top: 5px!important; margin-top: 5px!important;">
                                                            <div class="col-md-4">
                                                                <label for="txtCorreoSucursal" class="form-label">Correo Sucursal.</label>
                                                                <input type="text" id="txtCorreoSucursal" class="form-control validarMdlSucursales " >
                                                                <div class="invalid-feedback">Ingresa un Correo Valido</div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="cboDepartamentoSucursal" class="form-label">Departamento.</label>
                                                                <select id="cboDepartamentoSucursal" class="form-select validarMdlSucursales" onchange="generales.obtenerMunicipiosByDepartamento('cboMunicipioSucursal', this.value)">
                                                                </select>
                                                                <div class="invalid-feedback">Seleccione un departamento</div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="cboMunicipioSucursal" class="form-label">Municipio.</label>
                                                                <select id="cboMunicipioSucursal" style=" width: 100%!important;" class="form-select validarMdlSucursales ">
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                                <div class="invalid-feedback">Seleccione un departamento</div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-top: 5px!important; margin-top: 5px!important;">
                                                            <div class="col-md-12">
                                                                <label for="txtDirección" class="form-label">Dirección.</label>
                                                                <input type="text" id="txtDirección" class="form-control validarMdlSucursales">
                                                                <div class="invalid-feedback">Ingresa una Dirección</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary" id="btnMdlGuardar"
                                                        onclick="datos_empresa.validarSucursal('validarMdlSucursales')">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="documentosFiscales" role="tabpanel" aria-labelledby="documentosFiscales-tab">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table-toolbar" style="text-align: right!important; padding-bottom: 2%!important;">
                                        <button type="button" id="agregarUsuarioBtn" onclick="datos_empresa.mostrarModalSucursales()"  class="btn btn-outline-info btn-sm">Agregar Sucursal</button>
                                    </div>
                                    <table class="table table-striped" id="tblTipoDocumento">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tipo Documento</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="DTES" role="tabpanel" aria-labelledby="DTES-tab">
                            <form class="row g-3">
                                <input id="hdnConfigDte" type="hidden" value="0">
                                <div class="col-md-4">
                                    <label for="cboAmbiente" class="form-label">Tipo de Ambiente</label>
                                    <select id="cboAmbiente" class="form-select validarDtes">
                                        <option value="" selected disabled>Seleccione...</option>
                                        <option value="1">Desarrollo</option>
                                        <option value="2">Producción</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor ingrese un nombre</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtClavePublica" class="form-label">Clave Publica</label>
                                    <input type="text" class="form-control validarDtes" id="txtClavePublica"
                                           placeholder="Clave Publica">
                                    <div class="invalid-feedback">Por favoringrese la clave publica</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtClavePrivada" class="form-label">Clave Privada</label>
                                    <input type="text" class="form-control validarDtes" id="txtClavePrivada"
                                           placeholder="Clave Privada">
                                    <div class="invalid-feedback">Por favor ingrese la clave privada</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtPassAPI" class="form-label">Password API</label>
                                    <input type="text" class="form-control validarDtes" id="txtPassAPI"
                                           placeholder="API">
                                    <div class="invalid-feedback">Por favor ingrese la clave privada</div>
                                </div>
                                <div class="col-md-8">
                                    <label for="txtUrlFirmador" class="form-label">URL Firmador</label>
                                    <input type="text" class="form-control validarDtes" id="txtUrlFirmador"
                                           placeholder="">
                                    <div class="invalid-feedback">Por favor ingrese la URL Firmador</div>
                                </div>

                                <div class="card-footer">
                                    <div class="text-center">
                                        <button type="button" onclick="datos_empresa.validarDatosTransmision('validarDtes')" class="btn btn-primary">Guardar</button>
                                        <button type="button" onclick="generales.atras('administracion','adm_unidades_ambientales')" class="btn btn-secondary">Cancelar</button>
                                    </div>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<?php include './general/views/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="./general/js/datos_empresa.js?v=2"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".cboSelect2").select2({
            dropdownParent: $('#mdlAgregarActividadesEconomicas .modal-body')
        });
    });
</script>
