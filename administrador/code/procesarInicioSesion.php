<?php
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);

session_start();
$respuesta = (object)[];
$accion = "NADA";

if (!empty($_GET)) {
    $accion = isset($_GET['accion']) ? $_GET['accion'] : "";
} else if (isset($_POST['accion'])) {
    $accion = isset($_POST['accion']) ? $_POST['accion'] : "";
} else if (isset($input['accion'])) {
    $accion = isset($input['accion']) ? $input['accion'] : "";
}
include './MySQL_conection.php';
include_once './clases/Usuario.php';

$usuario = new Usuario();

switch ($accion) {
    case "inicioSesion":
        $usuario->correo = $input["correo"];
        $usuario->clave = $input["clave"];
        $respuesta = $usuario->iniciarSesion();
        break;
    case "obtenerUsuarioById":
        $usuario->id = $_GET["idUsuario"];
        $respuesta = $usuario->obtenerUsuarioById();
        break;
    case "obtenerUsuarios":
        $respuesta = $usuario->obtenerUsuarios();
        break;
    case "guardar":
        $usuario->nombre = $input["nombre"];
        $usuario->correo = $input["email"];
        $usuario->clave = $input["clave"];
        $usuario->habilitado = "N";
        $respuesta = $usuario->guardar();
        break;
    case "actualizar":
        $usuario->id = $input["idUsuario"];
        $usuario->nombre = $input["nombre"];
        $usuario->correo = $input["email"];
        $usuario->clave = $input["clave"];
        $usuario->habilitado = "N";
        $respuesta = $usuario->actualizar();
        break;
    case "cambiarEstado":
        $usuario->id = $input["idUsuario"];
        $usuario->habilitado = $input["estado"];
        $respuesta= $usuario->actualizarEstado();
        break;
    default:
        $respuesta = $accion;
        break;
}
echo json_encode($respuesta);