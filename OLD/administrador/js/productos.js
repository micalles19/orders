frmDatos = new FormData();
window.onload = () => {
    productos.obtenerCatalogos().then(() => {
        productos.obtenerCategorias().then(() => {
            if (productos.id.value.trim() != 0) {
                productos.obtenerbyId().then(() => {

                })
            }
        }).catch(generalMostrarError)
    }).catch(generalMostrarError)


}
const productos = {
    id: document.getElementById("txtId"),
    obtenerbyId() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarProductos",
                params: {
                    accion: "obtenerById",
                    id: this.id.value.trim()
                }
            }).then((respuesta) => {
                if (respuesta.mensaje === "EXITO") {
                    this.construirFormulario(respuesta.datos).then(resolve).catch(reject);
                }
            })
            console.log("Vamos a buscar");
        })

    },
    guardar() {
        frmDatos.append("accion", "guardar")
        frmDatos.append("codigo", document.getElementById("txtCodigo").value.trim())
        frmDatos.append("nombre", document.getElementById("txtNombre").value.trim())
        frmDatos.append("idCatalogo", document.getElementById("cboCatalogo").value.trim())
        frmDatos.append("idCategoria", document.getElementById("cboCategoria").value.trim())
        frmDatos.append("descripcion", document.getElementById("txtDescripcion").value.trim())
        frmDatos.append("unidadesBulto", document.getElementById("txtUnidadesBultos").value.trim())
        frmDatos.append("precioUnidad", document.getElementById("precioUnidad").value.trim())
        frmDatos.append("total", document.getElementById("txtTotalBulto").value.trim())
        fetchActions.setWFiles({
            archivo: "procesarProductos",
            datos: frmDatos
        }).then((respuesta) => {
            console.log(respuesta);
            generalMostrarError(respuesta);
        })

    },
    actualizar() {
        frmDatos.append("accion", "actualizar")
        frmDatos.append("id", this.id.value.trim());
        frmDatos.append("codigo", document.getElementById("txtCodigo").value.trim())
        frmDatos.append("nombre", document.getElementById("txtNombre").value.trim())
        frmDatos.append("idCatalogo", document.getElementById("cboCatalogo").value.trim())
        frmDatos.append("idCategoria", document.getElementById("cboCategoria").value.trim())
        frmDatos.append("descripcion", document.getElementById("txtDescripcion").value.trim())
        frmDatos.append("unidadesBulto", document.getElementById("txtUnidadesBultos").value.trim())
        frmDatos.append("precioUnidad", document.getElementById("precioUnidad").value.trim())
        frmDatos.append("total", document.getElementById("txtTotalBulto").value.trim())
        fetchActions.setWFiles({
            archivo: "procesarProductos",
            datos: frmDatos
        }).then((resultado) => {
            if (resultado.mensaje === "EXITO") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado Correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                    window.location.href = "?page=administrar_productos";
                });
            } else {
                generalMostrarError(resultado.mensaje);
            }
        })
    },

    obtenerCatalogos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarCatalogos",
                params: {
                    accion: "obtenerByCbo",
                }
            }).then((respuesta) => {
                generalConstruirCbo('cboCatalogo', respuesta).then(resolve).catch(reject)
            }).catch(reject)
        })
    },
    obtenerCategorias() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarCategorias",
                params: {
                    accion: "obtenerByCbo",
                }
            }).then((respuesta) => {
                generalConstruirCbo('cboCategoria', respuesta).then(resolve).catch(reject)
            }).catch(reject)
        })
    },
    construirFormulario(datos) {
        return new Promise((resolve, reject) => {
            document.getElementById("txtCodigo").value = datos[0].codigoProducto
            document.getElementById("txtNombre").value = datos[0].nombre
            document.getElementById("cboCatalogo").value = datos[0].idCatalogo
            document.getElementById("cboCategoria").value = datos[0].idCategoria
            document.getElementById("txtDescripcion").value = datos[0].descripcion
            document.getElementById("txtUnidadesBultos").value = datos[0].unidadesBulto
            document.getElementById("precioUnidad").value = datos[0].precioUnidad
            document.getElementById("txtTotalBulto").value = datos[0].precioTotal

            if (datos[0].imagen != null) {


                var bloque = '<li class="small-image-container" id="li_contenedor_imagen_' + datos[0].id + '">\n' +
                    '               <div class="portfolio_item">\n' +
                    '                   <img class="small-image" src="./../images/productos/' + datos[0].imagen + '">\n' +
                    '                   <input type="hidden" id="txt_foto_' + datos[0].id + '" name="file_foto_' + datos[0].id + '" class="name-imagen">' +
                    '                     <button class="delete-button" type="button"  onclick="productos.eliminarImagen(' + datos[0].id + ')" title="Borrar" data-original-title="Borrar">' +
                    '                       <i class="fas fa-trash-alt"></i>' +
                    '                     </button>\n' +
                    '               </div>\n' +
                    '         </li>';
                $("#ulGaleriaImagenes").append(bloque);
            }
            resolve();
        })
    },
    eliminarImagen(idProducto) {
        Swal.fire({
            title: 'Esta seguro de eliminar esta imagen?',
            text: "Los cambios no podran ser revertidos",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    archivo: "procesarProductos",
                    datos: {
                        accion: "eliminarImagen",
                        id: idProducto
                    }
                }).then((respuesta) => {
                    if (respuesta.mensaje === "EXITO") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Eliminado Correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        })
                    } else {
                        generalMostrarError(respuesta);
                    }
                })
            }
        })
    },
    eliminarImagenTemporal(contador) {
        $("#li_contenedor_imagen_" + contador).remove();
    },
    calcularTotal() {
        let unidades = parseFloat(document.getElementById("txtUnidadesBultos").value),
            precioUnitario = parseFloat(document.getElementById("precioUnidad").value);
        var total = unidades * precioUnitario;
        document.getElementById("txtTotalBulto").value = total.toFixed(2);
    }
}

$(document).on('change', '#fileImagenes', function () {
    var contador = parseInt($("#hdnCantidadImagenes").val());

    if (contador < 1) {
        for (var i = 0, f; f = this.files[i]; i++) {
            contador++;
            var img = URL.createObjectURL(this.files[i]);
            var bloque = '<li class="small-image-container" id="li_contenedor_imagen_' + contador + '">\n' +
                '               <div class="portfolio_item">\n' +
                '                   <img class="small-image" src="' + img + '">\n' +
                '                   <input type="hidden" id="txt_foto_' + contador + '" name="file_foto_' + contador + '" class="name-imagen">' +
                '                     <button class="delete-button" type="button"  onclick="productos.eliminarImagenTemporal(' + contador + ')" title="Borrar" data-original-title="Borrar">' +
                '                       <i class="fas fa-trash-alt"></i>' +
                '                     </button>\n' +
                '               </div>\n' +
                '         </li>';
            frmDatos.append('foto[' + contador + ']', this.files[i]);
            $("#ulGaleriaImagenes").append(bloque);
            $("#txt_foto_" + contador).val(this.files[i]["name"]);
        }
        $("#hdnCantidadImagenes").val(contador);

    } else {
        Swal.fire({
            title: "¡Informacion!",
            text: "Lo sentimos pero solo es posible subir 1 imagen",
            icon: "warning"
        });
    }

});