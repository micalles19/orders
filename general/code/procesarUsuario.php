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
include './MySQL_conection.php';
include_once './Clases/Usuario.php';

date_default_timezone_set('America/El_Salvador');

$usuario = new Usuario();

$usuario->id =isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ?? $_POST["id"]));
$usuario->email = isset($input["email"]) && !empty($input["email"]) ? $input["email"] :0;
$usuario->usuario = isset($input["usuario"]) && !empty($input["usuario"]) ? $input["usuario"] :0;
$usuario->clave = isset($input["clave"]) && !empty($input["clave"]) ? $input["clave"] :0;
$usuario->nombre = isset($input["nombres"]) && !empty($input["nombres"]) ? $input["nombres"] :0;
$usuario->rol = isset($input["rol"]) && !empty($input["rol"]) ? $input["rol"] :0;
$usuario->tipoDocumentoIdentidad =isset($_GET["tipoDocumentoIdentidad"]) ? $_GET["tipoDocumentoIdentidad"] : (isset($input["tipoDocumentoIdentidad"]) ? $input["tipoDocumentoIdentidad"] : (isset($_POST["tipoDocumentoIdentidad"]) ? $_POST["tipoDocumentoIdentidad"] : null));
$usuario->numeroDocumento = isset($_GET["numeroDocumento"]) ? $_GET["numeroDocumento"] : (isset($input["numeroDocumento"]) ? $input["numeroDocumento"] : (isset($_POST["numeroDocumento"]) ? $_POST["numeroDocumento"] : null));
$usuario->idUsuario = $_SESSION['general']['usuario'][0]->id;

$usuario->hoy = date("Y-m-d H:i:s");
switch ($accion) {

    case "iniciarSesion":

        $respuesta = $usuario->IniciarSesion();
        break;
    case "obtener":
        $respuesta = $usuario->Obtener();
        break;
    case "guardar":
        $respuesta = $usuario->Guardar();
        break;
    case "actualizar":
        $respuesta = $usuario->Actualizar();
        break;
    case "obtenerById":

        $respuesta = $usuario->obtenerById();
        break;
    case "eliminar":
        $respuesta = $usuario->Eliminar();
        break;
        case "bloquear":
      $respuesta = $usuario->bloquear();
        break;
    case "cerrarSesion":
        $respuesta = $usuario->cerrarSesion();
        break;
    case "reestablecerClave":
        $respuesta = $usuario->reestablecerClave();
        break;
    case "actualizarClave":
        $respuesta = $usuario->actualizarClave();
        break;
    case "validarUsuario":
        $respuesta = $usuario->validarExistencia();
        break;
    default:
        $respuesta = $accion;
        break;
}
echo json_encode($respuesta);
