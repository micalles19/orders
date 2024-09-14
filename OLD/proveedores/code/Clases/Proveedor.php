<?php

class Proveedor
{
    private $conexion, $hoy;
    public $id,
        $nombre,
        $tipoDocumento,
        $numeroDocumento,
        $iva,
        $actividadEconomica,
        $email,
        $telefono,
        $departamento,
        $municipio,
        $distrito,
        $direccion,
        $idUsuario,
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
        $sql = "insert into proveedores_datos_generales (nombre, idTipoDocumentoIdentidad, numeroDocumento,
                      iva, idActividadEconomica, correo, telefono, 
                      idDepartamento,idMunicipio, direccion, idUsuarioRegistra) 
                values (:nombre, :idTipoDocumentoIdentidad, :numeroDocumento, 
                        :iva, :idActividadEconomica,:correo, :telefono,
                        :idDepartamento, :idMunicipio,:direccion,:idUsuarioRegistra)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":idTipoDocumentoIdentidad", $this->tipoDocumento);
        $stmt->bindParam(":numeroDocumento", $this->numeroDocumento);
        $stmt->bindParam(":iva", $this->iva);
        $stmt->bindParam(":idActividadEconomica", $this->actividadEconomica);
        $stmt->bindParam(":correo", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":idDepartamento", $this->departamento);
        $stmt->bindParam(":idMunicipio", $this->municipio);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":idUsuarioRegistra", $this->idUsuario);

        if ($stmt->execute()) {
            $respuesta = "EXITO";
        } else {
            $respuesta = "ERROR";
        }
        return $respuesta;
    }

    function actualizar()
    {
        $respuesta = new stdClass();

            $sql = "update proveedores_datos_generales set nombre =:nombre, idTipoDocumentoIdentidad=:idTipoDocumentoIdentidad,
                    numeroDocumento=:numeroDocumento,iva=:iva,  idActividadEconomica =:idActividadEconomica, correo=:correo,
                    telefono=:telefono, idDepartamento=:idDepartamento,idMunicipio=:idMunicipio, direccion=:direccion where id=:id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":idTipoDocumentoIdentidad", $this->tipoDocumento);
            $stmt->bindParam(":numeroDocumento", $this->numeroDocumento);
            $stmt->bindParam(":iva", $this->iva);
            $stmt->bindParam(":idActividadEconomica", $this->actividadEconomica);
            $stmt->bindParam(":correo", $this->email);
            $stmt->bindParam(":telefono", $this->telefono);
            $stmt->bindParam(":idDepartamento", $this->departamento);
            $stmt->bindParam(":idMunicipio", $this->municipio);
            $stmt->bindParam(":direccion", $this->direccion);
            $stmt->bindParam(":id", $this->id);
            if ($stmt->execute()) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "ERROR";
            }
        return $respuesta;
    }


    function eliminar()
    {
        $respuesta = new stdClass();
        $sql = " update proveedores_datos_generales set eliminado='S', idUsuarioElimina = {$this->idUsuario},
                  fechaElimina ='{$this->hoy}'   where id ='{$this->id}'";
        $query = $this->conexion->query($sql);
        if ($query) {
            $respuesta->mensaje = "EXITO_DELETE";
        } else {
            $respuesta->mensaje = "NO_UPDATE";
        }
        return $respuesta;
    }


    function obtenerById()
    {
        $sql = "select id, nombre, idTipoDocumentoIdentidad, numeroDocumento,idActividadEconomica,
       iva, idDepartamento,idMunicipio, correo, telefono, direccion
       from proveedores_datos_generales where id = {$this->id}";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta = "NO_DATOS";
        }
        return $respuesta;
    }

    function obtenerByTable()
    {
        $respuesta = new stdClass();
        $sql = "select cli.id, cli.nombre, telefono, correo,  act.nombreActividad,tdoc.nombre as tipoDocumento,
       numeroDocumento
    from proveedores_datos_generales cli
    left join  mh_actividad_economica act on cli.idActividadEconomica = act.id
    left join mh_tipo_documento_identidad tdoc on cli.idTipoDocumentoIdentidad = tdoc.id
    
    where eliminado = 'N'";
        $query = $this->conexion->query($sql);

        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "NO_DATOS";
        }
        return $respuesta;
    }
    function obtenerByCbo()
    {
        $respuesta = new stdClass();
        try {
            $sql = "SELECT id, nombre FROM proveedores_datos_generales where eliminado = 'N'";
            $query = $this->conexion->query($sql);

            if ($query) {
                $tiposClientes = $query->fetchAll(PDO::FETCH_OBJ);

                if (!empty($tiposClientes)) {
                    $respuesta->mensaje = "EXITO";
                    $respuesta->datos = $tiposClientes;
                } else {
                    $respuesta->mensaje = "NO_DATOS";
                }
            } else {
                $respuesta->mensaje = "ERROR_QUERY";
            }
        } catch (PDOException $e) {
            $respuesta->mensaje = "ERROR_CONEXION";
            $respuesta->error = $e->getMessage();
        }

        return $respuesta;
    }

}