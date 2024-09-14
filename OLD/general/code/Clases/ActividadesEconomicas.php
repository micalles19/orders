<?php

class ActividadesEconomicas
{
    private $conexion, $logs;
    public $id,
        $idEmpresa,
        $hoy,
        $idUsuario;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
        $this->logs = new GuardarErroresSistema();
    }

    function Obtener()
    {
        $respuesta = new stdClass();
        $sql = "select id, nombreActividad as nombre from mh_actividad_economica where activo ='S'";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "SIN_DATOS";
        }
        return $respuesta;
    }

    function guardarDetalle()
    {
        $respuesta = new stdClass();
        $sqlFinal = "";
        try {
            $sqlFinal ="insert into general_datos_empresa_actividades_economicas (idEmpresa, idActividad, idUsuarioRegistra, fechaRegistro)
                        values ({$this->idEmpresa}, {$this->id},{$this->idUsuario}, '{$this->hoy}')";
            $query = $this->conexion->query($sqlFinal);
            if ($query){
                $respuesta->mensaje = "EXITO_TAG";
                $respuesta->modulo = "general";
                $respuesta->pagina = "datos_empresa";
                $respuesta->parametro = "id";
                $respuesta->valor = $this->idEmpresa;
                $respuesta->parametro2 = "tag";
                $respuesta->valor2 = "profile";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR_GUARDAR";
            $this->logs->funcionActual = "guardarDetalle()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sqlFinal;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }

        return $respuesta;
    }

    function actualizarDetalle($idUpdt)
    {
        $respuesta = new stdClass();
        $sqlFinal = "";
        try {
            $sqlFinal ="update general_datos_empresa_actividades_economicas set idActividad ={$idUpdt} where id = {$this->id}";
            $query = $this->conexion->query($sqlFinal);
            if ($query){
                $respuesta->mensaje = "EXITO_TAG";
                $respuesta->modulo = "general";
                $respuesta->pagina = "datos_empresa";
                $respuesta->parametro = "id";
                $respuesta->valor = $this->idEmpresa;
                $respuesta->parametro2 = "tag";
                $respuesta->valor2 = "profile";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR_GUARDAR";
            $this->logs->funcionActual = "guardarDetalle()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sqlFinal;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }

        return $respuesta;
    }

    function eliminarDetalle()
    {
        $respuesta = new stdClass();
        $sqlFinal = "";
        try {
            $sqlFinal ="update general_datos_empresa_actividades_economicas set eliminado = 'S', idUsuarioElimina = {$this->idUsuario}, fechaElimina = '{$this->hoy}' where id = {$this->id}";
            $query = $this->conexion->query($sqlFinal);
            if ($query){
                $respuesta->mensaje = "EXITO_TAG";
                $respuesta->modulo = "general";
                $respuesta->pagina = "datos_empresa";
                $respuesta->parametro = "id";
                $respuesta->valor = $this->idEmpresa;
                $respuesta->parametro2 = "tag";
                $respuesta->valor2 = "profile";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR_GUARDAR";
            $this->logs->funcionActual = "guardarDetalle()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sqlFinal;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }

        return $respuesta;
    }
}