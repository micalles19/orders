window.onload = () => {
    if (usuarios.id > 0){
        usuarios.obtenerUsuarioById().then();
    }
}

const usuarios = {
    id:document.getElementById("txtIdUsuario").value,
    nombre: document.getElementById("txtNombre"),
    correo: document.getElementById('txtEmail'),
    clave: document.getElementById('txtClave'),
    obtenerUsuarioById(){
        return new Promise((resolve,reject)=>{
            fetchActions.get({
                archivo: "procesarInicioSesion",
                params:{
                    accion: "obtenerUsuarioById",
                    idUsuario : this.id
                }
            }).then((usuario)=>{
                document.getElementById("txtNombre").value =  usuario[0]["nombre"];
                document.getElementById("txtEmail").value = usuario[0]["email"];
                resolve();
            })
        })
    },
    validarGuardadoUsuario() {
        if (this.nombre.value.trim() != 0 || this.correo.value.trim().length != 0 || this.clave.value.trim().length != 0) {
            if (validarEmail(this.correo.value)) {
                this.guardarUsuario().then((resultado)=>{
                    if (resultado == "EXITO") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Registro Guardado Exitosamente',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    } else {
                        generalMostrarError(resultado)
                    }
                })
            } else {
                generalMostrarError("FORMATO_EMAIL_INVALIDO");
            }
        } else {
            generalMostrarError("COMPLETAR_CAMPOS")
        }
    },
    guardarUsuario(){
        return new Promise((resolve,reject)=>{
            fetchActions.set({
                archivo:"procesarInicioSesion",
                datos:{
                    accion :"guardar",
                    nombre: this.nombre.value,
                    email : this.correo.value,
                    clave: this.clave.value
                }
            }).then(resolve).catch(reject);
        })
    },
    validarActualizacionUsuario() {
        if (this.nombre.value.trim() != 0 || this.correo.value.trim().length != 0 || this.clave.value.trim().length != 0) {
            if (validarEmail(this.correo.value)) {
                this.actualizar().then((resultado)=>{
                    if (resultado == "EXITO") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Registro Guardado Exitosamente',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    } else {
                        generalMostrarError(resultado)
                    }
                })
            } else {
                generalMostrarError("FORMATO_EMAIL_INVALIDO");
            }
        } else {
            generalMostrarError("COMPLETAR_CAMPOS")
        }
    },
    actualizar(){
        return new Promise((resolve,reject)=>{
            fetchActions.set({
                archivo:"procesarInicioSesion",
                datos:{
                    accion :"actualizar",
                    idUsuario: this.id,
                    nombre: this.nombre.value,
                    email : this.correo.value,
                    clave: this.clave.value
                }
            }).then(resolve).catch(reject);
        })
    },
    validarCampos() {
        if (this.correo.value.trim().length != 0 || this.clave.value.trim().length != 0) {
            if (validarEmail(this.correo.value)) {
                this.iniciarSesion().then((resultado) => {
                    if (resultado.respuesta == "EXITO") {
                        window.location.href = "?page=inicio";
                    } else {
                        generalMostrarError(resultado)
                    }
                })
            } else {
                generalMostrarError("FORMATO_EMAIL_INVALIDO");
            }
        }

    },
    iniciarSesion() {
        return new Promise((resolve, reject) => {
            fetchActions.set({
                archivo: "procesarInicioSesion",
                datos: {
                    accion: "inicioSesion",
                    correo: this.correo.value.trim(),
                    clave: this.clave.value.trim()
                }
            }).then((resultado) => {
                resolve(resultado)
            })

        })

    }
}