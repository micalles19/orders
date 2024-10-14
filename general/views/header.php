<?php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ORDERS</title>
    <meta content="" name="SISTEMA DE GESTION EMPRESARIAL SIGE ">
    <meta content="" name="SIGE GRUPO UNIVERSAL">

    <!-- Favicons -->
    <link href="images/gob.png" rel="icon">
    <link href="images/gob.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style_personalizado.css" rel="stylesheet">
    <link href="assets/vendor/datatables_new/datatables.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/fontawesome.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/brands.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/solid.css" rel="stylesheet">

</head>
<div class="loader" style="display:none;">
    <div class="spinner-grow" style="width: 50px; height: 50px;" role="status">
    </div>
    <span class="loader-text">Cargando...</span>
</div>
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="./images/logos/gu-blanco.png">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->



            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" onclick="general.mostrarInfo()">
                    <img src="assets/img/user.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2" style="color:#fff"><?php echo $_SESSION['general']['usuario'][0]->nombre ?>  -<span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" id="ulInfo">
                    <li class="dropdown-header" >
                        <h6><?php echo $_SESSION['general']['usuario'][0]->nombre?></h6>
                        <span>ROL- Sucursal</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-person"></i>
                            <span>Mi perfil</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" onclick="general.cerrarSesion()">
                            <i class="bi bi-box-arrow-right"></i>
                            <span >Cerrar Sesión</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
