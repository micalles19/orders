window.onload = () => {
    $(".loader").fadeIn("fast");
    if (catalogo_afp.id.value > 0) {
        catalogo_afp.obtener().then(() => {
            $(".loader").fadeOut("fast");
        })
    }
    $(".loader").fadeOut("fast");
}

const catalogo_afp = {
    id: document.getElementById("hdnId"),
    nombre: document.getElementById("txtNombre"),
    descripcion: document.getElementById("txtDescripcion"),
    porcentajePatronal : document.getElementById("txrPorcentajePatronal"),
    porcentajeTrabajador: document.getElementById("txtPorcentajeTrabajador"),
    techoMaximo: document.getElementById("txtTechoMaximo"),
    obtener() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarCatalogoAfp",
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
                modulo: "planilla",
                archivo: "procesarCatalogoAfp",
                datos: {
                    accion: "guardar",
                    nombre: this.nombre.value.trim(),
                    descripcion: this.descripcion.value.trim(),
                    porcentajePatronal: this.porcentajePatronal.value.trim(),
                    porcentajeTrabajador: this.porcentajeTrabajador.value.trim(),
                    techoMaximo: this.techoMaximo.value.trim(),
                }
            }).then(resolve)
        })

    },
    actualizar() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "planilla",
                archivo: "procesarCatalogoAfp",
                datos: {
                    accion: "actualizar",
                    id: this.id.value.trim(),
                    nombre: this.nombre.value.trim(),
                    descripcion: this.descripcion.value.trim(),
                    porcentajePatronal: this.porcentajePatronal.value.trim(),
                    porcentajeTrabajador: this.porcentajeTrabajador.value.trim(),
                    techoMaximo: this.techoMaximo.value.trim(),
                }
            }).then(resolve)
        })

    },
    construirFormulario(datos) {
        return new Promise(resolve => {
            this.nombre.value = datos[0].nombre
            this.descripcion.value = datos[0].descripcion
            this.porcentajePatronal.value = datos[0].porcentajePatronal
            this.porcentajeTrabajador.value = datos[0].porcentajeTrabajador
            this.techoMaximo.value = datos[0].techoMaximo
            resolve();
        })
    }
}