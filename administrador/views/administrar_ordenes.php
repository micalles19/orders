<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="page-title-left">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Administrar Ordenes</a></li>
                        <li class="breadcrumb-item active">Ver Ordenes</li>
                    </ol>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="tblAdmOrdenes" class="table table-striped   nowrap w-100">
                        <thead class="table-light">
                        <tr>
                            <th>N Orden</th>
                            <th>Cliente</th>
                            <th>Telefono</th>
                            <th align="center">Estado Orden</th>
                            <th>Tipo Comprobante</th>
                            <th>Fecha Recibida </th>
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

<script src="js/administrarOrdenes.js?vesion=1"></script>


