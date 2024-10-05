<?php $modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";?>
<div class="pagetitle">
    <h1>Administrar Cargos de Empleados</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Planillas</a></li>
            <li class="breadcrumb-item"><a href="#">Catálogos</a></li>
            <li class="breadcrumb-item active">Administrar Cargos de Empleados</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="section dashboard">
    <div class="card">
        <div class="card-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="page-title-left">

                </div>

                <div class="page-title-right">
                    <a href="?module=planilla&page=cargos_empleado" class="btn btn-outline-dark btn-sm">Nuevo Registro
                    </a>
                </div>

            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="tblCargos" class="table table-striped nowrap w-100">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
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
<script src="./<?php echo $modulo ?>/js/adm_cargo_empleado.js?vesion=5"></script>