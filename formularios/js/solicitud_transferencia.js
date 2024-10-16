window.onload = () => {
    $(".loader").fadeIn("fast");
    solicitud_transferencia.obtenerBancos().then(() => {
        solicitud_transferencia.obtenerTiposCuentas().then(() => {
            solicitud_transferencia.obtenerTipoTransferencia().then(() => {
                solicitud_transferencia.obtenerCuentas().then(() => {
                    $(".loader").fadeOut("fast");
                })
            })
        })
    })
}
const solicitud_transferencia = {
    obtenerBancos() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarCatalogoBancos",
                params: {
                    accion: "obtenerByCbo",
                }
            }).then((respuesta) => {
                generales.construirCbo("cboBancoDestino", respuesta).then(resolve)
            })
        })
    },
    obtenerTiposCuentas() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "formularios",
                archivo: "procesarCuentasBanco",
                params: {
                    accion: "obtenerTiposCuentasByCbo",
                }
            }).then((respuesta) => {
                generales.construirCbo("cboTipoCuenta", respuesta).then(resolve)
            })
        })
    },
    obtenerTipoTransferencia() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "formularios",
                archivo: "procesarSolicitudesTransferencias",
                params: {
                    accion: "obtenerTiposTransferenciasByCbo",
                }
            }).then((respuesta) => {
                generales.construirCbo("cboTipoTransferencia", respuesta).then(resolve)
            })
        })
    },
    obtenerCuentas() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "formularios",
                archivo: "procesarCuentasBanco",
                params: {
                    accion: "obtenerByCbo",
                }
            }).then((respuesta) => {
                generales.construirCbo("cboCuentaDebitar", respuesta).then(resolve)
            })
        })
    },
    mostrarTransInternacional(id){
        console.log(id);
        if (id ==1){
            $("#divInternacional").fadeOut("fast")
        }else{
            $("#divInternacional").fadeIn("fast")
        }
    }
}