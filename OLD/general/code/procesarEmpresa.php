<?php
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
session_start();
$respuesta = (object)[];
$accion = "";
if (isset($_SESSION['general']['usuario'])) {
    if (!empty($_GET)) {
        $accion = isset($_GET['accion']) ? $_GET['accion'] : "";
    } else if (isset($_POST['accion'])) {
        $accion = isset($_POST['accion']) ? $_POST['accion'] : "";
    } else if (isset($input['accion'])) {
        $accion = isset($input['accion']) ? $input['accion'] : "";
    }
    include '../../general/code/MySQL_conection.php';
    include_once './Clases/Empresa.php';
    include_once './Clases/GuardarErroresSistema.php';
    date_default_timezone_set('America/El_Salvador');

    $empresa = new Empresa();
    $empresa->id = isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"] : null));
    $empresa->nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : (isset($input["nombre"]) ? $input["nombre"] : (isset($_POST["nombre"]) ? $_POST["nombre"] : null));
    $empresa->nombreComercial = isset($_GET["nombreComercial"]) ? $_GET["nombreComercial"] : (isset($input["nombreComercial"]) ? $input["nombreComercial"] : (isset($_POST["nombreComercial"]) ? $_POST["nombreComercial"] : null));
    $empresa->idPersoneria = isset($_GET["tipoPersoneria"]) ? $_GET["tipoPersoneria"] : (isset($input["tipoPersoneria"]) ? $input["tipoPersoneria"] : (isset($_POST["tipoPersoneria"]) ? $_POST["tipoPersoneria"] : null));
    $empresa->nit = isset($_GET["nit"]) ? $_GET["nit"] : (isset($input["nit"]) ? $input["nit"] : (isset($_POST["nit"]) ? $_POST["nit"] : null));
    $empresa->iva = isset($_GET["iva"]) ? $_GET["iva"] : (isset($input["iva"]) ? $input["iva"] : (isset($_POST["iva"]) ? $_POST["iva"] : null));
    $empresa->correo = isset($_GET["correo"]) ? $_GET["correo"] : (isset($input["correo"]) ? $input["correo"] : (isset($_POST["correo"]) ? $_POST["correo"] : null));
    $empresa->telefono = isset($_GET["telefono"]) ? $_GET["telefono"] : (isset($input["telefono"]) ? $input["telefono"] : (isset($_POST["telefono"]) ? $_POST["telefono"] : null));
    $empresa->idUsuario = $_SESSION['general']['usuario'][0]->id;
    $empresa->hoy= date("Y-m-d H:i:s");


    switch ($accion) {
        case "guardar":
            $respuesta = $empresa->guardar();
            break;
        case "obtenerAll":
            $respuesta = $empresa->obtenerAll();
            break;
        case"obtenerById":
            $respuesta = $empresa->obtenerById();
            break;
        case "actualizar":
            $respuesta = $empresa->actualizar();
            break;
        default:
            $respuesta = $accion;
            break;
    }
}else{
    $respuesta->mensaje ="SESSION_DEAD";
}
echo json_encode($respuesta);
