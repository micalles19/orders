<?php
?>
<div class="modal fade" id="mdlRenovarSesion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Autenticación Requerida<span id="spnPeriodo"></span> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" id="mdlConsumo">
                    <div class="col-md-12">
                        <label for="txtUsuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control validarLogin" id="txtUsuario">
                        <div class="invalid-feedback">Ingrese su usuario</div>
                    </div>
                    <div class="col-md-12" style="padding-top: 10px!important;">
                        <label for="txtClave" class="form-label">Contraseña</label>
                        <input type="text" class="form-control validarLogin" id="txtClave">
                        <div class="invalid-feedback">Ingrese su Contraseña</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="generales.()">Validar Sesión</button>
            </div>
        </div>
    </div>
</div>
</main>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>mcadev.com</span></strong>. All Rights Reserved
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>


<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script src="general/js/scripts_menu_active.js"></script>

<script src="assets/vendor/jquery/js/jquery-3.3.1.js"></script>
<script src="assets/vendor/datatables_new/datatables.js"></script>
<script src="general/js/scripts_generales.js?v=1"></script>
<script src="general/js/fetch_lib.js?v=1"></script>
<script src="assets/vendor/fontawesome/js/fontawesome.js"></script>
<script src="general/js/scripts_alertas.js?v=1"></script>

<!--librerias cargadas del exterior-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>


</body>

</html>