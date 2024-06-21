window.onload = () => {
    usuario.obtenerRoles().then(() => {
        if (usuario.id.value > 0) {
            usuario.obtenerById().then((respuesta) => {
            })
        }else{
            document.getElementById("divClave").style.display = "none";
        }

    })
}
const usuario = {
    id: document.getElementById("hdnId"),
    nombres: document.getElementById("txtNombres"),
    correo: document.getElementById("txtCorreo"),
    rol: document.getElementById("cboRolUsuario"),
    clave: document.getElementById("txtClave"),

    obtenerById() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarUsuario",
                params: {
                    accion: "obtenerById",
                    id: this.id.value
                }
            }).then((respuesta) => {
                this.construirFormulario(respuesta).then(resolve).catch(mensajesAlertas)
            })
        })
    },
    construirFormulario(respuesta) {
        return new Promise(resolve => {
            if (respuesta.mensaje === "EXITO") {
                let usuario = respuesta.datos[0];
                this.nombres.value = usuario.nombre;
                this.correo.value = usuario.email;
                this.rol.value = usuario.idRol;
                this.clave.value = usuario.claveTemporal;
                resolve();
            } else {
                resolve(respuesta.mensaje);
            }
        })
    },
    guardar() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarUsuario",
                datos: {
                    accion: "guardar",
                    nombres: this.nombres.value.trim(),
                    email: this.correo.value.trim(),
                    clave: this.clave.value.trim(),
                    rol: this.rol.value.trim()
                }
            }).then((respuesta) => {
                resolve(respuesta);
            })
        })
    },
    Actualizar() {
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarUsuario",
                datos: {
                    accion: "actualizar",
                    id: this.id.value.trim(),
                    nombres: this.nombres.value.trim(),
                    apellidos: this.apellidos.value.trim(),
                    puesto: this.puesto.value.trim(),
                    usuario: this.usuario.value.trim(),
                    correo: this.correo.value.trim(),
                    tipoUsuario: this.tipoUsuario.value.trim(),
                    estadoUsuario: this.estadoUsuario.value.trim()
                }
            }).then(resolve)
        })
    },
    obtenerRoles() {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarRoles",
                params: {
                    accion: "obtenerByCbo"
                }
            }).then((respuesta) => {
                generales.construirCbo('cboRolUsuario', respuesta).then(resolve)
            })
        })
    },
    validarCampos() {
        if (validar.InputTextsConClase("validar")) {
            if (validar.formatoEmail(this.correo.value, "txtCorreo")) {
                this.guardar().then((respuesta) => {
                    if (respuesta.mensaje === "EXITO") {
                        fetchActions.set({
                            modulo: "general",
                            archivo: "procesarEmails",
                            datos: {
                                accion: "reestablecerClaveFromAdmin",
                                id: respuesta.id,
                                correo: respuesta.email,
                                nombre: respuesta.nombre,
                                clave: respuesta.clave,
                            }
                        }).then((respuesta2) => {
                            mensajesAlertas(respuesta2);
                        })
                    } else {
                        mensajesAlertas(respuesta);
                    }
                })
            }
        }
    },
    validarCamposUpd() {
        if (validar.InputTextsConClase("validar")) {
            if (validar.formatoEmail(this.correo.value, "txtCorreoReestablecimiento")) {
                this.Actualizar().then((respuesta) => {
                    mensajesAlertas(respuesta)
                })

            }
        }
    },
    cambiarClave() {
        if (validar.formatoEmail(this.correo.value, this.correo.id)) {
            Swal.fire({
                title: "¿Enviar Clave Temporal?",
                text: "Se enviará una clave al correo de reestablecimiento de un solo uso",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Reestablecer"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(".Preloader").fadeIn("fast");
                    fetchActions.set({
                        modulo: "general",
                        archivo: "procesarEmails",
                        datos: {
                            accion: "reestablecerClaveFromAdmin",
                            id: this.id.value.trim(),
                            correo: this.correo.value.trim(),
                            nombre: this.nombres.value.trim()
                        }
                    }).then((respuesta) => {
                        $(".Preloader").fadeOut("fast");
                        mensajesAlertas(respuesta);
                    })
                }
            });
        } else {
            Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Ingrese un Email válido",
                text: "El formato de email es incorrecto, por favor validar.",
                showConfirmButton: false,
                timer: 1500
            });
        }

    }
}