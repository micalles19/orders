<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1><?php echo  $nombre ?> Empleado</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Planilla</a></li>
            <li class="breadcrumb-item"><a href="#">Administrar empleados</a></li>
            <li class="breadcrumb-item active"><?php echo  $nombre ?> Empleado</li>
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
                                <div class="col-md-2">
                                    <label for="cboTipoDocumento" class="form-label">Tipo Documento</label>
                                    <select class="form-select" id="cboTipoDocumento" onchange="generales.crearMaskPorTipoDocumento(this,'txtNumeroDocumento')">
                                        <option value="0" disabled selected>Seleccione ...</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-2">
                                    <label for="txtNumeroDocumento" class="form-label">Documento (<span id="spnTipoDocumento"></span>) </label>
                                    <input class="form-control" type="text" value="" id="txtNumeroDocumento" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtNombres" class="form-label">Nombres </label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtNombres" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtApellidos" class="form-label">Apellidos</label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtApellidos" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-2">
                                    <label for="txtFechaNacimiento" class="form-label">Fecha Nacimiento</label>
                                    <input class="form-control validar" type="date" value=""
                                           id="txtFechaNacimiento" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-1">
                                    <label for="txtEdad" class="form-label">Edad</label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtEdad" disabled>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cboDepartamento" class="form-label">Departamento </label>
                                    <select id="cboDepartamento" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cboMunicipio" class="form-label">Municipio </label>
                                    <select id="cboMunicipio" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cboDistrito" class="form-label">Distrito </label>
                                    <select id="cboDistrito" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-6">
                                    <label for="txtDireccion" class="form-label">Dirección</label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtDireccion" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtTelefono" class="form-label">Telefono</label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtTelefono" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtCorreo" class="form-label">Correo</label>
                                    <input class="form-control" type="email" value=""
                                           id="txtCorreo" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-3">
                                    <label for="cboSexo" class="form-label">Sexo </label>
                                    <select id="cboSexo" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                        <option value="H">Hombre</option>
                                        <option value="M">Mujer</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cboTipoEmpleado" class="form-label">Tipo Empleado </label>
                                    <select id="cboTipoEmpleado" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cboCargo" class="form-label">Cargo </label>
                                    <select id="cboCargo" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cboEmpresa" class="form-label">Empresa Labora </label>
                                    <select id="cboEmpresa" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-3">
                                    <label for="txtSueldoBase" class="form-label">Sueldo Base</label>
                                    <input class="form-control validar" type="text" value=""
                                           id="txtSueldoBase" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtFechaIngreso" class="form-label">Fecha Ingreso</label>
                                    <input class="form-control validar" type="date" value=""
                                           id="txtFechaIngreso" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtFechaBaja" class="form-label">Fecha baja</label>
                                    <input class="form-control" type="date" value=""
                                           id="txtFechaBaja" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cboMotivoBaja" class="form-label">Motivo Baja</label>
                                    <select id="cboMotivoBaja" class="form-select ">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-md-3">
                                    <label for="cboAfp" class="form-label">AFP</label>
                                    <select id="cboAfp" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtNumeroAfp" class="form-label">Numero AFP</label>
                                    <input class="form-control" type="text" value=""
                                           id="txtNumeroAfp" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="cboSeguro" class="form-label">Seguro</label>
                                    <select id="cboSeguro" class="form-select validar">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>
                                <div class="col-md-3">
                                    <label for="txtNumeroSeguro" class="form-label">Número Afiliación</label>
                                    <input class="form-control" type="text" value=""
                                           id="txtNumeroSeguro" required>
                                    <div class="invalid-feedback">Campo Requerido</div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
                <div class="card-footer" align="center">
                    <button type="button" onclick="empleado.validar('validar');" class="btn btn-outline-dark">Guardar</button>
                    <button type="button" onclick="generales.atras('planilla','adm_catalogo_afp')" class="btn btn-outline-danger">Cancelar</button>
                </div>
            </div>

        </div> <!-- end col -->
    </div>


</div>

<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/empleado.js?version=2"></script>


