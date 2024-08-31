var tblMarcas = "";
window.onload = () => {

    administrarMarcas.inicializarDatatable().then(() => {
        administrarMarcas.obtenerCatalogos().then(() => {

        })
    })

}

const administrarMarcas = {
    contador: 0,

    obtenerCatalogos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "marcas",
                archivo: "procesarMarcas",
                params: {
                    accion: "obtenerByTable",
                }
            }).then((marcas) => {
                this.construirTable(marcas).then(resolve)
            })
        })
    },

    construirTable(clientes) {
        return new Promise((resolve, reject) => {
            tblMarcas.clear();
            tblMarcas.clear().draw();
            if (clientes.mensaje !== "NO_DATOS") {
                clientes.datos.forEach(cliente => {
                    this.contador++;
                    this.addRowTable(cliente);
                })
            } else {
                this.contador = 0;
                tblMarcas.clear();
            }
            tblMarcas.columns.adjust().draw();
            resolve();
        })
    },
    editar(idCatalogo) {
        window.location.href = "?module=marcas&page=marca&id="+ btoa(idCatalogo)
    },
    eliminar(id){
        Swal.fire({
            title: 'Estas seguro de eliminar esta marca?',
            text: "Esta accion no se podrá revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo: "marcas",
                    archivo: "procesarMarcas",
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
        tblMarcas.row.add([
            this.contador,
            nombre,
            descripcion,
            estadoFinal,
            "<button class='btn btn-outline-success btn-sm' type='button' title='Editar' onclick=' administrarMarcas.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> "+
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' administrarMarcas.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblMarcas").length > 0) {
                    tblMarcas = $("#tblMarcas").DataTable({
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
