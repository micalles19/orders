<?php

class TransmisionDTE
{
    private $conexion, $logs;
    public $id,
        $idEmpresa,
        $idTipoAmbiente,
        $clavePrivada,
        $clavePublica,
        $passwordApi,
        $urlFirmador,
        $idUsuario,
        $hoy;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
        $this->logs = new GuardarErroresSistema();
    }

    function obtenerByEmpresa()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {
            $sql = "select * from general_datos_empresa_config_transmision_dte where idEmpresa ={$this->idEmpresa}";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $respuesta->mensaje = "EXITO";
                $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "Error al obtener datos ";
            $this->logs->funcionActual = "obtenerByEmpresa()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sql;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }
        return $respuesta;
    }

    function guardar()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {
            $sql = "INSERT INTO general_datos_empresa_config_transmision_dte (idEmpresa, idTipoAmbiente, clavePublica, clavePrivada, passwordApi, urlFirmador, idUsuarioRegistra, fechaRegistro)
                    values ({$this->idEmpresa},{$this->idTipoAmbiente} ,'{$this->clavePublica}', '{$this->clavePrivada}', '{$this->passwordApi}', '{$this->urlFirmador}', {$this->idUsuario}, '{$this->hoy}')";

            if ($this->conexion->query($sql)) {
                $respuesta->mensaje = "EXITO_TAG";
                $respuesta->modulo = "general";
                $respuesta->pagina = "datos_empresa";
                $respuesta->parametro = "id";
                $respuesta->valor = $this->idEmpresa;
                $respuesta->parametro2 = "tag";
                $respuesta->valor2 = "DTES";
            } else {
                $respuesta->mensaje = "ERROR_INSERT";
            }

        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR_GUARDAR";
            $this->logs->funcionActual = "guardar()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sql;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }
        return $respuesta;
    }

    function actualizar()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {
            $sql = "update general_datos_empresa_config_transmision_dte set  idTipoAmbiente ={$this->idTipoAmbiente}, clavePublica ='{$this->clavePublica}',
                                                         clavePrivada ='{$this->clavePrivada}', passwordApi ='{$this->passwordApi}', 
                                                         urlFirmador ='{$this->urlFirmador}', idUsuarioActualiza ={$this->idUsuario}, 
                                                         fechaElimina ='{$this->hoy}' where id ={$this->id}";
            if ($this->conexion->query($sql)) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "ERROR_INSERT";
            }

        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR al actualizar";
            $this->logs->funcionActual = "actualizar()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sql;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }
        return $respuesta;
    }
}