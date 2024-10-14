<?php
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1>Administrar Cuentas de bancos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Formularios</a></li>
            <li class="breadcrumb-item"><a href="#">Catálogos</a></li>
            <li class="breadcrumb-item active">Administrar Cuentas de banco</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row" >


        <div class="card" >
            <div class="card-body" style="">
                <div class="table-toolbar" style="text-align: right!important; margin-top: 15px!important; margin-bottom: 15px !important;">
                    <a id="agregarUsuarioBtn" href="?module=formularios&page=cuentas_banco" class="btn btn-outline-info btn-sm">Nuevo Registro</a>
                </div>
                <table class="table table-striped" id="tblMontos">
                    <thead>
                    <tr>
                        <th scope="col">N</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Banco</th>
                        <th scope="col">Numero Cuenta</th>
                        <th scope="col">Tipo de Cuenta</th>
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
<script src="./<?php echo $modulo ?>/js/adm_cuentas_banco.js"></script>
