<?php
class Pais{
    private $conexion;
    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }
    function obtener(){
        $respuesta = new stdClass();
        $sql = "select id, nombre from mh_paises where eliminado = 'N'";
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