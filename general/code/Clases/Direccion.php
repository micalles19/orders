<?php

class Direccion
{

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }

    function obtenerDepartamento()
    {
        $respuesta = new stdClass();
        $sql = "select * from mh_departamentos ";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "NO_DATOS";
        }
        return $respuesta;
    }
    function obtenerMunicipio($idDepartamento)
    {
        $respuesta = new stdClass();
        $sql = "select * from mh_municipios where idDepartamento ='{$idDepartamento}' ";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "NO_DATOS";
        }
        return $respuesta;
    }
    function obtenerDistritos($idMunicipio)
    {
        $respuesta = new stdClass();
        $sql = "select * from distritos where idMunicipio ='{$idMunicipio}' and habilitado = 'S'";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "NO_DATOS";
        }
        return $respuesta;
    }
}