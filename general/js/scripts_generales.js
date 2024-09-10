!(function () {
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({
            visible: true,
            api: true
        }).columns.adjust();
    });
    document.addEventListener("resize", () => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true,
            })
            .columns.adjust();
    });

})();

const generales = {
    obtenerDepartamentos(nombreCbo) {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarDepartamentos",
                params: {
                    accion: "obtener"
                }
            }).then((respuesta) => {
                this.construirCbo(nombreCbo, respuesta).then(resolve)
            })
        })
    },
    obtenerMunicipiosByDepartamento(nombreCbo, idDepartamento) {
        return new Promise(resolve => {
            fetchActions.get({
                modulo: "general",
                archivo: "procesarMunicipios",
                params: {
                    accion: "obtener",
                    idDepartamento: idDepartamento
                }
            }).then((respuesta) => {
                this.construirCbo(nombreCbo, respuesta).then(resolve)
            })
        })
    },
    construirCbo(nombreCbo, objDatos) {
        return new Promise(Resolve => {
            document.getElementById(nombreCbo).innerHTML = "";
            document.getElementById(nombreCbo).innerHTML += "<option value='' selected disabled>Seleccione</option>";
            if (objDatos.mensaje === "EXITO") {
                objDatos.datos.forEach(dato => {
                    document.getElementById(nombreCbo).innerHTML += "<option value='" + dato.id + "'>" + dato.nombre + "</option>";
                })
            }
            document.getElementById(nombreCbo).value = '';
            Resolve();
        })
    },
    construirCboMultiple(nombreCbo, objDatos) {
        return new Promise(Resolve => {
            if (objDatos.mensaje === "EXITO") {
                objDatos.datos.forEach(dato => {
                    document.getElementById(nombreCbo).innerHTML += "<option value='" + dato.id + "'>" + dato.nombre + "</option>";
                })
            }
            Resolve();
        })
    },
    construirCboTodos(nombreCbo, objDatos) {
        return new Promise(Resolve => {
            document.getElementById(nombreCbo).innerHTML = "";
            document.getElementById(nombreCbo).innerHTML += "<option value='all' selected >Todos</option>";
            if (objDatos.mensaje === "EXITO") {
                objDatos.datos.forEach(dato => {
                    document.getElementById(nombreCbo).innerHTML += "<option value='" + dato.id + "'>" + dato.nombre + "</option>";
                })
            }
            document.getElementById(nombreCbo).value = 'all';
            Resolve();
        })
    },
    construirCboDefault(nombreCbo, objDatos) {
        return new Promise(Resolve => {
            document.getElementById(nombreCbo).innerHTML = "";
            document.getElementById(nombreCbo).innerHTML += "<option value='null' selected >No Aplica</option>";
            if (objDatos.mensaje === "EXITO") {
                objDatos.datos.forEach(dato => {
                    document.getElementById(nombreCbo).innerHTML += "<option value='" + dato.id + "'>" + dato.nombre + "</option>";
                })
            }
            document.getElementById(nombreCbo).value = 'null';
            Resolve();
        })
    },
    construirCboSP(nombreCbo, objDatos) {
        document.getElementById(nombreCbo).innerHTML = "";
        document.getElementById(nombreCbo).innerHTML += "<option value='' selected disabled>Seleccione</option>";
        if (objDatos.mensaje === "EXITO") {
            for (let id in objDatos.datos) {
                let nombre = objDatos.datos[id];
                document.getElementById(nombreCbo).innerHTML += "<option value='" + id + "'>" + nombre + "</option>";
            }
        }
        document.getElementById(nombreCbo).value = '';
    },
    cerrarSesion() {
        fetchActions.get({
            modulo: "general",
            archivo: "procesarUsuario",
            params: {
                accion: "cerrarSesion"
            }
        }).then(() => {
            location.reload();
        })
    },
    atras(modulo, pagina) {
        location.href = "?module=" + modulo + "&page=" + pagina;
    },
    redir(modulo, pagina) {
        self.location.href = "?module=" + modulo + "&page=" + pagina;
    },
    redir1Param(modulo, pagina,value,param) {
        self.location.href = "?module=" + modulo + "&page=" + pagina+"&"+value+"="+param;
    },
    formatearDecimalesComasPuntos(number) {
        if (number === '' || isNaN(number)) {
            return '0'; // Si es una cadena vacía o no es un número, devuelve '0'
        }

        const parts = Number(number).toFixed(2).toString().split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.join('.');
    },
    fillArrayWithZeros(array) {
        while (array.length < 12) {
            array.push(0);
        }
        return array;
    },
    calcularConsumoPromedioArray(arr) {
        // Verificar si los elementos son cadenas y convertirlos a números si es necesario
        const numeros = arr.map(valor => {
            // Verificar si el valor es una cadena
            if (typeof valor === 'string') {
                // Intentar convertir la cadena a número
                const numero = parseFloat(valor);
                // Verificar si la conversión fue exitosa
                if (!isNaN(numero)) {
                    return numero;
                }
            }
            // Si no es una cadena o no se pudo convertir, devolver el valor original
            return valor;
        });

        // Suma de todos los valores
        const total = numeros.reduce((acc, valor) => acc + valor, 0);

        // Calculando el promedio
        const promedio = total / numeros.length;

        return promedio;
    },
    moverTab(id) {
        console.log(id);
        document.getElementById(id + "-tab").click();
    },

}

const validar = {
    letrasNumerosPunto() {
        let validar = document.querySelectorAll(".letrasNumerosPunto");
        inputs.forEach(function (input) {
            var valor = input.value;

            if (validarCadena(valor)) {
                console.log(`El valor "${valor}" es válido.`);
            } else {
                console.log(`El valor "${valor}" no es válido.`);
                // Puedes realizar acciones adicionales aquí, como mostrar un mensaje de error.
            }
        });
    },
    cadena(cadena) {
        let expresionRegular = /^[a-zA-Z0-9.]+$/;
        return expresionRegular.test(cadena);
    },
    esNumeroEntero(event, input) {
        const numeroInput = document.getElementById(input);
        const valorInput = numeroInput.value;

        // Elimina cualquier carácter que no sea un número entero
        numeroInput.value = valorInput.replace(/\D/g, '');
    },
    esNumeroDecimal(event, input) {
        const numeroInput = document.getElementById(input);
        const valorInput = numeroInput.value;

        // Verifica si hay más de un punto decimal
        const puntos = valorInput.split('.').length - 1;

        // Permite solo números y un punto decimal, y asegura que solo haya un punto
        numeroInput.value = valorInput.replace(/[^0-9.]/g, '');

        if (puntos > 1) {
            // Si hay más de un punto, elimina los adicionales
            numeroInput.value = valorInput.substr(0, valorInput.lastIndexOf('.'));
        }
    },
    complejidadClave(clave) {
        if (clave.length < 6) {
            document.getElementById("spnClave").innerHTML = "El Minimo de  caracteres es 6";
            $("#spnClave").fadeIn("fast");
            return false;
        }
        // Al menos una letra minúscula
        if (!/[a-z]/.test(clave)) {
            document.getElementById("spnClave").innerHTML = "La clave debe llevar almenos una letra Minúscula";
            $("#spnClave").fadeIn("fast");
            return false;
        }
        // Al menos una letra mayúscula
        if (!/[A-Z]/.test(clave)) {
            document.getElementById("spnClave").innerHTML = "La clave debe llevar almenos una letra Mayúscula";
            $("#spnClave").fadeIn("fast");
            return false;
        }
        // Al menos un número
        if (!/\d/.test(clave)) {
            document.getElementById("spnClave").innerHTML = "La clave debe llevar almenos un número";
            $("#spnClave").fadeIn("fast");
            return false;
        }
        // Si se pasan todas las validaciones, la contraseña es válida
        return true;
    },
    InputTextsConClase(clase) {
        $(".invalid-feedback").fadeOut("fast");
        let validador = true,
            camposValidar = document.querySelectorAll("." + clase);
        camposValidar.forEach(campo => {

            if (campo.value.length === 0 || campo.value.trim() === 0) {
                console.log(campo.id)
                $("#" + campo.id).parent().find(".invalid-feedback").fadeIn("fast");
                validador = false;
            }
        })
        console.log(validador)
        return validador;
    },
    limpiarInputs(clase) {
        return new Promise(resolve => {
            let camposValidar = document.querySelectorAll("." + clase);
            camposValidar.forEach(campo => {
                  campo.value="";
            });
            resolve();
        })
    },
    formatoEmail(valor, idCampo) {
        if (valor.length > 0) {
            let re = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
            if (!re.exec(valor)) {
                console.log(valor)
                $("#" + idCampo).parent().find(".invalid-feedback").fadeIn("fast");
                return false;
            }
        }
        return true;
    },
    statusRadioButton(rbOpcion1, rbOpcion2) {
    const rbExentoSi = document.getElementById(rbOpcion1);
    const rbExentoNo = document.getElementById(rbOpcion2);
        if (rbExentoSi.checked) {
            return true;
        } else if (rbExentoNo.checked) {
           return true;
        } else {
            console.log("esta dando false el radio" +rbExentoSi.id)
            $("#" + rbExentoSi.id).parent().parent().find(".invalid-feedback").fadeIn("fast");
            return false;
        }
}
};


function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
