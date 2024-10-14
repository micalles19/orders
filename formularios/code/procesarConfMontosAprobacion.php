<?php
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
session_start();
$respuesta = (object)[];
$accion = "";

if (!empty($_GET)) {
    $accion = isset($_GET['accion']) ? $_GET['accion'] : "";
} else if (isset($input['accion'])) {
    $accion = isset($input['accion']) ? $input['accion'] : "prueba";
}

include '../../general/code/MySQL_conection.php';
include_once './Clases/MontosAprobacion.php';

$montos = new MontosAprobacion();

$montos->id  =  isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:null));
$montos->idCuenta =   isset($_GET["idCuenta"]) ? $_GET["idCuenta"] : (isset($input["idCuenta"]) ? $input["idCuenta"] : (isset($_POST["idCuenta"]) ? $_POST["idCuenta"]:null));
$montos->idUsuarioAutorizado =  isset($_GET["idUsuario"]) ? $_GET["idUsuario"] : (isset($input["idUsuario"]) ? $input["idUsuario"] : (isset($_POST["idUsuario"]) ? $_POST["idUsuario"]:null));
$montos->montoDesde =  isset($_GET["montoDesde"]) ? $_GET["montoDesde"] : (isset($input["montoDesde"]) ? $input["montoDesde"] : (isset($_POST["montoDesde"]) ? $_POST["montoDesde"]:null));
$montos->montoHasta =  isset($_GET["montoHasta"]) ? $_GET["montoHasta"] : (isset($input["montoHasta"]) ? $input["montoHasta"] : (isset($_POST["montoHasta"]) ? $_POST["montoHasta"]:null));
$montos->estado =  isset($_GET["estado"]) ? $_GET["estado"] : (isset($input["estado"]) ? $input["estado"] : (isset($_POST["estado"]) ? $_POST["estado"]:null));
$montos->idUsuario =$_SESSION['general']['usuario'][0]->id;


switch ($accion) {
    case "guardar":
        $respuesta = $montos->guardar();
        break;
    case "actualizar":
        $respuesta = $montos->actualizar();
        break;
    case "obtenerById":
        $respuesta = $montos->obtenerById();
        break;
    case "obtenerByTable":
        $respuesta = $montos->obtenerByTable();
        break;
    case "obtenerByCbo":
        $respuesta = $montos->obtenerByCbo();
        break;
    case "eliminar":
        $respuesta = $montos->eliminar();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);
