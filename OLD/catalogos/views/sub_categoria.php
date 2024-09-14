<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1><?php echo  $nombre ?> Sub Categoría</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Catalogos, Categorias & Sub Categorias</a></li>
            <li class="breadcrumb-item active"><?php echo  $nombre ?>Sub Categoría</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="section dashboard">

        <div class="row">
            <div class="col-12">
                <div class="card" style="padding-top: 2%;">
                    <div class="card-body ">
                        <div class="container">
                            <form name="frmCliente">
                                <div class="row" style="padding-bottom: 15px;">
                                    <input type="hidden" id="hdnId" value="<?php echo $id ?>">

                                    <div class="col-md-4">
                                        <label for="txtNombre" class="form-label">Nombre Sub Categoria </label>
                                        <input class="form-control" type="text" value=""
                                               id="txtNombre" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="txtDescripcion" class="form-label">Descripción </label>
                                        <input class="form-control" type="text" value=""
                                               id="txtDescripcion" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cboEstado" class="form-label">Estado</label>
                                        <select class="form-select" id="cboEstado">
                                            <option value="" selected disabled>Seleccione</option>
                                            <option value="A" >Activo</option>
                                            <option value="I" >Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="card-footer" align="center">
                            <button type="button" onclick="subCategoria.validar();" class="btn btn-outline-dark">Guardar</button>
                            <button type="button" onclick="subCategoria.atras('catalogos','administrar_categorias')" class="btn btn-outline-danger">Cancelar</button>
                    </div>
                </div>

            </div> <!-- end col -->
        </div>


</div>

<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/subCategoria.js?vesion=5"></script>


