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
include "MySQL_conection.php";
include_once 'clases/Producto.php';
//include 'clases/Errores.php';

$producto = new Producto();
switch ($accion) {
    case "guardar":
        $producto->codigo = $_POST["codigo"];
        $producto->nombre = $_POST["nombre"];
        $producto->idCatalogo = $_POST["idCatalogo"];
        $producto->idCategoria = $_POST["idCategoria"];
        $producto->descripcion = $_POST["descripcion"];
        $producto->unidadesBulto = $_POST["unidadesBulto"];
        $producto->precioUnidad = $_POST["precioUnidad"];
        $producto->precioTotal = $_POST["total"];
        $respuesta = $producto->guardar();
        break;
    case "actualizar":
        $producto->id = $_POST["id"];
        $producto->codigo = $_POST["codigo"];
        $producto->nombre = $_POST["nombre"];
        $producto->idCatalogo = $_POST["idCatalogo"];
        $producto->idCategoria = $_POST["idCategoria"];
        $producto->descripcion = $_POST["descripcion"];
        $producto->unidadesBulto = $_POST["unidadesBulto"];
        $producto->precioUnidad = $_POST["precioUnidad"];
        $producto->precioTotal = $_POST["total"];
        $respuesta = $producto->actualizar();
        break;
    case "cambiarEstado":
        $producto->id = $input["id"];
        $producto->disponible = $input["estado"];
        $respuesta = $producto->cambiarEstado();
        break;
    case "eliminar":
        $producto->id = $input["id"];
        $respuesta = $producto->eliminar();
        break;
    case "obtenerById":
        $producto->id = $_GET["id"];
        $respuesta = $producto->obtenerById();
        break;
    case "obtenerByTable":
        $respuesta = $producto->obtenerByTable();
        break;
    case "eliminarImagen":
        $producto->id = $input["id"];
        $respuesta = $producto->eliminarImagen();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);
