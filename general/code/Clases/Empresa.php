<?php

class Empresa
{
    private $conexion, $logs;
    public $id,
        $idPersoneria,
        $nit,
        $iva,
        $nombre,
        $nombreComercial,
        $nombreLogo,
        $correo,
        $telefono,
        $idUsuario,
        $hoy,
        $actividadesEconocomicas,
        $sucursales,
        $documentosFiscales,
        $datosDte;

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
            // Comienza una transacción
            $this->conexion->beginTransaction();

            $sql = "INSERT INTO general_datos_empresa (idPersoneria, numeroIVA, nit, nombre, nombreComercial, nombreLogo, 
                                    correo, telefono, fechaRegistro, idUsuarioRegistra) 
                VALUES (:idPersoneria, :numeroIVA, :nit, :nombre, :nombreComercial, :nombreLogo,
                        :correo, :telefono, :fechaRegistro, :idUsuarioRegistra)";
            $stmt = $this->conexion->prepare($sql);

            // Validación de imagen
            $imagen = isset($_FILES["imagen"]["name"]) && !empty($_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : null;

            // Bindeo de parámetros
            $stmt->bindParam(':idPersoneria', $this->idPersoneria);
            $stmt->bindParam(':numeroIVA', $this->iva);
            $stmt->bindParam(':nit', $this->nit);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':nombreComercial', $this->nombreComercial);
            $stmt->bindParam(':nombreLogo', $imagen);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':fechaRegistro', $this->hoy);
            $stmt->bindParam(':idUsuarioRegistra', $this->idUsuario);

            if ($stmt->execute()) {
                $this->id = $this->conexion->lastInsertId();

                // Si hay imagen, se sube
                if ($imagen != null) {
                    $this->subirImagenMasterizada();
                }

                // Confirma la transacción
                $this->conexion->commit();
                $respuesta->mensaje = "EXITO";
            } else {
                // Si falla, hace rollback
                $this->conexion->rollBack();
                $respuesta->mensaje = "ERROR_INSERT";
            }

        } catch (PDOException $e) {
            // Rollback en caso de excepción
            $this->conexion->rollBack();
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
        $sqlFinal = "";
        try {

            $sql = "update general_datos_empresa set idPersoneria = {$this->idPersoneria}, numeroIVA ='{$this->iva}' , 
                                 nit ='{$this->nit}', nombre='{$this->nombre}', nombreComercial= '{$this->nombreComercial}',
                                    correo ='{$this->correo}', telefono ='{$this->telefono}' ";
            $condiciones = [];
            $imagen = isset($_FILES["imagen"]["name"]) && !empty($_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : null;

            if ($imagen != null) {
                $condiciones[] = "nombreLogo =  '{$imagen}'";
            }


            $updt = "";
            if (!empty($condiciones)) {

                $updt = "," . implode(", ", $condiciones);
            }

            $sqlFinal = $sql . " " . $updt . " where id ={$this->id}";

            $stmt = $this->conexion->query($sqlFinal);


            if ($stmt) {
                // Si hay imagen, se sube
                if ($imagen != null) {
                    $this->subirImagenMasterizada();
                }
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "ERROR_INSERT";
            }

        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR_GUARDAR";
            $this->logs->funcionActual = "actualizar()";
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

    function obtenerAll()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {
            $sql = "select id, nombre, nombreComercial, nit, numeroIVA as iva, '' as direccion
                    from general_datos_empresa where eliminado = 0";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $respuesta->mensaje = "EXITO";
                $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR OBTENER DATOS ";
            $this->logs->funcionActual = "obtenerAll()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sql;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta->mensaje = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }

        return $respuesta;
    }

    function obtenerById()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {
            $sql = "select * from general_datos_empresa where id = {$this->id} and eliminado = 0";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $respuesta->mensaje = "EXITO";
                $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
                $respuesta->actividadesEconomicas = $this->obtenerActividadesEconomicas();
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR OBTENER DATOS ";
            $this->logs->funcionActual = "obtenerAll()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sql;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta->mensaje = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }

        return $respuesta;
    }
    function obtenerByCbo()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {
            $sql = "select * from general_datos_empresa where eliminado = 0";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $respuesta->mensaje = "EXITO";
                $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR OBTENER DATOS ";
            $this->logs->funcionActual = "obtenerAll()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sql;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta->mensaje = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }

        return $respuesta;
    }

    function obtenerActividadesEconomicas()
    {
        $respuesta = new stdClass();
        $sql = "";
        try {
            $sql = "select det.id, mae.id as idActividad, mae.codigoActividad, mae.nombreActividad
                    from general_datos_empresa_actividades_economicas as det
                    inner join mh_actividad_economica mae on det.idActividad = mae.id
                    where det.idEmpresa = {$this->id} and det.eliminado = 'N'";
            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $respuesta->mensaje ="EXITO";
                $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        } catch (PDOException $e) {
            $this->logs->mensaje = "ERROR OBTENER DATOS ";
            $this->logs->funcionActual = "obtenerActividadesEconomicas()";
            $this->logs->archivo = $_SERVER['PHP_SELF'];
            $this->logs->usuario = $this->idUsuario;
            $this->logs->consultasql = $sql;
            $this->logs->excepcion = 'Excepción ' . $e->getCode() . ': ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del fichero ' . $e->getFile();
            $respuesta->mensaje = $this->logs->guardarLogError();
        } finally {
            $this->conexion = null;
        }

        return $respuesta;
    }

    function subirImagenMasterizada()
    {
        $nombre_imagen = $_FILES['imagen']['name'];
        $rutaImagen = "../../images/logos/" . $nombre_imagen;
        $rutaMiniatura = "../../images/thumb/" . $nombre_imagen;
        if (!file_exists($rutaImagen)) {
            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
            $anchoMaximo = 1080; //
            $altoMaximo = 1080; //
            list($anchoOriginal, $altoOriginal) = getimagesize($rutaImagen);
            $factorEscala = min($anchoMaximo / $anchoOriginal, $altoMaximo / $altoOriginal);

            $anchoNuevo = $anchoOriginal * $factorEscala;
            $altoNuevo = $altoOriginal * $factorEscala;
            $imagenMiniatura = imagecreatetruecolor($anchoNuevo, $altoNuevo);

            // Guardar la miniatura
            $tipoMIME = $_FILES['imagen']['type'];

            switch ($tipoMIME) {
                case 'image/jpeg' :
                    $imagenOriginal = imagecreatefromjpeg($rutaImagen); // Cambia a imagecreatefrompng, imagecreatefromgif, etc., según el tipo de imagen
                    imagecopyresampled($imagenMiniatura, $imagenOriginal, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $anchoOriginal, $altoOriginal);
                    imagejpeg($imagenMiniatura, $rutaMiniatura); // Cambia a imagepng, imagegif, etc., según el tipo de imagen
                    break;
                case 'image/png':
                    $imagenOriginal = imagecreatefrompng($rutaImagen); // Cambia a imagecreatefrompng, imagecreatefromgif, etc., según el tipo de imagen
                    imagecopyresampled($imagenMiniatura, $imagenOriginal, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $anchoOriginal, $altoOriginal);
                    imagepng($imagenMiniatura, $rutaMiniatura); // Cambia a imagepng, imagegif, etc., según el tipo de imagen
                    break;
                case "image/bmp":
                    $imagenOriginal = imagecreatefrombmp($rutaImagen); // Cambia a imagecreatefrompng, imagecreatefromgif, etc., según el tipo de imagen
                    imagecopyresampled($imagenMiniatura, $imagenOriginal, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $anchoOriginal, $altoOriginal);
                    imagebmp($imagenMiniatura, $rutaMiniatura);
                    break;
                case "image/webp":
                    $imagenOriginal = imagecreatefromwebp($rutaImagen); // Cambia a imagecreatefrompng, imagecreatefromgif, etc., según el tipo de imagen
                    imagecopyresampled($imagenMiniatura, $imagenOriginal, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $anchoOriginal, $altoOriginal);
                    imagewebp($imagenMiniatura, $rutaMiniatura);
            }
            // Liberar memoria
            imagedestroy($imagenOriginal);
            imagedestroy($imagenMiniatura);
        }
    }

}