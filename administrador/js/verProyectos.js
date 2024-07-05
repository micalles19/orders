var vtlVerProyectos = "";
window.onload = () => {

    verProyectos.inicializarDatatable().then(() => {
        verProyectos.obtenerProyectos().then(()=>{

        })
    })

}
const verProyectos ={
    contador: 0,
    obtenerProyectos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarProyecto",
                params:{
                    accion: "obtenerProyectosByTable"
                }
            }).then((clientes) => {
                this.construirTable(clientes).then(resolve).catch(reject);
            })
        })
    },
    editar(id){
        window.location.href="?page=registrarProyectos&idProyecto="+id;
    },
    eliminar(idProyecto){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetchActions.set({
                    archivo:"procesarProyecto",
                    datos:{
                        idProyecto: idProyecto,
                        accion: "eliminar"
                    }
                }).then((respuesta)=>{
                    if (respuesta == "EXITO") {
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
    construirTable(clientes) {
        return new Promise((resolve, reject) => {
            if (clientes != "NO_DATOS") {
                clientes.forEach(cliente => {
                    this.contador++;
                    this.addRowTable(cliente);
                })
            } else {
                this.contador = 0;
                vtlVerProyectos.clear();
            }
            vtlVerProyectos.columns.adjust().draw();
            resolve();
        })
    },

    addRowTable({id, nombreCliente, nombreProyecto, estadoPago, invoice, precioProyecto, fechaEjecucion}) {
        vtlVerProyectos.row.add([
            this.contador,
            nombreCliente,
            nombreProyecto,
            estadoPago,
            invoice,
            "$ "+parseFloat(precioProyecto),
            fechaEjecucion,

            "&nbsp;" +
            "<span class='btnTbl' type='button' title='Editar' onclick=' verProyectos.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</span> " +
            "&nbsp;" +
            "<span class='btnTbl' type='button' title='Eliminar' onclick=' verProyectos.eliminar(" + id + ");'>" +
            "<i class='fas fa-trash-alt'></i>" +
            "</span>"
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblVerProyectos").length > 0) {
                    vtlVerProyectos = $("#tblVerProyectos").DataTable({
                        dateFormat: 'uk',
                        scrollX: false,
                        scrollY: 350,
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