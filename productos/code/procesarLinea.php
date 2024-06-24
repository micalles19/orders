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
include_once './Clases/Linea.php';
date_default_timezone_set('America/El_Salvador');

$linea = new Linea();
$linea->id = isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:"null"));
$linea->codigoFox = isset($_GET["codigoFox"]) ? $_GET["codigoFox"] : (isset($input["codigoFox"]) ? $input["codigoFox"] : (isset($_POST["codigoFox"]) ? $_POST["codigoFox"]:"null"));
$linea->nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : (isset($input["nombre"]) ? $input["nombre"] : (isset($_POST["nombre"]) ? $_POST["nombre"]:"null"));


switch ($accion) {
    case "obtenerCbo":
        $respuesta = $linea->obtenerCbo();
        break;
    default:
        $respuesta = $accion;
        break;
}
echo json_encode($respuesta);
