var tblVerProyectosEspecificos = "";
window.onload = () => {
    if (proveedores.idProveedor !== 0) {
        proveedores.obtener().then(() => {
        })
    }

}


const proveedores = {
    contador: 0,
    idProveedor: document.getElementById("txtProveedor").value.trim(),

    obtener() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarProveedor",
                params: {
                    accion: "obtenerById",
                    idProveedor: this.idProveedor
                }
            }).then((proveedor) => {
                console.log(proveedor)
                // this.construirCliente(cliente).then(resolve).catch(reject);
            })
        })
    },
    construirCliente(cliente) {
        return new Promise((resolve, reject) => {
            if (cliente !== "NO_DATOS") {

                document.getElementById("txtNombre").value = cliente[0]["nombres"];
                document.getElementById("txtApellidos").value = cliente[0]["apellidos"];
                document.getElementById("txtEmail").value = cliente[0]["email"];
                document.getElementById("txtNumeroContacto").value = cliente[0]["telefono"];
                document.getElementById("txtDireccion").value = cliente[0]["direccion"];
                resolve();
            }
        })
    },
    actualizar() {
        fetchActions.set({
            archivo: "procesarClientes",
            datos: {
                accion: "actualizar",
                idCliente: this.idCliente,
                nombres: document.getElementById("txtNombre").value.trim(),
                apellidos: document.getElementById("txtApellidos").value.trim(),
                telefono: document.getElementById("txtNumeroContacto").value.trim(),
                email: document.getElementById("txtEmail").value.trim(),
                direccion: document.getElementById("txtDireccion").value.trim()
            }
        }).then((resultado) => {
            if (resultado == "EXITO") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Actualizado Exitosamente',
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
    guardar() {

        fetchActions.set({
            archivo: "procesarProveedor",
            datos: {
                accion: "guardar",
                nombres: document.getElementById("txtNombre").value.trim(),
                idTipoCliente: document.getElementById("cboTipoCliente").value,
                email: document.getElementById("txtEmail").value.trim(),
                telefono: document.getElementById("txtNumeroContacto").value.trim(),
                direccion: document.getElementById("txtDireccion").value.trim()
            }
        }).then((resultado) => {
            if (resultado === "EXITO") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Agregado Exitosamente',
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
    obtenerProyectosByIdCliente() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarProyecto",
                params: {
                    accion: "obtenerProyectosByTableIdCliente",
                    idCliente: this.idCliente
                }
            }).then((clientes) => {
                this.construirTable(clientes).then(resolve).catch(reject);
            })
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
                tblVerProyectosEspecificos.clear();
            }
            tblVerProyectosEspecificos.columns.adjust().draw();
            resolve();
        })
    },

    addRowTable({id, nombreCliente, nombreProyecto, estadoPago, invoice, precioProyecto, fechaEjecucion}) {
        tblVerProyectosEspecificos.row.add([
            this.contador,
            nombreCliente,
            nombreProyecto,
            estadoPago,
            invoice,
            "$ " + parseFloat(precioProyecto),
            fechaEjecucion
        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblVerProyectosEspecificos").length > 0) {
                    tblVerProyectosEspecificos = $("#tblVerProyectosEspecificos").DataTable({
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