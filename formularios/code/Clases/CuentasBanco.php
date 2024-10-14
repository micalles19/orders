<?php

class CuentasBanco
{
    private $conexion;
    public
        $id,
        $idBanco,
        $numeroCuenta,
        $idTipoCuenta,
        $idEmpresa,
        $estado,
        $idUsuario,
        $hoy;
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
            $sql = "insert into formularios_bancos_cuentas ( idBanco, idEmpresa, numeroCuenta, idTipoCuenta, idUsuarioRegistra) 
                    value ({$this->idBanco},{$this->idEmpresa}, '{$this->numeroCuenta}',{$this->idTipoCuenta}, {$this->idUsuario})";
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
            $sql = "update formularios_bancos_cuentas  set numeroCuenta = '{$this->numeroCuenta}', idBanco ={$this->idBanco}, idEmpresa =,{$this->idEmpresa},
                   idTipoCuenta ={$this->idTipoCuenta}, idUsuarioActualiza ={$this->idUsuario},fechaActualiza ='{$this->hoy}' where id ={$this->id}";
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
            $sql = "select id, numeroCuenta, idBanco, idTipoCuenta from formularios_bancos_cuentas where id= {$this->id}";
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
            $sql = "select cuentas.id as idCuenta,
                     planilla_cat_bancos.nombre as nombreBanco,
                   cuentas.numeroCuenta,
                    tcuenta.nombre as tipoCuenta,
                    general_datos_empresa.nombre as nombreEmpresa
                    from formularios_bancos_cuentas as cuentas
                    inner join planilla_cat_bancos on cuentas.idBanco = planilla_cat_bancos.id
                    inner join formularios_bancos_tipo_cuentas tcuenta on cuentas.idTipoCuenta = tcuenta.id
                    inner join general_datos_empresa on cuentas.idEmpresa = general_datos_empresa.id
                     where cuentas.eliminado = 'N' and cuentas.eliminado ='N' ";
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
            $sql = "select formularios_bancos_cuentas.id, concat(empresa.nombre,' - ',planilla_cat_bancos.nombre ,' (',numeroCuenta,')') as nombre 
            from formularios_bancos_cuentas
            inner join planilla_cat_bancos on formularios_bancos_cuentas.idBanco = planilla_cat_bancos.id
            inner join general_datos_empresa empresa on formularios_bancos_cuentas.idEmpresa = empresa.id
            where formularios_bancos_cuentas.eliminado ='N' and planilla_cat_bancos.eliminado ='N' ";
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

    function obtenerTiposCuentasByCbo()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select id, nombre from formularios_bancos_tipo_cuentas where estado ='A' and eliminado ='N'";
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
            $sql = "update formularios_bancos_cuentas set eliminado = 'S', idUsuarioElimina = '{$this->idUsuario}' where id = {$this->id}";
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