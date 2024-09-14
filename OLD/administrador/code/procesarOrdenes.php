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
include "MySQL_conection.php";
include_once 'clases/Orden.php';


$orden = new Orden();
switch ($accion) {
    case "obtenerByTable":
        $respuesta = $orden->obtenerByTable();
        break;
    case "obtenerDatosOrdenById":
        $orden->id = $_GET["id"];
        $respuesta = $orden->obtenerDatosOrdenById();
        break;
    case "despacharOrden":
        $orden->id = $input["id"];
        $orden->idEstadoOrden = $input["estadoOrden"];
        $respuesta = $orden->despacharOrden();
        break;
    case "entregarOrden":
        $orden->id = $input["id"];
        $orden->idEstadoOrden = $input["estadoOrden"];
        $respuesta = $orden->entregarOrden();
        break;
        case "cancelarOrden":
        $orden->id = $input["id"];
        $orden->idEstadoOrden = $input["estadoOrden"];
        $respuesta = $orden->cancelarOrden();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);
