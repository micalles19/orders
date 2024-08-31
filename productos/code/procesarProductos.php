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
include '../../general/code/MySQL_conection.php';
include_once './Clases/Producto.php';
date_default_timezone_set('America/El_Salvador');

$producto = new Producto();
$producto->id = isset($_GET["id"]) ? $_GET["id"] : (isset($input["id"]) ? $input["id"] : (isset($_POST["id"]) ? $_POST["id"]:null));
$producto->codigo = isset($_GET["codigo"]) ? $_GET["codigo"] : (isset($input["codigo"]) ? $input["codigo"] : (isset($_POST["codigo"]) ? $_POST["codigo"]:null));
$producto->nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : (isset($input["nombre"]) ? $input["nombre"] : (isset($_POST["nombre"]) ? $_POST["nombre"]:null));
$producto->proveedor = isset($_GET["proveedor"]) ? $_GET["proveedor"] : (isset($input["proveedor"]) ? $input["proveedor"] : (isset($_POST["proveedor"]) ? $_POST["proveedor"]:null));
$producto->marca = isset($_GET["marca"]) ? $_GET["marca"] : (isset($input["marca"]) ? $input["marca"] : (isset($_POST["marca"]) ? $_POST["marca"]:null));
$producto->catalogo = isset($_GET["catalogo"]) ? $_GET["catalogo"] : (isset($input["catalogo"]) ? $input["catalogo"] : (isset($_POST["catalogo"]) ? $_POST["catalogo"]:null));
$producto->categoria = isset($_GET["categoria"]) ? $_GET["categoria"] : (isset($input["categoria"]) ? $input["categoria"] : (isset($_POST["categoria"]) ? $_POST["categoria"]:null));
$producto->subCategoria = isset($_GET["subCategoria"]) ? $_GET["subCategoria"] : (isset($input["subCategoria"]) ? $input["subCategoria"] : (isset($_POST["subCategoria"]) ? $_POST["subCategoria"]:null));
$producto->descripcion = isset($_GET["descripcion"]) ? $_GET["descripcion"] : (isset($input["descripcion"]) ? $input["descripcion"] : (isset($_POST["descripcion"]) ? $_POST["descripcion"]:null));
$producto->especificaciones = isset($_GET["especificaciones"]) ? $_GET["especificaciones"] : (isset($input["especificaciones"]) ? $input["especificaciones"] : (isset($_POST["especificaciones"]) ? $_POST["especificaciones"]:null));
$producto->excento = isset($_GET["excento"]) ? $_GET["excento"] : (isset($input["excento"]) ? $input["excento"] : (isset($_POST["excento"]) ? $_POST["excento"]:null));
$producto->precioFijo = isset($_GET["precioFijo"]) ? $_GET["precioFijo"] : (isset($input["precioFijo"]) ? $input["precioFijo"] : (isset($_POST["precioFijo"]) ? $_POST["precioFijo"]:null));
$producto->precioCompraSinIva = isset($_GET["precioCompraSinIva"]) ? $_GET["precioCompraSinIva"] : (isset($input["precioCompraSinIva"]) ? $input["precioCompraSinIva"] : (isset($_POST["precioCompraSinIva"]) ? $_POST["precioCompraSinIva"]:null));
$producto->ivaCompra = isset($_GET["ivaCompra"]) ? $_GET["ivaCompra"] : (isset($input["ivaCompra"]) ? $input["ivaCompra"] : (isset($_POST["ivaCompra"]) ? $_POST["ivaCompra"]:null));
$producto->precioCompraConIva = isset($_GET["precioCompraConIva"]) ? $_GET["precioCompraConIva"] : (isset($input["precioCompraConIva"]) ? $input["precioCompraConIva"] : (isset($_POST["precioCompraConIva"]) ? $_POST["precioCompraConIva"]:null));
$producto->precioVentaSinIva = isset($_GET["precioVentaSinIva"]) ? $_GET["precioVentaSinIva"] : (isset($input["precioVentaSinIva"]) ? $input["precioVentaSinIva"] : (isset($_POST["precioVentaSinIva"]) ? $_POST["precioVentaSinIva"]:null));
$producto->ivaVenta = isset($_GET["ivaVenta"]) ? $_GET["ivaVenta"] : (isset($input["ivaVenta"]) ? $input["ivaVenta"] : (isset($_POST["ivaVenta"]) ? $_POST["ivaVenta"]:null));
$producto->precioVentaConIva = isset($_GET["precioVentaConIva"]) ? $_GET["precioVentaConIva"] : (isset($input["precioVentaConIva"]) ? $input["precioVentaConIva"] : (isset($_POST["precioVentaConIva"]) ? $_POST["precioVentaConIva"]:null));
$producto->descuento = isset($_GET["descuento"]) ? $_GET["descuento"] : (isset($input["descuento"]) ? $input["descuento"] : (isset($_POST["descuento"]) ? $_POST["descuento"]:'N'));
$producto->porcentajeDescuento = isset($_GET["porcentajeDescuento"]) ? $_GET["porcentajeDescuento"] : (isset($input["porcentajeDescuento"]) ? $input["porcentajeDescuento"] : (isset($_POST["porcentajeDescuento"]) ? $_POST["porcentajeDescuento"]:null));
$producto->valorDescuento = isset($_GET["valorDescuento"]) ? $_GET["valorDescuento"] : (isset($input["valorDescuento"]) ? $input["valorDescuento"] : (isset($_POST["valorDescuento"]) ? $_POST["valorDescuento"]:null));
$producto->precioConsumidorFinal = isset($_GET["precioConsumidorFinal"]) ? $_GET["precioConsumidorFinal"] : (isset($input["precioConsumidorFinal"]) ? $input["precioConsumidorFinal"] : (isset($_POST["precioConsumidorFinal"]) ? $_POST["precioConsumidorFinal"]:null));
$producto->idUsuario = $_SESSION['general']['usuario'][0]->id;
switch ($accion) {
    case "guardar":
        $respuesta = $producto->guardar();
        break;
    case "obtenerByTable":
        $respuesta = $producto->obtenerByTable();
        break;
    case "obtenerById":
        $respuesta = $producto->obtenerById();
        break;
    default:
        $respuesta = $accion;
        break;
}
echo json_encode($respuesta);
