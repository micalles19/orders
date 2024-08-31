var tblAdmCategorias = "";
window.onload = () => {

    administrarSubCategorias.inicializarDatatable().then(() => {
        administrarSubCategorias.obtenerCatalogos().then(() => {

        })
    })

}

const administrarSubCategorias = {
    contador: 0,

    obtenerCatalogos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo:"catalogos",
                archivo: "procesarSubCategorias",
                params: {
                    accion: "obtenerByTable",
                }
            }).then((objRespuesta) => {
                this.construirTable(objRespuesta).then(resolve)
            })
        })
    },

    construirTable(objRespuesta) {
        return new Promise((resolve, reject) => {
            tblAdmCategorias.clear();
            tblAdmCategorias.clear().draw();
            if (objRespuesta.mensaje !== "NO_DATOS") {
                objRespuesta.datos.forEach(cliente => {
                    this.contador++;
                    this.addRowTable(cliente);
                })
            } else {
                this.contador = 0;
                tblAdmCategorias.clear();
            }
            tblAdmCategorias.columns.adjust().draw();
            resolve();
        })
    },
    editar(id) {
        window.location.href = "?module=catalogos&page=sub_categoria&id=" +btoa(id)
    },
    eliminar(id){
        Swal.fire({
            title: 'Estas seguro de eliminar esta categoria?',
            text: "Esta accion no se podrá revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo:"catalogos",
                    archivo: "procesarSubCategorias",
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
    addRowTable({id, nombre, descripcion, estado}) {
        let estadoFinal = estado === "A" ? "ACTIVO" : "INACTIVO";
        tblAdmCategorias.row.add([
            this.contador,
            nombre,
            descripcion,
            estadoFinal,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Editar' onclick=' administrarSubCategorias.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> "+
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' administrarSubCategorias.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblAdmCategorias").length > 0) {
                    tblAdmCategorias = $("#tblAdmCategorias").DataTable({
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
