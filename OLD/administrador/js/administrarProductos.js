var tblAdmProductos = "";
window.onload = () => {

    administrarProductos.inicializarDatatable().then(() => {
        administrarProductos.obtenerCatalogos().then(() => {

        })
    })

}

const administrarProductos = {
    contador: 0,

    obtenerCatalogos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarProductos",
                params: {
                    accion: "obtenerByTable",
                }
            }).then((objRespuesta) => {
                this.construirTable(objRespuesta).then(resolve)
            })
        })
    },

    construirTable(objRespuesta) {
        return new Promise((resolve, reject) => {
            tblAdmProductos.clear();
            tblAdmProductos.clear().draw();
            if (objRespuesta.mensaje !== "NO_DATOS") {
                objRespuesta.datos.forEach(dato => {
                    this.contador++;
                    this.addRowTable(dato);
                })
            } else {
                this.contador = 0;
                tblAdmProductos.clear();
            }
            tblAdmProductos.columns.adjust().draw();
            resolve();
        })
    },
    editar(id) {
        window.location.href = "?page=producto&id=" + id;
    },
    addRowTable({id,codigoProducto, nombre, imagen,unidadesBulto, precioUnidad, precioTotal, disponible, catalogo, categoria}) {
        let estadoFinal = disponible === "S" ? "SI" : "NO",
            colorBtn = disponible === 'S' ? "btn-warning" : "btn-primary",
            icono = disponible === 'S'? "fa-lock" :"fa-lock-open",
            tittl3 = disponible === 'S' ? " Deshabilitar Producto" : "Habilitar Producto";
        tblAdmProductos.row.add([
            codigoProducto,
            "<img className='float-left' src='./../images/thumbnails/"+imagen+"' height='65px' width='65px'>",
            nombre,
            catalogo,
            categoria,
            unidadesBulto,
            "$ "+ precioUnidad,
            "$ "+ precioTotal,
            estadoFinal,
            "<button class='btn btn-success btn-sm' type='button' title='Editar' onclick=' administrarProductos.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> " +
            "<button class='btn "+colorBtn+" btn-sm' type='button' title='"+tittl3+"' onclick=' administrarProductos.cambiarEstado(" + id + ",`"+disponible+"`);'>" +
            "<i class='fas "+icono+"'></i>" +
            "</button> " +
            "<button class='btn btn-danger btn-sm' type='button' title='Eliminar' onclick=' administrarProductos.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash'></i>" +
            "</button> "
        ]).node().id = "trSubCat";
    },
    cambiarEstado(id,estado){
        fetchActions.set({
            archivo:"procesarProductos",
            datos:{
                accion: "cambiarEstado",
                estado : estado,
                id :id
            }
        }).then((resultado)=>{
            if (resultado.mensaje === "EXITO") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado Exitosamente',
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
    eliminar(id){
        Swal.fire({
            title: 'Estas seguro?',
            text: "Al eliminar este producto, no podras revertirlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    archivo: "procesarProductos",
                    datos: {
                        id: id,
                        accion: "eliminar"
                    }
                }).then((respuesta) => {
                    if (respuesta === "EXITO") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Registro eliminado Exitosamente',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    } else {
                        generalMostrarError(respuesta)
                    }
                })
            }
        })
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblAdmProductos").length > 0) {
                    tblAdmProductos = $("#tblAdmProductos").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 500,
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
