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
require_once './../../assets/TCPDF/tcpdf.php';
include_once 'clases/Pdf.php';

$pdf = new Pdf();
switch ($accion) {
    case "generarPDF":
        $pdf->idOrden = $_GET["idOrden"];
        $respuesta = $pdf->crearPDF();
        break;
    default:
        $respuesta = $accion;
        break;
}

echo json_encode($respuesta);
