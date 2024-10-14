window.onload = () => {
    $(".loader").fadeIn("fast");
    if (catalogo_bancos.id.value > 0) {
        catalogo_bancos.obtener().then(() => {
            $(".loader").fadeOut("fast");
        }).catch(generalMostrarError);
    }
    $(".loader").fadeOut("fast");
}

const catalogo_bancos = {
    id: document.getElementById("hdnId"),
    nombre: document.getElementById("txtNombre"),
    descripcion: document.getElementById("txtDescripcion"),
    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarCatalogoBancos",
                params: {
                    accion: "obtenerById",
                    id: this.id.value.trim()
                }
            }).then((respuesta) => {
                if (respuesta.mensaje === "EXITO") {
                    this.construirFormulario(respuesta.datos).then(resolve).catch(respuesta)
                } else {
                    reject(respuesta)
                }
            })
        })
    },
    validar(clase) {
        $(".loader").fadeIn("fast");
        if (validar.InputTextsConClase(clase)){
            if (this.id.value > 0) {
                this.actualizar().then((respuesta)=>{
                    $(".loader").fadeOut("fast");
                    mensajesAlertas(respuesta)
                });
            } else {
                this.guardar().then((respuesta)=>{
                    $(".loader").fadeOut("fast");
                    mensajesAlertas(respuesta)
                })
            }
        }else{
            $(".loader").fadeOut("fast");
        }

    },
    guardar() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarCatalogoBancos",
                datos: {
                    accion: "guardar",
                    nombre: this.nombre.value.trim(),
                    descripcion: this.descripcion.value.trim(),
                }
            }).then(resolve)
        })

    },
    actualizar() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarCatalogoBancos",
                datos: {
                    accion: "actualizar",
                    id: this.id.value.trim(),
                    nombre: this.nombre.value.trim(),
                    descripcion: this.descripcion.value.trim(),
                }
            }).then(resolve)
        })

    },
    construirFormulario(datos) {
        return new Promise((resolve, reject) => {
            this.nombre.value = datos[0].nombre
            this.descripcion.value = datos[0].descripcion
            resolve();
        })
    }
}