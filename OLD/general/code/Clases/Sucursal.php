<?php

class Sucursal
{
    private $conexion,$logs;
    public $id,
        $idEmpresa,
        $idTipoEstablecimiento,
        $responsable,
        $nombreSucursal,
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

    function obtenerSucursalesByEmpresa()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {
            $sql = "select  sucu.id, sucu.nombreSucursal, tipoEsta.nombre as tipoEstablecimiento, tipoEsta.id as idTipoEstablecimiento, sucu.responsable,
                    sucu.telefono, sucu.correo, depa.nombre as departamento, depa.id as idDepartamento, muni.id as idMunicipio, muni.nombre as municipio, sucu.direccion
                    from general_datos_empresa_sucursales sucu
                    inner join mh_tipo_establecimiento tipoEsta on sucu.idTipoEstablecimiento = tipoEsta.id
                    inner join mh_departamentos depa on sucu.idDepartamento = depa.id
                    inner join mh_municipios muni on sucu.idMunicipio = muni.id
                    where sucu.idEmpresa = {$this->idEmpresa} and sucu.eliminado = 'N'";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $respuesta->mensaje = "EXITO";
                $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "Error al obtener datos ";
            $this->logs->funcionActual = "obtenerSucursalByEmpresa()";
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

    function eliminarSucursalDetalle(){
        $respuesta = new stdClass();
        $sqlFinal = "";
        try {
            $sqlFinal ="update general_datos_empresa_sucursales set eliminado = 'S', idUsuarioElimina = {$this->idUsuario}, fechaElimina = '{$this->hoy}' where id = {$this->id}";
            $query = $this->conexion->query($sqlFinal);
            if ($query){
                $respuesta->mensaje = "EXITO_DELETE";
            }else{
                $respuesta->mensaje ="ERROR_UPDT";
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


    function guardar()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {

            $sql = "INSERT INTO general_datos_empresa_sucursales (idEmpresa, idTipoEstablecimiento, nombreSucursal ,responsable, telefono, correo, 
                                              idDepartamento, idMunicipio, direccion, idUsuarioRegistra, fechaRegistro) 
                                value ({$this->idEmpresa}, {$this->idTipoEstablecimiento}, '{$this->nombreSucursal}','{$this->responsable}', '{$this->telefono}', '{$this->correo}',
                                      {$this->idDepartamento}, {$this->idMunicipio}, '{$this->direccion}', {$this->idUsuario}, '{$this->hoy}')";
            if ($this->conexion->query($sql)) {
                $respuesta->mensaje = "EXITO_TAG";
                $respuesta->modulo = "general";
                $respuesta->pagina = "datos_empresa";
                $respuesta->parametro = "id";
                $respuesta->valor = $this->idEmpresa;
                $respuesta->parametro2 = "tag";
                $respuesta->valor2 = "sucursales";
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