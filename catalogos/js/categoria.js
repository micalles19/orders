window.onload = () => {

    if (categoria.id.value.trim() != 0) {
        categoria.obtener().then(() => {

        }).catch(generalMostrarError);
    }
}

const categoria = {
    id: document.getElementById("hdnId"),
    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo:"catalogos",
                archivo: "procesarCategorias",
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
    validar(){
        if (this.id.value >0 ){
            this.actualizar();
        }else{
            this.guardar();
        }
    },
    guardar() {
        fetchActions.set({
            modulo:"catalogos",
            archivo: "procesarCategorias",
            datos: {
                accion: "guardar",
                nombre: document.getElementById("txtNombre").value.trim(),
                descripcion: document.getElementById("txtDescripcion").value.trim(),
                estado: document.getElementById("cboEstado").value,
            }
        }).then(mensajesAlertas)
    },
    actualizar() {
        fetchActions.set({
            modulo:"catalogos",
            archivo: "procesarCategorias",
            datos: {
                accion: "actualizar",
                id: this.id.value.trim(),
                nombre: document.getElementById("txtNombre").value.trim(),
                descripcion: document.getElementById("txtDescripcion").value.trim(),
                estado: document.getElementById("cboEstado").value,
            }
        }).then(mensajesAlertas)
    },
    construirFormulario(datos) {
        return new Promise((resolve, reject) => {
            document.getElementById("txtNombre").value = datos[0].nombre
            document.getElementById("txtDescripcion").value = datos[0].descripcion
            document.getElementById("cboEstado").value = datos[0].estado
            resolve();
        })
    }
}