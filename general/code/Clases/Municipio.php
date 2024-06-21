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

    function Obtener()
    {
        $respuesta = new stdClass();
        $sql = "select id_municipio as id, id_departamento, nombre_municipio as nombre, latitud, longitud
        from cat_municipios where id_departamento = {$this->idDepartamento}";
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