<?php

class Sucursal
{
    private $conexion;
    public $id,
        $idEmpresa,
        $idTipoEstablecimiento,
        $responsable,
        $telefono,
        $correo,
        $idDepartamento,
        $idMunicipio,
        $direccion,
        $idUsuario,
        $hoy;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
        $this->logs = new GuardarErroresSistema();
    }
    function guardar()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {

            $sql = "INSERT INTO general_datos_empresa_sucursales (idEmpresa, idTipoEstablecimiento, responsable, telefono, correo, 
                                              idDepartamento, idMunicipio, direccion, idUsuarioRegistra, fechaRegistro) 
                                value ({$this->idEmpresa}, {$this->idTipoEstablecimiento},'{$this->responsable}', '{$this->telefono}', '{$this->correo}',
                                      {$this->idDepartamento}, {$this->idMunicipio}, '{$this->direccion}', {$this->idUsuario}, '{$this->hoy}')";
            if ($this->conexion->query($sql)){
                $respuesta->mensaje = "EXITO";
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

}