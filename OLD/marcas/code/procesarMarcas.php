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
include_once './Clases/Marcas.php';

$marcas = new Marcas();

$marcas->id  =  isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:null));
$marcas->nombre =   isset($_GET["nombre"]) ? $_GET["nombre"] : (isset($input["nombre"]) ? $input["nombre"] : (isset($_POST["nombre"]) ? $_POST["nombre"]:null));
$marcas->descripcion =  isset($_GET["descripcion"]) ? $_GET["descripcion"] : (isset($input["descripcion"]) ? $input["descripcion"] : (isset($_POST["descripcion"]) ? $_POST["descripcion"]:null));
$marcas->estado = isset($_GET["estado"]) ? $_GET["estado"] : (isset($input["estado"]) ? $input["estado"] : (isset($_POST["estado"]) ? $_POST["estado"]:null));
switch ($accion) {
    case "guardar":
        $respuesta = $marcas->guardar();
        break;
    case "actualizar":
        $respuesta = $marcas->actualizar();
        break;
    case "obtenerById":
        $respuesta = $marcas->obtenerById();
        break;
    case "obtenerByTable":
        $respuesta = $marcas->obtenerByTable();
        break;
    case "obtenerByCbo":
        $respuesta = $marcas->obtenerByCbo();
        break;
    case "eliminar":
        $respuesta = $marcas->eliminar();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);
