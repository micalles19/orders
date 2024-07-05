// $(document).ready(function(){
//     $(".pace-activity").css("display", "none")
//     $(".pace-progress").css("display", "none")
// )}
$(document).ready(function () {
    $(".pace-activity").css("display", "none")
    $(".pace-progress").css("display", "none")
});
function generalCalcularTotal() {
    let cantidad = document.getElementById("txtCantidadBulto").value,
        precioBulto = document.getElementById("hdnPrecioBulto").value;
    console.log(cantidad)
    console.log(precioBulto)
    let totalBultos = cantidad * precioBulto;
    console.log(totalBultos)
    document.getElementById("spnPrecioTotal").innerText = totalBultos.toFixed(2);
    document.getElementById("hdnTotalBultos").value = totalBultos.toFixed(2);
}

function cerrarSesion() {

    let init = {
            method: "POST",
            headers: {
                "Content-type": "application/json"
            },
        },
        response = fetch(`./code/cerrarSesion.php`, init);

    if (response.ok) {
        window.top.location.reload();
    }
    window.top.location.reload();
}

function validarEmail(valor) {
    let re = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
    if (!re.exec(valor)) {
        return false;
    }
    return true;
}

// $('.soloNumeros').on('input', function () {
//     this.value = this.value.replace(/[^0-9,.]/g, '');
// });
function validarNumeros(event) {
    const teclaPresionada = event.key;
    const inputNumero = event.target;
    const valorActual = inputNumero.value;
    const regexNumero = /^-?\d*(\.\d+)?$/;

    if (teclaPresionada.match(/[0-9\.,]/) !== null) {
        // Si la tecla presionada es un número o un punto decimal
        const nuevoValor = valorActual + teclaPresionada;
        if (regexNumero.test(nuevoValor)) {
            // Si el nuevo valor es un número válido
            return true; // Permitir la entrada
        }
    } else if (teclaPresionada === "Backspace") {
        // Si la tecla presionada es el botón de retroceso
        const nuevoValor = valorActual.slice(0, -1); // Eliminar el último carácter
        if (regexNumero.test(nuevoValor)) {
            // Si el nuevo valor es un número válido
            return true; // Permitir la entrada
        }
    }

    // Si no se permitió la entrada
    event.preventDefault();
    return false;
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function generalConstruirCbo(nombreCbo, objDatos) {
    return new Promise((resolve, reject) => {
        document.getElementById(nombreCbo).innerHTML = "";
        document.getElementById(nombreCbo).innerHTML += "<option value='0' selected disabled>Seleccione</option>";
        if (objDatos.mensaje === "EXITO") {
            objDatos.datos.forEach(dato => {
                document.getElementById(nombreCbo).innerHTML += "<option value='" + dato.id + "'>" + dato.nombre + "</option>";
            })
        }
        document.getElementById(nombreCbo).value = 0;
        resolve();
    })
}

function generalMostrarError(error = {}) {
    $(".pace-activity").fadeOut("fast");
    $(".pace-progress").fadeOut("fast");
    console.error(error);
    if (typeof error == 'object') {
        if (error.mensaje) {
            switch (error.mensaje.trim()) {
                case "SESION":
                    Swal.fire({
                        title: "Sesión caducada",
                        icon: "warning",
                        html: "Parece que tu sesión caducó o se ha iniciado en otro equipo. <br />¿Deseas intentar recuperarla?",
                        showCloseButton: false,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Recuperar',
                        cancelButtonText: '<i class="fa fa-thumbs-down"></i> Salir',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#mdlRecoverySesion").modal("show");
                        } else {
                            userActions.cancelRecoverySession();
                        }
                    });
                    break;
                case 'NO_USUARIO':
                    Swal.fire({
                        title: "¡Atencion!",
                        text: "Usuario o contraseña incorrectos",
                        icon: "warning",
                        confirmButtonText: 'Aceptar',
                        showCancelButton: false,
                    });
                    break;
                case 'EXITO':
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Registrado Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    })
                    break;
                case 'CODIGO_EXISTE':
                    Swal.fire({
                        title: "¡Código existe!",
                        text: "El código ya se encuentra asignado a otro producto",
                        icon: "info",
                        confirmButtonText: 'Aceptar',
                        showCancelButton: false,
                    })
                    break;
                case 'ADD_ITEM':
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Agregado al carrito Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    })
                    break;
                case 'NEW_ITEM':
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Agregado al carrito Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    })
                    break;
                case 'EDIT_ITEM':
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cantidad Actualizada Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    })
                    break;
                    case 'ELIMINADO':
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Eliminado Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    })
                    break;
                    case 'ORDEN_CANCELADA':
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Orden Eliminada Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    })
                    break;
                default:
                    Swal.fire({
                        title: "¡Error!",
                        html: "Ha ocurrido un error catálogado. " + error.mensaje,
                        icon: "error"
                    });
                    break;
            }
        } else {
            Swal.fire({
                title: "¡Error!",
                html: "Ha ocurrido un error no controlado",
                icon: "error"
            });
        }
    } else {
        switch (error) {
            case 'NO_USUARIO':
                Swal.fire({
                    title: "¡Atencion!",
                    text: "Usuario o contraseña incorrectos",
                    icon: "warning",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
                case 'FORMATO_EMAIL_INVALIDO':
                Swal.fire({
                    title: "¡Atencion!",
                    text: "El formato de correo es incorrecto",
                    icon: "warning",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'SIN_TOTAL_MINIMO':
                Swal.fire({
                    title: "¡Información!",
                    text: "el total minimo a comprar es $1.00",
                    icon: "info",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
                case 'SIN_COMPROBANTE':
                Swal.fire({
                    title: "¡Información!",
                    text: "Seleccione el comprobante que requerirá",
                    icon: "info",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
                case 'METODO_PAGO':
                Swal.fire({
                    title: "¡Información!",
                    text: "Seleccione el Método de pago",
                    icon: "info",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'CAMPOS_INCOMPLETOS':
                Swal.fire({
                    title: "¡Información!",
                    text: "Se han detectado campos incompletos",
                    icon: "info",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'ERROR_GENERAL':
                Swal.fire({
                    title: "¡Atención!",
                    text: "Ocurrió un error intente nuevamente",
                    icon: "error",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'REGISTRO_LOG':
                Swal.fire({
                    title: "¡Atención!",
                    text: "Ocurrió un error controlado, revise que todo este correcto y vuelva a intentarlo",
                    icon: "info",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'GENERAL_ERROR':
                Swal.fire({
                    title: "¡Atención!",
                    text: "Por favor informar sobre este error al área de TI",
                    icon: "error",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'COMPLETAR_CAMPOS':
                Swal.fire({
                    title: "¡Atención!",
                    text: "Por favor Completar los campos",
                    icon: "info",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'REPORTERIA':
                Swal.fire({
                    title: "¡Ups!",
                    text: "Ocurrio un error al general el reporte favor refresque la pagina e intentelo nuevamente",
                    icon: "error",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'COMPLETAR_FECHAS':
                Swal.fire({
                    title: "¡Atención!",
                    text: "Por seleccione las fechas inicio y fin a buscar",
                    icon: "info",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'GENERAR_BUSQUEDA':
                Swal.fire({
                    title: "¡Atención!",
                    text: "Falta informacion para exportar, intente buscar informacion en otras fechas",
                    icon: "info",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
            case 'SIN_DATOS_SEARCH':
                Swal.fire({
                    title: "¡Atención!",
                    text: "Lo sentimos pero se han encontrado datos bajo las fechas seleccionadas",
                    icon: "warning",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
                case 'ACTUALIZADO':
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Actualizado Exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    })
                break;
            default:
                Swal.fire({
                    title: "¡Ha ocurrido un error interno!",
                    text: "Contactarse con soporte: " + error,
                    icon: "error",
                    confirmButtonText: 'Aceptar',
                    showCancelButton: false,
                });
                break;
        }

    }

}

const fetchActions = {
    set: function ({
                       archivo = '',
                       datos = {}
                   }) {
        return new Promise((resolve, reject) => {
            $(".preloader").fadeIn("fast");
            (async () => {
                try {
                    let init = {
                            method: "POST",
                            headers: {
                                "Content-type": "application/json",
                            },
                            body: JSON.stringify(datos)
                        },
                        response = await fetch(`./code/${archivo}.php`, init);
                    if (response.ok) {
                        $(".preloader").fadeOut("fast");
                        let datosRespuesta = await response.json();
                        resolve(datosRespuesta);
                    } else {
                        reject(response.statusText);
                    }
                } catch (err) {
                    reject(err.message);
                }
            })();
        });
    },
    getCats: function ({
                           archivo = null,
                           solicitados = []
                       }) {
        return new Promise((resolve, reject) => {
            (async () => {
                try {
                    $(".preloader").fadeIn("fast");
                    let init = {
                            method: "GET",
                            headers: {
                                "Content-type": "application/json"
                            }
                        },
                        response = await fetch(`./code/${archivo}.php?q=${solicitados.join("@@@")}`, init);
                    if (response.ok) {
                        $(".preloader").fadeOut("fast");
                        let datosRespuesta = await response.json();
                        resolve(datosRespuesta);
                    } else {
                        reject(response.statusText);
                    }
                } catch (err) {
                    reject(err.message);
                }
            })();
        });
    },
    setWFiles: function ({
                             archivo = '',
                             datos = new FormData()
                         }) {
        return new Promise((resolve, reject) => {
            $(".preloader").fadeIn("fast");
            (async () => {
                try {

                    let init = {
                            method: "POST",
                            headers: {},
                            body: datos
                        },
                        response = await fetch(`./code/${archivo}.php`, init);
                    if (response.ok) {
                        $(".preloader").fadeOut("fast");
                        let datosRespuesta = await response.json();
                        resolve(datosRespuesta);
                    } else {
                        reject(response.statusText);
                    }
                } catch (err) {
                    reject(err.message);
                }
            })();
        });
    },
    get: function ({
                       archivo = null,
                       params = {}
                   }) {
        return new Promise((resolve, reject) => {
            (async () => {
                try {
                    $(".pace-activity").fadeIn("fast");
                    let urlParams = [];
                    for (let key in params) {
                        urlParams.push(`${key}=${params[key]}`);
                    }
                    let init = {
                            method: "GET",
                            headers: {
                                "Content-type": "application/json"
                            }
                        },
                        response = await fetch(`./code/${archivo}.php?${urlParams.join("&")}`, init);
                    if (response.ok) {
                        $(".pace-activity").fadeOut("fast");
                        let datosRespuesta = await response.json();
                        // console.log(datosRespuesta);
                        resolve(datosRespuesta);
                    } else {
                        reject(response.statusText);
                    }
                } catch (err) {
                    reject(err.message);
                }
            })();
        });
    },
};