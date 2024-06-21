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
include_once './Clases/Municipio.php';
date_default_timezone_set('America/El_Salvador');
$municipios = new Municipio();

switch ($accion) {
    case "obtener":
        $municipios->idDepartamento = $_GET["idDepartamento"];
        $respuesta = $municipios->Obtener();
        break;
    case "obtenerDistritos":
        $municipios->idMunicipio = $_GET["idMunicipio"];
        $respuesta = $municipios->obtenerDistritosByMunicipio();
        break;
    default:
        $respuesta = $accion;
        break;
}
echo json_encode($respuesta);
