var tblMontos = "";
window.onload = () => {
    $(".loader").fadeIn("fast");
    adm_conf_montos_aprobacion.inicializarDatatable().then(() => {
        adm_conf_montos_aprobacion.obtener().then(() => {
            $(".loader").fadeOut("fast");
        })
    })

}

const adm_conf_montos_aprobacion = {
    contador: 0,

    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "formularios",
                archivo: "procesarConfMontosAprobacion",
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
            tblMontos.clear();
            tblMontos.clear().draw();
            if (data.mensaje !== "NO_DATOS") {
                data.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblMontos.clear();
            }
            tblMontos.columns.adjust().draw();
            resolve();
        })
    },
    editar(id) {
        window.location.href = "?module=formularios&page=conf_montos_aprobacion&id="+ btoa(id)
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
                    archivo: "procesarConfMontosAprobacion",
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
    addRowTable({id, montoDesde, montoHasta,usuarioAutorizado, banco, estado}) {
        let estadoF = estado === 'A' ?"Puede autorizar " :"permiso deshabilitado";
        tblMontos.row.add([
            this.contador,
            usuarioAutorizado,
            banco,
            '$'+generales.formatearDecimalesComasPuntos(montoDesde),
            '$'+generales.formatearDecimalesComasPuntos(montoHasta),
            estadoF,
            "<button class='btn btn-outline-success btn-sm' type='button' title='Editar' onclick=' adm_conf_montos_aprobacion.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> "+
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' adm_conf_montos_aprobacion.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblMontos").length > 0) {
                    tblMontos = $("#tblMontos").DataTable({
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
