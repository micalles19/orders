<?php

class Producto
{
    private $conexion;
    public $id, $codigo, $nombre, $proveedor,
        $marca, $catalogo, $categoria, $subCategoria, $descripcion, $especificaciones,
        $excento, $precioFijo, $precioCompraSinIva, $ivaCompra, $precioCompraConIva,
        $precioVentaSinIva, $ivaVenta, $precioVentaConIva, $descuento, $porcentajeDescuento,
        $valorDescuento, $precioConsumidorFinal, $idUsuario, $hoy;

    function __construct()
    {
        $con = new connect();
        $this->conexion = $con->connectDB();
    }

    function guardar()
    {

        $respuesta = new stdClass();
        try {
            if (!$this->validarCodigoProducto()) {
                $sql = "INSERT INTO productos (codigo, nombre, idProveedor, idMarca, idCatalogo, idCategoria, idSubCategoria, descripcion, especificaciones, excento, precioFijo, precioCompraSinIva, ivaCompra, precioCompraConIva, precioVentaSinIva, ivaVenta, precioVentaConIva, descuento, porcentajeDescuento, precioConsumidorFinal, imagen, valorDescuento, idUsuarioRegistra) 
                        VALUES (:codigo, :nombre, :idProveedor, :idMarca, :idCatalogo, :idCategoria, :idSubCategoria, :descripcion, :especificaciones, :excento, :precioFijo, :precioCompraSinIva, :ivaCompra, :precioCompraConIva, :precioVentaSinIva, :ivaVenta, :precioVentaConIva, :descuento, :porcentajeDescuento, :precioConsumidorFinal, :imagen, :valorDescuento, :idUsuarioRegistra)";
                $stmt = $this->conexion->prepare($sql);
                $imagen = isset($_FILES["imagen"]["name"]) && !empty($_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : null;
                $stmt->bindParam(':codigo', $this->codigo);
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':idProveedor', $this->proveedor);
                $stmt->bindParam(':idMarca', $this->marca);
                $stmt->bindParam(':idCatalogo', $this->catalogo);
                $stmt->bindParam(':idCategoria', $this->categoria);
                $stmt->bindParam(':idSubCategoria', $this->subCategoria);
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':especificaciones', $this->especificaciones);
                $stmt->bindParam(':excento', $this->excento);
                $stmt->bindParam(':precioFijo', $this->precioFijo);
                $stmt->bindParam(':precioCompraSinIva', $this->precioCompraSinIva);
                $stmt->bindParam(':ivaCompra', $this->ivaCompra);
                $stmt->bindParam(':precioCompraConIva', $this->precioCompraConIva);
                $stmt->bindParam(':precioVentaSinIva', $this->precioVentaSinIva);
                $stmt->bindParam(':ivaVenta', $this->ivaVenta);
                $stmt->bindParam(':precioVentaConIva', $this->precioVentaConIva);
                $stmt->bindParam(':descuento', $this->descuento);
                $stmt->bindParam(':porcentajeDescuento', $this->porcentajeDescuento);
                $stmt->bindParam(':precioConsumidorFinal', $this->precioConsumidorFinal);
                $stmt->bindParam(':imagen', $imagen);
                $stmt->bindParam(':valorDescuento', $this->valorDescuento);
                $stmt->bindParam(':idUsuarioRegistra', $this->idUsuario);
                if ($stmt->execute()) {
                    // cargamos el ID del producto
                    $this->id = $this->conexion->lastInsertId();
                    if ($imagen != null) {
                        $this->subirImagenMasterizada();
                    }
                    $respuesta->mensaje = "EXITO";
                } else {
                    $respuesta->mensaje = "ERROR_INSERT";
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

    function subirImagenMasterizada()
    {
        $nombre_imagen = $_FILES['imagen']['name'];
        $rutaImagen = "../images/productos/" . $nombre_imagen;
        $rutaMiniatura = "../images/thumbnails/" . $nombre_imagen;
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

    private function validarCodigoProducto()
    {
        if (!empty($this->codigo)) {
            $sql = "select count(id) as counter from productos where codigo ='{$this->codigo}' and eliminado = 'N'";
            $query = $this->conexion->query($sql);
            $rows = $query->fetchAll(PDO::FETCH_OBJ);
            return $rows[0]->counter > 0;
        } else {
            return false;
        }

    }


    function obtenerByTable()
    {
        $respuesta = new stdClass();
        if (isset($_SESSION['general'])){
            $sql = " select prod.id as idProducto,prod.codigo, prod.imagen, prod.nombre , prod.excento, prod.precioCompraConIva, prod.precioCompraSinIva,
        prod.valorDescuento, prod.precioVentaConIva, prod.precioVentaSinIva, prod.precioConsumidorFinal, marca.nombre as marca, cat.nombre as catalogo,
        cate.nombre as categoria, sc.nombre as subCategoria, concat(' ') as sucursales
        from productos prod  
        inner join marcas marca on prod.idMarca = marca.id
        inner join  catalogos cat on prod.idCatalogo = cat.id
        inner join categorias cate on prod.idCatalogo = cate.id
        inner join sub_categorias sc on prod.idSubCategoria = sc.id
        where prod.eliminado = 'N'";

            $query = $this->conexion->query($sql);
            if ($query->rowCount() > 0) {
                $respuesta->mensaje = "EXITO";
                $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $respuesta->mensaje = "NO_DATOS";
            }
        }else{
            return  $respuesta->mensaje ="SESSION";
        }

        return $respuesta;
    }
    function obtenerById(){
        $respuesta = new stdClass();
        $sql = "select * from productos where eliminado = 'N' and id ={$this->id}";

        $query = $this->conexion->query($sql);
        if ($query->rowCount() > 0) {
            $respuesta->mensaje = "EXITO";
            $respuesta->datos = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $respuesta->mensaje = "NO_DATOS";
        }
        return $respuesta;
    }
}