<?php ?>
<div class="pagetitle">
    <h1>Administración Usuarios</h1>
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
                    <a id="agregarUsuarioBtn" href="?module=general&page=usuario" class="btn btn-outline-info btn-sm">Nuevo Usuario</a>
                </div>
                <table class="table table-striped" id="tblUsuarios">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Agencias Asignadas</th>
                        <th scope="col">Correo</th>
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
<script src="./general/js/adm_usuarios.js"></script>
