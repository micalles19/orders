<?php

// acivar en produccion
//if ($_SERVER['HTTPS'] != "on") {
//    $url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//    header("Location: $url");
//    exit;
//}

$four_hours = 4 * 60 * 60; // 4 horas en segundos
ini_set('session.gc_maxlifetime', $four_hours);
// Inicia la sesión
session_start();
// Actualiza el tiempo de expiración de la sesión si existe
if (isset($_SESSION['general'])) {
    $_SESSION['general']['_expires'] = time() + $four_hours;
}
// Finalmente, regenera la ID de sesión para prevenir ataques de fijación de sesión
session_regenerate_id(true);


if (isset($_SESSION['general']) && !empty($_SESSION['general'])) {
    $modulo =isset($_GET['module']) ? $_GET['module'] : 'general';
    $pagina = isset($_GET['page']) ? $_GET['page'] : 'home';
    $final = $modulo.$pagina;
    require_once './general/views/header.php';
    require_once './general/views/menu.php';
    $ruta = "./".$modulo.'/views/' . $pagina . '.php';
    if (file_exists($ruta)) {
        $ruta;
    } else {
        $ruta = './general/views/404-not-found.php';
    }

    require_once $ruta;
} else {
    require_once './general/views/login.php';
}

?>