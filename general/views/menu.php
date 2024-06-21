<?php ?>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="?module=general&page=home">
                <i class="bi bi-grid"></i>
                <span>Inicio</span>
            </a>
        </li>

<!--        ROL administrador-->
        <?php if ($_SESSION['general']['usuario'][0]->idRol) { ?>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="fas fa-tools"></i><span>Configuraciones Generales</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=general&page=datos_empresa" id="datos_empresa">
                            <i class="bi bi-circle"></i><span>Datos Empresa</span>
                        </a>
                    </li>

                </ul>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=general&page=adm_usuarios" id="adm_usuarios">
                            <i class="bi bi-circle"></i><span>Usuarios</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Catálogos</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=administracion&page=cat_adm_tipo_unidad_ambiental" id="cat_adm_tipo_unidad_ambiental">
                            <i class="bi bi-circle"></i><span>Adminsitrar Tipos de Unidades</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=administracion&page=cat_adm_segmentos_uai" id="cat_adm_segmentos_uai">
                            <i class="bi bi-circle"></i><span>Administrar Segmentos</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        <?php }?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#hga" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-list-check"></i><span>Gestión Ambiental</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="hga" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <?php if ($_SESSION['general']['usuario']["tipoUsuario"] == 1) { ?>
                        <li>
                            <a href="?module=hga&page=dashboard" id="dashboard">
                                <i class="bi bi-circle"></i><span>Dashboard Institucional</span>
                            </a>
                        </li>
                        <li>
                            <a href="?module=hga&page=dashboardM" id="dashboardM">
                                <i class="bi bi-circle"></i><span>Dashboard Municipal</span>
                            </a>
                        </li>
                    <?php }else{ ?>
                        <li>
                            <a href="?module=hga&page=dashboard_unidad_ambiental" id="dashboardM">
                                <i class="bi bi-circle"></i><span>Dashboard</span>
                            </a>
                        </li>
                    <?php }?>
                    <li>
                        <a href="?module=hga&page=adm_herramienta_tecnica" id="adm_herramienta_tecnica">
                            <i class="bi bi-circle"></i><span>Herramienta Técnica</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#ecobalance">
                <i class="fa-solid fa-earth-americas"></i><span>Ecoeficiencia</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ecobalance2" class="nav-content" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="?module=ecobalance&page=home" id="home">
                        <i class="bi bi-grid"  style="font-size: 15px!important;"></i><span>Home</span>
                    </a>
                </li>

                    <li>
                        <a href="?module=ecobalance&page=dashboard_general" id="dashboard_general">
                            <i class="fa-solid fa-chart-line" style="font-size: 15px!important;"></i><span>Dashboard Ecoeficiencia</span>
                        </a>
                    </li>
            </ul>
            <ul id="ecobalance" class="nav-content collapse" data-bs-parent="#sidebar-nav">

                <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#EcoeficienciaPapel">
                            <i class="fa-solid fa-scroll" style="font-size: 15px!important;"></i><span>Papel</span><i class="bi bi-chevron-down ms-auto" style="font-size: 14px;"></i>
                        </a>
                        <ul id="EcoeficienciaPapel" class="nav-content collapse" data-bs-parent="#Ecoeficiencia">
                            <li style="margin-left: 20px!important;">
                                    <a href="?module=ecobalance&page=papel_dashboard" style="padding-top: 5px!important; padding-bottom: 5px!important;" id="papel_dashboard">
                                        <i class="bi bi-circle"></i><span>Dashboard</span>
                                    </a>

                            </li>
                        </ul>
                    </li>
            </ul>
        </li>


        <li class="nav-item">
            <hr>
            <a class="nav-link collapsed" onclick="general.cerrarSesion()">
                <i class="bi bi-box-arrow-left"></i>
                <span>Cerrar Sesión</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
<main id="main" class="main">