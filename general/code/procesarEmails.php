<?php
/*
 * Miguel Calles
 * Copyright (c) 2024.
 */


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
require '../../assets/vendor/php-mailer/src/PHPMailer.php';
require '../../assets/vendor/php-mailer/src/SMTP.php';
require '../../assets/vendor/php-mailer/src/Exception.php';
include "./../../Generales.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


date_default_timezone_set('America/El_Salvador');

$hoy = date("Y-m-d H:i:s");
switch ($accion) {

    case "reestablecerClaveFromAdmin":
        $respuesta = new stdClass();
        $codigo = generarClaveTemporal();
        if (registrarCodidoReetablecimiento($codigo, $input["id"])) {
            $respuesta = enviarMail($input["correo"], $input["nombre"], $codigo);
        } else {
            $respuesta->mensaje = "ERROR_UPDAT_CLAVE";
        }
        break;
    case "claveTemporal":

        break;
    default:
        $respuesta = $accion;
        break;
}
echo json_encode($respuesta);

function enviarMail($correo, $nombre, $codigo)
{
    $respuesta = new stdClass();
    $mail = new PHPMailer(true);
    try {
        // Configurar el servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'mi.calles19@gmail.com'; // Tu dirección de correo electrónico de Gmail
        $mail->Password = 'qfpvzcbtiaasohbn';        // Tu contraseña de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port =465;

        $mail->setFrom('mi.calles19@gmail.com', 'SIFEI - Administración');
        $mail->addAddress($correo, $nombre);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'SIFEI - Contraseña Temporal';
        $cuerpo = '<!DOCTYPE html>
                   <html lang="es">
<head>
  <meta charset="UTF-8">
  <title>SITEMA INTEGRAN DE FACTURACIÓN E INVENTARIO - SIFEI </title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 16px;
      line-height: 1.5;
      color: #333;
      margin: 20px;
    }

    h1 {
      color: #000;
      font-size: 20px;
      margin-top: 0;
    }

    h2 {
      color: #000;
      font-size: 18px;
    }

    p {
      margin-bottom: 10px;
    }

    a {
      color: #0073b7;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <h1>SITEMA INTEGRAN DE FACTURACIÓN E INVENTARIO - SIFEI  <br> 
  <small>Contraseña Temporal</small></h1>

  <p>Hola '.$nombre.',</p>

  <p>Se ha generado una contraseña temporal para que puedas acceder a tu cuenta en el Sistema de indicadores de Gestión Ambiental (SIGA) SINAMA y actualizarla por una personalizada.</p>

  <h2>Código: '.$codigo.'</h2>
  <p>Atentamente,</p>
  <p>El equipo de Soporte SIFEI</p>
</body>
</html>';

        $mail->Body = $cuerpo;
        $mail->addCustomHeader('Content-Type', 'text/html; charset=utf-8');
        $respuesta->mensaje = "EMAIL_ENVIADO";
        $mail->send();
    } catch (Exception $e) {
        $respuesta->mensaje = "EMAIL_ERROR";
        $respuesta->info = "Error al enviar el correo: {$mail->ErrorInfo}";
    }
    return $respuesta;
}

function registrarCodidoReetablecimiento($codigo, $idUsuario): bool
{
    $con = new connect();
    $conexion = $con->connectDB();
    $encrypt = md5($codigo);
    $sql = "update general_usuarios set clave = '{$encrypt}', claveTemporal = '{$codigo}', reestablecioClave = 1 where id = {$idUsuario}";
    if ($conexion->query($sql)) {
        return true;
    } else {
        return false;
    }
}

function generarClaveTemporal(): string
{
    $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $clave = "";

    for ($i = 0; $i < 6; $i++) {
        $posicionAleatoria = rand(0, strlen($caracteres) - 1);
        $caracter = $caracteres[$posicionAleatoria];
        if ($i === 0) {
            $caracter = strtoupper($caracter);
        }
        $clave .= $caracter;
    }
    return $clave;
}

