<?php

class SolicitudTransferencia
{
    private $conexion;
    public
    $id,

        $idUsuario,
        $hoy;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
        date_default_timezone_set('America/El_Salvador');
        $this->hoy = date("Y-m-d H:i:s");
    }

    function  obtenerByTable()
    {
        $respuesta = new stdClass();
        $respuesta->mensaje ="NO_DATOS";
        return $respuesta;
    }
    function obtenerTiposTransferenciasByCbo()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select * from formularios_banco_tipo_transferencia";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0 ) {
                $respuesta->mensaje = "EXITO";
                $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $exception) {
            $respuesta->mensaje = "ERROR_GENERAL";
            $respuesta->error = $exception->getMessage();
        }
        return $respuesta;

    }

}