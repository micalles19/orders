var tblRptrptProyectos = "";
window.onload = () => {
    rptProyectos.inicializarDatatable().then(() => {
        rptProyectos.obtenerProyectos().then(() => {

        })
    })

}
const rptProyectos = {
    contador: 0,
    dtpDesde: document.getElementById("dtpDesde"),
    dtpFin: document.getElementById("dtpHasta"),
    cboEstadoPago: document.getElementById("cboEstadoPago"),
    datos: [],
    obtenerProyectos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarProyecto",
                params: {
                    accion: "obtenerProyectosByReport"
                }
            }).then((clientes) => {
                this.construirTable(clientes).then(resolve).catch(reject);
            })
        })
    },

    validateDtpBuscar() {
        if (this.dtpDesde.value.trim().length > 0 || this.dtpFin.value.trim().length > 0) {
            this.obtenerProyectosByDates().then();
        } else {
            generalMostrarError("COMPLETAR_FECHAS");
        }
    },
    exportarExcel() {
        if (Object.keys(this.datos).length !== 0) {
            fetchActions.set({
                archivo: "rptGeneral",
                datos: {
                    datos: this.datos
                }
            }).then((respuesta) => {
                if (respuesta !=""){
                    var downloadLink = document.createElement('a');
                    downloadLink.download = respuesta;
                    downloadLink.href = "./reportesExcel/"+respuesta;
                    downloadLink.click();

                    // window.location.href = "./reportesExcel/"+respuesta;
                }else{
                    generalMostrarError("REPORTERIA");
                }
                console.log(respuesta);
            })
        } else {
            generalMostrarError("GENERAR_BUSQUEDA");
        }
    },
    obtenerProyectosByDates() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarProyecto",
                params: {
                    accion: "obtenerProyectosByDates",
                    fechaDesde: this.dtpDesde.value,
                    fechaHasta: this.dtpFin.value,
                    estadoPago: this.cboEstadoPago.value
                }
            }).then((clientes) => {
                if (clientes != "SIN_DATOS"){
                    this.construirTable(clientes).then(resolve).catch(reject);
                }else{
                    this.datos =[];
                    tblRptrptProyectos.clear();
                    tblRptrptProyectos.columns.adjust().draw();
                    generalMostrarError("SIN_DATOS_SEARCH")
                }

            })
        })
    },

    eliminar(idProyecto) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    archivo: "procesarProyecto",
                    datos: {
                        idProyecto: idProyecto,
                        accion: "eliminar"
                    }
                }).then((respuesta) => {
                    if (respuesta == "EXITO") {
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
            //limpiamos la tabla y el areglo que almacenara los datos.
            tblRptrptProyectos.clear();
            this.datos = [];
            if (clientes != "NO_DATOS") {
                this.datos = clientes;
                clientes.forEach(cliente => {
                    this.contador++;
                    this.addRowTable(cliente);
                })
            } else {
                this.contador = 0;
                // tblRptrptProyectos.clear();
            }
            tblRptrptProyectos.columns.adjust().draw();
            resolve();
        })
    },
    addRowTable({id, nombreCliente, nombreProyecto, estadoPago, invoice, precioProyecto, fechaEjecucion}) {
        tblRptrptProyectos.row.add([
            this.contador,
            nombreCliente,
            nombreProyecto,
            estadoPago,
            invoice,
            "$ " + parseFloat(precioProyecto),
            fechaEjecucion
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblRptVerProyectos").length > 0) {
                    tblRptrptProyectos = $("#tblRptVerProyectos").DataTable({
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