<?php

class Usuario
{
    private $conexion;
    public $id,
        $nombre,
        $correo,
        $clave,
        $habilitado;


    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }

    function guardar()
    {
        $sql = "insert into usuarios (nombre, email, clave, bloqueado) values(:nombre, :email, :clave, :bloqueado)";
        $stmt = $this->conexion->prepare($sql);
        $clave = md5($this->clave);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->correo);
        $stmt->bindParam(":clave", $clave);
        $stmt->bindParam(":bloqueado", $this->habilitado);

        if ($stmt->execute()) {
            $respuesta = "EXITO";
        } else {
            $respuesta = "ERROR";
        }
        return $respuesta;
    }
    function actualizar()
    {
        $sql = "update usuarios set nombre=:nombre, email=:email, clave=:clave, bloqueado=:bloqueado where id=:idUsuario";
        $stmt = $this->conexion->prepare($sql);
        $clave = md5($this->clave);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->correo);
        $stmt->bindParam(":clave", $clave);
        $stmt->bindParam(":bloqueado", $this->habilitado);
        $stmt->bindParam(":idUsuario", $this->id);

        if ($stmt->execute()) {
            $respuesta = "EXITO";
        } else {
            $respuesta = "ERROR";
        }
        return $respuesta;
    }

    function actualizarEstado()
    {
        $sql = "update usuarios set bloqueado = '{$this->habilitado}' where id = $this->id";
        $result = $this->conexion->query($sql);
        if ($result) {
            $resultado = "EXITO";
        } else {
            $resultado = "ERROR";
        }
        return $resultado;
    }

    function iniciarSesion()
    {
        $respuesta = new stdClass();

        $sql = "SELECT * FROM usuarios where  email = '{$this->correo}' and clave = md5('{$this->clave}')";
        $result = $this->conexion->query($sql);
        if ($result->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $_SESSION['general'] = $result->fetchAll(PDO::FETCH_OBJ);
            $respuesta->datos = $_SESSION['general'];

        } else {
            $respuesta->mensaje = "NO_USUARIO";
        }
        return $respuesta;
    }

    function obtenerUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $result = $this->conexion->query($sql);
        if ($result->rowCount() > 0) {
            $respuesta = $result->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta = "SIN_DATOS";
        }
        return $respuesta;
    }

    function obtenerUsuarioById()
    {
        $sql = "SELECT * FROM usuarios where id = $this->id";
        $result = $this->conexion->query($sql);
        if ($result->rowCount() > 0) {
            $respuesta = $result->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta = "SIN_DATOS";
        }
        return $respuesta;
    }
}