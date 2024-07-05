<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="./../images/logo.png" alt="" height="35">
                                </span>
                                <span class="logo-lg">
                                    <img src="./../images/logo.png" alt="" height="80" style="margin-left: 50px!important;">
                                </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="./../images/logo.png" alt="" height="35">
                                </span>
                        <span class="logo-lg">
                                    <img src="./../images/logo.png" alt="" height="35">
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

            </div>

            <div class="d-flex">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item topbar-light bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="./../assets/images/users/avatar-1.jpg"
                             alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1 fw-medium"><?php echo $_SESSION['general'][0]->nombre;  ?></span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
<!--                        <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-face-man font-size-16 align-middle me-1"></i> Profile</a>-->
<!--                        <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a>-->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="cerrarSesion()"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">Menu</li>

                    <li>
                        <a href="?page=inicio">
                            <i class="mdi mdi-home"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-account-group-outline"></i>
                            <span data-key="t-apps">Admin Clientes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="?page=cliente">
                                    <span data-key="t-calendar">&nbsp;&nbsp;&nbsp;Nuevo Cliente</span>
                                </a>
                            </li>

                        </ul>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="?page=administrar_clientes">
                                    <span data-key="t-calendar">&nbsp;&nbsp;&nbsp;Ver Clientes</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="?page=administrar_catalogos">
                            <i class="mdi mdi-book-cog-outline"></i>
                            <span data-key="t-horizontal">Administrar Catálogos</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=administrar_categorias">
                            <i class="mdi mdi-source-branch"></i>
                            <span data-key="t-horizontal">Administrar Categorias</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=administrar_productos">
                            <i class="mdi mdi-archive"></i>
                            <span data-key="t-horizontal">Administrar Productos</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-bookmark-box-multiple-outline"></i>
                            <span data-key="t-apps">Admin Ordenes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="?page=orden">
                                    <span data-key="t-calendar">&nbsp;&nbsp;&nbsp;Nueva Orden</span>
                                </a>
                            </li>

                        </ul>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="?page=administrar_ordenes">
                                    <span data-key="t-calendar">&nbsp;&nbsp;&nbsp;Administrar Ordenes</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="?page=administrarUsuarios">
                            <i class="mdi mdi-shield-account-outline"></i>
                            <span data-key="t-horizontal">Administrar Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="" onclick="cerrarSesion()">
                            <i class="mdi mdi-exit-to-app"></i>
                            <span data-key="t-horizontal">Cerrar Sesion</span>
                        </a>
                    </li>



                </ul>


            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->

    <div class="main-content">

        <div class="page-content">