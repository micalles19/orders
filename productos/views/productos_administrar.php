<?php
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1>Administración Productos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row" >


        <div class="card" >
            <div class="card-body" style="">
                <div class="table-toolbar" style="text-align: right!important; margin-top: 15px!important; margin-bottom: 15px !important;">
                    <a id="agregarUsuarioBtn" href="?module=productos&page=producto" class="btn btn-outline-info btn-sm">Nuevo Producto</a>
                </div>
                <table class="table table-striped" id="tblProductos">
                    <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Exento</th>
                        <th scope="col">Precio 2</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>

    </div>
</section>

<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/productos_administrar.js"></script>
