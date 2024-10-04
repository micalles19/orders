var tblAdmCatalogosCliente = "";
window.onload = () => {
    $(".loader").fadeIn("fast");
    sucursal_punto_venta.obtenerDatosSucursal().then(()=>{
        $(".loader").fadeOut("fast");
    })
}

const sucursal_punto_venta ={
    idSucursal : document.getElementById("hdnIdSucursal"),
    obtenerDatosSucursal(){
        return new Promise(resolve => {
            fetchActions.get({
                modulo:"general",
                archivo: "procesarSucursales",
                params:{
                    accion: "obtenerSucursalByIdyEmpresa",
                    id: this.idSucursal.value.trim()
                }
            }).then((respuesta)=>{
                this.construirDatosSucursal(respuesta).then(resolve);
            })
        })
    },
    construirDatosSucursal(respuesta){
        return new Promise(resolve => {
            if (respuesta.mensaje === "EXITO"){
                respuesta.datos.forEach(datos=>{
                    document.getElementById("spnNombreEmpresa").innerText = datos.nombreEmpresa;
                    document.getElementById("spnNit").innerText = datos.nit;
                    document.getElementById("spnSucursal").innerText = datos.nombreSucursal;
                    document.getElementById("spnDireccion").innerText = datos.direccion;
                    document.getElementById("spnTelefono").innerText = datos.telefono;
                    document.getElementById("spnCorreo").innerText = datos.correo;
                })
            }
            resolve();
        })
    }
}