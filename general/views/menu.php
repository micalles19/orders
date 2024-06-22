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
        <?php if ($_SESSION['general']['usuario'][0]->idRol ==1) { ?>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="fas fa-tools"></i><span>Configuraciones Generales</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                </a>
<!--                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">-->
<!--                    <li>-->
<!--                        <a href="?module=general&page=datos_empresa" id="datos_empresa">-->
<!--                            <i class="bi bi-circle"></i><span>Datos Empresa</span>-->
<!--                        </a>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=general&page=adm_usuarios" id="adm_usuarios">
                            <i class="bi bi-circle"></i><span>Usuarios</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#productos" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-boxes-packing"></i><span>Productos</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="productos" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=productos&page=productos_administrar" id="productos_administrar">
                            <i class="bi bi-circle"></i><span>Adminsitrar Productos</span>
                        </a>
                        <a href="?module=productos&page=producto" id="producto">
                            <i class="bi bi-circle"></i><span>Nuevo Producto</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#clientes" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-users"></i><span>Clientes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="clientes" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=clientes&page=clientes_administrar" id="clientes_administrar">
                            <i class="bi bi-circle"></i><span>Adminsitrar Clientes</span>
                        </a>
                        <a href="?module=clientes&page=cliente" id="cliente">
                            <i class="bi bi-circle"></i><span>Nuevo Cliente</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#ordenes" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-cart-shopping"></i><span>Ordenes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="ordenes" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=ordenes&page=ordenes_administrar" id="ordenes_administrar">
                            <i class="bi bi-circle"></i><span>Ver  Ordenes</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=ordenes&page=orden" id="orden">
                            <i class="bi bi-circle"></i><span>Nueva Orden</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        <?php }?>
<!--        ROL DE VENDEDOR-->


        <li class="nav-item">
            <hr>
            <a class="nav-link collapsed" onclick="generales.cerrarSesion()">
                <i class="bi bi-box-arrow-left"></i>
                <span>Cerrar Sesión</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
<main id="main" class="main">