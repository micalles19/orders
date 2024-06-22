<?php

class Roles
{
    private $conexion;
    public $id,
        $nombre;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }

    function obtenerByCbo(){
        $respuesta = new stdClass();
        $sql = "select id, nombre from general_roles";
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