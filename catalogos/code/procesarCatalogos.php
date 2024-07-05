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
include_once './Clases/Catalogo.php';


$catalogo = new Catalogo();
$catalogo->id  =  isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:null));
$catalogo->nombre =   isset($_GET["nombre"]) ? $_GET["nombre"] : (isset($input["nombre"]) ? $input["nombre"] : (isset($_POST["nombre"]) ? $_POST["nombre"]:null));
$catalogo->descripcion =  isset($_GET["descripcion"]) ? $_GET["descripcion"] : (isset($input["descripcion"]) ? $input["descripcion"] : (isset($_POST["descripcion"]) ? $_POST["descripcion"]:null));
$catalogo->estado = isset($_GET["estado"]) ? $_GET["estado"] : (isset($input["estado"]) ? $input["estado"] : (isset($_POST["estado"]) ? $_POST["estado"]:null));
$catalogo->idUsuario = $_SESSION['general']['usuario'][0]->id ;

switch ($accion) {
    case "guardarCatalogo":
        $respuesta = $catalogo->guardar();
        break;
    case "actualizarCatalogo":
        $respuesta = $catalogo->actualizar();
        break;
    case "obtenerCatalogoById":
        $respuesta = $catalogo->obtenerCatalogoById();
        break;
    case "obtenerCatalogosByTable":
        $respuesta = $catalogo->obtenerCatalogosByTable();
        break;
    case "obtenerByCbo":
        $respuesta = $catalogo->obtenerByCbo();
        break;
    case "eliminar":
        $catalogo->id = $input["id"];
        $respuesta = $catalogo->eliminar();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);