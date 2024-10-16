<?php
$id = isset($_GET["id"]) && $_GET["id"] != null ? base64_decode($_GET["id"]) : 0;
$nombre = $id != 0 ? "Editar" : "Registrar";
$modulo = isset($_GET["module"]) && $_GET["module"] != null ? $_GET["module"] : "general";
?>
<div class="pagetitle">
    <h1><?php echo $nombre ?> Solicitud de Transferencia</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Formularios </a></li>
            <li class="breadcrumb-item"><a href="#">Administrar Solicitud de transferencia</a></li>
            <li class="breadcrumb-item active"><?php echo $nombre ?> Solicitud de Transferencia</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<input type="hidden" id="hdnId" value="<?php echo $id ?>">


<div class="card" style="padding-top: 1%">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form name="frmCliente">
                <div class="row" style="padding-bottom: 15px; padding-top: 15px;">
                    <div class="col-md-4">
                        <label for="txtNombreAPagar" class="form-label">Pagar a favor de</label>
                        <input type="text" class="form-control validar" id="txtNombreAPagar">
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                    <div class="col-md-3">
                        <label for="txtMontoAPagar" class="form-label">Monto (USD)</label>
                        <input type="text" class="form-control validar" id="txtMontoAPagar" placeholder="0.00">
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                    <div class="col-md-5">
                        <label for="txtConcepto" class="form-label">Concepto</label>
                        <input type="text" class="form-control validar" id="txtConcepto">
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 15px;">
                    <div class="col-md-12">
                        <label for="txtConcepto" class="form-label">Describa el motivo de la transferencia o
                            actividad</label>
                        <textarea rows="2" id="txtDescripcionPago" class="form-control"></textarea>
                    </div>
                    <div class="invalid-feedback">Campo Requerido</div>
                </div>
                <div class="row" style="padding-bottom: 15px;">
                    <div class="col-md-3">
                        <label for="cboBancoDestino" class="form-label">Banco de Destino</label>
                        <select class="form-select validar" id="cboBancoDestino">
                            <option value="">Seleccione</option>
                        </select>
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                    <div class="col-md-3">
                        <label for="txtNumeroCuenta" class="form-label">Número de Cuenta</label>
                        <input type="text" class="form-control validar" id="txtNumeroCuenta">
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                    <div class="col-md-3">
                        <label for="cboTipoCuenta" class="form-label">Tipo de cuenta</label>
                        <select class="form-select validar" id="cboTipoCuenta">
                            <option value="">Seleccione</option>
                        </select>
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                    <div class="col-md-3">
                        <label for="cboTipoTransferencia" class="form-label">Tipo de Transferencia</label>
                        <select class="form-select validar" id="cboTipoTransferencia" onchange="solicitud_transferencia.mostrarTransInternacional(this.value)">
                            <option value="">Seleccione</option>
                        </select>
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>

                </div>
                <div class="row" style="padding-top: 3%; display: none" id="divInternacional">
                    <div class="row">
                        <p><strong>Datos de cuenta internacional a detallar</strong></p>
                        <hr>
                        <div class="col-md-3">
                            <label for="txtCuentaIntermediaria" class="form-label">Cuenta Intermediaria</label>
                            <input type="text" class="form-control validarInt" id="txtCuentaIntermediaria">
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                        <div class="col-md-3">
                            <label for="txtSWIFT" class="form-label">SWIFT</label>
                            <input type="text" class="form-control validarInt" id="txtSWIFT">
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                        <div class="col-md-6">
                            <label for="txtSWIFT" class="form-label">Banco intermediario</label>
                            <input type="text" class="form-control validarInt" id="txtSWIFT">
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px">
                        <div class="col-md-3">
                            <label for="txtIntermediarioAba" class="form-label">Intermediario ABA</label>
                            <input type="text" class="form-control validarInt" id="txtIntermediarioAba">
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                        <div class="col-md-3">
                            <label for="txtSwiftIntermediario" class="form-label">SWIFT intermediario</label>
                            <input type="text" class="form-control validarInt" id="txtSwiftIntermediario">
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                        <div class="col-md-6">
                            <label for="txtIntermediario" class="form-label">Intermediario</label>
                            <input type="text" class="form-control validarInt" id="txtIntermediario">
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px">
                        <div class="col-md-12">
                            <label for="txtDetalles" class="form-label">Detalles o Comentarios</label>
                            <textarea rows="2" id="txtDetalles" class="form-control"></textarea>
                        </div>
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>

                </div>
                <div class="row" style="padding-top: 25px;">
                    <div class="col-md-4">
                        <label for="txtNombreSolicita" class="form-label">Solicita</label>
                        <input type="text" class="form-control" id="txtNombreSolicita"
                               value="<?php echo $_SESSION['general']['usuario'][0]->nombre ?>" readonly>
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                    <div class="col-md-4">
                        <label for="txtAutoriza" class="form-label">Autoriza</label>
                        <input type="text" class="form-control" id="txtAutoriza" readonly>
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                    <div class="col-md-4">
                        <label for="cboEstadoTransaccion" class="form-label">Estado Transacción</label>
                        <select class="form-select validar" id="cboEstadoTransaccion">
                            <option value="1" selected disabled>Solicitado</option>
                        </select>
                        <div class="invalid-feedback">Campo Requerido</div>
                    </div>
                </div>
                <div class="row" style="padding-top:3.5%; margin-bottom: 15px;" id="divContabilidad">
                    <div class="row">

                        <p><strong>Espacio para contabilidad</strong></p>
                        <hr>
                        <div class="col-md-8">
                            <label for="cboCuentaDebitar" class="form-label">Cuenta a debitar</label>
                            <select class="form-select validar" id="cboCuentaDebitar">
                                <option value="1" selected disabled>Seleccione</option>
                            </select>
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                        <div class="col-md-4">
                            <label for="cboDocumentoRespaldo" class="form-label">Presentó Documentos Respaldo</label>
                            <select class="form-select validar" id="cboDocumentoRespaldo">
                                <option value="" selected disabled>Seleccione</option>
                                <option value="S">Si</option>
                                <option value="N">No</option>
                                <option value="P">Pendiente</option>
                            </select>
                            <div class="invalid-feedback">Campo Requerido</div>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 25px;">
                        <div class="col-md-12">
                            <label for="txtObservaciones" class="form-label">Observaciones</label>
                            <textarea rows="2" id="txtObservaciones" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer" align="center" style="padding-top: 1%">

        <button type="button" onclick="cuentas_banco.validar('validar');" class="btn btn-outline-dark">Guardar</button>
        <button type="button" onclick="generales.atras('formularios','adm_cuentas_banco')"
                class="btn btn-outline-danger">Cancelar
        </button>
    </div>
</div>


<?php include './general/views/footer.php'; ?>
<script src="./<?php echo $modulo ?>/js/solicitud_transferencia.js?version=2"></script>


