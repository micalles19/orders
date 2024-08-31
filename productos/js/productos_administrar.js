var tblProductos;

window.onload = () => {
    productos_administrar.inicializarDatatable().then(() => {
        productos_administrar.obtenerByTable().then(()=>{

        })

    })
}

const productos_administrar ={
    contador:0,
    obtenerByTable(){
        return new Promise(resolve=>{
            fetchActions.get({
                modulo : "productos",
                archivo: "procesarProductos",
                params:{
                    accion: "obtenerByTable"
                }
            }).then((respuesta)=>{
                this.construirTable(respuesta).then(resolve)
            })
        })
    },
    construirTable(productos) {
        return new Promise((resolve, reject) => {
            if (productos.mensaje !== "NO_DATOS") {
                productos.datos.forEach(producto => {
                    this.contador++;
                    this.addRowTable(producto);
                })
            } else {
                this.contador = 0;
                tblProductos.clear();
            }
            tblProductos.columns.adjust().draw();
            resolve();
        })
    },
    addRowTable({idProducto, codigo,imagen,nombre, marca, catalogo, categoria, subCategoria, excento, precioCompraConIva, precioCompraSinIva, valorDescuento, precioVentaSinIva,precioVentaConIva,precioConsumidorFinal, sucursales}) {
        let img = imagen == null ? "no-disponible.jpg" : imagen;
        let sucu = sucursales == null ? " " : sucursales,
            excet = excento === 'S' ? "SI" : "NO";
        tblProductos.row.add([
            codigo,
            "<img className='float-left' src='./productos/images/thumbnails/"+img+"' height='65px' width='65px'>",
            nombre,
            marca,
            catalogo,
            categoria,
            subCategoria,
            excet,
            "$"+ precioCompraSinIva,
            "$"+ precioCompraConIva,
            "$"+ precioVentaSinIva,
            "$"+ precioVentaConIva,
            "$"+ valorDescuento,
            "$"+ precioConsumidorFinal,
            sucu,
            "<button class='btn btn-outline-info btn-sm' type='button' title='Editar' onclick=' productos_administrar.editar(" + idProducto + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</button> " +
            "&nbsp;" +
            "<button class='btn-outline-danger btn-sm' type='button' title='Eliminar' onclick=' productos_administrar.eliminar(" + idProducto + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</button>"
        ]).node().id = "trSubCat";
    },
    editar(id) {
        window.location.href = "?module=productos&page=producto&id=" + btoa(id);
    },
    inicializarDatatable(){
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblProductos").length > 0) {
                    tblProductos = $("#tblProductos").DataTable({
                        dateFormat: 'uk',
                        scrollX: true,
                        fixedHeader: false,
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