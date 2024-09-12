var tblActividades, tblSucursales, tblTipoDocumento, frmDatos = new FormData();
window.onload = () => {
    datos_empresa.initDatatables().then(() => {
        datos_empresa.obtenerTipoPersoneria().then(() => {
            datos_empresa.obtenerEmpresaById().then(() => {
                datos_empresa.obtenerSucursalByEmpresa().then(() => {
                    datos_empresa.obtenerDatosTransmionDte().then(() => {
                        generales.moverTab(datos_empresa.tab.value);
                        console.log("prueba")
                    })
                })
            })
        })
    })
}
const datos_empresa = {
    id: document.getElementById("hdnId"),
    nombre: document.getElementById("txtNombre"),
    nombreComercial: document.getElementById("txtNombreComercial"),
    idTipoPersoneria: document.getElementById("cboTipoPersoneria"),
    nit: document.getElementById("txtNIT"),
    iva: document.getElementById("txtIVA"),
    correo: document.getElementById("txtCorreo"),
    telefono: document.getElementById("txtTelefono"),
    logo: document.getElementById("txtLogo"),
    tab: document.getElementById("hdnTab"),
    contadorAct: 0,
    contadorSuc: 0,
    //
    arrayActividadesEconomicas: [],
    arraySucursales: [],
    arrayDocumentosFiscales: [],

    obtenerTipoPersoneria() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarTipoPersoneria",
                params: {
                    accion: "obternerCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboTipoPersoneria", respuesta).then(resolve)
            })
        })
    },

    // pestaña empresa
    obtenerEmpresaById() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarEmpresa",
                params: {
                    accion: "obtenerById",
                    id: this.id.value
                }
            }).then((respuesta) => {
                this.construirFormulario(respuesta).then(() => {
                    this.construirTblActividadesEconomicas().then(() => {
                        resolve();
                    })
                })
            })
        })
    },
    construirFormulario(respuesta) {
        return new Promise(resolve => {
            if (respuesta.mensaje === "EXITO") {
                this.nombre.value = respuesta.datos[0].nombre;
                this.nombreComercial.value = respuesta.datos[0].nombreComercial;
                this.idTipoPersoneria.value = respuesta.datos[0].idPersoneria;
                this.nit.value = respuesta.datos[0].nit;
                this.iva.value = respuesta.datos[0].numeroIVA;
                this.correo.value = respuesta.datos[0].correo;
                this.telefono.value = respuesta.datos[0].telefono;
                let rutaIng = './images/logos/' + respuesta.datos[0].nombreLogo;
                const imageContainer = document.getElementById('imageContainer');
                imageContainer.innerHTML = ''; // Limpiar el contenedor de imágenes
                const img = document.createElement('img');
                img.src = rutaIng;
                img.className = 'img-thumbnail';
                imageContainer.appendChild(img);
                this.arrayActividadesEconomicas = respuesta.actividadesEconomicas;
            } else {
                mensajesAlertas(datos)
            }
            resolve();
        })
    },
    validarCamposEmpresa(claseValidar) {

        if (validar.InputTextsConClase(claseValidar)) {
            if (this.id.value > 0) {
                this.actualizarDatosEmpresa()
            } else {
                this.guardarDatosEmpresa()
            }

        }
    },
    guardarDatosEmpresa() {
        frmDatos.append("accion", "guardar");
        frmDatos.append("nombre", this.nombre.value);
        frmDatos.append("nombreComercial", this.nombreComercial.value);
        frmDatos.append("tipoPersoneria", this.idTipoPersoneria.value);
        frmDatos.append("nit", this.nit.value);
        frmDatos.append("iva", this.iva.value);
        frmDatos.append("correo", this.correo.value);
        frmDatos.append("telefono", this.telefono.value);
        fetchActions.setWFiles({
            modulo: "general",
            archivo: "procesarEmpresa",
            datos: frmDatos
        }).then((respuesta) => {
            mensajesAlertas(respuesta);
        })

    },
    actualizarDatosEmpresa() {
        frmDatos.append("accion", "actualizar");
        frmDatos.append("id", this.id.value)
        frmDatos.append("nombre", this.nombre.value);
        frmDatos.append("nombreComercial", this.nombreComercial.value);
        frmDatos.append("tipoPersoneria", this.idTipoPersoneria.value);
        frmDatos.append("nit", this.nit.value);
        frmDatos.append("iva", this.iva.value);
        frmDatos.append("correo", this.correo.value);
        frmDatos.append("telefono", this.telefono.value);
        fetchActions.setWFiles({
            modulo: "general",
            archivo: "procesarEmpresa",
            datos: frmDatos
        }).then((respuesta) => {
            mensajesAlertas(respuesta);
        })

    },

    // pestaña actividades economicas
    obtenerActividadesEconomicas() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarActividadesEconomicas",
                params: {
                    accion: "obtener"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboActividadEconomica", respuesta).then(resolve)
            })
        })
    },
    mostrarModalActividades() {
        $(".loader").fadeIn("fast");
        validar.limpiarInputs("limpiarMdlAct").then(() => {
            this.obtenerActividadesEconomicas().then(() => {
                $('#mdlAgregarActividadesEconomicas').modal('show');
                $(".loader").fadeOut("fast");
            })
        })
    },
    construirTblActividadesEconomicas() {
        return new Promise((resolve, reject) => {
            if (this.arrayActividadesEconomicas.mensaje !== "SIN_DATOS") {
                this.arrayActividadesEconomicas.datos.forEach(dato => {
                    this.contadorAct++;
                    this.addRowTableActividadesEconomicas(dato);
                })
            } else {
                this.contadorAct = 0;
                tblActividades.clear();
            }
            tblActividades.columns.adjust().draw();
            resolve();
        })
    },
    addRowTableActividadesEconomicas({
                                         id,
                                         idActividad,
                                         codigoActividad,
                                         nombreActividad,
                                     }) {
        tblActividades.row.add([
            this.contadorAct,
            codigoActividad,
            nombreActividad,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Ver' onclick=' datos_empresa.verActividadEconomica(" + id + "," + idActividad + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button>" +
            "&nbsp;&nbsp;" +
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' datos_empresa.eliminarActividadEconomica(" + id + ");'>" +
            "<i class='ri-delete-bin-6-line'></i>" +
            "</button>"
        ]).node().id = "trSubCat";
    },
    verActividadEconomica(id, idActividad) {
        $(".loader").fadeIn("fast");
        validar.limpiarInputs("limpiarMdlAct").then(() => {
            this.obtenerActividadesEconomicas().then(() => {
                document.getElementById("hdnIdActividadEco").value = id;
                document.getElementById("cboActividadEconomica").value = idActividad;
                $('#mdlAgregarActividadesEconomicas').modal('show');

                $(".loader").fadeOut("fast");
            })
        })
    },
    agregarActividadEconomica() {
        let id = document.getElementById("hdnIdActividadEco").value;
        if (id > 0) {
            this.actualizarActividadEconomica().then(mensajesAlertas)
        } else {
            this.guardarActividadEconomica().then(mensajesAlertas);
        }
    },
    guardarActividadEconomica() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarActividadesEconomicas",
                datos: {
                    accion: "guardarDetalleEconomica",
                    idEmpresa: this.id.value,
                    id: document.getElementById("cboActividadEconomica").value
                }
            }).then((respuesta) => {
                resolve(respuesta);
            })
        })
    },
    actualizarActividadEconomica() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarActividadesEconomicas",
                datos: {
                    accion: "actualizarDetalleEconomica",
                    idEmpresa: this.id.value,
                    idUpdt: document.getElementById("cboActividadEconomica").value,
                    id: document.getElementById("hdnIdActividadEco").value
                }
            }).then((respuesta) => {
                resolve(respuesta);
            })
        })
    },
    eliminarActividadEconomica(id) {
        Swal.fire({
            title: 'Estas seguro?',
            text: "Si eliminas este registro no podras recuperarlo",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo: "general",
                    archivo: "procesarActividadesEconomicas",
                    datos: {
                        accion: "eliminarDetalle",
                        idEmpresa: this.id.value,
                        id: id
                    }
                }).then((respuesta) => {
                    mensajesAlertas(respuesta);
                })
            }
        })
    },

    // pestania sucursales
    obtenerSucursalByEmpresa() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarSucursales",
                params: {
                    accion: "obtenerSucursalesByEmpresa",
                    idEmpresa: this.id.value
                }
            }).then((respuesta) => {
                this.construirTblSucursalesEmpresa(respuesta).then(resolve);
            })
        })
    },
    construirTblSucursalesEmpresa(respuesta) {
        return new Promise((resolve, reject) => {
            if (respuesta.mensaje !== "SIN_DATOS") {
                respuesta.datos.forEach(dato => {
                    this.contadorSuc++;
                    this.addRowTableSucursalesEmpresa(dato);
                })
            } else {
                this.contadorAct = 0;
                tblSucursales.clear();
            }
            tblSucursales.columns.adjust().draw();
            resolve();
        })
    },
    addRowTableSucursalesEmpresa({
                                     id,
                                     nombreSucursal,
                                     tipoEstablecimiento,
                                     responsable,
                                     telefono,
                                     correo,
                                     departamento,
                                     municipio,
                                     direccion
                                 }) {
        tblSucursales.row.add([
            this.contadorSuc,
            nombreSucursal,
            tipoEstablecimiento,
            responsable,
            telefono,
            correo,
            departamento,
            municipio,
            direccion,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Ver / Editar' onclick=' datos_empresa.verSucursalEmpresa(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button>" +
            "&nbsp;" +
            "<button class='btn btn-outline-success btn-sm' type='button' title='Configurar Sucursal' onclick=' datos_empresa.asignarPuntoVenta(" + id + ");'>" +
            "<i class='fas fa-cogs'></i>" +
            "</button>" +
            "&nbsp;" +
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' datos_empresa.eliminarSucursalEmpresa(" + id + ");'>" +
            "<i class='ri-delete-bin-6-line'></i>" +
            "</button>"
        ]).node().id = "trSubCat";
    },
    eliminarSucursalEmpresa(id) {
        Swal.fire({
            title: 'Estas seguro?',
            text: "Si eliminas este registro no podras recuperarlo",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    modulo: "general",
                    archivo: "procesarSucursales",
                    datos: {
                        accion: "eliminarSucursalDetalle",
                        idEmpresa: this.id.value,
                        id: id
                    }
                }).then((respuesta) => {
                    mensajesAlertas(respuesta);
                })
            }
        })
    },
    obtenerTipoEstablecimiento() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarTipoEstablecimiento",
                params: {
                    accion: "obtenerCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboTipoEstablecimiento", respuesta).then(resolve)
            })
        })
    },
    mostrarModalSucursales() {
        $(".loader").fadeIn("fast");
        validar.limpiarInputs("validarMdlSucursales").then(() => {
            this.obtenerTipoEstablecimiento().then(() => {
                generales.obtenerDepartamentos("cboDepartamentoSucursal").then(() => {
                    $('#mdlSucursales').modal('show');
                    $(".loader").fadeOut("fast");
                })
            })
        })
    },
    validarSucursal(claseValidar) {
        if (validar.InputTextsConClase(claseValidar)) {
            let idSucursal = document.getElementById("hdnIdSucursal").value,
                correo = document.getElementById("txtCorreoSucursal").value.trim();
            if (validar.formatoEmail(correo, "txtCorreoSucursal"))
                if (idSucursal > 0) {

                } else {
                    this.guardarSucursal().then(mensajesAlertas)

                }

        }
    },
    guardarSucursal() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarSucursales",
                datos: {
                    accion: "guardar",
                    idEmpresa: this.id.value,
                    nombreSucursal: document.getElementById("txtNombreSucursal").value.trim(),
                    idTipoEstablecimiento: document.getElementById("cboTipoEstablecimiento").value.trim(),
                    responsable: document.getElementById("txtResponsable").value,
                    telefono: document.getElementById("txtTelefonoSucursal").value,
                    correo: document.getElementById("txtCorreoSucursal").value,
                    idDepartamento: document.getElementById("cboDepartamentoSucursal").value,
                    idMunicipio: document.getElementById("cboMunicipioSucursal").value,
                    direccion: document.getElementById("txtDirección").value
                }
            }).then((respuesta) => {
                resolve(respuesta);
            })
        })
    },

    // PESTAÑA DTE
    obtenerDatosTransmionDte() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: 'general',
                archivo: 'procesarDatosTransmisionDte',
                params: {
                    idEmpresa: this.id.value,
                    accion: "obtenerByEmpresa"
                }
            }).then((respuesta) => {
                this.contruirDatosTransmisionDte(respuesta).then(resolve)
            })
        })
    },
    contruirDatosTransmisionDte(respuesta) {
        return new Promise(resolve => {
            if (respuesta.mensaje === "EXITO") {
                document.getElementById("hdnConfigDte").value = respuesta.datos[0].id;
                document.getElementById("cboAmbiente").value = respuesta.datos[0].idTipoAmbiente;
                document.getElementById("txtClavePublica").value = respuesta.datos[0].clavePublica;
                document.getElementById("txtClavePrivada").value = respuesta.datos[0].clavePrivada;
                document.getElementById("txtPassAPI").value = respuesta.datos[0].passwordApi;
                document.getElementById("txtUrlFirmador").value = respuesta.datos[0].urlFirmador;
            }
            resolve();
        })
    },

    validarDatosTransmision(claseValidar) {
        if (validar.InputTextsConClase(claseValidar)) {
            let idConf = document.getElementById("hdnConfigDte").value;
                if (idConf > 0) {
                    this.actualizarDatosTransmisionDTE().then(mensajesAlertas)
                } else {
                    this.guardarDatosTransmisionDTE().then(mensajesAlertas)
                }
        }
    },
    guardarDatosTransmisionDTE(){
        return new Promise(resolve => {
            fetchActions.set({
                modulo:'general',
                archivo:'procesarDatosTransmisionDte',
                datos :{
                    accion : "guardar",
                    idEmpresa : this.id.value,
                    idTipoAmbiente : document.getElementById("cboAmbiente").value,
                    clavePublica: document.getElementById("txtClavePublica").value,
                    clavePrivada: document.getElementById("txtClavePrivada").value,
                    passwordApi: document.getElementById("txtPassAPI").value,
                    urlFirmador: document.getElementById("txtUrlFirmador").value
                }
            }).then(resolve);
        })
    },
    actualizarDatosTransmisionDTE(){
        return new Promise(resolve => {
            fetchActions.set({
                modulo:'general',
                archivo:'procesarDatosTransmisionDte',
                datos :{
                    accion : "actualizar",
                    id: document.getElementById("hdnConfigDte").value,
                    idEmpresa : this.id.value,
                    idTipoAmbiente : document.getElementById("cboAmbiente").value,
                    clavePublica: document.getElementById("txtClavePublica").value,
                    clavePrivada: document.getElementById("txtClavePrivada").value,
                    passwordApi: document.getElementById("txtPassAPI").value,
                    urlFirmador: document.getElementById("txtUrlFirmador").value
                }
            }).then(resolve);
        })
    },

    initDatatables() {
        return new Promise(resolve => {
            try {
                if ($("#tblActividades").length > 0) {
                    tblActividades = $("#tblActividades").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 250,
                        order: [],
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
                if ($("#tblSucursales").length > 0) {
                    tblSucursales = $("#tblSucursales").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 250,
                        order: [],
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
                if ($("#tblTipoDocumento").length > 0) {
                    tblTipoDocumento = $("#tblTipoDocumento").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 250,
                        order: [],
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
    },

}
$(document).on('change', '#txtLogo', function () {
    // var img = URL.createObjectURL(this.files[i]);
    frmDatos.append('imagen', this.files[0]);
    const imageInput = document.getElementById('txtLogo');
    const imageContainer = document.getElementById('imageContainer');
    imageContainer.innerHTML = '';
    if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail';
            imageContainer.appendChild(img);
        }
        reader.readAsDataURL(imageInput.files[0]);
    }
});
