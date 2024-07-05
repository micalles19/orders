<?php

class Producto
{
    private $conexion, $hoy, $idUsuario;
    public
        $id,
        $codigo,
        $nombre,
        $descripcion,
        $imagen,
        $unidadesBulto,
        $precioUnidad,
        $precioTotal,
        $idCatalogo,
        $idCategoria,
        $disponible,
        $eliminado;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
        date_default_timezone_set('America/El_Salvador');
        $this->hoy = date("Y-m-d H:i:s");
        $this->idUsuario = $_SESSION['general'][0]->id;
    }

    function guardar()
    {
        $respuesta = new  stdClass();
        try {

            if (!$this->validarCodigoProducto($this->codigo)) {

                $sql = "insert into productos (codigoProducto, nombre, descripcion, imagen, unidadesBulto, precioUnidad, precioTotal, idCatalogo, idCategoria, idUsuarioRegistro, fechaRegistro)
                    values('{$this->codigo}', '{$this->nombre}', '{$this->descripcion}','{$_FILES["foto"]["name"][1]}','{$this->unidadesBulto}','{$this->precioUnidad}', '{$this->precioTotal}', 
                           '{$this->idCatalogo}', '{$this->idCategoria}', '{$this->idUsuario}', '{$this->hoy}') ";
                $query = $this->conexion->query($sql);
                if ($query) {
                    $nombre_imagen = $_FILES['foto']['name'][1];
                    $rutaImagen = "./../../images/productos/" . $nombre_imagen;
                    $rutaMiniatura = "./../../images/thumbnails/" . $nombre_imagen;
                    if (!file_exists($rutaImagen)) {
                        move_uploaded_file($_FILES['foto']['tmp_name'][1], $rutaImagen);
                        $anchoMaximo = 1080; //
                        $altoMaximo = 1080; //
                        list($anchoOriginal, $altoOriginal) = getimagesize($rutaImagen);
                        $factorEscala = min($anchoMaximo / $anchoOriginal, $altoMaximo / $altoOriginal);

                        $anchoNuevo = $anchoOriginal * $factorEscala;
                        $altoNuevo = $altoOriginal * $factorEscala;
                        $imagenMiniatura = imagecreatetruecolor($anchoNuevo, $altoNuevo);

                        // Guardar la miniatura
                        $tipoMIME = $_FILES['foto']['type'][1];

                        switch ($tipoMIME){
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
//                        move_uploaded_file($_FILES['foto']['tmp_name'][1], $rutaImagen);
//                        $anchoMaximo = 100; //
//                        $altoMaximo = 100; //
//                        list($anchoOriginal, $altoOriginal) = getimagesize($rutaImagen);
//                        $factorEscala = min($anchoMaximo / $anchoOriginal, $altoMaximo / $altoOriginal);
//
//                        $anchoNuevo = $anchoOriginal * $factorEscala;
//                        $altoNuevo = $altoOriginal * $factorEscala;
//                        $imagenMiniatura = imagecreatetruecolor($anchoNuevo, $altoNuevo);
//                        $imagenOriginal = imagecreatefromjpeg($rutaImagen); // Cambia a imagecreatefrompng, imagecreatefromgif, etc., según el tipo de imagen
//
//                        imagecopyresampled($imagenMiniatura, $imagenOriginal, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $anchoOriginal, $altoOriginal);
//
//                        // Guardar la miniatura
//                        imagejpeg($imagenMiniatura, $rutaMiniatura); // Cambia a imagepng, imagegif, etc., según el tipo de imagen
//
//                        // Liberar memoria
//                        imagedestroy($imagenOriginal);
//                        imagedestroy($imagenMiniatura);
                    }
                    $respuesta->mensaje = "EXITO";

                } else {
                    $respuesta->mesaje = "ERROR_GENERAL";
                }
            } else {
                $respuesta->mensaje = "CODIGO_EXISTE";
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
        try {
            $imagen = "";
            if (isset($_FILES["foto"]["name"][1])) {
                $imagen = " imagen = '{$_FILES["foto"]["name"][1]}', ";
                $nombre_imagen = $_FILES['foto']['name'][1];

                $rutaImagen = "./../../images/productos/" . $nombre_imagen;
                $rutaMiniatura = "./../../images/thumbnails/" . $nombre_imagen;
                if (!file_exists($rutaImagen)) {
                    move_uploaded_file($_FILES['foto']['tmp_name'][1], $rutaImagen);
                    $anchoMaximo = 1080; //
                    $altoMaximo = 1080; //
                    list($anchoOriginal, $altoOriginal) = getimagesize($rutaImagen);
                    $factorEscala = min($anchoMaximo / $anchoOriginal, $altoMaximo / $altoOriginal);

                    $anchoNuevo = $anchoOriginal * $factorEscala;
                    $altoNuevo = $altoOriginal * $factorEscala;
                    $imagenMiniatura = imagecreatetruecolor($anchoNuevo, $altoNuevo);

                    // Guardar la miniatura
                    $tipoMIME = $_FILES['foto']['type'][1];

                    switch ($tipoMIME){
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
            $sql = "update productos set codigoProducto='{$this->codigo}', nombre ='{$this->nombre}', descripcion = '{$this->descripcion}', " . $imagen . " unidadesBulto ='{$this->unidadesBulto}', precioUnidad = '{$this->precioUnidad}', precioTotal = '{$this->precioTotal}', idCatalogo = '{$this->idCatalogo}', idCategoria = '{$this->idCategoria}' where id = {$this->id}";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mesaje = "ERROR_GENERAL";
            }
        } catch (PDOException $exception) {
            $respuesta->mensaje = "ERROR_GENERAL";
            $respuesta->error = $exception->getMessage();
        }
        return $respuesta;
    }

    function validarCodigoProducto($codigoProd)
    {
        $sql = "select count(id) as counter from productos where codigoProducto ='{$codigoProd}' and eliminado = 'N'";
        $query = $this->conexion->query($sql);
        $rows = $query->fetchAll(PDO::FETCH_OBJ);
        return $rows[0]->counter > 0;
    }

    function obtenerByTable()
    {
        $respuesta = new  stdClass();
        try {
            $sql = "select productos.id, productos.codigoProducto, productos.nombre, productos.imagen, productos.unidadesBulto, 
                     productos.precioUnidad,productos.precioTotal, productos.disponible, catalogos.nombre as catalogo, 
                     categorias.nombre as categoria
                    from productos  
                    left join catalogos  on productos.idCatalogo = catalogos.id
                    left join categorias on productos.idCategoria = categorias.id 
                    where productos.eliminado = 'N'";
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

    function eliminarImagen()
    {
        $respuesta = new  stdClass();
        try {
            $sql = " update productos set imagen = null where id = {$this->id}";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "NO_DELETE";
            }
        } catch (PDOException $exception) {
            $respuesta->mensaje = "ERROR_GENERAL";
            $respuesta->error = $exception->getMessage();
        }
        return $respuesta;
    }

    function cambiarEstado()
    {
        $respuesta = new  stdClass();
        try {
            $estadoFinal = $this->disponible == "S" ? "N" : "S";
            $sql = "update productos set disponible = '{$estadoFinal}'  where id ={$this->id}";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "NO_UPDT";
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
            $sql = "update productos set eliminado = 'S', fechaEliminado = '{$this->hoy}', idUsuarioElimino =  '{$this->idUsuario}'  where id ={$this->id}";
            $query = $this->conexion->query($sql);
            if ($query) {
                $respuesta->mensaje = "EXITO";
            } else {
                $respuesta->mensaje = "NO_DELETE";
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
            $sql = " select * from productos where id ={$this->id}";
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