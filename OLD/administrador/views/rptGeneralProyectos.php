<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="page-title-left">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reportes</a></li>
                        <li class="breadcrumb-item active">General Proyectos</li>
                    </ol>
                </div>
                <div class="page-title">
                    <label for="dtpDesde" class="form-label"> Fecha Desde <span>*</span></label>
                    <input class="form-control" type="date" value=""
                           id="dtpDesde" required>
                </div>
                <div class="page-title">
                    <label for="dtpHasta" class="form-label">Fecha Hasta <span>*</span></label>
                    <input class="form-control" type="date" value=""
                           id="dtpHasta" required>
                </div>
                <div class="page-title">
                    <label for="dtpHasta" class="form-label">Estado Pago <span>*</span></label>
                        <select class="form-select" id="cboEstadoPago">
                            <option value="0" selected >Todos</option>
                            <option value="1">Pendiente</option>
                            <option value="2">Pago Parcial</option>
                            <option value="3">Pagado</option>
                        </select>
                </div>

                <div class="page-title" style="margin-top: 25px;">
                    <label for="txtNombre" class="form-label"></label>
                    <button type="button" class="btn btn-info" onclick="rptProyectos.validateDtpBuscar()" style="margin-right: 10px;"><span class="fas fa-search"></span> Buscar
                    </button>
                    <button type="button" class="btn btn-success" onclick="rptProyectos.exportarExcel()"><span class="fas fa-file-excel"></span> Exportar Excel
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="tblRptVerProyectos" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Nombre Proyecto</th>
                            <th>Estado Pago</th>
                            <th>Invoice</th>
                            <th>Pago</th>
                            <th>Fecha</th>
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
include "./views/footer.php"; ?>
<script src="js/rptGeneralProyectos.js?v=4"></script>

