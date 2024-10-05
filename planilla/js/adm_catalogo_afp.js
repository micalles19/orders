var tblAfp = "";
window.onload = () => {
    $(".loader").fadeIn("fast");
    adm_catalogo_afp.inicializarDatatable().then(() => {
        adm_catalogo_afp.obtener().then(() => {
            $(".loader").fadeOut("fast");
        })
    })

}

const adm_catalogo_afp = {
    contador: 0,

    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarCatalogoAfp",
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
            tblAfp.clear();
            tblAfp.clear().draw();
            if (data.mensaje !== "NO_DATOS") {
                data.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblAfp.clear();
            }
            tblAfp.columns.adjust().draw();
            resolve();
        })
    },
    editar(id) {
        window.location.href = "?module=planilla&page=catalogo_afp&id="+ btoa(id)
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
                    archivo: "procesarCatalogoAfp",
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
        tblAfp.row.add([
            this.contador,
            nombre,
            porcentajePatronal, porcentajeTrabajador, techoMaximo,
            "<button class='btn btn-outline-success btn-sm' type='button' title='Editar' onclick=' adm_catalogo_afp.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> "+
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' adm_catalogo_afp.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblAfp").length > 0) {
                    tblAfp = $("#tblAfp").DataTable({
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
