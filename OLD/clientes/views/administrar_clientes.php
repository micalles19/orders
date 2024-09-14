<?php $modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";?>
<div class="pagetitle">
    <h1>Administrar Clientes</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Clientes</a></li>
            <li class="breadcrumb-item active">Administrar Clientes</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="section dashboard">

    <div class="card">
        <div class="card-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="page-title-left">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Administrar Clientes</a></li>
                        <li class="breadcrumb-item active">Ver Clientes</li>
                    </ol>
                </div>

                <div class="page-title-right">
                    <a href="?module=clientes&page=cliente" class="btn btn-outline-dark btn-sm">Nuevo Cliente
                    </a>
                </div>

            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="tblVerClientes" class="table table-striped   nowrap w-100">
                        <thead class="table-light">
                        <tr>
                            <th>Nombre Cliente</th>
                            <th>Tipo <br> Documento</th>
                            <th>Número <br> Documento</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Actividad Económica</th>
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

<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/administrarClientes.js?vesion=5"></script>




