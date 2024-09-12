var tblAdmCatalogosCliente = "";
window.onload = () => {
    $(".loader").fadeIn("fast");
    generales.obtenerTiposDocumento("cboTipoDocumento").then(() => {
        proveedor.obtenerActividadesEconomicas().then(() => {
            proveedor.obtenerDepartamentos().then(() => {
                if (proveedor.id.value > 0) {
                    proveedor.obtenerCliente().then(() => {
                        //dibujar info del cliente
                        proveedor.inicializarDatatable().then(() => {
                            $(".loader").fadeOut("fast");
                            // proveedor.obtenerComprasCliente().then(() => {
                            //
                            // })
                        })
                    })
                }else{
                    $(".loader").fadeOut("fast");
                }
            })
        })
    })
}


const proveedor = {
    contador: 0,
    id: document.getElementById("hdnId"),
    nombre: document.getElementById("txtNombre"),
    tipoDocumento: document.getElementById("cboTipoDocumento"),
    iva: document.getElementById("txtIVA"),
    numeroDocumento: document.getElementById("txtNumeroDocumento"),
    actividadEconomica: document.getElementById("cboActividadEconomica"),
    email: document.getElementById("txtEmail"),
    telefono: document.getElementById("txtTelefono"),
    departamento: document.getElementById("cboDepartamento"),
    municipio: document.getElementById("cboMunicipio"),
    direccion: document.getElementById("txtDireccion"),

    obtenerActividadesEconomicas() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarActividadesEconomicas",
                params: {
                    accion: "obtener"
                }
            }).then((respuesta) => {
                generales.construirCboDefault("cboActividadEconomica", respuesta).then(resolve)
            })
        })
    },
    obtenerDepartamentos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarDireccion",
                params: {
                    accion: "departamentos"
                }
            }).then((departamentos) => {
                generales.construirCbo('cboDepartamento', departamentos).then(resolve)
            }).catch(reject)
        })
    },
    obtenerMunicipios(idDepartamento) {
        fetchActions.get({
            modulo: "general",
            archivo: "procesarDireccion",
            params: {
                accion: "municipios",
                idDepartamento: idDepartamento
            }
        }).then((departamentos) => {
            generales.construirCbo('cboMunicipio', departamentos).then()
        })
    },
    obtenerCliente() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "proveedores",
                archivo: "procesarProveedor",
                params: {
                    accion: "obtenerById",
                    id: this.id.value.trim()
                }
            }).then((cliente) => {
                this.construirCliente(cliente).then(resolve).catch(reject);
            })
        })
    },

    construirCliente(cliente) {
        return new Promise((resolve, reject) => {
            if (cliente !== "NO_DATOS") {
                this.nombre.value = cliente[0]["nombre"];
                this.tipoDocumento.value = cliente[0]["idTipoDocumentoIdentidad"];
                $("#cboTipoDocumento").trigger('change');
                this.numeroDocumento.value = cliente[0]["numeroDocumento"];
                this.iva.value = cliente[0]["iva"];
                this.actividadEconomica.value = cliente[0]["idActividadEconomica"];
                this.email.value = cliente[0]["correo"];
                this.telefono.value = cliente[0]["telefono"];
                this.departamento.value = cliente[0]["idDepartamento"];
                $('#cboDepartamento').trigger('change');
                sleep(2000).then(() => {
                    document.getElementById("cboMunicipio").value = cliente[0]["idMunicipio"];
                })
                this.direccion.value = cliente[0]["direccion"];
                resolve();
            }
        })
    },
    validar() {
       if (validar.InputTextsConClase("validar")){
           if (this.id.value > 0) {
               // actualiozad
               this.actualizar();
           } else {
               this.guardar()
           }
       }

    },
    guardar() {
        fetchActions.set({
            modulo: "proveedores",
            archivo: "procesarProveedor",
            datos: {
                accion: "guardar",
                nombre: this.nombre.value.trim(),
                tipoDocumento: this.tipoDocumento.value.trim(),
                numeroDocumento: this.numeroDocumento.value.trim(),
                iva: this.iva.value.trim(),
                actividadEconomica: this.actividadEconomica.value.trim(),
                email: this.email.value.trim(),
                telefono: this.telefono.value.trim(),
                departamento: this.departamento.value.trim(),
                municipio: this.municipio.value.trim(),
                direccion: this.direccion.value.trim()
            }
        }).then((resultado) => {
            if (resultado === "EXITO") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Agregado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                })
            } else {
                generalMostrarError(resultado)
            }
        })

    },
    actualizar() {
        fetchActions.set({
            modulo: "proveedores",
            archivo: "procesarProveedor",
            datos: {
                accion: "actualizar",
                id: this.id.value.trim(),
                nombre: this.nombre.value.trim(),
                tipoDocumento: this.tipoDocumento.value.trim(),
                numeroDocumento: this.numeroDocumento.value.trim(),
                iva: this.iva.value.trim(),
                actividadEconomica: this.actividadEconomica.value.trim(),
                email: this.email.value.trim(),
                telefono: this.telefono.value.trim(),
                departamento: this.departamento.value.trim(),
                municipio: this.municipio.value.trim(),
                direccion: this.direccion.value.trim()
            }
        }).then((resultado) => {
            if (resultado.mensaje === "EXITO") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Actualizado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                })
            } else {
                generalMostrarError(resultado)
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
                tblAdmCatalogosCliente.clear();
            }
            tblAdmCatalogosCliente.columns.adjust().draw();
            resolve();
        })
    },

    addRowTable({id, nombreCatalogo, descripcion, fechaInicio, fechaFin}) {
        tblAdmCatalogosCliente.row.add([
            this.contador,
            nombreCatalogo,
            descripcion,
            fechaInicio,
            fechaFin,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Editar' onclick=' proveedor.editarFechasCatalogo(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> " +
            "&nbsp;" +
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' proveedor.eliminarCatalogo(" + id + ");'>" +
            "<i class='fa  fa-trash-alt'></i>" +
            "</button> " +
            "&nbsp;"
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblAdmCatalogosCliente").length > 0) {
                    tblAdmCatalogosCliente = $("#tblAdmCatalogosCliente").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 350,
                        order: [0, "desc"],
                        sortable: true,
                        searching: false, // Deshabilita la barra de búsqueda
                        paging: false
                    });
                    tblAdmCatalogosCliente.columns.adjust().draw();
                }
                resolve();
            } catch (err) {
                reject(err.message);
            }
        })
    }
}