<?php ?>

<div class="modal fade" id="mdlReestablecerClave" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reestablecer Clave</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">

                        <input type="hidden" id="hdnIdCliente" value="">
                        <div class="col-md-6">
                            <label for="txtCorreoCliente" class="form-label">Correo cliente </label>
                            <input class="form-control" type="text" value=""
                                   id="txtCorreoCliente" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="txtNuevaClave" class="form-label">Nueva Clave</label>
                            <input class="form-control" type="text" value="" placeholder="Ingrese Nueva Clave"
                                   id="txtNuevaClave" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="administrarClientes.actualizarClave()" class="btn btn-primary">Actualizar Clave</button>
            </div>
        </div>
    </div>
</div>
