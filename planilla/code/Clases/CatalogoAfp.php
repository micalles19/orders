<?php

class CatalogoAfp
{
    private $conexion, $hoy;
    public
        $id,
        $nombre,
        $descripcion,
        $porcentajePatronal,
        $porcentajeTrabajador,
        $techoMaximo,
        $estado,
        $idUsuario;
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
            $sql = "insert into planilla_cat_afp (nombre, descripcion, porcentajePatronal, porcentajeTrabajador, techoMaximo,idUsuarioRegistra)
                value ('{$this->nombre}', '{$this->descripcion}','{$this->porcentajePatronal}','{$this->porcentajeTrabajador}', '{$this->techoMaximo}','{$this->idUsuario}')";

            if ($this->conexion->query($sql)) {
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

    function actualizar()
    {
        $respuesta = new  stdClass();
        try{
            $sql = "update planilla_cat_afp set nombre ='{$this->nombre}', descripcion ='{$this->descripcion}',
                            porcentajePatronal = '{$this->porcentajePatronal}', porcentajeTrabajador = '{$this->porcentajeTrabajador}' where id = {$this->id}";

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
            $sql = "select id, nombre, descripcion, porcentajePatronal, porcentajeTrabajador, techoMaximo from planilla_cat_afp where id= {$this->id }";
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
            $sql = "select id, nombre, porcentajePatronal, porcentajeTrabajador, techoMaximo from planilla_cat_afp where eliminado ='N' ";
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
            $sql = "select id, nombre from planilla_cat_afp where eliminado ='N' ";
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
            $sql = "update planilla_cat_afp set eliminado = 'S', idUsuarioElimina = '{$this->idUsuario}' where id = {$this->id}";
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