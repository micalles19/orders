var tblDetalleProductos = "";
window.onload = () => {

    detalleOrden.inicializarDatatable().then(() => {
        detalleOrden.obtenerDatosOrden().then(() => {
            detalleOrden.iva = detalleOrden.subTotal * 0.13;
            detalleOrden.total = detalleOrden.iva + detalleOrden.subTotal;
            document.getElementById("spnSubTotal").innerHTML = detalleOrden.subTotal.toFixed(2);
            document.getElementById("spnIVa").innerHTML = detalleOrden.iva.toFixed(2);
            document.getElementById("spnTotal").innerHTML = detalleOrden.total.toFixed(2);
            // document.getElementById("totalOrden").innerHTML = detalleOrden.total.toFixed(2);
        })
    })

}
const detalleOrden = {
    id: document.getElementById("txtId"),
    total: 0,
    subTotal : 0,
    iva :0,

    obtenerDatosOrden() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarOrdenes",
                params: {
                    accion: "obtenerDatosOrdenById",
                    id: this.id.value.trim()
                }
            }).then((respuesta) => {
                this.construirOrden(respuesta).then(resolve)
            })
        })
    },

    construirOrden(orden) {
        return new Promise((resolve, reject) => {
            if (orden.mensaje === "EXIT0") {
                console.log("llego aca" + orden.datosOrden[0].nombreCliente)
                document.getElementById("txtNombreCliente").value = orden.datosOrden[0].nombreCliente
                document.getElementById("txtNombreTienda").value = orden.datosOrden[0].nombreTienda
                document.getElementById("txtDui").value = orden.datosOrden[0].dui
                document.getElementById("txtNIT").value = orden.datosOrden[0].nit
                document.getElementById("txtIVA").value = orden.datosOrden[0].iva
                document.getElementById("txtNumeroContacto").value = orden.datosOrden[0].telefonoPrincipal
                document.getElementById("txtEmail").value = orden.datosOrden[0].coreoCliente
                document.getElementById("txtDepartamento").value = orden.datosOrden[0].departamento
                document.getElementById("txtMunicipio").value = orden.datosOrden[0].municipio
                document.getElementById("txtDistrito").value = orden.datosOrden[0].distrito
                document.getElementById("txtEstadoOrden").value = orden.datosOrden[0].estadoOrden
                document.getElementById("txtTipoFactura").value = orden.datosOrden[0].tipoComprobante
                document.getElementById("txtDireccion").value = orden.datosOrden[0].direccion
                document.getElementById("txtFechaRecibido").value = orden.datosOrden[0].fechaRecibida
                document.getElementById("txtFechaDespachada").value = orden.datosOrden[0].fechaDespacho
                document.getElementById("txtFechaCanclada").value = orden.datosOrden[0].fechaCancela

                this.construirTable(orden.detalleOrden).then(() => {
                    // document.getElementById("spnTotalOrden").innerText = this.totalOrden.toFixed(2);
                    resolve();
                })
                switch (orden.datosOrden[0].idEstadoOrden) {
                    case 1:
                        document.getElementById("btnEntregar").style.display = "none";
                        break;
                    case 2:
                        $("#btnEntregar").fadeIn("fast");
                        document.getElementById("btnDespachar").style.display = "none";
                        break;
                    case 3:
                        document.getElementById("btnEntregar").style.display = "none";
                        document.getElementById("btnDespachar").style.display = "none";
                        document.getElementById("btnCancelar").style.display = "none";
                        break;
                    case 4:
                        document.getElementById("btnEntregar").style.display = "none";
                        document.getElementById("btnDespachar").style.display = "none";
                        document.getElementById("btnCancelar").style.display = "none";
                        document.getElementById("btnEliminar").style.display = "none";
                        break;
                }
            } else {
                generalMostrarError("NO_DATOS");
            }
        })
    },
    despacharOrden() {
        fetchActions.set({
            archivo: "procesarOrdenes",
            datos: {
                accion: "despacharOrden",
                estadoOrden: 2,
                id: this.id.value.trim()
            }
        }).then((respuesta) => {
            if (respuesta.mensaje === "EXITO") {
                Swal.fire({
                    position: 'center', // Esto centra el mensaje en el medio de la pantalla
                    icon: 'success',
                    title: 'La orden se ha despachado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                })
            } else {
                generalMostrarError(respuesta)
            }
        })
    },
    entregarOrden() {
        fetchActions.set({
            archivo: "procesarOrdenes",
            datos: {
                accion: "entregarOrden",
                estadoOrden: 3,
                id: this.id.value.trim()
            }
        }).then((respuesta) => {
            if (respuesta.mensaje === "EXITO") {
                Swal.fire({
                    position: 'center', // Esto centra el mensaje en el medio de la pantalla
                    icon: 'success',
                    title: 'La orden se ha entregado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                })
            } else {
                generalMostrarError(respuesta)
            }
        })
    },
    cancelarOrden() {
        fetchActions.set({
            archivo: "procesarOrdenes",
            datos: {
                accion: "cancelarOrden",
                estadoOrden: 4,
                id: this.id.value.trim()
            }
        }).then((respuesta) => {
            if (respuesta.mensaje === "EXITO") {
                Swal.fire({
                    position: 'center', // Esto centra el mensaje en el medio de la pantalla
                    icon: 'success',
                    title: 'La orden se ha cancelado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                })
            } else {
                generalMostrarError(respuesta)
            }
        })
    },
    descargarPDF() {
        fetchActions.get({
            archivo: "procesarPDF",
            params: {
                accion: "generarPDF",
                idOrden: this.id.value.trim()
            }
        }).then((respuesta) => {
            var pdfUrl = "./../pdf/" + respuesta + ".pdf";
            window.open(pdfUrl, '_blank');
        })
    },

    construirTable(objRespuesta) {
        return new Promise((resolve, reject) => {
            tblDetalleProductos.clear();
            tblDetalleProductos.clear().draw();
            if (objRespuesta.mensaje !== "NO_DATOS") {
                objRespuesta.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblDetalleProductos.clear();
            }
            tblDetalleProductos.columns.adjust().draw();
            resolve();
        })
    },
    addRowTable({
                    idDetalle,
                    codigoProducto,
                    imagen,
                    nombreProducto,
                    unidadesBulto,
                    precioUnidad,
                    precioTotal
                }) {
        this.subTotal += parseFloat(precioTotal);
        tblDetalleProductos.row.add([
            codigoProducto,
            "<img className='float-left' src='./../images/thumbnails/" + imagen + "' height='65px' width='65px'>",
            nombreProducto,
            unidadesBulto,
            "$ " + precioUnidad,
            "$ " + precioTotal,
            "<button class='btn btn-danger btn-sm' type='button' title='Eliminar' onclick=' detalleOrden.eliminar(" + idDetalle + ");'>" +
            "<i class='fas fa-trash'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblDetalleProductos").length > 0) {
                    tblDetalleProductos = $("#tblDetalleProductos").DataTable({
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
