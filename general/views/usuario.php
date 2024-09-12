<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
?>

<div class="pagetitle">
    <h1>Administración Usuarios</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $nombre ?> Usuario</li>
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
            <input type="hidden"id="hdnId" value="<?php echo $id?>">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $nombre ?> Usuario</h5>
                    <!-- Multi Columns Form -->
                    <form class="row g-3">
                        <div class="col-md-4">
                            <label for="txtNombres" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control validar" id="txtNombres" placeholder="Juan">
                            <div class="invalid-feedback">Por favor ingrese un nombre</div>
                        </div>

                        <div class="col-md-4">
                            <label for="txtCorreo" class="form-label">Correo Reestablecimiento</label>
                            <input type="email" class="form-control validar" id="txtCorreo" placeholder="juan@example.com">
                            <div class="invalid-feedback">Formato de Correo Incorrecto</div>
                        </div>
                        <div class="col-md-4">
                            <label for="txtUsuario" class="form-label">Usuario </label>
                            <input type="text" class="form-control validar" id="txtUsuario" placeholder="usuario">
                            <div class="invalid-feedback">Ingrese un usuario</div>
                        </div>
                        <div class="col-md-4">
                            <label for="cboTipoDocumento" class="form-label">Tipo Documento</label>
                            <select class="form-select validar" id="cboTipoDocumento" onchange="generales.crearMaskPorTipoDocumento(this,'txtNumeroDocumento')">
                                <option value="0" disabled selected>Seleccione ...</option>
                            </select>
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                        <div class="col-md-4">
                            <label for="txtNumeroDocumento" class="form-label">Numero Documento (<span id="spnTipoDocumento"></span>) </label>
                            <input class="form-control validar" type="text" value="" id="txtNumeroDocumento" required>
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                        <div class="col-md-4">
                            <label for="cboRolUsuario" class="form-label">Rol</label>
                            <select id="cboRolUsuario" class="form-select validar">
                                <option value="" selected disabled>Seleccione...</option>
                                <option>...</option>
                            </select>
                            <div class="invalid-feedback">Selecione un rol de usuario</div>
                        </div>
                        <div class="col-md-4" id="divClave">
                            <div class="password-container">
                                <label for="password" class="form-label">Contraseña Temporal (Enviada)</label>
                                <input type="password" id="txtClave" class="form-control" placeholder="Contraseña" readonly>
                                <span id="togglePassword" class="toggle-password" onclick="togglePasswordVisibility()">
                                  <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>



                    </form><!-- End Multi Columns Form -->

                </div>
                <div class="card-footer">
                    <div class="text-center">
                        <button type="button" onclick="usuario.validarCampos()" class="btn btn-success">Guardar</button>
                        <?php if($id > 0) {?>
                            <button type="button" onclick="usuario.cambiarClave()" class="btn btn-primary">Enviar Clave Temporal</button>
                        <?php }?>
                        <button type="button" onclick="generales.atras('general','adm_usuarios')" class="btn btn-secondary">Cancelar</button>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include './general/views/footer.php'; ?>
<script src="general/js/usuario.js"></script>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("txtClave");
        var toggleIcon = document.getElementById("togglePassword");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordInput.type = "password";
            toggleIcon.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
</script>