<?php

class Municipio
{
    private $conexion;
    public $idMunicipio,
        $idDepartamento;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }

    function obtenerByDepartamento()
    {
        $respuesta = new stdClass();
        $sql = "select id, nombre from mh_municipios where idDepartamento = {$this->idDepartamento}";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "SIN_DATOS";
        }
        return $respuesta;
    }

    function obtenerDistritosByMunicipio()
    {
        $respuesta = new stdClass();
        $sql = "select id, nombreDistrito as nombre
        from cat_municipios_distritos where idMunicipio = {$this->idMunicipio}";
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