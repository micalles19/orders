<?php

class Usuario
{
    private $conexion;
    public $id,
        $nombre,
        $email,
        $usuario,
        $clave,
        $rol,
        $idUsuario,
        $hoy;


    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }

    function Obtener()
    {
        $respuesta = new stdClass();
        $sql = "SELECT usu.id, usu.nombre, usu.email, rol.nombre as nombreRol  FROM general_usuarios usu
          inner join general_roles rol on usu.idRol = rol.id where usu.eliminado = 'N'";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "SIN_DATOS";
        }
        return $respuesta;
    }

    function obtenerById()
    {
        $respuesta = new stdClass();
        $sql = "SELECT usu.id, usu.nombre, usu.email, rol.id as idRol, rol.nombre as nombreRol, usu.claveTemporal, usu.usuario  FROM general_usuarios usu
          inner join general_roles rol on usu.idRol = rol.id where usu.id = {$this->id} and usu.eliminado = 'N'";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "SIN_DATOS";
        }
        return $respuesta;
    }


    function IniciarSesion()
    {
        $respuesta = new stdClass();

        $sql = "SELECT * FROM general_usuarios where  usuario = '{$this->usuario}' and clave = md5('{$this->clave}') and eliminado ='N'";

        $result = $this->conexion->query($sql);
        if ($result->rowCount() > 0) {
            $respuesta->mensaje = "INICIAR_SESION";
            $_SESSION['general']['usuario'] = $result->fetchAll(PDO::FETCH_OBJ);
            $respuesta->datos = $_SESSION['general'];

        } else {
            $respuesta->mensaje = "USUARIO_CLAVE_INCORRECTO";
        }
        return $respuesta;
    }

    private function obtenerUnidadesAsignadas($idUsuario, $tipoUsuario)
    {
        $respuesta = new stdClass();
        if ($tipoUsuario != 1) {
            $sql = "select * from detalle_usuarios_unidades_ambientales 
         inner join unidades_ambientales ua on detalle_usuarios_unidades_ambientales.id_unidad_ambiental = ua.id_ua
         where id_usuario_asignado = {$idUsuario} and eliminado= 0";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $tmp = $query->fetchAll(PDO::FETCH_OBJ);
                $respuesta->mensaje = 'EXITO';
                $respuesta->datos = array();
                $respuesta->idUnidadAmbiental = $tmp[0]->id_unidad_ambiental;
                $respuesta->idTipoUnidad = $tmp[0]->id_tipo_unidad_ambiental;
                foreach ($tmp as $fila) {
                    $datosFila = array(
                        'idUnidadAmbiental' => $fila->id_unidad_ambiental,
                        'nombreUnidad' => $fila->nombre_institucion,
                        'unidadPrincipal' => $fila->uaPrincipal,
                        'representante' => $fila->representante,
                        'idMunicipio' => $fila->idMunicipio,
                        'idDistrito' => $fila->idDistrito,
                        'idTipoUnidad'=> $fila->id_tipo_unidad_ambiental
                    );
                    $respuesta->datos[] = $datosFila;
                }
            } else {
                $respuesta->mensaje = "NO_ASIGNADO";
            }
        } else {
            $respuesta->mensaje = "EXITO";
        }
        return $respuesta;
    }

    function Guardar()
    {
        $respuesta = new stdClass();
        $sql = "insert into general_usuarios (nombre, email, usuario, clave, idRol) values(:nombre, :email, :usuario, :clave,:rol)";
        $stmt = $this->conexion->prepare($sql);
        $clave = md5($this->clave);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":clave", $clave);
        $stmt->bindParam(":rol", $this->rol);

        if ($stmt->execute()) {
            $respuesta->mensaje = "EXITO";
            $respuesta->id= $this->conexion->lastInsertId();
            $respuesta->email =$this->email;
            $respuesta->nombre =$this->nombre;
        } else {
            $respuesta->mensaje = "ERROR";
        }
        return $respuesta;

    }

    function Actualizar()
    {
        $respuesta = new stdClass();
        $sql = "update general_usuarios set nombre=:nombre, email=:email, clave=:clave, idRol=:rol where id=:idUsuario";
        $stmt = $this->conexion->prepare($sql);
        $clave = md5($this->clave);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":clave", $clave);
        $stmt->bindParam(":rol", $this->rol);
        $stmt->bindParam(":idUsuario", $this->id);

        if ($stmt->execute()) {
            $respuesta->mensaje = "EXITO";
        } else {
            $respuesta->mensaje = "ERROR";
        }
        return $respuesta;
    }

    function cerrarSesion()
    {
        session_destroy();
        return "EXITO";
    }

    function actualizarClave(){
        $respuesta = new stdClass();

        $sql = "update general_usuarios set clave=:clave, reestablecioClave =:reestablecioClave, claveTemporal='' where id=:id";
        $stmt = $this->conexion->prepare($sql);
        $clave = md5($this->clave);
        $valor=0;
        $stmt->bindParam(":clave", $clave);
        $stmt->bindParam(":reestablecioClave", $valor);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            $respuesta->mensaje = "CLAVE_ACTUALIZADA";
        } else {
            $respuesta->mensaje = "ERROR";
        }
        return $respuesta;

    }

    function validarExistencia(){
        $respuesta = new stdClass();
        $sql = "select id,  nombre,  email from general_usuarios where usuario ='{$this->usuario}' and eliminado= 0";
        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
          $respuesta->mensaje = "USUARIO_NO_EXISTE";
        }
        return $respuesta;
    }

    function obtenerUnidadesAmbientalesAsignadas()
    {

    }


}