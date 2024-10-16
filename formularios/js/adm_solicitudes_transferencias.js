var tblAutorizaciones = "";
window.onload = () => {
    $(".loader").fadeIn("fast");
    adm_cuentas_banco.inicializarDatatable().then(() => {
        adm_cuentas_banco.obtener().then(() => {
            $(".loader").fadeOut("fast");
        })
    })

}

const adm_cuentas_banco = {
    contador: 0,

    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "formularios",
                archivo: "procesarSolicitudesTransferencias",
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
            tblAutorizaciones.clear();
            tblAutorizaciones.clear().draw();
            if (data.mensaje !== "NO_DATOS") {
                data.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblAutorizaciones.clear();
            }
            tblAutorizaciones.columns.adjust().draw();
            resolve();
        })
    },
    editar(id) {
        window.location.href = "?module=formularios&page=cuentas_banco&id="+ btoa(id)
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
                    modulo: "formularios",
                    archivo: "procesarSolicitudesTransferencias",
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
    addRowTable({idCuenta, nombreBanco, numeroCuenta, tipoCuenta,nombreEmpresa}) {
        tblAutorizaciones.row.add([
            this.contador,
            nombreEmpresa,
            nombreBanco,
            numeroCuenta,
            tipoCuenta,
            "<button class='btn btn-outline-success btn-sm' type='button' title='Editar' onclick=' adm_cuentas_banco.editar(" + idCuenta + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> "+
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' adm_cuentas_banco.eliminar(" + idCuenta + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblAutorizaciones").length > 0) {
                    tblAutorizaciones = $("#tblAutorizaciones").DataTable({
                        dateFormat: 'uk',
                        scrollX: true,
                        fixedHeader: false,
                        scrollY: 400,
                        order: [0, "asc"],
                        sortable: true,
                        "language": {
                            "emptyTable": "No hay datos disponibles en la tabla",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                            "infoFiltered": "(filtrado de _MAX_ registros totales)",
                            "thousands": ".",
                            "lengthMenu": "Mostrar _MENU_ registros por página",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "No se encontraron registros coincidentes"
                            // Otras traducciones...
                        }
                    });
                }
                resolve();
            } catch (err) {
                reject(err.message);
            }
        })
    }
}
