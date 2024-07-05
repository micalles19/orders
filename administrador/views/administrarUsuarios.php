<div class="container-fluid">

    <div class="card">
        <div class="card-header" >
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="page-title-left">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Administrar Usuarios</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>

                <div class="page-title-right">
                    <a href="?page=registrarUsuario" class="btn btn-info btn-sm">Registrar Usuario
                    </a>
                </div>

            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="tblVerUsuarios" class="table table-striped nowrap w-100">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo Electronico</th>
                            <th>Bloqueado</th>
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
include "./views/footer.php"; ?>
<script src="js/verUsuarios.js?v=5"></script>

