<?php ?>

<div class="modal fade" id="mdlAsignarCatalogo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Asignar Catálogo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">

                        <input type="hidden" id="hdnIdCliente" value="">
                        <div class="col-md-4">
                            <label for="cboCatalogos" class="form-label">Catálogos</label>
                            <select class="form-select" id="cboCatalogos">
                                <option value="" disable>Seleccione</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="dtpFechaInicio" class="form-label">Fecha inicio</label>
                            <input class="form-control" type="date" value=""
                                   id="dtpFechaInicio" required>
                        </div>
                        <div class="col-md-4">
                            <label for="dtpFechaFin" class="form-label">Fecha Fin</label>
                            <input class="form-control" type="date" value=""
                                   id="dtpFechaFin" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnAsignarCatalogo" onclick="clientes.agregarCatalogo()" class="btn btn-primary">Asignar Catálogo</button>
                <button type="button" id="btnEditarCatalogo" style="display: none" onclick="clientes.actualizarCatalogo()" class="btn btn-primary">Actualizar Catálogo</button>
            </div>
        </div>
    </div>
</div>
