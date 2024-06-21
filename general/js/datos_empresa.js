var tblActividades,tblSucursales,tblTipoDocumento;

window.onload = () => {
    datos_empresa.initDatatables().then(()=>{

    })
}
const datos_empresa ={
    id: document.getElementById("hdnId"),
    nombre: document.getElementById("txtNombre"),
    nombreComercial: document.getElementById("txtNombreComercial"),
    idTipoPersoneria: document.getElementById("cboTipoPersoneria"),
    nit: document.getElementById("txtNIT"),
    iva : document.getElementById("txtIVA"),
    correo: document.getElementById("txtCorreo"),
    telefono: document.getElementById("txtTelefono"),
    log: document.getElementById("txtLogo"),
    //
    arrayActividadesEconomicas:[],
    arraySucursales:[],
    arrayDocumentosFiscales:[],

    validarCamposEmpresa(claseValidar) {
        if (validar.InputTextsConClase(claseValidar)) {
            if (this.id.value >0){
                this.actualizarDatosEmpresa().then(mensajesAlertas)
            }else{
                this.guardarDatosEmpresa().then((mensajesAlertas))
            }

        }
    },
    guardarDatosEmpresa(){
        return new Promise(resolve => {
            fetchActions.setWFiles({
                modulo:"general",
                archivo:"procesarEmpresa",
                datos:{
                    accion: "guardarDatosEmpresa",

                }
            }).then((respuesta)=>{
                console.log(respuesta);
            })
        })

    },
    mostrarModalSucursales(){



    },
    initDatatables(){
        return new Promise(resolve=>{
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
    }
}