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
include_once './Clases/CatalogoSeguro.php';

$catalogoSeguro = new CatalogoSeguro();

$catalogoSeguro->id  =  isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:null));
$catalogoSeguro->nombre =   isset($_GET["nombre"]) ? $_GET["nombre"] : (isset($input["nombre"]) ? $input["nombre"] : (isset($_POST["nombre"]) ? $_POST["nombre"]:null));
$catalogoSeguro->descripcion =  isset($_GET["descripcion"]) ? $_GET["descripcion"] : (isset($input["descripcion"]) ? $input["descripcion"] : (isset($_POST["descripcion"]) ? $_POST["descripcion"]:null));
$catalogoSeguro->porcentajePatronal =  isset($_GET["porcentajePatronal"]) ? $_GET["porcentajePatronal"] : (isset($input["porcentajePatronal"]) ? $input["porcentajePatronal"] : (isset($_POST["porcentajePatronal"]) ? $_POST["porcentajePatronal"]:null));
$catalogoSeguro->porcentajeTrabajador =  isset($_GET["porcentajeTrabajador"]) ? $_GET["porcentajeTrabajador"] : (isset($input["porcentajeTrabajador"]) ? $input["porcentajeTrabajador"] : (isset($_POST["porcentajeTrabajador"]) ? $_POST["porcentajeTrabajador"]:null));
$catalogoSeguro->techoMaximo =  isset($_GET["techoMaximo"]) ? $_GET["techoMaximo"] : (isset($input["techoMaximo"]) ? $input["techoMaximo"] : (isset($_POST["techoMaximo"]) ? $_POST["techoMaximo"]:null));
$catalogoSeguro->idUsuario =$_SESSION['general']['usuario'][0]->id ;
switch ($accion) {
    case "guardar":
        $respuesta = $catalogoSeguro->guardar();
        break;
    case "actualizar":
        $respuesta = $catalogoSeguro->actualizar();
        break;
    case "obtenerById":
        $respuesta = $catalogoSeguro->obtenerById();
        break;
    case "obtenerByTable":
        $respuesta = $catalogoSeguro->obtenerByTable();
        break;
    case "obtenerByCbo":
        $respuesta = $catalogoSeguro->obtenerByCbo();
        break;
    case "eliminar":
        $respuesta = $catalogoSeguro->eliminar();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);
