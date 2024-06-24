var tblEscalaCantidad;
var tblEscalaPrecios;

window.onload = () => {
    producto.inicializarDatatable().then(() => {
        producto.obtenerLineas().then(() => {
            producto.obtenerLineasSub().then(() => {

            })

        })

    })
}

const producto = {
    id: document.getElementById("hdnId"),
    codigoFox: document.getElementById("txtCodigo"),
    nombreProducto: document.getElementById("txtNombre"),
    idLinea: document.getElementById("cboLinea"),
    idLineaSub: document.getElementById("cboLineaSub"),
    idTmpCantidad:0,
    arrayEscalaCantidad: [],
    arrayEscalaPrecios: [],

    obtenerLineas() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "productos",
                archivo: "procesarLinea",
                params: {
                    accion: "obtenerCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboLinea", respuesta).then(resolve)
            })
        })
    },
    obtenerLineasSub() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "productos",
                archivo: "procesarLineaSub",
                params: {
                    accion: "obtenerCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboLineaSub", respuesta).then(resolve)
            })
        })
    },

    // mostrar modales
    mdlAgregarEscalaCantidad() {
        return new Promise(resolve => {
            validar.limpiarInputs("limpiarMdl").then(() => {
                $("#mdlEscalaCantidad").modal("show");
                resolve();
            })
        })

    },

    agregarEscalaCantidad() {
        if(validar.InputTextsConClase("validarCantidad")){
            let idRow = document.getElementById("hdnIdCantidad").value.trim();
            let datos = {
                id: idRow == 0 ? ++this.idTmpCantidad : idRow,
                cantidadDesde: document.getElementById("txtDesdeCantidad").value.trim(),
                cantidadHasta: document.getElementById("txtHastaCantidad").value.trim(),
                precio: document.getElementById("txtPrecioCantidad").value.trim(),
                comision: document.getElementById("txtComisionCantidad").value.trim()
            };

            // if (idRow > 0) {
            //     this.arrayEscalaCantidad.forEach()
            //     // Eliminamos el item del arreglo si existe
            //     this.arrayEscalaCantidad = this.arrayEscalaCantidad.filter(item => item.id !== idRow);
            // }

            // Añadimos el nuevo item al arreglo
            this.arrayEscalaCantidad.push(datos);
            //limpiamos la tabla
            tblEscalaCantidad.clear();
            tblEscalaCantidad.columns.adjust().draw();
        // Añadir la fila a la tabla y ajustar la vista
            var construirTable = new Promise(resolve => {
                this.arrayEscalaCantidad.forEach(dato => {
                    if(dato.id == idRow){

                    }else{
                        this.addRowTableCantidad(dato);
                    }

                });
                resolve();
            });

            construirTable.then(() => {
                tblEscalaCantidad.columns.adjust().draw();
                $("#mdlEscalaCantidad").modal("hide");
            });
        }
    },
    addRowTableCantidad({id,cantidadDesde,cantidadHasta,precio,comision}){

            tblEscalaCantidad.row.add([
                cantidadDesde,cantidadHasta,
                "$ "+precio,
                comision +"%",
                "<button class='btn btn-outline-info btn-sm' type='button' title='Ver' onclick=' producto.editarCantidadArray(" + id + ");'>" +
                "<i class='bx bxs-cog'></i>" +
                "</button>" +
                "&nbsp;&nbsp;" +
                "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' producto.eliminarCantidadArray(" + id + ");'>" +
                "<i class='ri-delete-bin-6-line'></i>" +
                "</button>"
            ]).node().id = "trSubCat"+id;

    },
    editarCantidadArray(id){
        this.arrayEscalaCantidad.forEach(escala =>{
            if (escala.id == id){
                this.mdlAgregarEscalaCantidad().then(()=>{
                    document.getElementById("hdnIdCantidad").value = escala.id;
                    document.getElementById("txtDesdeCantidad").value = escala.cantidadDesde;
                    document.getElementById("txtHastaCantidad").value = escala.cantidadHasta;
                    document.getElementById("txtPrecioCantidad").value = escala.precio;
                    document.getElementById("txtComisionCantidad").value = escala.comision;
                })
            }
        })
    },
    // validadores
    validarEscalaCantidad(valor) {
        if (valor === 'S') {
            // ocultamos el boton de agregar escala de precios
            document.getElementById("btnAgregarEscalaCantidad").style.display = "block";
            document.getElementById("btnAgregarEscalaPrecios").style.display = "none";
            document.getElementById("rbEscalaPrecioNo").checked = true;
        } else {
            document.getElementById("btnAgregarEscalaPrecios").style.display = "block";
            document.getElementById("rbEscalaPrecioNo").checked = false;
            document.getElementById("rbEscalaCantidadNo").checked = true;
            document.getElementById("btnAgregarEscalaCantidad").style.display = "none";
            document.getElementById("rbEscalaPrecioSi").checked = true;
        }
    },
    validarEscalaPrecio(valor) {
        if (valor === 'S') {
            // ocultamos el boton de agregar escala de precios
            document.getElementById("btnAgregarEscalaPrecios").style.display = "block";
            document.getElementById("btnAgregarEscalaCantidad").style.display = "none";
            document.getElementById("rbEscalaCantidadNo").checked = true;
        } else {
            document.getElementById("btnAgregarEscalaPrecios").style.display = "none";
            document.getElementById("rbEscalaPrecioNo").checked = false;

            document.getElementById("btnAgregarEscalaCantidad").style.display = "block";
            document.getElementById("rbEscalaCantidadSi").checked = true;
            document.getElementById("rbEscalaPrecioNo").checked = true;
        }
    },

    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblEscalaCantidad").length > 0) {
                    tblEscalaCantidad = $("#tblEscalaCantidad").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 200,
                        order: [0, "asc"],
                        sortable: true,
                        searching: false, // Deshabilitar el buscador
                        lengthChange: false, // Deshabilitar la opción de "Mostrar registros por página"
                        pageLength: 10, // Fijar una longitud de página, si es necesario
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
                if ($("#tblEscalaPrecios").length > 0) {
                    tblEscalaPrecios = $("#tblEscalaPrecios").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 200,
                        order: [0, "asc"],
                        sortable: true,
                        searching: false, // Deshabilitar el buscador
                        lengthChange: false, // Deshabilitar la opción de "Mostrar registros por página"
                        pageLength: 10, // Fijar una longitud de página, si es necesario
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

$(document).on('change', '#txtImagen', function () {
    // var img = URL.createObjectURL(this.files[i]);

    const imageInput = document.getElementById('txtImagen');
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