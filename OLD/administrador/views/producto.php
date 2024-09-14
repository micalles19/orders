<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? $_GET["id"] : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
?>
<style>
    /* Define la clase para las imágenes pequeñas */
    .small-image-container {
        position: relative;
        display: inline-block; /* Permite que las imágenes se muestren en línea */
        width: 250px; /* Ancho del contenedor */
        height: 250px; /* Altura del contenedor */
        overflow: hidden; /* Oculta cualquier parte de la imagen que exceda las dimensiones */
    }

    .small-image {
        width: 100%; /* Ancho de la imagen */
        height: 100%; /* Altura de la imagen */
    }

    .delete-button {
        position: absolute;
        top: 0;
        right: 0;
        background-color: red;
        color: white;
        border: none;
        padding: 2px 5px;
        font-size: 19px;
        cursor: pointer;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Administrar Productos</a>
                                </li>
                                <li class="breadcrumb-item active"><?php echo $nombre ?> Producto</li>
                            </ol>
                        </div>

                        <div class="page-title-right">
                            <a href="?page=administrar_productos" class="btn btn-info btn-sm">Ver Productos
                            </a>
                        </div>

                    </div>

                </div>
                <div class="card-body ">
                    <div class="container">
                        <form name="frmCliente">
                            <div class="row" style="padding-bottom: 15px;">
                                <input type="hidden" id="txtId" value="<?php echo $id ?>">

                                <div class="col-md-4">
                                    <label for="txtCodigo" class="form-label">Código inventario </label>
                                    <input class="form-control" type="text" value=""
                                           id="txtCodigo" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtNombre" class="form-label">Nombre Producto </label>
                                    <input class="form-control" type="text" value=""
                                           id="txtNombre" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="cboCatalogo" class="form-label">Catálogo</label>
                                    <select class="form-select" id="cboCatalogo">
                                        <option value="0" disabled selected>Seleccione ...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 35px;">
                                <div class="col-md-4">
                                    <label for="cboCategoria" class="form-label">Categoria</label>
                                    <select class="form-select" id="cboCategoria">
                                        <option value="0" disabled selected>Seleccione ...</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="txtUnidadesBultos" class="form-label">Piezas por bulto</label>
                                    <input class="form-control" type="number" onchange="productos.calcularTotal()"
                                           value="1" min="1"
                                           id="txtUnidadesBultos">
                                </div>
                                <div class="col-md-4">
                                    <label for="precioUnidad" class="form-label">Precio Por Pieza de
                                        Bulto</label>
                                    <input class="form-control" type="number" value="0" min="0" step="0.01"
                                           id="precioUnidad" onchange="productos.calcularTotal()">
                                </div>

                            </div>

                            <div class="row" style="padding-bottom: 35px;">

                                <div class="col-md-4">
                                    <label for="txtTotalBulto" class="form-label">Total del Bulto</label>
                                    <input class="form-control" type="number" value=""
                                           id="txtTotalBulto">
                                </div>
                                <div class="col-md-8">
                                    <label for="txtDescripcion" class="form-label">Descripción del producto</label>
                                    <textarea class="form-control" value="" rows="4"
                                              id="txtDescripcion"></textarea>
                                </div>
                            </div>

                            <div class="row" style="padding-bottom: 35px;">
                                <div class="col-lg-10">
                                    <label>Multimedia - Imagenes</label>
                                    <input type="hidden" id="hdnCantidadImagenes" name="hdnCantidadImagenes" value="0">
                                    <ul class='mb0' id="ulGaleriaImagenes">
                                        <span id='spnGaleriaImagenes'> </span>
                                    </ul>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input type="file" id="fileImagenes" name="fileImagenes" style="display:none;"
                                               accept="image/*" multiple>
                                        <span class="btn btn-xl btn-info"
                                              onclick="$('#fileImagenes').trigger('click');"><i
                                                    class="fa fa-upload"></i> Seleccionar imagenes</span>
                                        <br>
                                        <span class="spn-error" id="spnImagenes" style="display:none; color: red;">*Debe subir al menos una imagen</span>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
                <div class="card-footer" align="center">
                    <?php
                    if ($id == 0) {
                        ?>
                        <button type="button" onclick="productos.guardar();" class="btn btn-info">Guardar</button>
                    <?php } else {
                        ?>
                        <button type="button" onclick="productos.actualizar();" class="btn btn-info">Actualizar</button>
                    <?php } ?>

                    <button type="button" class="btn btn-danger">Cancelar</button>

                </div>
            </div>

        </div> <!-- end col -->
    </div>


</div>

<?php
include "./views/footer.php"; ?>
<script src="js/productos.js?vesion=4"></script>

