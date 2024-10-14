<?php
class MontosAprobacion
{
    private $conexion;
    public
        $id,
        $idCuenta,
        $idUsuarioAutorizado,
        $montoDesde ,
        $montoHasta,
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
            $sql = "insert into formularios_bancos_conf_montos_aprobacion (idCuentaBanco, idUsuarioAutorizado, montoDesde, montoHasta, estado, idUsuarioRegistra)
                value ('{$this->idCuenta}', '{$this->idUsuarioAutorizado}', '{$this->montoDesde}','{$this->montoHasta}','{$this->estado}', {$this->idUsuario})";
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
            $sql = "update formularios_bancos_conf_montos_aprobacion set idUsuarioAutorizado ={$this->idUsuarioAutorizado}, idCuentaBanco ={$this->idCuenta}, montoDesde ='{$this->montoDesde}', montoHasta='{$this->montoHasta}', fechaActualiza ='{$this->hoy}', idUsuarioActualiza ={$this->idUsuario} where id = {$this->id}";

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
            $sql = "select id, idCuentaBanco, idUsuarioAutorizado, montoDesde, montoHasta, estado from formularios_bancos_conf_montos_aprobacion
                    where id= {$this->id}";
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
            $sql = "select aprob.id, montoDesde, montoHasta, usu.nombre as usuarioAutorizado, 
                    concat(empresa.nombre,'-',bancos.nombre,'(', cuenta.numeroCuenta,')') as banco, aprob.estado
                    from formularios_bancos_conf_montos_aprobacion aprob
                    inner join formularios_bancos_cuentas cuenta on aprob.idCuentaBanco = cuenta.id
                    inner join general_datos_empresa empresa on cuenta.idEmpresa = empresa.id
                    inner join planilla_cat_bancos bancos on cuenta.idBanco = bancos.id
                    inner join general_usuarios usu on usu.id =  aprob.idUsuarioAutorizado where aprob.eliminado = 'N' and bancos.eliminado ='N' ";
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
            $sql = "select id from formularios_bancos_conf_montos_aprobacion where eliminado ='N' ";
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
            $sql = "update formularios_bancos_conf_montos_aprobacion set eliminado = 'S', idUsuarioElimina = '{$this->idUsuario}' where id = {$this->id}";
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