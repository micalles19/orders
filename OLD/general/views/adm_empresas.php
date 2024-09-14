<?php ?>
<div class="pagetitle">
    <h1>Administrar Empresas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Configuraciones Generales</a></li>
            <li class="breadcrumb-item active">Administración de empresas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row" >


        <div class="card" >
            <div class="card-body" style="">
                <div class="table-toolbar" style="text-align: right!important; margin-top: 15px!important; margin-bottom: 15px !important;">
                    <a id="agregarUsuarioBtn" href="?module=general&page=datos_empresa" class="btn btn-outline-info btn-sm">Nueva Empresa</a>
                </div>
                <table class="table table-striped" id="tblEmpresas">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Nombre Comercial</th>
                        <th scope="col">NIT</th>
                        <th scope="col">IVA</th>
                        <th scope="col">Dirección</th>
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
<script src="./general/js/adm_empresas.js"></script>
