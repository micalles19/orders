<?php

class Orden
{
    private $conexion, $hoy, $idUsuario;
    public $id, $idEstadoOrden;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
        date_default_timezone_set('America/El_Salvador');
        $this->hoy = date("Y-m-d H:i:s");
        $this->idUsuario = $_SESSION['general'][0]->id;
    }

    function obtenerByTable()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select ordenes.id as numeroOrden, clientes.nombreCliente, clientes.telefonoPrincipal, 
       ordenes_estados.nombre as estadoOrden, ordenes_tipos_comprobantes.nombre as tipoComprobante, ordenes.fechaRecibida, ordenes.idEstadoOrden,
       DATE_FORMAT(ordenes.fechaRecibida, '%d-%m-%Y %H:%i:%s') AS fechaRecibida  from ordenes
         inner join clientes on ordenes.idCliente = clientes.id
       inner join ordenes_estados on ordenes.idEstadoOrden = ordenes_estados.id
       inner join ordenes_tipos_comprobantes  on ordenes.idTipoComprobante = ordenes_tipos_comprobantes.id  where ordenes.eliminado = 'N'";
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

    function despacharOrden()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "update ordenes set idEstadoOrden = {$this->idEstadoOrden}, fechaDespacho ='{$this->hoy}', idUsuarioDespacho ={$this->idUsuario}  where id ={$this->id}";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "NO_UPDATE";
            }

        } catch (PDOException $exception) {
            $respuesta->mensaje = "ERROR_GENERAL";
            $respuesta->error = $exception->getMessage();
        }
        return $respuesta;
    }

    function entregarOrden()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "update ordenes set idEstadoOrden = {$this->idEstadoOrden}, fechaEntrega ='{$this->hoy}', idUsuarioEntrega ={$this->idUsuario}  where id ={$this->id}";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "NO_UPDATE";
            }

        } catch (PDOException $exception) {
            $respuesta->mensaje = "ERROR_GENERAL";
            $respuesta->error = $exception->getMessage();
        }
        return $respuesta;
    }

    function cancelarOrden()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "update ordenes set idEstadoOrden = {$this->idEstadoOrden}, fechaCancela ='{$this->hoy}', idUsuarioCancela ={$this->idUsuario}  where id ={$this->id}";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "NO_UPDATE";
            }

        } catch (PDOException $exception) {
            $respuesta->mensaje = "ERROR_GENERAL";
            $respuesta->error = $exception->getMessage();
        }
        return $respuesta;
    }

    function obtenerDatosOrdenById()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select ordenes.id as idOrden, DATE_FORMAT(ordenes.fechaRecibida, '%d-%m-%Y %H:%i:%s') as fechaRecibida,
        DATE_FORMAT(ordenes.fechaDespacho, '%d-%m-%Y %H:%i:%s') as fechaDespacho, DATE_FORMAT(ordenes.fechaCancela, '%d-%m-%Y %H:%i:%s') as fechaCancela,
        ordenes_estados.nombre as estadoOrden, ordenes.idEstadoOrden, ordenes_tipos_comprobantes.nombre as tipoComprobante, clientes.nombreCliente, clientes.nombreTienda,
        clientes.dui, clientes.nit, clientes.iva, clientes.telefonoPrincipal, clientes.coreoCliente, departamentos.nombre as departamento,
        municipios.nombre as municipio, distritos.nombre as distrito, clientes.direccion, ordenes.idTipoComprobante
    from ordenes
    inner join ordenes_estados on ordenes_estados.id = ordenes.idEstadoOrden
    inner join ordenes_tipos_comprobantes  on ordenes.idTipoComprobante = ordenes_tipos_comprobantes.id 
    inner join clientes on ordenes.idCliente = clientes.id
    inner join departamentos  on clientes.idDepartamento = departamentos.id
    inner join municipios  on clientes.idMunicipio = municipios.id
    inner join distritos  on clientes.idDistrito = distritos.id
    where ordenes.id ={$this->id}";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $respuesta->mensaje = "EXIT0";
                $respuesta->datosOrden = $query->fetchAll(PDO::FETCH_OBJ);
                $respuesta->detalleOrden = $this->obtenerDetalleOrdenByID();
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $exception) {
            $respuesta->mensaje = "ERROR_GENERAL";
            $respuesta->error = $exception->getMessage();
        }
        return $respuesta;
    }

    function obtenerDetalleOrdenByID()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select ordenes_detalle.id as idDetalle, productos.codigoProducto, ordenes_detalle.unidadesBulto, ordenes_detalle.precioUnidad, ordenes_detalle.precioTotal,
            productos.nombre as nombreProducto, productos.imagen
            from ordenes_detalle
            inner join productos  on ordenes_detalle.idProducto = productos.id
            where ordenes_detalle.idOrden = {$this->id} and ordenes_detalle.eliminado ='N'";
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
}