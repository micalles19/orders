var tblVerUsuarios = "";
window.onload = () => {

    verUsuarios.inicializarDatatable().then(() => {
        verUsuarios.obtenerUsuarios().then(() => {

        })
    })

}
const verUsuarios = {
    contador: 0,
    obtenerUsuarios() {
        return new Promise((resolve, reject) => {
            fetchActions.get({
                archivo: "procesarInicioSesion",
                params: {
                    accion: "obtenerUsuarios"
                }
            }).then((clientes) => {
                this.construirTable(clientes).then(resolve).catch(reject);
            })
        })
    },
    editar(id) {
        window.location.href = "?page=registrarUsuario&idUsuario=" + id;
    },
    cambiarEstado(idUsuario,estado){
      let esta = (estado == 1) ? "S" :"N";
      fetchActions.set({
          archivo:"procesarInicioSesion",
          datos:{
              accion: "cambiarEstado",
              estado : esta,
              idUsuario :idUsuario
          }
      }).then((resultado)=>{
          if (resultado == "EXITO") {
              Swal.fire({
                  position: 'center',
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
    construirTable(usuarios) {
        return new Promise((resolve, reject) => {
            if (usuarios != "NO_DATOS") {
                usuarios.forEach(cliente => {
                    this.contador++;
                    this.addRowTable(cliente);
                })
            } else {
                this.contador = 0;
                tblVerUsuarios.clear();
            }
            tblVerUsuarios.columns.adjust().draw();
            resolve();
        })
    },
    addRowTable({id, nombre, email, bloqueado}) {
        let habilitado = null,
            tittle = null,
            icon = null,
            bloquear =null,
            classs = null;
        if (bloqueado === "N") {
            bloquear =1;
            habilitado = "NO";
            tittle = "bloquear";
            icon ="fa-lock-open";
            classs = "btn btn-outline-danger  btn-sm"
        } else {
            bloquear = 0;
            habilitado = "SI";
            tittle = "Desbloquear";
            icon ="fa-lock";
            classs = "btn btn-outline-info btn-sm"
        }
        tblVerUsuarios.row.add([
            this.contador,
            nombre,
            email,
            habilitado,
            "&nbsp;" +
            "<span class='btn btn-outline-success btn-sm' type='button' title='Editar' onclick=' verUsuarios.editar(" + id + ");'>" +
            "<i class='fas fa-edit'></i>" +
            "</span> " +
            "&nbsp;" +
            "<span class='"+classs+"' type='button' title='"+tittle+"' onclick=' verUsuarios.cambiarEstado(" + id + ","+bloquear+");'>" +
            "<i class='fas "+icon+" '></i>" +
            "</span> "

        ]).node().id = "trSubCat";
    },
    inicializarDatatable() {
        return new Promise((resolve, reject) => {
            try {
                if ($("#tblVerUsuarios").length > 0) {
                    tblVerUsuarios = $("#tblVerUsuarios").DataTable({
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