<?php

$requestedPage = 'welcomePage';

$userName = App::getUser_name();
$userEmail = App::getUser_email();
$userPhoto = App::getUser_photoFilename();
$rolename = App::getUser_rolename();

if (isset($_GET['s'])) {
    $requestedPage = $_GET['s'] . 'Page';
}

if (isset($_GET['m'])) {
    $requestedPage = '\/../' . $_GET['m'] . '\/views/' . $requestedPage;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>UNO</title>
    <meta charset="utf-8" />
    <meta name="description" content="MST" />
    <meta name="keywords" content="gasolinera" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="GasStation" />
    <meta property="og:url" content="https://mrsoftware.tech" />
    <meta property="og:site_name" content="Mr Software Technologies" />
    <link rel="shortcut icon" href="src/assets/img/sys/favicon.jpeg" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="src/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

    <link href="src/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="src/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="src/assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="src/assets/css/loader.css" rel="stylesheet" type="text/css" />

</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

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

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">

        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">

                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">

                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>

                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="./" class="d-lg-none">
                            <img alt="Logo" src="src/assets/img/logos/default-small.svg" class="h-30px" />
                        </a>
                    </div>

                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">

                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">

                            <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">

                            </div>
                        </div>
                        <div class="app-navbar flex-shrink-0">

                            <div class="app-navbar-item ms-1 ms-md-4">

                                <a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-night-day theme-light-show fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                    <i class="ki-duotone ki-moon theme-dark-show fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">

                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-night-day fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                    <span class="path7"></span>
                                                    <span class="path8"></span>
                                                    <span class="path9"></span>
                                                    <span class="path10"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Light</span>
                                        </a>
                                    </div>

                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-moon fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Dark</span>
                                        </a>
                                    </div>

                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-screen fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">System</span>
                                        </a>
                                    </div>

                                </div>

                            </div>

                            <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">

                                <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <img src="src/assets/img/avatars/<?= $userPhoto; ?>?v=<?= date("YmdHi"); ?>" class="rounded-3" alt="user" />
                                </div>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">

                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">

                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo" src="src/assets/img/avatars/<?= $userPhoto; ?>?v=<?= date("YmdHi"); ?>" />
                                            </div>

                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5"><?= $userName ?>
                                                    <!-- <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span> -->
                                                </div>
                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?= $userEmail; ?></a>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="separator my-2"></div>

                                    <div class="menu-item px-5">
                                        <a href="./?s=profile" class="menu-link px-5">Mi perfil</a>
                                    </div>

                                    <div class="separator my-2"></div>

                                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                        <a href="#" class="menu-link px-5">
                                            <span class="menu-title position-relative">Idioma
                                                <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">Español
                                                    <img class="w-15px h-15px rounded-1 ms-2" src="src/assets/img/flags/spain.svg" alt="" /></span></span>
                                        </a>

                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">

                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link d-flex px-5 active">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1" src="src/assets/img/flags/united-states.svg" alt="" />
                                                    </span>English</a>
                                            </div>

                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link d-flex px-5">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1" src="src/assets/img/flags/spain.svg" alt="" />
                                                    </span>Español</a>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="menu-item px-5">
                                        <a href="#" class="menu-link px-5" id="logout-lnk">Cerrar sesión</a>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
                        <a href="./">
                            <img alt="Logo" src="src/assets/img/logos/unologo.webp" class="h-25px app-sidebar-logo-default" />
                            <img alt="Logo" src="src/assets/img/logos/default-small.svg" class="h-20px app-sidebar-logo-minimize" />

                            <span class="app-sidebar-logo-text"></span>
                        </a>

                        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>

                    </div>

                    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">

                        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">

                            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">

                                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                                    <div class="menu-item pt-5">

                                        <div class="menu-content">
                                            <span class="menu-heading fw-bold text-uppercase fs-7">Administración</span>
                                        </div>
                                    </div>

                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-profile-user fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Usuarios</span>
                                            <span class="menu-arrow"></span>
                                        </span>

                                        <div class="menu-sub menu-sub-accordion">

                                            <div class="menu-item">

                                                <a class="menu-link" href="./?s=userManagement">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Gestión</span>
                                                </a>

                                            </div>

                                            <div class="menu-item">

                                                <a class="menu-link" href="./?s=userSessions">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">Sesiones</span>
                                                </a>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link" href="./?s=branch">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-map fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Sucursales</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link" href="./?s=product">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-cube-3 fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Productos</span>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    <div class="d-flex flex-column flex-column-fluid">

                        <?php
                        if (!file_exists(__DIR__ . '/' . $requestedPage . '.php')) $requestedPage = '404Page';

                        require_once __DIR__ . '/' . $requestedPage . '.php';
                        ?>

                    </div>

                    <div id="kt_app_footer" class="app-footer">

                        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">

                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">2024&copy;</span>
                                <a href="https://mrsoftware.tech" target="_blank" class="text-gray-800 text-hover-primary">Mr Software Technologies</a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>

    <script>
        var hostUrl = "assets/";
    </script>

    <script src="src/assets/plugins/global/plugins.bundle.js"></script>
    <script src="src/assets/js/scripts.bundle.js"></script>
    <script src="src/assets/plugins/global/l10n/es.js"></script>
    <script src="src/assets/plugins/global/bootstrap-validation.init.js"></script>
    <script type="module" src="src/assets/js/custom/app.js"></script>
    <script type="module" src="src/assets/js/custom/custom.js"></script>
    <script src="src/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <?php
    if (isset($jsModules)) {
        $module = isset($_GET['mod']) ? base64_decode(urldecode($_GET['mod'])) . '/' : '';
        foreach ($jsModules as $file) {
            $urlArchivoJS = 'src/' . $module . 'assets/js/modules/' . $file . '.js';
            !file_exists($urlArchivoJS) && $urlArchivoJS = 'src/assets/js/modules/404-not-found.js';
    ?>
            <script type="module" src="<?= $urlArchivoJS ?>?v.1.0.4"></script>
    <?php
        }
    }
    ?>

</body>

</html>