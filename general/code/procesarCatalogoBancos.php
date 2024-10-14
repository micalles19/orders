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
include_once './Clases/CatalogoBancos.php';

$catalogoBancos = new CatalogoBancos();

$catalogoBancos->id  =  isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:null));
$catalogoBancos->nombre =   isset($_GET["nombre"]) ? $_GET["nombre"] : (isset($input["nombre"]) ? $input["nombre"] : (isset($_POST["nombre"]) ? $_POST["nombre"]:null));
$catalogoBancos->descripcion =  isset($_GET["descripcion"]) ? $_GET["descripcion"] : (isset($input["descripcion"]) ? $input["descripcion"] : (isset($_POST["descripcion"]) ? $_POST["descripcion"]:null));
$catalogoBancos->idUsuario =$_SESSION['general']['usuario'][0]->id ;
switch ($accion) {
    case "guardar":
        $respuesta = $catalogoBancos->guardar();
        break;
    case "actualizar":
        $respuesta = $catalogoBancos->actualizar();
        break;
    case "obtenerById":
        $respuesta = $catalogoBancos->obtenerById();
        break;
    case "obtenerByTable":
        $respuesta = $catalogoBancos->obtenerByTable();
        break;
    case "obtenerByCbo":
        $respuesta = $catalogoBancos->obtenerByCbo();
        break;
    case "eliminar":
        $respuesta = $catalogoBancos->eliminar();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);
