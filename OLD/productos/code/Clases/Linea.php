<?php

class Linea
{
 private $conexion;
 public $id, $codigoFox, $nombre;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }
    function obtenerCbo()
    {
        $respuesta = new stdClass();
        $sql = "select id, codigoFox, nombre from linea where eliminado =0 ";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "SIN_DATOS";
        }
        return $respuesta;
    }

}