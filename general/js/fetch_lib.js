/*
 * Miguel Calles
 * Copyright (c) 2024.
 */

const fetchActions = {
    set: function ({
                       modulo = '',
                       archivo = '',
                       datos = {}
                   }) {
        return new Promise((resolve, reject) => {
            $(".Preloader").fadeIn("fast");
            (async () => {
                try {
                    let init = {
                            method: "POST",
                            headers: {
                                "Content-type": "application/json",
                            },
                            body: JSON.stringify(datos)
                        },
                        response = await fetch(`./${modulo}/code/${archivo}.php`, init);
                    if (response.ok) {
                        $(".Preloader").fadeOut("fast");
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
                             modulo = '',
                             archivo = '',
                             datos = new FormData()
                         }) {
        return new Promise((resolve, reject) => {
            $(".Preloader").fadeIn("fast");
            (async () => {
                try {

                    let init = {
                            method: "POST",
                            headers: {},
                            body: datos
                        },
                        response = await fetch(`./${modulo}/code/${archivo}.php`, init);
                    if (response.ok) {
                        $(".Preloader").fadeOut("fast");
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
                       modulo = '',
                       archivo = null,
                       params = {}
                   }) {
        return new Promise((resolve, reject) => {
            (async () => {
                try {
                    $(".Preloader").fadeIn("fast");
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
                        response = await fetch(`./${modulo}/code/${archivo}.php?${urlParams.join("&")}`, init);
                    if (response.ok) {
                        $(".Preloader").fadeOut("fast");
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