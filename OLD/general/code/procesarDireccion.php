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

include "MySQL_conection.php";
include_once 'clases/Direccion.php';
$direccion = new Direccion();

switch ($accion) {
    case 'departamentos':
        $respuesta = $direccion->obtenerDepartamento();
        break;

    case 'municipios':
        $respuesta = $direccion->obtenerMunicipio($_GET["idDepartamento"]);
        break;
    case 'distritos':
        $respuesta = $direccion->obtenerDistritos($_GET["idMunicipio"]);
        break;
    default:
        $respuesta->mensaje = "NO_CASE";
        break;
}
echo json_encode($respuesta);