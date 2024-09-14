<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./" />
    <title>Restaurant</title>
    <meta charset="utf-8" />
    <meta name="description" content="Restaurant admin" />
    <meta name="keywords" content="restaurant,Karla,Hernandez" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Restaurant" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="shortcut icon" href="src/assets/img/sys/favicon.jpeg" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <link href="src/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="src/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="src/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <link href="src/assets/css/custom.css" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">

    <div class="loader-container">
        <div class="loader"></div>
    </div>
    <script>
        var defaultThemeMode = "dark";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('src/assets/img/auth/bg10.jpeg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('src/assets/img/media/auth/bg10-dark.jpeg');
            }
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="src/assets/img/auth/unologo.webp" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="src/assets/img/auth/unologoDark.webp" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Sistema de toma de ordenes</h1>
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20" id="loginForm-container">
                            <form class="form w-100 needs-validation" novalidate id="loginForm" action="#">
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Inicia sesión</h1>
                                </div>
                                <div class="fv-row mb-8 mayusculas">
                                    <input type="text" placeholder="Usuario" name="txtUsername" id="txtUsername" autocomplete="off" class="form-control bg-transparent" required />
                                    <div class="invalid-feedback">
                                        Este campo es requerido
                                    </div>
                                </div>
                                <div class="fv-row mb-3">
                                    <div class="input-group">
                                        <input type="password" placeholder="Contraseña" name="txtPassword" id="txtPassword" autocomplete="off" class="form-control bg-transparent" required />
                                        <span class="input-group-text changePasswordType">
                                            <i class="bi bi-eye fs-2"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <a href="authentication/layouts/overlay/reset-password.html" class="link-primary">¿Has olvidado tu contraseña?</a>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">Ingresar</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20 d-none" id="passwordChangeForm-container">
                            <form class="form w-100 needs-validation" novalidate id="passwordChangeForm" action="#">
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Cambio de contraseña</h1>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Usuario" name="txtPasswordChangeUsername" id="txtPasswordChangeUsername" autocomplete="off" class="form-control bg-transparent" required readonly />
                                </div>
                                <div class="fv-row mb-3">
                                    <div class="input-group">
                                        <input type="password" placeholder="Nueva contraseña" name="txtNewPassword" id="txtNewPassword" autocomplete="off" class="form-control bg-transparent" required />
                                        <button class="input-group-text changePasswordType">
                                            <i class="bi bi-eye fs-2"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="fv-row mb-3">
                                    <div class="input-group">
                                        <input type="password" placeholder="Confirmar contraseña" name="txtConfirmPassword" id="txtConfirmPassword" autocomplete="off" class="form-control bg-transparent" required />
                                        <button class="input-group-text changePasswordType">
                                            <i class="bi bi-eye fs-2"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-grid mt-8">
                                    <button type="submit" id="kt_cp_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">Cambiar e ingresar</span>
                                    </button>
                                </div>
                                <div class="fv-row mt-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="password-rules-item">
                                                <span class="password-rules-icon password-rules-icon-length">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                                <span class="password-rules-text">Debe tener al menos 6 caracteres</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="password-rules-item">
                                                <span class="password-rules-icon password-rules-icon-number">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                                <span class="password-rules-text">Debe tener al menos un número</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="password-rules-item">
                                                <span class="password-rules-icon password-rules-icon-uppercase">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                                <span class="password-rules-text">Debe tener al menos una mayúscula</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="password-rules-item">
                                                <span class="password-rules-icon password-rules-icon-lowercase">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                                <span class="password-rules-text">Debe tener al menos una minúscula</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="src/assets/plugins/global/plugins.bundle.js"></script>
    <script src="src/assets/js/scripts.bundle.js"></script>
    <script src="src/assets/plugins/global/bootstrap-validation.init.js"></script>
    <script type="module" src="src/assets/js/custom/sweetMessages.js"></script>
    <script type="module" src="src/assets/js/custom/formFunctions.js"></script>
    <script src="src/assets/js/custom/custom.js"></script>
    <script type="module" src="src/assets/js/custom/constants.js"></script>
    <script type="module" src="src/assets/js/custom/general.js"></script>


    <script type="module" src="src/assets/js/modules/loginPage.js?v=1.0.3"></script>
</body>

</html>