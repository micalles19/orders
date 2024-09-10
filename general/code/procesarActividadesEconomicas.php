<?php


header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
session_start();
$respuesta = (object)[];
$accion = "";
if (!empty($_GET)) {
    $accion = isset($_GET['accion']) ? $_GET['accion'] : "";
} else if (isset($_POST['accion'])) {
    $accion = isset($_POST['accion']) ? $_POST['accion'] : "";
} else if (isset($input['accion'])) {
    $accion = isset($input['accion']) ? $input['accion'] : "";
}
include '../../general/code/MySQL_conection.php';
include_once './Clases/ActividadesEconomicas.php';
include_once './Clases/GuardarErroresSistema.php';

date_default_timezone_set('America/El_Salvador');
$actividades = new ActividadesEconomicas();
$actividades->id = isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"] : null));
$actividades->idEmpresa = isset($_GET["idEmpresa"]) ? $_GET["idEmpresa"] : (isset($input["idEmpresa"]) ? $input["idEmpresa"] : (isset($_POST["idEmpresa"]) ? $_POST["idEmpresa"] : null));
$actividades->idUsuario = $_SESSION['general']['usuario'][0]->id;
$actividades->hoy= date("Y-m-d H:i:s");

switch ($accion) {
    case "obtener":
        $respuesta = $actividades->Obtener();
        break;
    case "guardarDetalleEconomica":
        $respuesta = $actividades->guardarDetalle();
        break;
        case "actualizarDetalleEconomica":
        $respuesta = $actividades->actualizarDetalle($input["idUpdt"]);
        break;
        case "eliminarDetalle":
        $respuesta = $actividades->eliminarDetalle();
        break;
    default:
        $respuesta = $accion;
        break;
}
echo json_encode($respuesta);
