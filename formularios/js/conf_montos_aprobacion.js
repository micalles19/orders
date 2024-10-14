window.onload = () => {
    $(".loader").fadeIn("fast");
    conf_montos_aprobacion.obtenerCuentas().then(()=>{
        conf_montos_aprobacion.obtenerUsuarios().then(()=>{
            if (conf_montos_aprobacion.id.value.trim() >0){
                conf_montos_aprobacion.obtenerById().then(()=>{
                    $(".loader").fadeOut("fast");
                })
            }
            $(".loader").fadeOut("fast");
        })
    })
}

const conf_montos_aprobacion = {
    id: document.getElementById("hdnId"),
    idUsuario :document.getElementById("cboUsuario"),
    idCuenta : document.getElementById("cboCuenta"),
    montoDesde : document.getElementById("txtMontoDesde"),
    montoHasta :document.getElementById("txtMontoHasta"),
    estado: document.getElementById("cboEstado"),

    obtenerCuentas() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "formularios",
                archivo: "procesarCuentasBanco",
                params: {
                    accion: "obtenerByCbo",
                }
            }).then((respuesta) => {
                generales.construirCbo("cboCuenta", respuesta).then(resolve)
            })
        })
    },
    obtenerUsuarios(){
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarUsuario",
                params: {
                    accion: "obtenerByCbo",
                }
            }).then((respuesta) => {
                generales.construirCbo("cboUsuario", respuesta).then(resolve)
            })
        })
    },
    validar(clase) {
        $(".loader").fadeIn("fast");
        if (validar.InputTextsConClase(clase)) {
            if (this.id.value > 0) {
                this.actualizar().then((respuesta) => {
                    $(".loader").fadeOut("fast");
                    mensajesAlertas(respuesta)
                });
            } else {
                this.guardar().then((respuesta) => {
                    $(".loader").fadeOut("fast");
                    mensajesAlertas(respuesta)
                })
            }
        } else {
            $(".loader").fadeOut("fast");
        }
    },
    guardar() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "formularios",
                archivo: "procesarConfMontosAprobacion",
                datos: {
                    accion: "guardar",
                    idCuenta: this.idCuenta.value.trim(),
                    idUsuario: this.idUsuario.value.trim(),
                    montoDesde: this.montoDesde.value.trim(),
                    montoHasta: this.montoHasta.value.trim(),
                    estado: this.estado.value.trim()
                }
            }).then(resolve)
        })
    },

    obtenerById(){
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "formularios",
                archivo: "procesarConfMontosAprobacion",
                params: {
                    accion: "obtenerById",
                    id: this.id.value.trim()
                }
            }).then((respuesta) => {
                if (respuesta.mensaje === "EXITO") {
                    this.construirFormulario(respuesta.datos).then(resolve)
                } else{
                    resolve(respuesta);
                }
            })
        })
    },
    construirFormulario(respuesta) {
        return new Promise(resolve => {
            respuesta.forEach(dato=>{
                this.idCuenta.value = dato.idCuentaBanco;
                this.idUsuario.value = dato.idUsuarioAutorizado;
                this.montoDesde.value = dato.montoDesde;
                this.montoHasta.value = dato.montoHasta;
                this.estado.value = dato.estado;
            })
            resolve();
        })
    },
    actualizar() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "formularios",
                archivo: "procesarConfMontosAprobacion",
                datos: {
                    accion: "actualizar",
                    id: this.id.value.trim(),
                    idCuenta: this.idCuenta.value.trim(),
                    idUsuario: this.idUsuario.value.trim(),
                    montoDesde: this.montoDesde.value.trim(),
                    montoHasta: this.montoHasta.value.trim(),
                    estado: this.estado.value.trim()
                }
            }).then(resolve)
        })

    },
}