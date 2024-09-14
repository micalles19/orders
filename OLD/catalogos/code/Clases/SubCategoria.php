<?php

class SubCategoria
{
    private $conexion, $hoy;
    public
        $id,
        $nombre,
        $descripcion,
        $estado;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
        date_default_timezone_set('America/El_Salvador');
        $this->hoy = date("Y-m-d H:i:s");
    }

    function guardar()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "insert into sub_categorias (nombre, descripcion, estado) value ('{$this->nombre}', '{$this->descripcion}', '{$this->estado}')";
            $query = $this->conexion->query($sql);
            if ($query) {
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

    function actualizar()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "update sub_categorias set nombre ='{$this->nombre}', descripcion ='{$this->descripcion}', estado='{$this->estado}' where id = {$this->id}";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $exception) {
            $respuesta->mensaje = "ERROR_GENERAL";
            $respuesta->error = $exception->getMessage();
        }
        return $respuesta;
    }

    function obtenerById()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select id, nombre, descripcion, estado from sub_categorias where id= {$this->id}";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
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

    function obtenerByTable()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select id, nombre, descripcion, estado from sub_categorias where eliminado ='N' ";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
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

    function obtenerByCbo()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select id, nombre from sub_categorias where estado ='A' and eliminado ='N' ";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
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

    function eliminar()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "update sub_categorias set eliminado ='S' where id = {$this->id}  ";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
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