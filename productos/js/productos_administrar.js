var tblProductos;

window.onload = () => {
    productos_administrar.inicializarDatatable().then(() => {


    })
}

const productos_administrar ={

    inicializarDatatable(){
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblProductos").length > 0) {
                    tblProductos = $("#tblProductos").DataTable({
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