var tblUsuarios;

window.onload = () => {
    adm_usuarios.inicializarDatatable().then(() => {
        adm_usuarios.obtener().then(() => {

        })

    })
}
const adm_usuarios = {
    contador: 0,
    obtener() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarUsuario",
                params: {
                    accion: "obtener"
                }
            }).then((respuesta) => {
                this.construirTable(respuesta).then(resolve)
            })
        })
    },
    ver(idUsuario) {
        location.href = "?module=general&page=usuario&id=" + btoa(idUsuario);
    },
    eliminar(id) {
        Swal.fire({
            title: '¿Deseas realizar esta accion?',
            text: "Bloquear usuario",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo: "general",
                    archivo: "procesarUsuario",
                    datos: {
                        accion: "bloquear",
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
                tblUsuarios.clear();
            }
            tblUsuarios.columns.adjust().draw();
            resolve();
        })
    },
    addRowTable({
                    id,
                    nombre,
                    email,
                    nombreRol,
                }) {
        let agencias = "N/A";
        tblUsuarios.row.add([
            this.contador,
            nombre,
            nombreRol,
            agencias,
            email,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Ver' onclick=' adm_usuarios.ver(" + id + ");'>" +
            "<i class='bx bx-group'></i>" +
            "</button>" +
            "&nbsp;&nbsp;" +
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' adm_usuarios.eliminar(" + id + ");'>" +
            "<i class='ri-delete-bin-6-line'></i>" +
            "</button>"
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblUsuarios").length > 0) {
                    tblUsuarios = $("#tblUsuarios").DataTable({
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