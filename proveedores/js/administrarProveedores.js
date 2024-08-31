var tblVerClientes = "";
window.onload = () => {

    administrarProveedores.inicializarDatatable().then(() => {
        administrarProveedores.obtenerClientes().then(() => {

        })
    })

}

const administrarProveedores = {
    contador: 0,

    obtenerClientes() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo:"proveedores",
                archivo: "procesarProveedor",
                params: {
                    accion: "obtenerByTable"
                }
            }).then((proveedores) => {
                this.construirTable(proveedores).then(resolve).catch(reject);
            })
        })
    },
    editar(idCliente) {
        window.location.href = "?module=proveedores&page=proveesor&id=" + btoa(idCliente);
    },
    eliminar(idCliente) {
        Swal.fire({
            title: 'Estás seguro de realizar esta acción?',
            text: "Eliminarás el cliente definitivamente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si Elimininar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo:"proveedores",
                    archivo: "procesarProveedor",
                    datos: {
                        id: idCliente,
                        accion: "eliminar"
                    }
                }).then((respuesta) => {
                    if (respuesta === "EXITO") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Registro eliminado Exitosamente',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    } else {
                        generalMostrarError(respuesta)
                    }
                })
            }
        })
    },
    construirTable(proveedores) {
        return new Promise((resolve, reject) => {
            if (proveedores.mensaje !== "NO_DATOS") {
                proveedores.datos.forEach(cliente => {
                    this.contador++;
                    this.addRowTable(cliente);
                })
            } else {
                this.contador = 0;
                tblVerClientes.clear();
            }
            tblVerClientes.columns.adjust().draw();
            resolve();
        })
    },


    addRowTable({id, nombre,tipoDocumento,numeroDocumento, telefono, correo, nombreActividad}) {
        tblVerClientes.row.add([
            nombre,
            tipoDocumento,
            numeroDocumento,
            telefono,
            correo,
            nombreActividad,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Editar' onclick=' administrarProveedores.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> " +
            "&nbsp;" +
            "<button class='btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' administrarProveedores.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button>"
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblVerClientes").length > 0) {
                    tblVerClientes = $("#tblVerClientes").DataTable({
                        dateFormat: 'uk',
                        scrollX: true,
                        fixedHeader: false,
                        scrollY: 360,
                        order: [0, "asc"],
                        sortable: true,
                    });
                }
                resolve();
            } catch (err) {
                reject(err.message);
            }
        })
    }
}