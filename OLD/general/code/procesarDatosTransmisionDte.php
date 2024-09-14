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
    include_once './Clases/GuardarErroresSistema.php';
    include_once './Clases/TransmisionDTE.php';
    date_default_timezone_set('America/El_Salvador');
    $transmisionDTE = new TransmisionDTE();
    $transmisionDTE->id = isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"] : null));
    $transmisionDTE->idEmpresa = isset($_GET["idEmpresa"]) ? $_GET["idEmpresa"] : (isset($input["idEmpresa"]) ? $input["idEmpresa"] : (isset($_POST["idEmpresa"]) ? $_POST["idEmpresa"] : null));
    $transmisionDTE->idTipoAmbiente = isset($_GET["idTipoAmbiente"]) ? $_GET["idTipoAmbiente"] : (isset($input["idTipoAmbiente"]) ? $input["idTipoAmbiente"] : (isset($_POST["idTipoAmbiente"]) ? $_POST["idTipoAmbiente"] : null));
    $transmisionDTE->clavePrivada = isset($_GET["clavePrivada"]) ? $_GET["clavePrivada"] : (isset($input["clavePrivada"]) ? $input["clavePrivada"] : (isset($_POST["clavePrivada"]) ? $_POST["clavePrivada"] : null));
    $transmisionDTE->clavePublica = isset($_GET["clavePublica"]) ? $_GET["clavePublica"] : (isset($input["clavePublica"]) ? $input["clavePublica"] : (isset($_POST["clavePublica"]) ? $_POST["clavePublica"] : null));
    $transmisionDTE->passwordApi = isset($_GET["passwordApi"]) ? $_GET["passwordApi"] : (isset($input["passwordApi"]) ? $input["passwordApi"] : (isset($_POST["passwordApi"]) ? $_POST["passwordApi"] : null));
    $transmisionDTE->urlFirmador = isset($_GET["urlFirmador"]) ? $_GET["urlFirmador"] : (isset($input["urlFirmador"]) ? $input["urlFirmador"] : (isset($_POST["urlFirmador"]) ? $_POST["urlFirmador"] : null));
    $transmisionDTE->idUsuario = $_SESSION['general']['usuario'][0]->id;
    $transmisionDTE->hoy = date("Y-m-d H:i:s");

    switch ($accion) {
        case "obtenerByEmpresa":
            $respuesta = $transmisionDTE->obtenerByEmpresa();
            break;
        case "guardar":
            $respuesta= $transmisionDTE->guardar();
            break;
            case "actualizar":
            $respuesta= $transmisionDTE->actualizar();
            break;
        default:
            $respuesta = $accion;
            break;
    }
} else {
    $respuesta->mensaje = "SESSION_DEAD";
}
echo json_encode($respuesta);
