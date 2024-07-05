window.onload = () => {

    if (catalogo.id.value.trim() >0 ) {
        catalogo.obtener().then(() => {

        })
    }
}

const catalogo = {
    id: document.getElementById("hdnId"),
    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo:"catalogos",
                archivo: "procesarCatalogos",
                params: {
                    accion: "obtenerCatalogoById",
                    id: this.id.value.trim()
                }
            }).then((respuesta) => {
                if (respuesta.mensaje === "EXITO") {
                    this.construirFormularioCatalogo(respuesta.datos).then(resolve).catch(respuesta)
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
            archivo: "procesarCatalogos",
            datos: {
                accion: "guardarCatalogo",
                nombre: document.getElementById("txtNombreCatalogo").value.trim(),
                descripcion: document.getElementById("txtDescripcion").value.trim(),
                estado: document.getElementById("cboEstado").value
            }
        }).then(mensajesAlertas)
    },
    actualizar() {
        fetchActions.set({
            modulo:"catalogos",
            archivo: "procesarCatalogos",
            datos: {
                accion: "actualizarCatalogo",
                id: this.id.value.trim(),
                nombre: document.getElementById("txtNombreCatalogo").value.trim(),
                descripcion: document.getElementById("txtDescripcion").value.trim(),
                estado: document.getElementById("cboEstado").value
            }
        }).then(mensajesAlertas)
    },
    construirFormularioCatalogo(datos) {
        return new Promise((resolve, reject) => {
            document.getElementById("txtNombreCatalogo").value = datos[0].nombre
            document.getElementById("txtDescripcion").value = datos[0].descripcion
            document.getElementById("cboEstado").value = datos[0].estado
            resolve();
        })
    },
}