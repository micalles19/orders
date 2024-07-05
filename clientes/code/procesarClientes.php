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
include_once './Clases/Cliente.php';

$cliente = new Cliente();
$cliente->id = isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:"null"));
$cliente->nombreCliente = isset($_GET["nombreCliente"]) ? $_GET["nombreCliente"] : (isset($input["nombreCliente"]) ? $input["nombreCliente"] : (isset($_POST["nombreCliente"]) ? $_POST["nombreCliente"]: null));
$cliente->tipoDocumento = isset($_GET["tipoDocumento"]) ? $_GET["tipoDocumento"] : (isset($input["tipoDocumento"]) ? $input["tipoDocumento"] : (isset($_POST["tipoDocumento"]) ? $_POST["tipoDocumento"]:null));
$cliente->numeroDocumento = isset($_GET["numeroDocumento"]) ? $_GET["numeroDocumento"] : (isset($input["numeroDocumento"]) ? $input["numeroDocumento"] : (isset($_POST["numeroDocumento"]) ? $_POST["numeroDocumento"]:null));
$cliente->iva = isset($_GET["iva"]) ? $_GET["iva"] : (isset($input["iva"]) ? $input["iva"] : (isset($_POST["iva"]) ? $_POST["iva"]:null));
$cliente->actividadEconomica = isset($_GET["actividadEconomica"]) ? $_GET["actividadEconomica"] : (isset($input["actividadEconomica"]) ? $input["actividadEconomica"] : (isset($_POST["actividadEconomica"]) ? $_POST["actividadEconomica"]:null));
$cliente->email = isset($_GET["email"]) ? $_GET["email"] : (isset($input["email"]) ? $input["email"] : (isset($_POST["email"]) ? $_POST["email"]:null));
$cliente->telefono = isset($_GET["telefono"]) ? $_GET["telefono"] : (isset($input["telefono"]) ? $input["telefono"] : (isset($_POST["telefono"]) ? $_POST["telefono"]:null));
$cliente->departamento = isset($_GET["departamento"]) ? $_GET["departamento"] : (isset($input["departamento"]) ? $input["departamento"] : (isset($_POST["departamento"]) ? $_POST["departamento"]:null));
$cliente->municipio = isset($_GET["municipio"]) ? $_GET["municipio"] : (isset($input["municipio"]) ? $input["municipio"] : (isset($_POST["municipio"]) ? $_POST["municipio"]:null));
$cliente->direccion = isset($_GET["direccion"]) ? $_GET["direccion"] : (isset($input["direccion"]) ? $input["direccion"] : (isset($_POST["direccion"]) ? $_POST["direccion"]:null));
$cliente->idUsuario = $_SESSION['general']['usuario'][0]->id ;

switch ($accion) {
    case "guardar":
        $respuesta = $cliente->guardar();
        break;
    case "actualizar":
        $respuesta = $cliente->actualizar();
        break;
    case "obtenerById":
        $respuesta = $cliente->obtenerById();
        break;
    case "eliminar":
        $respuesta = $cliente->eliminar();
        break;
    case "obtenerClientesByTable":
        $respuesta = $cliente->obtenerClientesByTable();
        break;
    case "obtenerTiposClientes":
        $respuesta = $cliente->obtenerTiposClientes();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);