var tblTipoEmpleado = "";
window.onload = () => {
    $(".loader").fadeIn("fast");
    adm_tipo_empleado.inicializarDatatable().then(() => {
        adm_tipo_empleado.obtener().then(() => {
            $(".loader").fadeOut("fast");
        })
    })

}

const adm_tipo_empleado = {
    contador: 0,

    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "planilla",
                archivo: "procesarTipoEmpleado",
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
            tblTipoEmpleado.clear();
            tblTipoEmpleado.clear().draw();
            if (data.mensaje !== "NO_DATOS") {
                data.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblTipoEmpleado.clear();
            }
            tblTipoEmpleado.columns.adjust().draw();
            resolve();
        })
    },
    editar(id) {
        window.location.href = "?module=planilla&page=tipo_empleado&id="+ btoa(id)
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
                    modulo: "planilla",
                    archivo: "procesarTipoEmpleado",
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
        tblTipoEmpleado.row.add([
            this.contador,
            nombre,
            descripcion,
            "<button class='btn btn-outline-success btn-sm' type='button' title='Editar' onclick=' adm_tipo_empleado.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> "+
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' adm_tipo_empleado.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblTipoEmpleado").length > 0) {
                    tblTipoEmpleado = $("#tblTipoEmpleado").DataTable({
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
