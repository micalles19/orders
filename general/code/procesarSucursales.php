<?php
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
session_start();
$respuesta = (object)[];
$accion = "";
if (isset($_SESSION['general']['usuario'])) {
    if (!empty($_GET)) {
        $accion = isset($_GET['accion']) ? $_GET['accion'] : "";
    } else if (isset($_POST['accion'])) {
        $accion = isset($_POST['accion']) ? $_POST['accion'] : "";
    } else if (isset($input['accion'])) {
        $accion = isset($input['accion']) ? $input['accion'] : "";
    }
    include '../../general/code/MySQL_conection.php';
    include_once './Clases/Sucursal.php.php';
    include_once './Clases/GuardarErroresSistema.php';
    date_default_timezone_set('America/El_Salvador');
    $sucursal = new Sucursal();
    $sucursal->id = isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"] : null));
    $sucursal->idTipoEstablecimiento = isset($_GET["idTipoEstablecimiento"]) ? $_GET["idTipoEstablecimiento"] : (isset($input["idTipoEstablecimiento"]) ? $input["idTipoEstablecimiento"] : (isset($_POST["idTipoEstablecimiento"]) ? $_POST["idTipoEstablecimiento"] : null));
    $sucursal->idEmpresa = isset($_GET["idEmpresa"]) ? $_GET["idEmpresa"] : (isset($input["idEmpresa"]) ? $input["idEmpresa"] : (isset($_POST["idEmpresa"]) ? $_POST["idEmpresa"] : null));
    $sucursal->responsable = isset($_GET["responsable"]) ? $_GET["responsable"] : (isset($input["responsable"]) ? $input["responsable"] : (isset($_POST["responsable"]) ? $_POST["responsable"] : null));
    $sucursal->telefono = isset($_GET["telefono"]) ? $_GET["telefono"] : (isset($input["telefono"]) ? $input["telefono"] : (isset($_POST["telefono"]) ? $_POST["telefono"] : null));
    $sucursal->correo = isset($_GET["correo"]) ? $_GET["correo"] : (isset($input["correo"]) ? $input["correo"] : (isset($_POST["correo"]) ? $_POST["correo"] : null));
    $sucursal->idDepartamento = isset($_GET["idDepartamento"]) ? $_GET["idDepartamento"] : (isset($input["idDepartamento"]) ? $input["idDepartamento"] : (isset($_POST["idDepartamento"]) ? $_POST["idDepartamento"] : null));
    $sucursal->idMunicipio = isset($_GET["idMunicipio"]) ? $_GET["idMunicipio"] : (isset($input["idMunicipio"]) ? $input["idMunicipio"] : (isset($_POST["idMunicipio"]) ? $_POST["idMunicipio"] : null));
    $sucursal->idUsuario = $_SESSION['general']['usuario'][0]->id;
    $sucursal->hoy= date("Y-m-d H:i:s");

    switch ($accion) {
        case "guardar":
            $respuesta = $sucursal->guardar();
            break;
        default:
            $respuesta = $accion;
            break;
    }
}else{
        $respuesta->mensaje ="SESSION_DEAD";
    }
echo json_encode($respuesta);
