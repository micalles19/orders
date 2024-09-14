document.addEventListener('DOMContentLoaded', function () {
    // Obtener los campos de texto del formulario
    var txtUsuario = document.getElementById('txtUsuario');
    var txtClave = document.getElementById('txtClave');

    // Agregar controlador de eventos al presionar tecla en txtUsuario
    txtUsuario.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evitar el comportamiento predeterminado del Enter (enviar formulario)
            auth.validarInicio(); // Llamar a la función validarInicio
        }
    });

    // Agregar controlador de eventos al presionar tecla en txtClave
    txtClave.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evitar el comportamiento predeterminado del Enter (enviar formulario)
            auth.validarInicio(); // Llamar a la función validarInicio
        }
    });
});

const auth = {

    validarInicio() {
        if (validar.InputTextsConClase("validar")) {
            this.iniciarSesion().then((respuesta) => {
                if (respuesta.mensaje === "INICIAR_SESION"){
                    mensajesAlertas(respuesta);
                }else if(respuesta.mensaje === "CAMBIAR_CLAVE"){
                    document.getElementById("hdnUsuario").value = respuesta.id;
                    $("#divUsuario").fadeOut("fast");
                    $("#divClave").fadeOut("fast");
                    $("#btnIniciarSesion").fadeOut("fast");
                    $("#divClaveNueva").fadeIn("fast");
                    $("#divClaveConf").fadeIn("fast");
                    $("#btnReestablecerClave").fadeIn("fast");
                }else {
                    mensajesAlertas(respuesta);
                }
            })
        } else {
            mensajesAlertas("VALIDACION_GENERAL")
        }
    },
    iniciarSesion() {
        return new Promise((resolve) => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarUsuario",
                datos: {
                    usuario: document.getElementById("txtUsuario").value.trim(),
                    clave: document.getElementById("txtClave").value.trim(),
                    accion: "iniciarSesion"
                }
            }).then((respuesta) => {
                resolve(respuesta);
            })
        })
    },

    validarActualizarClave(){
        let claveNew = document.getElementById("passwordNew").value.trim(),
            claveConf = document.getElementById("passwordConf").value.trim();
        if (validar.InputTextsConClase("validarNew")) {
            if (claveNew === claveConf){
                if (validar.complejidadClave(claveNew)){
                    this.actualizarClave().then(mensajesAlertas)
                }
            }else{
                Swal.fire({
                    position: "top-center",
                    icon: "warning",
                    title: "Las contraseñas no coinciden",
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        }
    },
    actualizarClave(){
        return new Promise(resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarUsuario",
                datos:{
                    accion: "actualizarClave",
                    id : document.getElementById("hdnUsuario").value,
                    clave: document.getElementById("passwordNew").value.trim()
                }
            }).then(resolve)
        })
    },
    solicitudReestablecerClave(){
        $(".loader").fadeIn("fast");
        this.validarUsuarioExiste().then((respuesta)=>{
            $(".loader").fadeOut("fast");
            if (respuesta.mensaje === "EXITO"){
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
                        $(".loader").fadeIn("fast");
                        fetchActions.set({
                            modulo: "general",
                            archivo: "procesarEmails",
                            datos: {
                                accion: "reestablecerClaveFromAdmin",
                                id: respuesta.datos[0].id_usuario,
                                correo: respuesta.datos[0].correo_reestablecimiento,
                                nombre: respuesta.datos[0].nombres
                            }
                        }).then((respuesta) => {
                            $(".loader").fadeOut("fast");
                            mensajesAlertas(respuesta);
                        })
                    }
                });
            }else{
                mensajesAlertas(respuesta)
            }
        })
    },
    validarUsuarioExiste(){
        return new Promise( resolve => {
            fetchActions.set({
                modulo: "general",
                archivo: "procesarUsuario",
                datos: {
                    usuario: document.getElementById("txtUsuario").value.trim(),
                    accion: "validarUsuario"
                }
            }).then((respuesta) => {
                resolve(respuesta);
            })
        })
    }



}



