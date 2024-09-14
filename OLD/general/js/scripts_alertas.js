/*
 * Miguel Calles
 * Copyright (c) 2024.
 */


function mensajesAlertas(error = {}) {
    console.error(error);
    if (typeof error == 'object') {
        switch (error.mensaje.trim()) {
            case "EXITO":
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro ingresado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.reload();
                })
                break;

            case "SESSION_DEAD":
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Su sesión Murió',
                    showConfirmButton: false,
                    timer: 3500
                }).then((result) => {

                })
                break;
            case "EXITO_REDIR":
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Ingresado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    let valorF = btoa(error.valor);
                    let modulo = typeof error.modulo !== 'undefined' ? '&module=' + error.modulo : "";
                    location.href = "?page=" + error.pagina + "&" + error.parametro + "=" + valorF + modulo;
                })
                break;
            case "EXITO_TAG":
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Ingresado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    let modulo = typeof error.modulo !== 'undefined' ? '&module=' + error.modulo : "",
                        parametro1 = typeof error.parametro !== 'undefined' ? "&" + error.parametro + "=" + btoa(error.valor) : "",
                        parametro2 = typeof error.parametro2 !== 'undefined' ? "&" + error.parametro2 + "=" + btoa(error.valor2) : "",
                        parametro3 = typeof error.parametro3 !== 'undefined' ? "&" + error.parametro3 + "=" + btoa(error.valor3) : "";

                    location.href = "?" + modulo + "&page=" + error.pagina + "" + parametro1 + "" + parametro2 + "" + parametro3;
                })
                break;
            case "EXITO_TAG_SIN_ALERT":
                let modulo = typeof error.modulo !== 'undefined' ? '&module=' + error.modulo : "",
                    parametro1 = typeof error.parametro !== 'undefined' ? "&" + error.parametro + "=" + btoa(error.valor) : "",
                    parametro2 = typeof error.parametro2 !== 'undefined' ? "&" + error.parametro2 + "=" + btoa(error.valor2) : "",
                    parametro3 = typeof error.parametro3 !== 'undefined' ? "&" + error.parametro3 + "=" + btoa(error.valor3) : "";
                location.href = "?" + modulo + "&page=" + error.pagina + "" + parametro1 + "" + parametro2 + "" + parametro3;
                break;
            case "EXITO_DELETE":
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro Eliminado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.reload();
                })
                break;
            case "EMAIL_ENVIADO":
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Email enviado correctamente',
                    showConfirmButton: false,
                    timer: 4500
                }).then((result) => {
                    location.reload();
                })
                break;
            case "EMAIL_ERROR":
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Contacte al Adminsitrador',
                    text: 'Codigo de error: ' + error.info,
                    showConfirmButton: true,
                }).then((result) => {

                })
                break;

            case "CLAVE_ACTUALIZADA":
                Swal.fire({
                    position: 'top-end',
                    icon: "success",
                    title: "Contraseña Actualizada",
                    text: "Ahora puedes iniciar sesión con tu nueva clave",
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.reload();
                })
                break;
            case "USUARIO_BLOQUEADO_LOGIN":
                Swal.fire({
                    position: 'top-end',
                    icon: "warning",
                    title: "Usuario Bloqueado",
                    text: "Se ha bloqueado el acceso a la aplicación",
                    showConfirmButton: false,
                    timer: 4000
                }).then()
                break;
            case "USUARIO_EXISTE":
                Swal.fire({
                    title: 'Upss!',
                    text: "El nombre de usuario ya existe",
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok'
                })
                break;
            case "USUARIO_NO_EXISTE":
                Swal.fire({
                    title: 'Upss!',
                    text: "El nombre de usuario no existe",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok'
                })
                break;
            case "REGISTRO_EXISTE":
                Swal.fire({
                    title: 'Upss!',
                    text: "Los datos ingresados ya se encuentran en nuestra base de datos, por favor valide los campos: " + error.datos,
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok'
                })
                break;
            case "USUARIO_BLOQUEADO":
                Swal.fire({
                    position: 'top-end',
                    title: 'Usuario Bloqueado Correctamente!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.reload()
                })
                break;


            case "INICIAR_SESION":
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Iniciando sesión',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.href = "?page=home"
                })
                break;
            case "USUARIO_CLAVE_INCORRECTO":
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Usuario o contraseña inválido',
                    showConfirmButton: false,
                    timer: 1500
                })
                break;
            case 'VALIDACION_GENERAL':
                Swal.fire({
                    position: 'top-end',
                    icon: "info",
                    title: "Se han detectado campos incompletos",
                    showConfirmButton: false,
                    timer: 1500
                });
                break;

            case 'SIN_PERMISOS':
                Swal.fire({
                    position: 'top-end',
                    icon: "error",
                    title: "Acceso Denegado",
                    text: "No posees los permisos suficientes para realizar esta acción",
                    showConfirmButton: false,
                    timer: 5000
                }).then((result) => {
                    location.href = "?module=hga&page=adm_herramienta_tecnica"
                })
                break;
            case 'REGISTRO_LOG':
                Swal.fire({
                    title: 'Upss!',
                    text: "Ocurrió un error contacte a soporte y brinde el siguiente ID:" + error.idLog,
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok'
                })
                break;
            default:
                Swal.fire({
                    title: 'Upss!',
                    text: "Error Fatal, contacte a soporte y brinde las acciones que dieron este error",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok'
                })
                break;
        }
    } else {
        switch (error) {
            case "EXITO":
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Registro ingresado Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.reload();
                })
                break;
            case "INICIAR_SESION":
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Iniciando sesión',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.href = "?page=home"
                })
                break;

            case 'USUARIO_BLOQUEADO':
                Swal.fire({
                    position: 'top-end',
                    icon: "warning",
                    title: "Tu usuario se ha deshabilitado, contactate con el administrador.",
                    showConfirmButton: false,
                    timer: 1500
                });
                break;
            case "USUARIO_EXISTE":
                Swal.fire({
                    title: 'Upss!',
                    text: "El nombre de usuario ya existe",
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ok'
                })
                break;
            case 'VALIDACION_GENERAL':
                Swal.fire({
                    position: 'top-end',
                    icon: "info",
                    title: "Se han detectado campos incompletos",
                    showConfirmButton: false,
                    timer: 1500
                });
                break;
            case 'CONFIGURAR_PRECIOS':
                Swal.fire({
                    position: 'top-end',
                    icon: "info",
                    title: "Debes de configurar los precios",
                    showConfirmButton: false,
                    timer: 1500
                });
                break;
            default:
                alert(error);
                break;
        }
    }
}