var tblEmpresas;

window.onload = () => {
    adm_empresas.inicializarDatatable().then(() => {
        adm_empresas.obtener().then(() => {

        })

    })
}
const adm_empresas = {
    contador: 0,
    obtener() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarEmpresa",
                params: {
                    accion: "obtenerAll"
                }
            }).then((respuesta) => {
                this.construirTable(respuesta).then(resolve)
            })
        })
    },
    ver(idUsuario) {
        location.href = "?module=general&page=datos_empresa&id=" + btoa(idUsuario);
    },
    eliminar(id) {
        Swal.fire({
            title: '¿Deseas realizar esta accion?',
            text: "Eliminar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo: "general",
                    archivo: "procesarEmpresa",
                    datos: {
                        accion: "eliminar",
                        id: id
                    }
                }).then((respuesta) => {
                    mensajesAlertas(respuesta);
                })
            }
        })

    },
    construirTable(respuesta) {
        console.log(respuesta)
        return new Promise((resolve, reject) => {
            if (respuesta.mensaje !== "SIN_DATOS") {
                respuesta.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblEmpresas.clear();
            }
            tblEmpresas.columns.adjust().draw();
            resolve();
        })
    },
    addRowTable({
                    id,
                    nombre,
                    nombreComercial,
                    nit,
                    iva,
                    direccion,
                }) {
        tblEmpresas.row.add([
            this.contador,
            nombre,
            nombreComercial,
            nit,
            iva,
            direccion,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Ver' onclick=' adm_empresas.ver(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button>" +
            "&nbsp;&nbsp;" +
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' adm_empresas.eliminar(" + id + ");'>" +
            "<i class='ri-delete-bin-6-line'></i>" +
            "</button>"
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblEmpresas").length > 0) {
                    tblEmpresas = $("#tblEmpresas").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
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