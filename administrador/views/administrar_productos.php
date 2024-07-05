<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="page-title-left">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Administrar Productos</a></li>
                        <li class="breadcrumb-item active">Ver Productos</li>
                    </ol>
                </div>

                <div class="page-title-right">
                    <a href="?page=producto" class="btn btn-info btn-sm">Registrar Producto
                    </a>
                </div>

            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="tblAdmProductos" class="table table-striped  nowrap w-100">
                        <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Catálogo</th>
                            <th>Categoria</th>
                            <th>Unidades bulto</th>
                            <th>Precio Unidad</th>
                            <th>Precio Bulto</th>
                            <th>Disponible</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>

    </div>


</div>

<?php
include "./views/footer.php";
?>

<script src="js/administrarProductos.js?vesion=1"></script>


