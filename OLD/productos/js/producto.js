var tblEscalaCantidad,
    tblEscalaPrecios,
    frmDatos = new FormData();
window.onload = () => {
    producto.inicializarDatatable().then(() => {
        producto.obtenerProveedores().then(() => {
            producto.obtenerMarcas().then(() => {
                producto.obtenerCatalogo().then(() => {
                    producto.obtenerCategoria().then(() => {
                        producto.obtenerSubCategoria().then(() => {
                            if (producto.id.value > 0) {
                                producto.obtenerById().then(() => {

                                })
                            }
                        })
                    })
                })

            })
        })

    })
}

const producto = {
    id: document.getElementById("hdnId"),
    codigo: document.getElementById("txtCodigo"),
    nombreProducto: document.getElementById("txtNombre"),
    proveedor: document.getElementById("cboProveedor"),
    marca: document.getElementById("cboMarca"),
    catalogo: document.getElementById("cboCatalogo"),
    categoria: document.getElementById("cboCategoria"),
    subCcategoria: document.getElementById("cboSubCategoria"),
    descripcion: document.getElementById("txtDescripcionProducto"),
    especificacionesTecnicas: document.getElementById("txtEspecificacionesProducto"),
    precioCompraSinIva: document.getElementById("txtPrecioCompraSinIVA"),
    ivaCompra: document.getElementById("txtIvaCompra"),
    precioCompraConIva: document.getElementById("txtPrecioCompraConIVA"),
    precioVentaSinIva: document.getElementById("txtPrecioVentaSinIVA"),
    ivaVenta: document.getElementById("txtIVAVenta"),
    precioVentaConIva: document.getElementById("txtPrecioVentaConIVA"),
    porcentajeDescuento: document.getElementById("txtPorcentajeDescuento"),
    valorDescuento: document.getElementById("txtValorDescuento"),
    precioConsumidorFinal: document.getElementById("txtPrecioFinal"),
    idTmpPrecio: 0,
    arrayEscalaCantidad: [],
    arrayEscalaPrecios: [],
    porcentajeIVA: 0.13,
    productoExcento: false,

    obtenerProveedores() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "proveedores",
                archivo: "procesarProveedor",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboProveedor", respuesta).then(resolve)
            })
        })
    },
    obtenerMarcas() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "marcas",
                archivo: "procesarMarcas",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboMarca", respuesta).then(resolve)
            })
        })
    },
    obtenerCatalogo() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "catalogos",
                archivo: "procesarCatalogos",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboCatalogo", respuesta).then(resolve)
            })
        })
    },
    obtenerCategoria() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "catalogos",
                archivo: "procesarCategorias",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboCategoria", respuesta).then(resolve)
            })
        })
    },
    obtenerSubCategoria() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "catalogos",
                archivo: "procesarSubCategorias",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo("cboSubCategoria", respuesta).then(resolve)
            })
        })
    },

    // validar campos al insertar o actualizar
    validarCampos() {
        var validador = true;
        if (validar.InputTextsConClase("validarTab1")) {
            document.getElementById("spnNombreGuardar").innerText = "";
            document.getElementById("spnNombreGuardar").innerText = "Guardar";
            document.getElementById("profile-tab").click();
            if (validar.statusRadioButton("rbExentoSi", "rbExentoNo")) {
                if (validar.statusRadioButton("rbPrecioFijoSi", "rbPrecioFijoNo")) {
                    if (validar.InputTextsConClase("validarTab2")) {
                        if (validar.statusRadioButton("rbDescuentoSi", "rbDescuentoNo")) {
                            this.guardarDatos();
                        } else {
                            validador = false;
                            mensajesAlertas("VALIDACION_GENERAL");
                        }
                    } else {
                        validador = false;
                        mensajesAlertas("VALIDACION_GENERAL");
                    }
                } else {
                    validador = false;
                    mensajesAlertas("VALIDACION_GENERAL");
                }
            } else {
                validador = false;
                mensajesAlertas("VALIDACION_GENERAL");
            }
        } else {
            document.getElementById("homeT-tab").click();
            validador = false;
            mensajesAlertas("VALIDACION_GENERAL");
        }

    },
    guardarDatos() {
        frmDatos.append("accion", "guardar")
        frmDatos.append("codigo", this.codigo.value.trim())
        frmDatos.append("nombre", this.nombreProducto.value.trim())
        frmDatos.append("proveedor", this.proveedor.value.trim())
        frmDatos.append("marca", this.marca.value.trim())
        frmDatos.append("catalogo", this.catalogo.value.trim())
        frmDatos.append("categoria", this.categoria.value.trim())
        frmDatos.append("subCategoria", this.categoria.value.trim())
        frmDatos.append("descripcion", this.descripcion.value.trim())
        frmDatos.append("especificaciones", this.especificacionesTecnicas.value.trim())
        frmDatos.append("excento", document.querySelector('input[name="rbExento"]:checked').value)
        frmDatos.append("precioFijo", document.querySelector('input[name="rbPrecioFijo"]:checked').value)
        frmDatos.append("precioCompraSinIva", this.precioCompraSinIva.value.trim())
        frmDatos.append("ivaCompra", this.ivaCompra.value.trim())
        frmDatos.append("precioCompraConIva", this.precioCompraConIva.value.trim())
        frmDatos.append("precioVentaSinIva", this.precioVentaSinIva.value.trim())
        frmDatos.append("ivaVenta", this.ivaVenta.value.trim())
        frmDatos.append("precioVentaConIva", this.precioVentaConIva.value.trim())
        frmDatos.append("descuento", document.querySelector('input[name="rbDescuento"]:checked').value)
        frmDatos.append("porcentajeDescuento", this.porcentajeDescuento.value)
        frmDatos.append("valorDescuento", this.valorDescuento.value)
        frmDatos.append("precioConsumidorFinal", this.precioConsumidorFinal.value)

        fetchActions.setWFiles({
            modulo: "productos",
            archivo: "procesarProductos",
            datos: frmDatos
        }).then((respuesta) => {
            console.log(respuesta);
            mensajesAlertas(respuesta);
        })

    },

    // obtener Datos By ID
    obtenerById() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "productos",
                archivo: "procesarProductos",
                params: {
                    accion: "obtenerById",
                    id: this.id.value.trim()
                }
            }).then((producto) => {
                this.construirProducto(producto).then(resolve)
            })
        });
    },
    construirProducto(producto) {
        return new Promise(resolve => {
            if (producto.mensaje === "EXITO") {
                let prod = producto.datos[0];
                this.codigo.value = prod.codigo;
                this.nombreProducto.value = prod.nombre;
                this.proveedor.value = prod.idProveedor;
                this.marca.value = prod.idMarca;
                this.catalogo.value = prod.idCatalogo;
                this.categoria.value = prod.idCategoria;
                this.subCcategoria.value = prod.idSubCategoria;
                this.descripcion.value = prod.descripcion;
                this.especificacionesTecnicas.value = prod.especificaciones;
                if (prod.exento === 'S') {
                    document.getElementById("rbExentoSi").checked = true;
                    document.getElementById("rbExentoNo").checked = false;
                } else {
                    document.getElementById("rbExentoSi").checked = false;
                    document.getElementById("rbExentoNo").checked = true;
                }

                this.precioCompraSinIva.value = prod.precioCompraSinIva;
                this.ivaCompra.value = prod.ivaCompra;
                this.precioCompraConIva.value = prod.precioCompraConIva;
                this.precioVentaSinIva.value = prod.precioVentaSinIva;
                this.ivaVenta.value = prod.ivaVenta;
                this.precioVentaConIva.value = prod.precioVentaConIva;
                if (prod.descuento === 'S') {
                    document.getElementById("rbDescuentoSi").checked = true;
                    document.getElementById("rbDescuentoNo").checked = false;
                } else {
                    document.getElementById("rbDescuentoSi").checked = false;
                    document.getElementById("rbDescuentoNo").checked = true;
                }
                this.porcentajeDescuento.value = prod.porcentajeDescuento;
                this.valorDescuento.value = prod.valorDescuento;
                this.precioConsumidorFinal.value = prod.precioConsumidorFinal;
                let rutaIng = './productos/images/thumbnails/'+prod.imagen;
                const imageContainer = document.getElementById('imageContainer');
                imageContainer.innerHTML = ''; // Limpiar el contenedor de imágenes
                const img = document.createElement('img');
                img.src = rutaIng;
                img.className = 'img-thumbnail';
                imageContainer.appendChild(img);
            }
            resolve();
        })
    },
    showExistingImage(path) {

    },
    // validar acciones y calculos
    validarPrecioFijo(valor) {
        console.log(valor)
        if (valor === 'S') {
            // ocultamos el boton de agregar escala de precios
            document.getElementById("divPreciosVarios").style.display = "none";
            document.getElementById("txtPrecioCompraSinIVA").disabled = false;
            this.arrayEscalaCantidad = [];
            this.arrayEscalaPrecios = [];

        } else {
            $("#divPreciosVarios").fadeIn("fast");
            document.getElementById("txtPrecioCompraSinIVA").disabled = true;
            document.getElementById("rbDescuentoNo").checked = true;
        }
    },
    calcularIVAProducto(precio) {
        if (!this.productoExcento) {
            let valorIVA = (precio * this.porcentajeIVA).toFixed(2);
            let precioConIVA = (parseFloat(valorIVA) + parseFloat(precio)).toFixed(2);
            document.getElementById("txtIvaCompra").value = valorIVA;
            document.getElementById("txtPrecioCompraConIVA").value = precioConIVA;
        } else {
            document.getElementById("txtIvaCompra").value = 0;
            document.getElementById("txtPrecioCompraConIVA").value = precio;
        }

    },
    calcularIVAProductoVenta(precio) {
        if (!this.productoExcento) {
            let valorIVA = (precio * this.porcentajeIVA).toFixed(2);
            let precioConIVA = (parseFloat(valorIVA) + parseFloat(precio)).toFixed(2);

            document.getElementById("txtIVAVenta").value = valorIVA;
            document.getElementById("txtPrecioVentaConIVA").value = precioConIVA;
            this.calcularDescuento(document.getElementById("txtPorcentajeDescuento").value)
            let descuento = document.getElementById("txtValorDescuento").value;

            document.getElementById("txtPrecioFinal").value = (precioConIVA - descuento).toFixed(2);
        } else {
            document.getElementById("txtPrecioVentaConIVA").value = 0;
            document.getElementById("txtIVAVenta").value = 0;
            document.getElementById("txtPrecioFinal").value = precio;
        }
    },
    validarDescuento(valor) {
        console.log(valor);
        if (valor === 'S') {
            const descuentoInput = document.getElementById("txtPorcentajeDescuento");
            descuentoInput.disabled = valor !== 'S';
            descuentoInput.value = "";
        } else {
            document.getElementById("txtPorcentajeDescuento").value = 0;
            document.getElementById("txtPorcentajeDescuento").disabled = true;
            document.getElementById("txtValorDescuento").value = 0;
            if (!this.productoExcento) {
                document.getElementById("txtPrecioFinal").value = document.getElementById("txtPrecioVentaConIVA").value;
            } else {
                document.getElementById("txtPrecioFinal").value = document.getElementById("txtPrecioVentaSinIVA").value;
            }
        }

    },
    calcularDescuento(descuento) {
        if (descuento > 0) {
            if (!this.productoExcento) {
                let descuFinal = descuento / 100;
                let precioIvaIncluido = document.getElementById("txtPrecioVentaConIVA").value;
                let valorDescuento = (precioIvaIncluido * descuFinal).toFixed(2);
                document.getElementById("txtValorDescuento").value = valorDescuento;
                document.getElementById("txtPrecioFinal").value = (precioIvaIncluido - valorDescuento).toFixed(2)
            } else {
                let precioVentaSinIvA = document.getElementById("txtPrecioVentaSinIVA").value;
                let descuFinal = descuento / 100;
                let valorDescuento = (precioVentaSinIvA * descuFinal).toFixed(2);
                document.getElementById("txtValorDescuento").value = valorDescuento;
                document.getElementById("txtPrecioFinal").value = (precioVentaSinIvA - valorDescuento).toFixed(2)
            }
        }
    },
    validarExento(valor) {
        let precioCompra = document.getElementById("txtPrecioCompraSinIVA").value;
        let precioVenta = document.getElementById("txtPrecioVentaSinIVA").value;
        let porcentajeDescuento = document.getElementById("txtPorcentajeDescuento").value;
        if (valor === 'S') {
            this.productoExcento = true;
            this.calcularIVAProducto(precioCompra);
            this.calcularIVAProductoVenta(precioVenta);
            this.calcularDescuento(porcentajeDescuento);
        } else {
            this.productoExcento = false;
            this.calcularIVAProducto(precioCompra);
            this.calcularIVAProductoVenta(precioVenta);
            this.calcularDescuento(porcentajeDescuento);
        }

    },

    // Escala por cantidades
    mdlAgregarEscalaCantidad() {
        return new Promise(resolve => {
            validar.limpiarInputs("limpiarMdl").then(() => {
                $("#mdlEscalaCantidad").modal("show");
                resolve();
            })
        })

    },
    agregarEscalaCantidad() {
        if (validar.InputTextsConClase("validarCantidad")) {
            let idRow = parseInt(document.getElementById("hdnIdCantidad").value.trim(), 10);
            if (idRow > 0) {
                // eliminamos el item
                this.arrayEscalaCantidad = this.arrayEscalaCantidad.filter(item => {
                    console.log("Checking item:", item, "id :" + idRow);
                    return item.id !== idRow;
                });
            }
            let datos = {
                id: this.idTmpCantidad += 1,
                cantidadDesde: document.getElementById("txtDesdeCantidad").value.trim(),
                cantidadHasta: document.getElementById("txtHastaCantidad").value.trim(),
                precio: document.getElementById("txtPrecioCantidad").value.trim(),
                comision: document.getElementById("txtComisionCantidad").value.trim()
            };

            // Añadimos el nuevo item al arreglo
            this.arrayEscalaCantidad.push(datos);

            //limpiamos la tabla
            tblEscalaCantidad.clear();
            tblEscalaCantidad.columns.adjust().draw();

            // Añadir la fila a la tabla y ajustar la vista
            var construirTable = new Promise(resolve => {
                this.arrayEscalaCantidad.forEach(dato => {
                    console.log(dato)
                    this.addRowTableCantidad(dato);
                });
                resolve();
            });

            construirTable.then(() => {
                tblEscalaCantidad.columns.adjust().draw();
                $("#mdlEscalaCantidad").modal("hide");
            });
        }
    },
    addRowTableCantidad({id, cantidadDesde, cantidadHasta, precio, comision}) {

        tblEscalaCantidad.row.add([
            cantidadDesde, cantidadHasta,
            "$ " + precio,
            comision + "%",
            "<button class='btn btn-outline-info btn-sm' type='button' title='Ver' onclick=' producto.editarCantidadArray(" + id + ");'>" +
            "<i class='bx bxs-cog'></i>" +
            "</button>" +
            "&nbsp;&nbsp;" +
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' producto.eliminarCantidadArray(" + id + ");'>" +
            "<i class='ri-delete-bin-6-line'></i>" +
            "</button>"
        ]).node().id = "trSubCat" + id;

    },
    editarCantidadArray(id) {
        this.arrayEscalaCantidad.forEach(escala => {
            if (escala.id == id) {
                this.mdlAgregarEscalaCantidad().then(() => {
                    document.getElementById("hdnIdCantidad").value = escala.id;
                    document.getElementById("txtDesdeCantidad").value = escala.cantidadDesde;
                    document.getElementById("txtHastaCantidad").value = escala.cantidadHasta;
                    document.getElementById("txtPrecioCantidad").value = escala.precio;
                    document.getElementById("txtComisionCantidad").value = escala.comision;
                })
            }
        })
    },
    eliminarCantidadArray(idRow) {
        if (idRow > 0) {
            // eliminamos el item
            this.arrayEscalaCantidad = this.arrayEscalaCantidad.filter(item => {
                console.log("Checking item:", item, "id :" + idRow);
                return item.id !== idRow;
            });
            tblEscalaCantidad.clear();
            tblEscalaCantidad.columns.adjust().draw();

            // Añadir la fila a la tabla y ajustar la vista
            var construirTable = new Promise(resolve => {
                this.arrayEscalaCantidad.forEach(dato => {
                    console.log(dato)
                    this.addRowTableCantidad(dato);
                });
                resolve();
            });

            construirTable.then(() => {
                tblEscalaCantidad.columns.adjust().draw();
                $("#mdlEscalaCantidad").modal("hide");
            });
        }
    },

    //Escala de precios
    mdlAgregarEscalaPrecio() {
        return new Promise(resolve => {
            validar.limpiarInputs("limpiarMdl").then(() => {
                $("#mdlEscalaPrecio").modal("show");
                resolve();
            })
        })

    },
    agregarEscalaPrecio() {
        if (validar.InputTextsConClase("validarPrecio")) {
            let idRow = parseInt(document.getElementById("hdnIdPrecio").value.trim(), 10);
            if (idRow > 0) {
                // eliminamos el item
                this.arrayEscalaPrecios = this.arrayEscalaPrecios.filter(item => {
                    console.log("Checking item:", item, "id :" + idRow);
                    return item.id !== idRow;
                });
            }
            let datos = {
                id: this.idTmpPrecio += 1,
                precio: document.getElementById("txtPrecio").value.trim(),
                comision: document.getElementById("txtComisionPrecio").value.trim()
            };

            // Añadimos el nuevo item al arreglo
            this.arrayEscalaPrecios.push(datos);

            //limpiamos la tabla
            tblEscalaPrecios.clear();
            tblEscalaPrecios.columns.adjust().draw();

            // Añadir la fila a la tabla y ajustar la vista
            var construirTable = new Promise(resolve => {
                this.arrayEscalaPrecios.forEach(dato => {

                    this.addRowTablePrecio(dato);
                });
                resolve();
            });

            construirTable.then(() => {
                tblEscalaPrecios.columns.adjust().draw();
                $("#mdlEscalaPrecio").modal("hide");
            });
        }
    },
    addRowTablePrecio({id, precio, comision}) {
        tblEscalaPrecios.row.add([
            "$ " + precio,
            comision + "%",
            "<button class='btn btn-outline-info btn-sm' type='button' title='Ver' onclick=' producto.editarPrecioArray(" + id + ");'>" +
            "<i class='bx bxs-cog'></i>" +
            "</button>" +
            "&nbsp;&nbsp;" +
            "<button class='btn btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' producto.eliminarPrecioArray(" + id + ");'>" +
            "<i class='ri-delete-bin-6-line'></i>" +
            "</button>"
        ]).node().id = "trSubCat" + id;

    },
    editarPrecioArray(id) {
        this.arrayEscalaPrecios.forEach(escala => {
            if (escala.id == id) {
                this.mdlAgregarEscalaPrecio().then(() => {
                    document.getElementById("hdnIdPrecio").value = escala.id;
                    document.getElementById("txtPrecio").value = escala.precio;
                    document.getElementById("txtComisionPrecio").value = escala.comision;
                })
            }
        })
    },
    eliminarPrecioArray(idRow) {
        if (idRow > 0) {
            // eliminamos el item
            this.arrayEscalaPrecios = this.arrayEscalaPrecios.filter(item => {
                console.log("Checking item:", item, "id :" + idRow);
                return item.id !== idRow;
            });
            tblEscalaPrecios.clear();
            tblEscalaPrecios.columns.adjust().draw();

            // Añadir la fila a la tabla y ajustar la vista
            var construirTable = new Promise(resolve => {
                this.arrayEscalaPrecios.forEach(dato => {
                    console.log(dato)
                    this.addRowTablePrecio(dato);
                });
                resolve();
            });

            construirTable.then(() => {
                tblEscalaPrecios.columns.adjust().draw();
                $("#mdlEscalaPrecio").modal("hide");
            });
        }
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
    frmDatos.append('imagen', this.files[0]);
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
