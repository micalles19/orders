var tblVerClientes = "";
window.onload = () => {

    administrarClientes.inicializarDatatable().then(() => {
        administrarClientes.obtenerClientes().then(() => {

        })
    })

}

const administrarClientes = {
    contador: 0,

    obtenerClientes() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo:"clientes",
                archivo: "procesarClientes",
                params: {
                    accion: "obtenerClientesByTable"
                }
            }).then((clientes) => {
                this.construirTable(clientes).then(resolve).catch(reject);
            })
        })
    },
    editar(idCliente) {
        window.location.href = "?module=clientes&page=cliente&idCliente=" + btoa(idCliente);
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
                    modulo:"clientes",
                    archivo: "procesarClientes",
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
    construirTable(clientes) {
        return new Promise((resolve, reject) => {
            if (clientes.mensaje !== "NO_DATOS") {
                clientes.datos.forEach(cliente => {
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


    addRowTable({id, nombreCliente,tipoDocumento,numeroDocumento, telefono, correo, nombreActividad}) {
        tblVerClientes.row.add([
            nombreCliente,
            tipoDocumento,
            numeroDocumento,
            telefono,
            correo,
            nombreActividad,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Editar' onclick=' administrarClientes.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> " +
            "&nbsp;" +
            "<button class='btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' administrarClientes.eliminar(" + id + ");'>" +
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