<?php
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1>Administrar Cuentas de bancos</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Formularios</a></li>
            <li class="breadcrumb-item active">Administrar Solicitudes de transferencias</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row" >


        <div class="card" >
            <div class="card-body" style="">
                <div class="table-toolbar" style="text-align: right!important; margin-top: 15px!important; margin-bottom: 15px !important;">
                    <a id="agregarUsuarioBtn" href="?module=formularios&page=solicitud_transferencia" class="btn btn-outline-info btn-sm">Nuevo Registro</a>
                </div>
                <table class="table table-striped" id="tblAutorizaciones">
                    <thead>
                    <tr>
                        <th scope="col">N#</th>
                        <th scope="col">Solicita</th>
                        <th scope="col">Monto Solicitado</th>
                        <th scope="col">Fecha Solicita</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Autorizado Por</th>
                        <th scope="col">Fecha Autoriza</th>
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
<script src="./<?php echo $modulo ?>/js/adm_solicitudes_transferencias.js"></script>
