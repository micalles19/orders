<?php
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
session_start();
$respuesta = (object)[];
$accion = "";
if (isset($_SESSION['general']['usuario']) && !empty($_SESSION['general']['usuario'])) {
    if (!empty($_GET)) {
        $accion = isset($_GET['accion']) ? $_GET['accion'] : "";
    } else if (isset($input['accion'])) {
        $accion = isset($input['accion']) ? $input['accion'] : "prueba";
    }

    include '../../general/code/MySQL_conection.php';
    include_once './Clases/SolicitudTransferencia.php';

    $cuenta = new SolicitudTransferencia();

    $cuenta->id  =  isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:null));
    $cuenta->numeroCuenta =   isset($_GET["numeroCuenta"]) ? $_GET["numeroCuenta"] : (isset($input["numeroCuenta"]) ? $input["numeroCuenta"] : (isset($_POST["numeroCuenta"]) ? $_POST["numeroCuenta"]:null));
    $cuenta->idBanco =  isset($_GET["idBanco"]) ? $_GET["idBanco"] : (isset($input["idBanco"]) ? $input["idBanco"] : (isset($_POST["idBanco"]) ? $_POST["idBanco"]:null));
    $cuenta->idTipoCuenta =  isset($_GET["idTipoCuenta"]) ? $_GET["idTipoCuenta"] : (isset($input["idTipoCuenta"]) ? $input["idTipoCuenta"] : (isset($_POST["idTipoCuenta"]) ? $_POST["idTipoCuenta"]:null));
    $cuenta->idEmpresa =  isset($_GET["idEmpresa"]) ? $_GET["idEmpresa"] : (isset($input["idEmpresa"]) ? $input["idEmpresa"] : (isset($_POST["idEmpresa"]) ? $_POST["idEmpresa"]:null));
    $cuenta->idUsuario =$_SESSION['general']['usuario'][0]->id ;
    switch ($accion) {
        case "guardar":
            $respuesta = $cuenta->guardar();
            break;
        case "actualizar":
            $respuesta = $cuenta->actualizar();
            break;
        case "obtenerById":
            $respuesta = $cuenta->obtenerById();
            break;
        case "obtenerByTable":
            $respuesta = $cuenta->obtenerByTable();
            break;
        case "obtenerByCbo":
            $respuesta = $cuenta->obtenerByCbo();
            break;
        case "obtenerTiposCuentasByCbo":
            $respuesta = $cuenta->obtenerTiposCuentasByCbo();
            break;
            case "obtenerTiposTransferenciasByCbo":
            $respuesta = $cuenta->obtenerTiposTransferenciasByCbo();
            break;
        case "eliminar":
            $respuesta = $cuenta->eliminar();
            break;
        default:
            $respuesta = $accion;
            break;
    }
}else{
    $respuesta->mensaje  = "RENOVAR_SESSION";
}


echo json_encode($respuesta);
