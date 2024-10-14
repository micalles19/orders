window.onload = () => {
    $(".loader").fadeIn("fast");
    generales.obtenerEmpresas("cboEmpresa").then(()=>{
        cuentas_banco.obtenerBancos().then(() => {
            cuentas_banco.obtenerTiposCuentas().then(() => {
                if (cuentas_banco.id.value.trim() > 0){
                    cuentas_banco.obtenerById().then(()=>{
                        $(".loader").fadeOut("fast");
                    })
                }
                $(".loader").fadeOut("fast");
            })
        })
    })
}


const cuentas_banco = {
    id: document.getElementById("hdnId"),
    idEmpresa: document.getElementById("cboEmpresa"),
    idBanco: document.getElementById("cboBancos"),
    numeroCuenta: document.getElementById("txtNumeroCuenta"),
    idTipoCuenta: document.getElementById("cboTipoCuenta"),

    obtenerBancos() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarCatalogoBancos",
                params: {
                    accion: "obtenerByCbo",
                }
            }).then((respuesta) => {
                generales.construirCbo("cboBancos", respuesta).then(resolve)
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
                archivo: "procesarCuentasBanco",
                datos: {
                    accion: "guardar",
                    idEmpresa: this.idEmpresa.value.trim(),
                    idBanco: this.idBanco.value.trim(),
                    numeroCuenta: this.numeroCuenta.value.trim(),
                    idTipoCuenta: this.idTipoCuenta.value.trim()
                }
            }).then(resolve)
        })

    },
    actualizar() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "formularios",
                archivo: "procesarCuentasBanco",
                datos: {
                    accion: "actualizar",
                    id: this.id.value.trim(),
                    idEmpresa: this.idEmpresa.value.trim(),
                    idBanco: this.idBanco.value.trim(),
                    numeroCuenta: this.numeroCuenta.value.trim(),
                    idTipoCuenta: this.idTipoCuenta.value.trim()
                }
            }).then(resolve)
        })

    },
    obtenerById(){
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "formularios",
                archivo: "procesarCuentasBanco",
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
                this.idBanco.value = dato.idBanco;
                this.numeroCuenta.value = dato.numeroCuenta;
                this.idTipoCuenta.value = dato.idTipoCuenta;
            })
            resolve();
        })
    }
}