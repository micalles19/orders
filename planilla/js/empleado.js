window.onload = () => {
    $(".loader").fadeIn("fast");
    generales.obtenerTiposDocumentoIdentidad("cboTipoDocumento").then(() => {
        empleado.obtenerTipoEmpleado().then(() => {
            empleado.obtenerCargoEmpleado().then(() => {
                empleado.obtenerEmpresa().then(() => {
                    empleado.obtenerMotivoBaja().then(() => {
                        empleado.obtenerAFP().then(()=>{
                            empleado.obtenerSeguro().then(()=>{
                                $(".loader").fadeOut("fast");
                            })
                        })
                    })
                })
            })
        })
    })
}

const empleado = {
    obtenerTipoEmpleado() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarTipoEmpleado",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboTipoEmpleado", respuesta).then(resolve)
            })
        })
    },
    obtenerCargoEmpleado() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarCargosEmpleado",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboCargo", respuesta).then(resolve)
            })
        })
    },
    obtenerEmpresa() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarEmpresa",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboEmpresa", respuesta).then(resolve)
            })
        })
    },
    obtenerMotivoBaja() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarMotivoBajas",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboMotivoBaja", respuesta).then(resolve)
            })
        })
    },
    obtenerAFP() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarCatalogoAfp",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboAfp", respuesta).then(resolve)
            })
        })
    },
    obtenerSeguro() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarCatalogoSeguro",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboSeguro", respuesta).then(resolve)
            })
        })
    },
}