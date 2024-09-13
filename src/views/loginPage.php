<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ORDERS / LOGIN</title>
    <meta content="SINAMA" name="description">
    <meta content="SINAMA" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="src/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="src/assets/libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="src/assets/libs/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="src/assets/libs/quill/quill.snow.css" rel="stylesheet">
    <link href="src/assets/libs/quill/quill.bubble.css" rel="stylesheet">
    <link href="src/assets/libs/remixicon/remixicon.css" rel="stylesheet">
    <link href="src/assets/libs/simple-datatables/style.css" rel="stylesheet">

    <link href="src/assets/css/style.css" rel="stylesheet">
    <link href="src/assets/css/custom.css" rel="stylesheet">
</head>
<div class="loader d-none">
    <div class="spinner-grow" style="width: 50px; height: 50px;" role="status">
    </div>
    <span class="loader-text">Cargando...</span>
</div>

<body>
    <main style="background: #313945 !important;">
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">
                                    <div class="d-flex justify-content-center py-4">
                                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                                        </a>
                                    </div>
                                    <div style="margin-top: -8%!important;">
                                        <h5 class="card-title text-center pb-0 fs-4">¡BIENVENIDO/A!
                                        </h5>
                                        <p class="text-center small">Sistema de toma de ordenes
                                        </p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate>
                                        <input id="hdnUsuario" type="hidden" value="0">

                                        <div class="col-12" id="divUsuario">
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control validar" id="txtUsuario" required>
                                                <div class="invalid-feedback">Por favor ingrese su usuario</div>
                                            </div>
                                        </div>

                                        <div class="col-12" id="divClave">
                                            <input type="password" name="passwword" class="form-control validar" id="txtClave" required>
                                            <div class="invalid-feedback">Por favor ingrese su contraseña!</div>
                                        </div>
                                        <div class="col-12" id="divClaveNueva" style="display: none">
                                            <label for="passwordNew">Ingrese la nueva Contraseña</label>
                                            <input type="password" name="passwordNew" class="form-control validarNew" id="passwordNew" required>
                                            <div class="invalid-feedback" id="spnClave">Por favor ingrese su contraseña!</div>
                                        </div>
                                        <div class="col-12" id="divClaveConf" style="display: none">
                                            <label for="passwordConf">Confirme la nueva Contraseña</label>
                                            <input type="password" name="passwordConf" class="form-control validarNew" id="passwordConf" required>
                                            <div class="invalid-feedback">Por favor ingrese su contraseña!</div>
                                        </div>
                                        <div class="col-12" id="btnIniciarSesion">
                                            <button class="btn btn-primary w-100" type="button" onclick="auth.validarInicio()">Iniciar Sesión</button>
                                        </div>
                                        <div class="col-12" id="btnReestablecerClave" style="display: none">
                                            <button class="btn btn-primary w-100" type="button" onclick="auth.validarActualizarClave()">Actualizar Contraseña</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">¿Olvidaste tu clave? <a href="#" onclick="auth.solicitudReestablecerClave()">Restaurar Clave</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="src/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="src/assets/libs/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <!-- <script src="general/js/auth.js"></script> -->
    <script src="src/assets/js/bootstrap-validation.init.js"></script>
    <script src="src/assets/libs/jquery/js/jquery-3.3.1.js"></script>
    <!-- <script src="general/js/scripts_generales.js"></script>
    <script src="general/js/scripts_alertas.js"></script> -->
    <!-- <script src="general/js/fetch_lib.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="module" src="src/assets/js/modules/loginPage.js"></script>

</body>

</html>