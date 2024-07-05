window.onload = () => {
    // flatpickr("#datepicker-basic", {defaultDate: new Date})
    proyectos.obtenerClientes().then(() => {
        proyectos.obtenerEstadoPagos().then(() => {
            if (proyectos.idProyecto!=0){
                console.log("aqui");
                proyectos.obtenerProyectoById().then();
            }else{
                console.log("No hay nada");
            }
        })
    })

}

const proyectos = {
    idProyecto: document.getElementById("txtIdProyecto").value,
    guardar(){
        fetchActions.set({
            archivo :"procesarProyecto",
            datos:{
                accion:"guardar",
                idCliente: document.getElementById('cboClientes').value,
                nombreProyecto : document.getElementById("txtNombreProyecto").value,
                invoice : document.getElementById("txtInvoice").value,
                idEstadoPago: document.getElementById("cboEstadoPago").value,
                precio : document.getElementById("txtPrecioProyecto").value.trim(),
                fechaProyecto : document.getElementById("txtFechaEjecucion").value,
                direccionProyecto : document.getElementById("txtDireccion").value.trim(),
                descripcion : document.getElementById("txtDescripcion").value.trim()
            }
        }).then((resultado)=>{
            if (resultado == "EXITO") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Guardado Exitosamente',
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

    actualizar(){
        fetchActions.set({
            archivo :"procesarProyecto",
            datos:{
                accion:"actualizar",
                idProyecto : this.idProyecto.trim(),
                idCliente: document.getElementById('cboClientes').value,
                nombreProyecto : document.getElementById("txtNombreProyecto").value,
                invoice : document.getElementById("txtInvoice").value,
                idEstadoPago: document.getElementById("cboEstadoPago").value,
                precio : document.getElementById("txtPrecioProyecto").value.trim(),
                fechaProyecto : document.getElementById("txtFechaEjecucion").value,
                direccionProyecto : document.getElementById("txtDireccion").value.trim(),
                descripcion : document.getElementById("txtDescripcion").value.trim()
            }
        }).then((resultado)=>{
            if (resultado == "EXITO") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Guardado Exitosamente',
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

    obtenerProyectoById() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarProyecto",
                params: {
                    accion: "obtenerProyectoById",
                    idProyecto: this.idProyecto
                }
            }).then((cliente) => {
                if (cliente!= "NO_DATOS"){
                    document.getElementById("cboClientes").value =cliente[0]["idCliente"];
                    document.getElementById("txtNombreProyecto").value =cliente[0]["nombreProyecto"];
                    document.getElementById("txtInvoice").value = cliente[0]["invoice"];
                    document.getElementById("cboEstadoPago").value = cliente[0]["idEstadoPago"];
                    document.getElementById("txtPrecioProyecto").value = cliente[0]["precioProyecto"];
                    document.getElementById("txtFechaEjecucion").value = cliente[0]["fechaEjecucion"];
                    document.getElementById("txtDireccion").value = cliente[0]["direccion"];
                    document.getElementById("txtDescripcion").value = cliente[0]["descripcionProyecto"]
                }
                resolve();
            })
        })
    },
    obtenerClientes() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarClientes",
                params: {
                    accion: "obtener"
                }
            }).then((cliente) => {
                if (cliente != "NO_DATOS") {
                    cliente.forEach(cliente => {
                        document.getElementById('cboClientes').innerHTML += "<option value='" + cliente.id + "'>" + cliente.nombres + ' ' + cliente.apellidos + "</option>";
                    })
                }
                document.getElementById("cboClientes").value = 0;
                resolve();
            })
        })
    },
    obtenerEstadoPagos() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarEstadosPago",
                params: {
                    accion: "obtener"
                }
            }).then((estados) => {
                if (estados != "NO_DATOS") {
                    estados.forEach(estado => {
                        document.getElementById('cboEstadoPago').innerHTML += "<option value='" + estado.id + "'>" + estado.nombre + "</option>";
                    })
                }
                document.getElementById("cboEstadoPago").value = 0;
                resolve();
            })
        })
    }
}