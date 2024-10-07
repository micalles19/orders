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
                <a class="nav-link collapsed" data-bs-target="#generales" data-bs-toggle="collapse" href="#">
                    <i class="fas fa-tools"></i><span>Configuraciones Generales</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="generales" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=general&page=adm_empresas" id="adm_empresas">
                            <i class="bi bi-circle"></i><span>Administrar Empresa</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=general&page=adm_usuarios" id="adm_usuarios">
                            <i class="bi bi-circle"></i><span>Usuarios</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#catalogos" data-bs-toggle="collapse" href="#">
                    <i class="fa-regular fa-bookmark"></i><span>Catálogos, Categorias & Sub Categorias</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="catalogos" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=catalogos&page=administrar_catalogos" id="administrar_catalogos">
                            <i class="bi bi-circle"></i><span>Administrar Catálogos</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=catalogos&page=catalogo" id="catalogo">
                            <i class="bi bi-circle"></i><span>Nuevo Catálogo</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=catalogos&page=administrar_categorias" id="administrar_categorias">
                            <i class="bi bi-circle"></i><span>Administrar Categoría</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=catalogos&page=categoria" id="categoria">
                            <i class="bi bi-circle"></i><span>Nueva Categoría</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=catalogos&page=administrar_sub_categorias" id="administrar_sub_categorias">
                            <i class="bi bi-circle"></i><span>Administrar Sub Categoría</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=catalogos&page=sub_categoria" id="sub_categoria">
                            <i class="bi bi-circle"></i><span>Nueva Sub Categoría</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#marcas" data-bs-toggle="collapse" href="#">
                    <i class="fa-regular fa-bookmark"></i><span>Marcas</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="marcas" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=marcas&page=administrar_marcas" id="administrar_marcas">
                            <i class="bi bi-circle"></i><span>Administrar Marcas</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=marcas&page=marca" id="marca">
                            <i class="bi bi-circle"></i><span>Nueva Marca</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#productos" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-boxes-packing"></i><span>Productos</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="productos" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=productos&page=productos_administrar" id="productos_administrar">
                            <i class="bi bi-circle"></i><span>Administrar Productos</span>
                        </a>
                        <a href="?module=productos&page=producto" id="producto">
                            <i class="bi bi-circle"></i><span>Nuevo Producto</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#clientes" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-users"></i><span>Clientes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="clientes" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=clientes&page=administrar_clientes" id="administrar_clientes">
                            <i class="bi bi-circle"></i><span>Administrar Clientes</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=clientes&page=cliente" id="cliente">
                            <i class="bi bi-circle"></i><span>Nuevo Cliente</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#proveedores" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-people-carry-box"></i><span>Proveedores</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="proveedores" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?module=proveedores&page=administrar_proveedor" id="administrar_proveedor">
                            <i class="bi bi-circle"></i><span>Administrar Proveedores</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=proveedores&page=proveedor" id="proveedor">
                            <i class="bi bi-circle"></i><span>Nuevo Proveedor</span>
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
                            <i class="bi bi-circle"></i><span>Ver Ordenes</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=ordenes&page=orden" id="orden">
                            <i class="bi bi-circle"></i><span>Nueva Orden</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
            <hr>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#planilla" data-bs-toggle="collapse" href="#">
                    <i class="fa-solid fa-receipt"></i><span>PLANILLAS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="planilla" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#planillaCatalogos">
                            <i class="fa-solid fa-scroll" style="font-size: 15px!important;"></i><span>Catálogos</span><i class="bi bi-chevron-down ms-auto" style="font-size: 14px;"></i>
                        </a>
                        <ul id="planillaCatalogos" class="nav-content collapse" data-bs-parent="#planillaCatalogos">
                            <li style="margin-left: 20px!important;">

                                <a href="?module=planilla&page=adm_tipo_empleado" style="padding-top: 5px!important; padding-bottom: 5px!important;" id="adm_tipo_empleado">
                                    <i class="bi bi-circle"></i><span>Tipos de Empleado</span>
                                </a>
                                <a href="?module=planilla&page=adm_cargos_empleados" style="padding-top: 5px!important; padding-bottom: 5px!important;" id="adm_cargos_empleados">
                                    <i class="bi bi-circle"></i><span>Catálogo de Cargos</span>
                                </a>
                                <a href="?module=planilla&page=adm_catalogo_bancos" style="padding-top: 5px!important; padding-bottom: 5px!important;" id="catalogo_bancos">
                                    <i class="bi bi-circle"></i><span>Catálogo de Bancos</span>
                                </a>
                                <a href="?module=planilla&page=adm_catalogo_afp" style="padding-top: 5px!important; padding-bottom: 5px!important;" id="catalogo_afp">
                                    <i class="bi bi-circle"></i><span>Catálogo de AFP</span>
                                </a>
                                <a href="?module=planilla&page=adm_catalogo_seguros" style="padding-top: 5px!important; padding-bottom: 5px!important;" id="adm_catalogo_seguros">
                                    <i class="bi bi-circle"></i><span>Catálogo de Seguros</span>
                                </a>


                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?module=planilla&page=amd_empleados" id="amd_empleados">
                            <i class="bi bi-circle"></i><span>Empleados</span>
                        </a>
                    </li>
                    <li>
                        <a href="?module=planilla&page=adm_planilla" id="adm_planilla">
                            <i class="bi bi-circle"></i><span>Planillas</span>
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