<?php
$image = __DIR__ . '/../../assets/img/not-found.svg';
?>
<div class="container">

    <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>404</h1>
        <h2>Lo sentimos, pero no encontramos el recurso</h2>
        <a class="btn" href="#">Regresar al inicio</a>
        <img src="<?= $image ?>" class="img-fluid py-5" alt="Page Not Found">
        <div class="credits">
        </div>
    </section>

</div>
<?php
// include './general/views/footer.php';
?>