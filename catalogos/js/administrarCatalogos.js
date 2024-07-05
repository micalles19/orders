var tblAdmCatalogos = "";
window.onload = () => {

    administrarCatalogos.inicializarDatatable().then(() => {
        administrarCatalogos.obtenerCatalogos().then(() => {

        })
    })

}

const administrarCatalogos = {
    contador: 0,

    obtenerCatalogos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "catalogos",
                archivo: "procesarCatalogos",
                params: {
                    accion: "obtenerCatalogosByTable",
                }
            }).then((catalogos) => {
                this.construirTable(catalogos).then(resolve)
            })
        })
    },

    construirTable(clientes) {
        return new Promise((resolve, reject) => {
            tblAdmCatalogos.clear();
            tblAdmCatalogos.clear().draw();
            if (clientes.mensaje !== "NO_DATOS") {
                clientes.datos.forEach(cliente => {
                    this.contador++;
                    this.addRowTable(cliente);
                })
            } else {
                this.contador = 0;
                tblAdmCatalogos.clear();
            }
            tblAdmCatalogos.columns.adjust().draw();
            resolve();
        })
    },
    editar(idCatalogo) {
        window.location.href = "?module=catalogos&page=catalogo&id="+ btoa(idCatalogo)
    },
    eliminar(id){
        Swal.fire({
            title: 'Estas seguro de eliminar el catalogo?',
            text: "Esta accion no se podrá revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo: "catalogos",
                    archivo: "procesarCatalogos",
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
    addRowTable({id, nombre, estado,descripcion}) {
        let   estadoFinal = estado === "A" ? "ACTIVO" : "INACTIVO";
        tblAdmCatalogos.row.add([
            this.contador,
            nombre,
            descripcion,
            estadoFinal,
            "<button class='btn btn-outline-success btn-sm' type='button' title='Editar' onclick=' administrarCatalogos.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> "+
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' administrarCatalogos.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblAdmCatalogos").length > 0) {
                    tblAdmCatalogos = $("#tblAdmCatalogos").DataTable({
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
