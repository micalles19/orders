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
include_once './Clases/CatalogoAfp.php';

$catalogoAfp = new CatalogoAfp();

$catalogoAfp->id  =  isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:null));
$catalogoAfp->nombre =   isset($_GET["nombre"]) ? $_GET["nombre"] : (isset($input["nombre"]) ? $input["nombre"] : (isset($_POST["nombre"]) ? $_POST["nombre"]:null));
$catalogoAfp->descripcion =  isset($_GET["descripcion"]) ? $_GET["descripcion"] : (isset($input["descripcion"]) ? $input["descripcion"] : (isset($_POST["descripcion"]) ? $_POST["descripcion"]:null));
$catalogoAfp->porcentajePatronal =  isset($_GET["porcentajePatronal"]) ? $_GET["porcentajePatronal"] : (isset($input["porcentajePatronal"]) ? $input["porcentajePatronal"] : (isset($_POST["porcentajePatronal"]) ? $_POST["porcentajePatronal"]:null));
$catalogoAfp->porcentajeTrabajador =  isset($_GET["porcentajeTrabajador"]) ? $_GET["porcentajeTrabajador"] : (isset($input["porcentajeTrabajador"]) ? $input["porcentajeTrabajador"] : (isset($_POST["porcentajeTrabajador"]) ? $_POST["porcentajeTrabajador"]:null));
$catalogoAfp->techoMaximo =  isset($_GET["techoMaximo"]) ? $_GET["techoMaximo"] : (isset($input["techoMaximo"]) ? $input["techoMaximo"] : (isset($_POST["techoMaximo"]) ? $_POST["techoMaximo"]:null));
$catalogoAfp->idUsuario =$_SESSION['general']['usuario'][0]->id ;
switch ($accion) {
    case "guardar":
        $respuesta = $catalogoAfp->guardar();
        break;
    case "actualizar":
        $respuesta = $catalogoAfp->actualizar();
        break;
    case "obtenerById":
        $respuesta = $catalogoAfp->obtenerById();
        break;
    case "obtenerByTable":
        $respuesta = $catalogoAfp->obtenerByTable();
        break;
    case "obtenerByCbo":
        $respuesta = $catalogoAfp->obtenerByCbo();
        break;
    case "eliminar":
        $respuesta = $catalogoAfp->eliminar();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);
