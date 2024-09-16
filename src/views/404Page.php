<div class="d-flex flex-column flex-center flex-column-fluid">
    <div class="d-flex flex-column flex-center text-center p-10">
        <div class="card card-flush w-lg-650px py-5">
            <div class="card-body py-15 py-lg-20">

                <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>

                <div class="fw-semibold fs-6 text-gray-500 mb-7">No encontramos el recurso solicitado.</div>

                <div class="mb-3">
                    <img src="src/assets/img/auth/404-error.png" class="mw-100 mh-300px theme-light-show" alt="" />
                    <img src="src/assets/img/auth/404-error-dark.png" class="mw-100 mh-300px theme-dark-show" alt="" />
                </div>

                <div class="mb-0">
                    <a href="./" class="btn btn-sm btn-primary">Regresar a inicio</a>
                </div>

            </div>
        </div>

    </div>

</div>

<script type="text/javascript">
    window.onload = function() {
        const loader = document.querySelector('.loader-container');

        loader && loader.classList.add('d-none');
    }
</script>