var tblSeguros = "";
window.onload = () => {
    $(".loader").fadeIn("fast");
    adm_catalogo_seguro.inicializarDatatable().then(() => {
        adm_catalogo_seguro.obtener().then(() => {
            $(".loader").fadeOut("fast");
        })
    })
}

const adm_catalogo_seguro = {
    contador: 0,

    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarCatalogoSeguro",
                params: {
                    accion: "obtenerByTable",
                }
            }).then((marcas) => {
                this.construirTable(marcas).then(resolve)
            })
        })
    },

    construirTable(data) {
        return new Promise(resolve => {
            tblSeguros.clear();
            tblSeguros.clear().draw();
            if (data.mensaje !== "NO_DATOS") {
                data.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblSeguros.clear();
            }
            tblSeguros.columns.adjust().draw();
            resolve();
        })
    },
    editar(id) {
        window.location.href = "?module=planilla&page=catalogo_seguro&id="+ btoa(id)
    },
    eliminar(id){
        Swal.fire({
            title: 'Estas seguro de eliminar este registro?',
            text: "Esta accion no se podrá revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo: "planilla",
                    archivo: "procesarCatalogoSeguro",
                    datos: {
                        id: id,
                        accion: "eliminar"
                    }
                }).then((respuesta) => {
                    if (respuesta.mensaje === "EXITO") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Registro eliminado Exitosamente',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    } else {
                        mensajesAlertas(respuesta)
                    }
                })
            }
        })
    },
    addRowTable({id, nombre, porcentajePatronal, porcentajeTrabajador, techoMaximo}) {
        tblSeguros.row.add([
            this.contador,
            nombre,
            porcentajePatronal+"%", porcentajeTrabajador+"%", "$"+techoMaximo,
            "<button class='btn btn-outline-success btn-sm' type='button' title='Editar' onclick=' adm_catalogo_seguro.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> "+
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' adm_catalogo_seguro.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblSeguros").length > 0) {
                    tblSeguros = $("#tblSeguros").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 350,
                        order: [0, "asc"],
                        sortable: true
                    });
                }
                resolve();
            } catch (err) {
                reject(err.message);
            }
        })
    }
}
