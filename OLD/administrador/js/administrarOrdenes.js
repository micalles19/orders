var tblAdmOrdenes = "";
window.onload = () => {

    administrarOrdenes.inicializarDatatable().then(() => {
        administrarOrdenes.obtenerOrdenes().then(() => {

        })
    })

}

const administrarOrdenes = {
    contador: 0,

    obtenerOrdenes() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarOrdenes",
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
            tblAdmOrdenes.clear();
            tblAdmOrdenes.clear().draw();
            if (objRespuesta.mensaje !== "NO_DATOS") {
                objRespuesta.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblAdmOrdenes.clear();
            }
            tblAdmOrdenes.columns.adjust().draw();
            resolve();
        })
    },
    verDetalle(id) {
        let orden = btoa(id);
        window.location.href = "?page=detalle_orden&id=" + orden;
    },
    addRowTable({
                    numeroOrden,
                    nombreCliente,
                    telefonoPrincipal,
                    idEstadoOrden,
                    estadoOrden,
                    tipoComprobante,
                    fechaRecibida
                }) {
        let classEstado = idEstadoOrden === 1 ? 'bg-info-subtle' : (idEstadoOrden === 2 ? 'bg-success-subtle' : (idEstadoOrden === 3 ? 'bg-success-subtle' : 'bg-danger-subtle'))
        tblAdmOrdenes.row.add([
            numeroOrden,
            nombreCliente,
            telefonoPrincipal,
            "<div align='center' class='"+classEstado+" rounded-pill '  style='width: 95px; height: 26px; align-content: center!important;'> "+estadoOrden+"</div>" ,
            tipoComprobante,
            fechaRecibida,

            "<button class='btn btn-outline-info btn-sm' type='button' data-toggle='ver orden' title='ver orden' onclick=' administrarOrdenes.verDetalle(" + numeroOrden + ");'>" +
            "<span class='fas fa-eye'></span>" +
            "</button> " +
            "</button> " +
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' administrarOrdenes.eliminar(" + numeroOrden + ");'>" +
            "<i class='fas fa-trash'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },

    eliminar(id) {
        Swal.fire({
            title: 'Estas seguro?',
            text: "Al eliminar este producto, no podras revertirlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    archivo: "procesarProductos",
                    datos: {
                        id: id,
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
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblAdmOrdenes").length > 0) {
                    tblAdmOrdenes = $("#tblAdmOrdenes").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 350,
                        order: [0, "desc"],
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
