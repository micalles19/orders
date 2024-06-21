<?php

class Meses
{
    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }

    function Obtener()
    {
        $respuesta = new stdClass();
        $sql = "select id, mes as nombre from periodos_meses";
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
